<?php
// FINAL TESTED CODE - Created by Compcentral

// NOTE: currency pairs are reverse of what most exchanges use...
//       For instance, instead of XPM_BTC, use BTC_XPM

class poloniex {
    protected $api_key;
    protected $api_secret;
    protected $trading_url = "https://poloniex.com/tradingApi";
    protected $public_url = "https://poloniex.com/public";

    public function __construct($api_key, $api_secret) {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }

    private function query(array $req = array()) {
        // API settings
        $key = $this->api_key;
        $secret = $this->api_secret;

        // generate a nonce to avoid problems with 32bit systems
        $mt = explode(' ', microtime());
        $req['nonce'] = $mt[1] . substr($mt[0], 2, 6);

        // generate the POST data string
        $post_data = http_build_query($req, '', '&');
        $sign = hash_hmac('sha512', $post_data, $secret);

        // generate the extra headers
        $headers = array(
            'Key: ' . $key,
            'Sign: ' . $sign,
        );

        // curl handle (initialize if required)
        static $ch = null;
        if (is_null($ch)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT,
                'Mozilla/4.0 (compatible; Poloniex PHP bot; ' . php_uname('a') . '; PHP/' . phpversion() . ')'
            );
        }
        curl_setopt($ch, CURLOPT_URL, $this->trading_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // run the query
        $res = curl_exec($ch);

        if ($res === false) throw new Exception('Curl error: ' . curl_error($ch));
        //echo $res;
        $dec = json_decode($res, true);
        if (!$dec) {
            //throw new Exception('Invalid data: '.$res);
            return false;
        } else {
            return $dec;
        }
    }

    protected function retrieveJSON($URL) {
        $opts = array('http' =>
            array(
                'method' => 'GET',
                'timeout' => 10
            )
        );
        $context = stream_context_create($opts);
        $feed = file_get_contents($URL, false, $context);
        $json = json_decode($feed, true);
        return $json;
    }

    public function get_balances() {
        return $this->query(
            array(
                'command' => 'returnBalances'
            )
        );
    }

    public function get_open_orders($pair) {
        return $this->query(
            array(
                'command' => 'returnOpenOrders',
                'currencyPair' => strtoupper($pair)
            )
        );
    }

    public function get_my_trade_history($pair) {
        return $this->query(
            array(
                'command' => 'returnTradeHistory',
                'currencyPair' => strtoupper($pair)
            )
        );
    }

    public function buy($pair, $rate, $amount) {
        return $this->query(
            array(
                'command' => 'buy',
                'currencyPair' => strtoupper($pair),
                'rate' => $rate,
                'amount' => $amount
            )
        );
    }

    public function sell($pair, $rate, $amount) {
        return $this->query(
            array(
                'command' => 'sell',
                'currencyPair' => strtoupper($pair),
                'rate' => $rate,
                'amount' => $amount
            )
        );
    }

    public function cancel_order($pair, $order_number) {
        return $this->query(
            array(
                'command' => 'cancelOrder',
                'currencyPair' => strtoupper($pair),
                'orderNumber' => $order_number
            )
        );
    }

    public function withdraw($currency, $amount, $address) {
        return $this->query(
            array(
                'command' => 'withdraw',
                'currency' => strtoupper($currency),
                'amount' => $amount,
                'address' => $address
            )
        );
    }

    /**
     * Возвращает последние 200 сделок для данного рынка или до 50 000 сделок между диапазоном, указанным в отметках времени UNIX
     * @param $pair
     * @return mixed
     */
    public function get_trade_history($pair, $start = '', $end = '') {

//        если есть время
        if (!empty($start) and !empty($end)) {
            $trades = $this->retrieveJSON(
                $this->public_url
                . '?command=returnTradeHistory&currencyPair='
                . strtoupper($pair)
                . '&start=' . $start
                . '&end=' . $end
            );
            return $trades;
        } else {
//            если нет времени
            $trades = $this->retrieveJSON(
                $this->public_url
                . '?command=returnTradeHistory&currencyPair='
                . strtoupper($pair)
            );
            return $trades;
        }
    }

    /**
     * Возвращает книгу заказов для данного рынка
     * @param $pair
     * @return mixed
     */
    public function get_order_book($pair) {
        $orders = $this->retrieveJSON($this->public_url . '?command=returnOrderBook&currencyPair=' . strtoupper($pair));
        return $orders;
    }

    public function get_volume() {
        $volume = $this->retrieveJSON($this->public_url . '?command=return24hVolume');
        return $volume;
    }

