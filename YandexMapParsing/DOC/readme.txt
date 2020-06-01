Выборка Аптек

select name, address, category, phone from object where category regexp 'Аптека' and address regexp 'Москва';
select category, count(*) from object group by category;
-------------------------------------------------

-- все уникальные категории, с сортировкой по кол-ву объектов в каждой.
SELECT DISTINCT `category`, COUNT(`id`) as `quallityobjects` 
FROM `object` 
GROUP BY `category` 
ORDER BY `quallityobjects` DESC;


-- все уникальные категории, с сортировкой по кол-ву объектов в каждой, где объектов больше 1000.
SELECT DISTINCT `category`, COUNT(`id`) as `quallityobjects` 
FROM `object` 
GROUP BY `category` 
HAVING `quallityobjects` >= 1000
ORDER BY `quallityobjects` DESC


-- все уникальные категории, с сортировкой по кол-ву объектов в каждой, у которых есть мыла.
SELECT DISTINCT `category`, COUNT(`id`) as `quallityobjects` 
FROM `object` 
WHERE LENGTH(`email`)>1
GROUP BY `category` 
ORDER BY `quallityobjects` DESC;


-- все объекты по данной категории.
SELECT `name`, `address`, `url`
FROM `object` 
WHERE `category` = 'Банки';


-- все объекты с телефонами.
SELECT COUNT(*) FROM `object` WHERE LENGTH(`phone`)>1;


-- количество пройденных запросов.
SELECT DISTINCT COUNT(*) FROM `city_has_type`;
SELECT DISTINCT COUNT(*) FROM `city_has_brand`;


-- количество объектов.
SELECT COUNT(*) FROM `object`;


-- все объекты, у которых есть сайты.
SELECT COUNT(*) FROM `object` WHERE LENGTH(`url`)>1;


-- обновим все адреса объектов в базе тимура. добавим в начало город.
UPDATE `object` SET `address`= CONCAT('Санкт-Петербург, ', `address`);
---------------------------------------------------------------------------------------------------

4. заберем нужные объекты

-- все объекты по данным категориям из яндекс-базы, с телефонами.
SELECT *
FROM `object` 
WHERE
`category` IN ('Автосервис, автотехцентр', 'Юридические услуги', 'Детский сад', 'Салон красоты', 'Парикмахерская', 'Кафе', 'Стоматологическая клиника', 'Медцентр, клиника', 'Ресторан', 'Ремонт бытовой техники', 'Автосалон', 'Химчистка')
AND
LENGTH(`phone`)>1;


-- все объекты по данным категориям из базы тимура, с мылами.
SELECT *
FROM `object` 
WHERE
`category` IN ('Автосервис, автотехцентр', 'Юридические услуги', 'Детский сад', 'Салон красоты', 'Парикмахерская', 'Кафе', 'Стоматологическая клиника', 'Медцентр, клиника', 'Ресторан', 'Ремонт бытовой техники', 'Автосалон', 'Химчистка')
AND
LENGTH(`email`)>1;
---------------------------------------------------------------------------------------------------

вывод яндекс-карты

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

<div id="map_' . $v->properties->CompanyMetaData->id . '" style="width: 600px; height: 400px"></div>

<script type="text/javascript">
ymaps.ready(init);
var myMap, myPlacemark;
function init(){
myMap = new ymaps.Map("map_' . $v->properties->CompanyMetaData->id . '", {
center: [' . $v->geometry->coordinates[1] . ', ' . $v->geometry->coordinates[0] . '],
zoom: 17
});

myPlacemark = new ymaps.Placemark([' . $v->geometry->coordinates[1] . ', ' . $v->geometry->coordinates[0] . '], { hintContent: "Москва", balloonContent: "Столица России"});

myMap.geoObjects.add(myPlacemark);
 }
</script>