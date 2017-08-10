<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!--jquery-->
  <script type="text/javascript" src="https://yastatic.net/jquery/3.1.1/jquery.min.js"></script>
  <!--yandex api-->
  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&mode=debug" type="text/javascript"></script>
</head>
<body>

<style type='text/css'>
  div.cities a {
    font-size: 18px;
    text-decoration: none;
  }
</style>

<div class='cities'>
  <a data-latlong="55.72504493, 37.64696100" href=''>Москва и МО</a>,
  <a data-latlong="59.91817154, 30.30557800" href=''>Санкт-Петербург и ЛО</a>,
  <a data-latlong="46.35931094, 48.03750850" href=''>Астрахань</a>,

  <a data-latlong="51.69427264, 39.33595500" href=''>Воронеж</a>,
  <a data-latlong="56.78886213, 60.60339450" href=''>Екатеринбург</a>,
  <a data-latlong="55.77025877, 49.10271300" href=''>Казань</a>,

  <a data-latlong="45.06148367, 38.96220200" href=''>Краснодар</a>,
  <a data-latlong="56.02280833, 92.89742900" href=''>Красноярск</a>,
  <a data-latlong="53.41943508, 59.06718550" href=''>Магнитогорск</a>,

  <a data-latlong="56.30450253, 43.83352350" href=''>Нижний Новгород</a>,
  <a data-latlong="53.78650204, 87.15643100" href=''>Новокузнецк</a>,
  <a data-latlong="55.00081759, 82.95627700" href=''>Новосибирск</a>,

  <a data-latlong="55.12276857, 73.37843000" href=''>Омск</a>,
  <a data-latlong="58.02283311, 56.22942050" href=''>Пермь</a>,

  <a data-latlong="53.32206091, 50.06108050" href=''>Самара</a>,
  <a data-latlong="51.54004117, 46.00444150" href=''>Саратов</a>,
  <a data-latlong="61.29236153, 73.42541650" href=''>Сургут</a>,

  <a data-latlong="54.18117314, 37.61902750" href=''>Тула</a>,
  <a data-latlong="57.13740520, 65.54499550" href=''>Тюмень</a>,
  <a data-latlong="54.30298715, 48.43415950" href=''>Ульяновск</a>,

  <a data-latlong="48.46897578, 135.11297400" href=''>Хабаровск</a>,
  <a data-latlong="55.15336244, 61.39169750" href=''>Челябинск</a>,
  <a data-latlong="57.65072123, 39.86692250" href=''>Ярославль</a>
</div>

<br>
<br>

<div id="mymap" style="width:800px; height:600px"></div>

<!--данные для отображения-->
<script src='points.js' type='text/javascript' charset='utf-8'></script>

<script type="text/javascript">

  var mymap;

  //сетап карты
  ymaps.ready(function () {
    mymap = new ymaps.Map("mymap", {
      center: [55.72504493, 37.64696100], // москва
      zoom: 2
    });

//центровка по городам, по клику на ссылках городов
    $('a').click(function () {
      var latlong = $(this).data('latlong');
      latlong = latlong.split(',');
      mymap.setCenter([latlong[0], latlong[1]], 10);
      return false;
    });

//сетап точек
    for (var i = 0; i < points.length; i++) {
      mymap.geoObjects.add(new ymaps.Placemark(
        points[i].center,
        points[i].properties
      ));
    }

  });


</script>

</body>
</html>