    /**
     * Возвращает тикер для всех рынков.
     * @param string $pair
     * @return array|mixed
     */
    public function get_ticker($pair = "ALL") {
        $pair = strtoupper($pair);
        $prices = $this->retrieveJSON($this->public_url . '?command=returnTicker');
        if ($pair == "ALL") {
            return $prices;
        } else {
            $pair = strtoupper($pair);
            if (isset($prices[$pair])) {
                return $prices[$pair];
            } else {
                return array();
            }
        }
    }

    public function get_trading_pairs() {
        $tickers = $this->retrieveJSON($this->public_url . '?command=returnTicker');
        return array_keys($tickers);
    }

    public function get_total_btc_balance() {
        $balances = $this->get_balances();
        $prices = $this->get_ticker();

        $tot_btc = 0;

        foreach ($balances as $coin => $amount) {
            $pair = "BTC_" . strtoupper($coin);

            // convert coin balances to btc value
            if ($amount > 0) {
                if ($coin != "BTC") {
                    $tot_btc += $amount * $prices[$pair];
                } else {
                    $tot_btc += $amount;
                }
            }

            // process open orders as well
            if ($coin != "BTC") {
                $open_orders = $this->get_open_orders($pair);
                foreach ($open_orders as $order) {
                    if ($order['type'] == 'buy') {
                        $tot_btc += $order['total'];
                    } elseif ($order['type'] == 'sell') {
                        $tot_btc += $order['amount'] * $prices[$pair];
                    }
                }
            }
        }

        return $tot_btc;
    }
}

/**
 * парсер курсов валютных пар
 */

echo '<pre>';

//ман https://poloniex.com/support/api/

$p = new poloniex('', '');

//свой набор пар
$pairs = [
    'BTC_ETC',
    'BTC_ETH',
    'BTC_DASH',
];

//или весь набор пар
$pairs = [];
$get_ticker = $p->get_ticker();
foreach ($get_ticker as $k => $v) {
    $pairs[] = $k;
}

$end = time();
$start = $end - (20 * 60);

//запрос последних 200 сделок для каждой пары
foreach ($pairs as $v) {
    $a3[$v] = $p->get_trade_history($v, $start, $end);
}
//print_r($a3);


$result = [];
foreach ($a3 as $k1 => $v) {

    $count_transaction = count($v);
    if ($count_transaction == 0) {
        continue;
    }

//сколько всего сделок в массиве
    $result[$k1]['count_transaction'] = $count_transaction;

//название пары
    $result[$k1]['pair'] = $k1;

    foreach ($v as $k2 => $v1) {

// начало массива сделок. курс
        if ($k2 == 0) {
            $result[$k1]['first_rate'] = $v1['rate'];
        }

        // TODO брать еще точки в середине. 25%, 50%, 75%

// конец массива сделок. курс
        if ($k2 == $count_transaction - 1) {
            $result[$k1]['last_rate'] = $v1['rate'];
        }

//сколько сделок с покупкой и сколько с продажей
        if ($v1['type'] == 'buy') {
            $result[$k1]['buy'] = $result[$k1]['buy'] + 1;
        }
        if ($v1['type'] == 'sell') {
            $result[$k1]['sell'] = $result[$k1]['sell'] + 1;
        }
    }

//    рост в процентах
    $result[$k1]['growth_persent'] = ($result[$k1]['last_rate'] * 100) / $result[$k1]['first_rate'];

//    рост в абсолютных величинах
    $result[$k1]['growth_absolute'] = $result[$k1]['last_rate'] - $result[$k1]['first_rate'];
}


//print_r($result);

// сортировка по growth_absolute или growth_persent
function myCmp($a, $b) {
    if ($a['growth_persent'] === $b['growth_persent']) return 0;
    return $a['growth_persent'] < $b['growth_persent'] ? 1 : -1;
}

uasort($result, 'myCmp');

?>

    <p>
        Выбираются сделки за последние 20 минут, <?= count($pairs) ?> валютных пар.
    </p>

<?php

foreach ($result as $v) {

//    if ($v['growth_persent'] <= 100) {
//        continue;
//    }

    echo "<a target='_blank' href='https://poloniex.com/exchange#" . $v['pair'] . "'>" . $v['pair'] . "</a>" . '<br>';
    echo 'Сделок ' . $v['count_transaction'] . '<br>';
    echo 'Продаж/Покупок ' . $v['sell'] . '/' . $v['buy'] . '<br>';
    echo 'Курс ' . $v['first_rate'] . '/' . $v['last_rate'] . '<br>';
    echo 'Рост ' . $v['growth_persent'] . '/' . $v['growth_absolute'] . '<hr>';
}