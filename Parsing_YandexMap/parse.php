<?php
// парсинг организаций с Яндекс-Карт по запросам типа "Москва магазины"

require_once 'curl.php';

class Parse {

    public function getdata($phrase) {

        $options = array(

//   'apikey' => '126f6787-5161-4bc0-9c01-5257e9804997', // padishevastanislava
//   'apikey' => '1f4d6d4f-efc5-4770-b00a-b5e67e2d4496', // valcova1972
//   'apikey' => '5fa3ac1f-4ad8-4303-98c6-59dc465ed8cb', // ovsyanikinaviktoriya
//   'apikey' => '50642365-a67f-4d16-a56c-2f61813a5170', // shabanova1986
//   'apikey' => 'c32eb276-ff26-4e9e-aa44-31f1bd9b3563', // ovcina1970
//   'apikey' => 'ce9d9499-31cd-441d-8b8a-87059117f3a4', // pakshinaliya
//   'apikey' => 'c05ead06-402d-4325-854f-eaf1baf0345d', // chabanova1986
//   'apikey' => '91e27164-fe9a-4bd6-b1aa-0021ead28580', // filippova1964
//   'apikey' => 'c76f451b-4b6b-4e70-8ca1-eb940d8bf114', // cvilevavladlena
//   'apikey' => '9f675ffa-01eb-4ff5-9d2f-7a9c0b3db848', // lavrenko1967
//   'apikey' => '45170718-81e7-4d00-95d8-c74486817026', // noskovakseniya
//   'apikey' => 'acf0b68c-7bd9-4598-85c1-3b970756e591', // ydobina1965
//   'apikey' => 'ea665489-231d-4091-992c-5e66a744d658', // savoninavladislava
//   'apikey' => '32acc8f5-33da-46c6-97e8-9923f0280cd4', // jarynaanastasiya
//   'apikey' => '37441a38-479a-4efb-8199-b0596fc26cab', // pavlikovalarisa
            'apikey' => 'fefc030c-e913-4dc3-ae15-abc53e86fb7b', // danilishinastela
//   'apikey' => '943f99e0-41f3-4315-a777-4e8f5c0d02af', // vakorevaalevtina

            'text' => urlencode($phrase),
            'lang' => 'ru_RU',
            'results' => 1000,
            'type' => 'biz',
        );

        $options2 = '';
        foreach ($options as $k => $v) {
            $options2 .= '&' . $k . '=' . $v;
        }

        $url = 'https://search-maps.yandex.ru/v1/?' . $options2;
        $curl = Curl::getpage($url);

        if ($curl['getinfo']['http_code'] != 200) {
            file_put_contents('log.txt', 'код ответа сервера не 200' . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);
            echo('код ответа сервера не 200');
            return;
        }

        $content = json_decode($curl['content']);

        var_dump($content);

        if ($content->status) {
            file_put_contents('log.txt', 'сервис ответил ' . $content->message . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND | LOCK_EX);
            echo('сервис ответил ' . $content->message);
            return;
        }

        $result = array();

        foreach ($content->features as $v) {

            $description = array();
            if (isset($v->properties->CompanyMetaData->Features)) {
                foreach ($v->properties->CompanyMetaData->Features as $v2) {
                    $description[] = $v2->name;
                }
            }

            $result[] = array(
                'place_id' => $v->properties->CompanyMetaData->id,
                'name' => $v->properties->CompanyMetaData->name,
                'address' => $v->properties->CompanyMetaData->address,
                'url' => $v->properties->CompanyMetaData->url,
                'category' => $v->properties->CompanyMetaData->Categories[0]->name,
                'phone' => $v->properties->CompanyMetaData->Phones[0]->formatted,
                'schedule' => $v->properties->CompanyMetaData->Hours->text,
                'description' => implode(', ', $description),
                'latitude' => $v->geometry->coordinates[1],
                'longitude' => $v->geometry->coordinates[0],
            );

        }

        return $result;
    }
}