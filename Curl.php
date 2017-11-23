<?php

/**
 * Скачивает страницу по $url
 * $head=0 без заголовков севера, $head=1 с заголовками сервера
 * $body=0 без тела страницы, $body=1 с телом страницы
 * $verbose=0 молчаливый, $verbose=1 подробный вывод о действиях
 */

class Curl {

 public static function getpage($url, $head = 0, $body = 1, $verbose = 0) {
  $curl = curl_init();

// урл (протокол обязателен)
  curl_setopt($curl, CURLOPT_URL, $url);

// User-Agent
  curl_setopt($curl, CURLOPT_USERAGENT,
   'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36');

// сжатие. все поддерживаемые сервером
// curl_setopt($curl, CURLOPT_ENCODING, '');

// возвращаем результат строкой в переменную curl_exec, а не в браузер
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// вернуть сырой вывод
  curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);

// полность молчаливый режим
// curl_setopt($curl, CURLOPT_MUTE, 1);

// позволить редиректы
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

// при редиректах подставлять в Referer значение Location
  curl_setopt($curl, CURLOPT_AUTOREFERER, 1);

// вернет FALSE если код ответа сервера >=400
  curl_setopt($curl, CURLOPT_FAILONERROR, 1);

// curl_setopt($curl, CURLOPT_REFERER, 'referer'); // подставить свой заголовок "Referer: "
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/plain', 'Content-length: 100')); // установить свои заголовки
// curl_setopt($curl, CURLOPT_USERPWD, "myusername:mypassword"); // позволить авторизацию
// curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10); // число секунд ожидания успешного коннекта
// curl_setopt($curl, CURLOPT_TIMEOUT, 10); // число секунд выполнения курла

// возвращаем http-заголовки вместе с телом страницы
  if ($head == 1) {
   curl_setopt($curl, CURLOPT_HEADER, 1);
  }

// не возвращаем тело страницы
  if ($body == 0) {
   curl_setopt($curl, CURLOPT_NOBODY, 1);
  }

// подробный вывод обо всех действиях
  if ($verbose == 1) {
   curl_setopt($curl, CURLOPT_VERBOSE, 1);
  }

// КУКИ
// curl_setopt($curl, CURLOPT_COOKIESESSION, 1); // игнорить сессионные куки
// curl_setopt($curl, CURLOPT_COOKIE, "name1=value1; name2=value2"); // отослать куки
// curl_setopt($curl, CURLOPT_COOKIEFILE, $file); // файл содержащий строку-куку
// curl_setopt($curl, CURLOPT_COOKIEJAR, $file); // файл куда сохраняются несессионные куки после закрытия курла

// ВВОД/ВЫВОД В ФАЙЛ
// curl_setopt($curl, CURLOPT_FILE, $file); // вывод результата работы курла в файл
// curl_setopt($curl, CURLOPT_INFILE, $file); // ввод данных для работы курла из файла
// curl_setopt($curl, CURLOPT_WRITEHEADER, $file); // полученные HTTP-заголовки в файл

// ОТПРАВИТЬ POST-ДАННЫЕ (конвертить в urlencode). можно приаттачить файл с POST-данными
// curl_setopt($curl, CURLOPT_POST, 1); // в формате "application/x-www-form-urlencoded"
// curl_setopt($curl, CURLOPT_POSTFIELDS, "field1=value1&field2=value2");

// АПЛОД ФАЙЛА
// curl_setopt($curl, CURLOPT_UPLOAD, 1);
// curl_setopt($curl, CURLOPT_INFILE, $string); // строка в котором файл прочитанный
// curl_setopt($curl, CURLOPT_FTPASCII, 1);
// curl_setopt($curl, CURLOPT_INFILESIZE, filesize($file)); // сам файл

// SSL
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // без сертификата
// curl_setopt($curl, CURLOPT_CAINFO, $file); // файл сертификата. если с сертификатом

// ПРОКСИ
// curl_setopt($curl, CURLOPT_PROXY, $proxyurl);
// curl_setopt($curl, CURLOPT_PROXYPORT, $proxyport); // прокси порт
// curl_setopt($curl, CURLOPT_PROXYUSERPWD, "username:password"); // авторизация на прокси
// curl_setopt($curl, CURLOPT_INTERFACE, $ip); // имя исходящего интерфейса для использования (IP\host\interface)

  $content = curl_exec($curl);

//старое
//  $result = array(
//   'content' => $content,
//   'errno' => curl_errno($curl),
//   'error' => curl_error($curl),
//   'getinfo' => curl_getinfo($curl),
//  );

//  новое
  if (curl_errno($curl) == 0 and curl_getinfo($curl)['http_code'] == 200) {
   return $content;
  } else {
   return false;
  }

  curl_close($curl);

//  старое
//  return $result;

 }

}
