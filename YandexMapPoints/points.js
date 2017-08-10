/*
 как это заполнять, исправлять, дополнять.
 1. идем сюда http://dimik.github.io/ymaps/examples/location-tool/
 2. вставляем адрес в поле поиска, нажимаем Найти
 3. забираем координаты из поля Центр карты
 */

var points = [

  // ярославль
  {
    center: [57.62773957, 39.87108600],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ АУРА (цокольный этаж) <br> Адрес: ул. Победы, д. 41 <br> Телефон: +7 (4852) 20-70-17 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/yaroslavl/' target='_blank'>http://leonardo.ru/shop/yaroslavl/</a>"
    }
  },

  // челябинск
  {
    center: [55.14544157, 61.45197900],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Алмаз (3 этаж) <br> Адрес: Копейское шоссе, д.64 <br> Телефон: +7 351) 216-50-57 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/chelyabinsk-almaz/' target='_blank'>http://leonardo.ru/shop/chelyabinsk-almaz/</a>"
    }
  },

  // хабаровск
  {
    center: [48.48547307, 135.06726350],

    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТЦ На Пушкина (5 этаж) <br> Адрес: ул. Льва Толстого, д. 19 <br> Телефон: +7 (4212) 47-71-75 <br> Время работы: с 10:00 до 21:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/khabarovsk/' target='_blank'>http://leonardo.ru/shop/khabarovsk/</a>"
    }
  },

  // ульяновск
  {
    center: [54.30657507, 48.35964450],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ АКВАМОЛЛ (2 этаж) <br> Адрес: Московское шоссе, д. 108 <br> Телефон: +7 (8422) 58-04-95 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/ulyanovsk/' target='_blank'>http://leonardo.ru/shop/ulyanovsk/</a>"
    }
  },

  // тюмень
  {
    center: [57.14605157, 65.54194550],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТЦ Галерея Вояж (3 этаж) <br> Адрес: ул. Герцена, д. 94 <br> Телефон: +7 (3452) 56-77-10 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/tumen/' target='_blank'>http://leonardo.ru/shop/tumen/</a>"
    }
  },

  // тула
  {
    center: [54.19354357, 37.63711950],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Макси (2 этаж) <br> Адрес: ул. Пролетарская, д. 2 <br> Телефон: +7 (4872) 77-49-23 <br> Время работы: с 10:00 до 21:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/tula/' target='_blank'>http://leonardo.ru/shop/tula/</a>"
    }
  },

  // сургут
  {
    center: [61.27750006, 73.36573250],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Аура (2 этаж) <br> Адрес: Нефтеюганское шоссе, д. 1 <br> Телефон: +7 (3462) 93-26-26 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/surgut/' target='_blank'>http://leonardo.ru/shop/surgut/</a>"
    }
  },

  {
    center: [61.23956606, 73.37387150],
    properties: {
      balloonContentHeader: 'Моделист',
      balloonContentBody: "ТРЦ Сургут Сити Молл <br> Адрес: Югорский тракт д. 38 <br> Телефон: +7 (922) 253-87-99 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://modelist86.ru/' target='_blank'>http://modelist86.ru/</a>"
    }
  },

  // саратов
  {
    center: [51.54693907, 46.01466450],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТК ФОРУМ (новый корпус - 3 этаж) <br> Адрес: ул. Танкистов, д. 1 ( пересечение улиц Большой Горной и Астраханской) <br> Телефон: +7 (8452) 42-64-12 <br> Время работы: с 10:00 до 21:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/saratov/' target='_blank'>http://leonardo.ru/shop/saratov/</a>"
    }
  },

  {
    center: [51.57539407, 45.97510250],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Тау Галерея (3 этаж) <br> Адрес: проспект 50 Лет Октября, д. 89В <br> Телефон: +7 (8452) 65-90-12 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/saratov2/' target='_blank'>http://leonardo.ru/shop/saratov2/</a>"
    }
  },

  // самара
  {
    center: [53.20738857, 50.19790300],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Космопорт (цокольный этаж) <br> Адрес: ул. Дыбенко, д. 30 <br> Телефон: +7 (846) 276-48-65 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/leo_samara/' target='_blank'>http://leonardo.ru/shop/leo_samara/</a>"
    }
  },

  // пермь
  {
    center: [58.00759907, 56.26190850],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК СемьЯ (4 этаж) <br> Адрес: ул. Революции, д. 13 <br> Телефон: +7 (342) 214 40 15 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/perm/' target='_blank'>http://leonardo.ru/shop/perm/</a>"
    }
  },

  // омск
  {
    center: [54.97763007, 73.32459000],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТЦ Континент (2 этаж) <br> Адрес: ул. 70 лет Октября, д. 25, корп. 2 <br> Телефон: +7 (3812) 92-52-80 <br> Время работы: с 10:00 до 21:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/omsk/' target='_blank'>http://leonardo.ru/shop/omsk/</a>"
    }
  },

  // новосибирск
  {
    center: [55.02874907, 82.93669800],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Аура (4 этаж) <br> Адрес: ул. Военная, д. 5 (м. Октябрьская, м. Площадь Ленина) <br> Телефон: +7 (383) 230-50-57 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/nsk/' target='_blank'>http://leonardo.ru/shop/nsk/</a>"
    }
  },

  {
    center: [55.04372157, 82.92233400],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Галерея (3 этаж) <br> Адрес: ул.Гоголя, д. 13 (м. Красный проспект, м. Сибирская) <br> Телефон: +7 (383) 204-58-52; +7 (383) 204-59-13 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/nsk-2/' target='_blank'>http://leonardo.ru/shop/nsk-2/</a>"
    }
  },

  // новокузнецк
  {
    center: [53.78036257, 87.12603650],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Планета (2 этаж) <br> Адрес: ул. Доз, д. 10а <br> Телефон: +7 (3843) 20-01-28 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/novokuznetsk/' target='_blank'>http://leonardo.ru/shop/novokuznetsk/</a>"
    }
  },

  // нижний новгород
  {
    center: [56.30644807, 44.07667500],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Фантастика (цокольный этаж) <br> Адрес: ул. Родионова, д. 187-В <br> Телефон: +7 (831) 282-01-75 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/nnov/' target='_blank'>http://leonardo.ru/shop/nnov/</a>"
    }
  },

  {
    center: [56.30884007, 43.98737350],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Небо (4 этаж) <br> Адрес: ул. Б. Покровская, д. 82 <br> Телефон: 8 (831) 262 24 04 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/nnov-2/' target='_blank'>http://leonardo.ru/shop/nnov-2/</a>"
    }
  },

  // магнитогорск
  {
    center: [53.37869807, 58.98156700],
    properties: {
      balloonContentHeader: 'Хобби Остров',
      balloonContentBody: "ТРК Гостиный Двор (1 этаж) <br> Адрес: пр. Карла Маркса, д.153 <br> Телефон: +7 (929) 207-59-59 <br> Время работы: с 10:00 до 21:00 (без перерывов и выходных) <br> Сайт: <a href='http://hobbyostrov.ru/' target='_blank'>http://hobbyostrov.ru/</a>"
    }
  },

  {
    center: [53.40275057, 58.98763950],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Континент (3 этаж) <br> Адрес: пр. Ленина, д.83 <br> Телефон: +7 (3519) 51-00-30 <br> Время работы: с 10:00 до 21:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/magnit1/' target='_blank'>http://leonardo.ru/shop/magnit1/</a>"
    }
  },

  // красноярск
  {
    center: [56.05093357, 92.90437750],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Планета (1 этаж) <br> Адрес: ул 9 Мая, д. 77 <br> Телефон: +7 (391) 279-19-19 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/krasnoyarsk/' target='_blank'>http://leonardo.ru/shop/krasnoyarsk/</a>"
    }
  },

  // краснодар
  {
    center: [45.10220857, 38.98384700],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "Мегацентр Красная Площадь (2 этаж) <br> Адрес: ул. Дзержинского, д. 100 <br> Телефон: +7 (861) 217-05-29 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/krasdar2/' target='_blank'>http://leonardo.ru/shop/krasdar2/</a>"
    }
  },

  {
    center: [45.03951507, 38.97442350],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Галерея Краснодар (1-я очередь, 0 этаж) <br> Адрес: ул. Головатого, д. 313 <br> Телефон: +7 (861) 201-51-63 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/krasdar3/' target='_blank'>http://leonardo.ru/shop/krasdar3/</a>"
    }
  },

  // казань
  {
    center: [55.82135007, 49.09340650],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Тандем (3 этаж) <br> Адрес: проспект Ибрагимова, д. 56 <br> Телефон: +7 (843) 518-83-31 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/kazan2/' target='_blank'>http://leonardo.ru/shop/kazan2/</a>"
    }
  },

  // екатеринбург
  {
    center: [56.85309507, 60.55026800],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Карнавал (цокольный этаж) <br> Адрес: ул. Халтурина, д. 55 <br> Телефон: +7 (343) 310-14-99 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/eburg/' target='_blank'>http://leonardo.ru/shop/eburg/</a>"
    }
  },

  {
    center: [56.81717807, 60.53853600],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Радуга Парк (1 этаж) <br> Адрес: ул. Репина, д.94 <br> Телефон: +7 (343) 311-15-60 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/eburg2/' target='_blank'>http://leonardo.ru/shop/eburg2/</a>"
    }
  },

  {
    center: [56.82909857, 60.59898350],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Гринвич (3 уровень) <br> Адрес: ул. 8 Марта, д. 46 <br> Телефон: +7 (343) 311-61-24 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/eburg3/' target='_blank'>http://leonardo.ru/shop/eburg3/</a>"
    }
  },

  // воронеж
  {
    center: [51.78833207, 39.20526350],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "Сити-парк ГРАД (2 этаж) <br> Адрес: г. Воронеж, Воронежская обл., поселок Солнечный, ул. Парковая, д.3 <br> Телефон: +7 (473) 260-48-37 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/voronezh/' target='_blank'>http://leonardo.ru/shop/voronezh/</a>"
    }
  },

  // астрахань
  {
    center: [46.35991757, 48.05535800],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Ярмарка (3 этаж) <br> Адрес: Вокзальная площадь, д. 13 <br> Телефон: +7 (8512) 66-70-55 <br> Время работы: с 10:00 до 22:00 (без перерывов и выходных) <br> Сайт: <a href='http://leonardo.ru/shop/astrakhan/' target='_blank'>http://leonardo.ru/shop/astrakhan/</a>"
    }
  },

  // Санкт-Петербург
  {
    center: [59.82833756, 30.37808550],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Балкания Nova (3 этаж)<br>Адрес: Балканская пл., д. 5 (м. Купчино)<br>Телефон: +7 (812) 333-29-45<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/leo_spb/' target='_blank'>http://leonardo.ru/shop/leo_spb/</a>"
    }
  },

  {
    center: [60.00543656, 30.29903350],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Сити Молл (2 этаж)<br>Адрес: Коломяжский проспект, д. 17 (м. Пионерская)<br>Телефон: +7 (812) 677-97-74<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/spb2/' target='_blank'>http://leonardo.ru/shop/spb2/</a>"
    }
  },

  {
    center: [59.87696006, 30.35931950],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Рио<br>Адрес: ул. Фучика, д. 2 (м. Бухарестская)<br>Телефон: +7 (812) 414-31-74<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/spb3/' target='_blank'>http://leonardo.ru/shop/spb3/</a>"
    }
  },

  {
    center: [59.84920256, 30.14424500],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Жемчужная Плаза (2 этаж)<br>Адрес: Петергофское шоссе, д. 51, лит. А (м. Ленинский проспект)<br>Телефон: +7 (812) 383-15-06<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/spb6/' target='_blank'>http://leonardo.ru/shop/spb6/</a>"
    }
  },

  {
    center: [59.93330256, 30.44022200],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Заневский Каскад (1 этаж)<br>Адрес: Заневский проспект, д. 71, корпус С (м. Ладожская)<br>Телефон: +7 (812) 333-15-98<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/spb5/' target='_blank'>http://leonardo.ru/shop/spb5/</a>"
    }
  },

  {
    center: [59.99076406, 30.25776500],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Гулливер (4 этаж)<br>Адрес: Торфяная дорога, д. 7 (м. Старая Деревня)<br>Телефон: +7 (812) 600-94-12<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/spb7/' target='_blank'>http://leonardo.ru/shop/spb7/</a>"
    }
  },

  {
    center: [59.98760006, 30.35390250],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Европолис (3 этаж)<br>Адрес: Полюстровский проспект, д. 84А (м. Лесная)<br>Телефон: +7 (812) 677-37-95<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/spb8/' target='_blank'>http://leonardo.ru/shop/spb8/</a>"
    }
  },

  {
    center: [60.31109479, 30.91013950],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТЦ МЕГА Парнас (3 этаж)<br>Адрес: Ленинградская область, Всеволожский район, пересечение КАД (кольцевой автодороги) и проспекта Энгельса (м. Парнас)<br>Телефон: +7 (812) 334-89-74<br>Время работы: Воскресенье - Четверг с 10:00 - 22:00, Пятница - Суббота c 10:00 - 23:00<br>Сайт: <a href='http://leonardo.ru/shop/spb9/' target='_blank'>http://leonardo.ru/shop/spb9/</a>"
    }
  },

  {
    center: [60.05270306, 30.33119350],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Норд (цокольный этаж)<br>Адрес: проспект Просвещения, д.19, литера А (м. Проспект Просвещения)<br>Телефон: +7 (812) 333-34-12<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/spb10/' target='_blank'>http://leonardo.ru/shop/spb10/</a>"
    }
  },

  {
    center: [59.83181956, 30.34567450],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Континент (цокольный этаж)<br>Адрес: ул. Звездная, д. 1 (м. Звездная)<br>Телефон: +7 (812) 602-19-62<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/spb11/' target='_blank'>http://leonardo.ru/shop/spb11/</a>"
    }
  },

  {
    center: [59.99076406, 30.25776500],
    properties: {
      balloonContentHeader: 'Хобби Остров',
      balloonContentBody: "ТРК Гулливер<br>Адрес: Торфяная дор., д.7 (м. Старая деревня)<br>Телефон: +7 (812) 926-51-56<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://hobbyostrov.ru/' target='_blank'>http://hobbyostrov.ru/</a>"
    }
  },

  {
    center: [60.05908556, 30.33502000],
    properties: {
      balloonContentHeader: 'Хобби Остров',
      balloonContentBody: "ТРК Гранд Каньон<br>Адрес: пр. Энгельса, д.154 (м. пр.Просвещения)<br>Телефон: +7 (812) 989-13-66<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://hobbyostrov.ru/' target='_blank'>http://hobbyostrov.ru/</a>"
    }
  },

  {
    center: [59.95123106, 30.30561850],
    properties: {
      balloonContentHeader: 'Хобби Остров',
      balloonContentBody: "Адрес: Кронверкский пр. д.75 (м. Горьковская и м. Спортивная)<br>Телефон: +7 (812) 235-69-36<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://hobbyostrov.ru/' target='_blank'>http://hobbyostrov.ru/</a>"
    }
  },

  {
    center: [59.85328806, 30.34070650],
    properties: {
      balloonContentHeader: 'Хобби Остров',
      balloonContentBody: "ТК Питер<br>Адрес: ул. Типанова, д.21 (м. Московская и м. Звездная)<br>Телефон: +7 (812) 988-33-30<br>Время работы: с 10:00 до 21:00 (без перерывов и выходных)<br>Сайт: <a href='http://hobbyostrov.ru/' target='_blank'>http://hobbyostrov.ru/</a>"
    }
  },

  {
    center: [59.94105106, 30.41407200],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "Адрес: пр.Шаумяна д.2 (Универмаг)<br>Телефон: +7 (812) 363-17-64, 8-800-500-28-86<br>Время работы: Пн - Сб с 10-00 до 20-00, Вс с 11-00 до 20-00<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [59.87696006, 30.35931950],
    properties: {
      balloonContentHeader: 'ШопНтойз',
      balloonContentBody: "ТЦ РИО<br>Адрес: ул. Фучика, д.2 Павильон А78<br>Телефон: +7 (981) 970-11-70, 8-800-350-11-70<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='https://shopntoys.ru/' target='_blank'>https://shopntoys.ru/</a>"
    }
  },

  {
    center: [59.91543156, 30.31332600],
    properties: {
      balloonContentHeader: 'Евротрейн / SuperPilot',
      balloonContentBody: "Адрес: 2-я Красноармейская улица, д. 11 (м. Технологический институт)<br>Телефон: +7 (812) 575-90-32<br>Время работы: Пн-Пт с 10:00 до 20:00, Сб-Вс с 11:00 до 20:00<br>Сайт: <a href='http://www.eurotrain.ru/' target='_blank'>http://www.eurotrain.ru/</a> <br> Сайт: <a href='http://www.super-pilot.ru/' target='_blank'>http://www.super-pilot.ru/</a>"
    }
  },

  {
    center: [59.95681356, 30.31181650],
    properties: {
      balloonContentHeader: 'Toy&Hobby',
      balloonContentBody: "Адрес: Кронверкский проспект, д. 47 (м. Горьковская)<br>Телефон: +7 (812) 232-66-22, +7 (812) 498‑08-75<br>Время работы: с 11:00 до 21:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.toyhobby.spb.ru/' target='_blank'>http://www.toyhobby.spb.ru/</a>"
    }
  },
  {
    center: [59.92372106, 30.40787350],
    properties: {
      balloonContentHeader: 'Красный Барон',
      balloonContentBody: "Адрес: ул. Таллинская, д. 6А, пом. 2Н (м. Новочеркасская, м. Площадь Александра Невского)<br>Телефон: +7 (931) 972‑97-52, +7 (911) 150‑33-30<br>Время работы: Пн-Пт с 10:00 до 20:00, Сб-Вс с 11:00 до 19:00<br>Сайт: <a href='http://red-baron.spb.ru/ls-model/' target='_blank'>http://red-baron.spb.ru/ls-model/</a>"
    }
  },

  {
    center: [59.94883406, 30.47546250],
    properties: {
      balloonContentHeader: 'Три Хобби',
      balloonContentBody: "Адрес: Индустриальный проспект, д. 27 (м. Ладожская, м. Проспект Большевиков)<br>Телефон: +7 (812) 900‑89-53, +7 (812) 945‑66-20<br>Время работы: с 11:00 до 20:00 (без перерывов и выходных)<br>Сайт: <a href='http://3hobby.ru/manufacturers/ls-model/' target='_blank'>http://3hobby.ru/manufacturers/ls-model/</a>"
    }
  },

  {
    center: [59.37237806, 28.61268950],
    properties: {
      balloonContentHeader: 'АРТмасфера',
      balloonContentBody: "ТДЦ Красная Башня (2 этаж, 211 павильон)<br>Адрес: Ленинградская область, г. Кингисепп, ул. Октябрьская д. 22<br>Телефон: +7 (921) 415-52-14<br>Время работы: Пн-Пт с 10:00 до 19:00, Сб-Вс с 10:00 до 18:00<br>Сайт: <a href='http://artmasfera.ru/' target='_blank'>http://artmasfera.ru/</a>"
    }
  },

  // Москва
  {
    center: [55.81240807, 37.58469400],
    properties: {
      balloonContentHeader: 'Моделька – официальный эксклюзивный дистрибьютер по ЦФО РФ',
      balloonContentBody: "Адрес: ул. Руставели д.3, корп.2, офис 1 (м. Дмитровская)<br>Телефон: +7 (495) 542-23-63, 8-800-555-63-77<br>Время работы: Пн-Пт с 10:00 до 20:00, Суббота с 11:00 до 18:00, Воскресенье - выходной.<br>Сайт: <a href='http://model-ka.ru/brands/ls-model/' target='_blank'>http://model-ka.ru/brands/ls-model/</a>"
    }
  },

  {
    center: [55.98883707, 37.15929700],
    properties: {
      balloonContentHeader: 'Зелёный Кораблик',
      balloonContentBody: "Адрес: Москва, г. Зеленоград, ул. Новокрюковская, 3Б, 5 этаж<br>Телефон: +7 (916) 216-00-89, +7 (499) 995-25-19, +7 (499) 398-29-37<br>Время работы: Пн-Пт с 09:00 до 18:00, Сб-Вс с 10:00 до 16:00. Выходной – воскресенье.<br>Сайт: <a href='https://hobby4me.ru/' target='_blank'>https://hobby4me.ru/</a>"
    }
  },
  {
    center: [55.74736307, 37.70709850],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "TК Город Лефортово (3 этаж)<br>Адрес: шоссе Энтузиастов, д.12, корп.2 (м.Авиамоторная)<br>Телефон: +7 (495) 660-02-94<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk_gorod/' target='_blank'>http://leonardo.ru/shop/msk_gorod/</a>"
    }
  },

  {
    center: [55.61946707, 37.50928050],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Спектр (цокольный этаж)<br>Адрес: Новоясеневский пр-т, д.1 (м.Теплый Cтан)<br>Телефон: +7 (499) 550-25-60, +7 (499) 550-07-99<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk3/' target='_blank'>http://leonardo.ru/shop/msk3/</a>"
    }
  },

  {
    center: [55.61204457, 37.73271850],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "TРЦ Облака (3 этаж)<br>Адрес: Ореховый бульвар д.22А (м. Домодедовская)<br>Телефон: +7 (495) 783-28-87<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk5/' target='_blank'>http://leonardo.ru/shop/msk5/</a>"
    }
  },

  {
    center: [55.77549957, 37.65976650],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "Универмаг Московский (3 этаж)<br>Адрес: Комсомольская пл. д. 6, стр. 1 (м. Комсомольская)<br>Телефон: +7 (495) 916-57-64<br>Время работы: с 09:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk6/' target='_blank'>http://leonardo.ru/shop/msk6/</a>"
    }
  },

  {
    center: [55.72969057, 37.73456900],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТК Город на Рязанке (2 этаж)<br>Адрес: Рязанский проспект, д.2, к.3 (м. Рязанский проспект)<br>Телефон: +7 (495) 783-28-77<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk4/' target='_blank'>http://leonardo.ru/shop/msk4/</a>"
    }
  },
  {
    center: [55.84023957, 37.49202400],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТЦ Водный (3 этаж)<br>Адрес: Головинское шоссе д 5 корп 1 (м. Водный стадион)<br>Телефон: +7 (495) 280-38-02<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk8/' target='_blank'>http://leonardo.ru/shop/msk8/</a>"
    }
  },

  {
    center: [55.85507757, 37.47808200],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Речной (3 этаж)<br>Адрес: ул. Фестивальная, д.2Б (м. Речной Вокзал)<br>Телефон: +7 (495) 286-72-31<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk9/' target='_blank'>http://leonardo.ru/shop/msk9/</a>"
    }
  },

  {
    center: [55.61218157, 37.60702600],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Колумбус (3 этаж)<br>Адрес: ул.Кировоградская, д.13А (м. Пражская)<br>Телефон: +7 (495) 650-86-16<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk7/' target='_blank'>http://leonardo.ru/shop/msk7/</a>"
    }
  },

  {
    center: [55.86920757, 37.66301800],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТК Радужный (3 этаж)<br>Адрес: ул. Енисейская, д.19, корп.1 (м. Бабушкинская)<br>Телефон: +7 (495) 783-28-70<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk10/' target='_blank'>http://leonardo.ru/shop/msk10/</a>"
    }
  },

  {
    center: [55.91612357, 37.75885950],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Красный кит (цокольный этаж)<br>Адрес: Московская область, г. Мытищи, Шараповский проезд, вл.2<br>Телефон: +7 (495) 407-08-11<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk11/' target='_blank'>http://leonardo.ru/shop/msk11/</a>"
    }
  },
  {
    center: [55.67013307, 37.55242650],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТДЦ Черемушки (1 этаж)<br>Адрес: ул. Профсоюзная, д.56 (м. Новые Черёмушки)<br>Телефон: +7 (495) 259-06-01<br>Время работы: с 10:00 до 21:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk12/' target='_blank'>http://leonardo.ru/shop/msk12/</a>"
    }
  },

  {
    center: [55.80946907, 37.46457150],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРК Щука (5 этаж)<br>Адрес: ул. Щукинская, д.42 (м. Щукинская)<br>Телефон: +7 (495) 229-97-49<br>Время работы: с 10:00 до 21:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk13/' target='_blank'>http://leonardo.ru/shop/msk13/</a>"
    }
  },

  {
    center: [55.84613307, 37.66259600],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Золотой Вавилон (2 торговый уровень)<br>Адрес: пр-кт Мира, д.211 (м. Свиблово)<br>Телефон: +7 (495) 650-81-03<br>Время работы: с 10:00 до 21:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk14/' target='_blank'>http://leonardo.ru/shop/msk14/</a>"
    }
  },

  {
    center: [55.74463207, 37.56607200],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Европейский (атриум «Рим» - 0 этаж)<br>Адрес: площадь Киевского вокзала, д.2<br>Телефон: +7 (495) 225-72-95<br>Время работы: понедельник - четверг, воскресенье с 10.00 до 22.00,<br>пятница - суббота с 10.00 до 23.00<br>Сайт: <a href='http://leonardo.ru/shop/msk17/' target='_blank'>http://leonardo.ru/shop/msk17/</a>"
    }
  },

  {
    center: [55.69586957, 37.66489550],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Мегаполис (3 этаж)<br>Адрес: проспект Андропова, д.8 (м. Технопарк)<br>Телефон: +7 (495) 271-96-07<br>Время работы: с 10:00 до 21:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk16/' target='_blank'>http://leonardo.ru/shop/msk16/</a>"
    }
  },
  {
    center: [55.70688307, 37.59209600],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Гагаринский (3 этаж)<br>Адрес: ул. Вавилова, д. 3 (м. Ленинский проспект)<br>Телефон: +7 (495) 730-07-65<br>Время работы: с 09:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk18/' target='_blank'>http://leonardo.ru/shop/msk18/</a>"
    }
  },

  {
    center: [55.79046307, 37.53040900],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТЦ Авиапарк (3 этаж)<br>Адрес: ул. Ходынский бульвар, д.4 (м. Аэропорт)<br>Телефон: +7 (495) 730-31-61<br>Время работы: пятница, суббота: с 10.00 до 23.00, все остальные дни: с 10.00 до 22.00<br>Сайт: <a href='http://leonardo.ru/shop/msk19/' target='_blank'>http://leonardo.ru/shop/msk19/</a>"
    }
  },

  {
    center: [55.90906507, 37.53924850],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ РИО (2 этаж)<br>Адрес: Дмитровское шоссе, д.163А<br>Телефон: +7 (495) 988-51-22<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk20/' target='_blank'>http://leonardo.ru/shop/msk20/</a>"
    }
  },

  {
    center: [55.65825607, 37.84508850],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТЦ МЕГА Белая Дача<br>Адрес: Московская область, г. Котельники, 1-й Покровский проезд, д.1 (м. Котельники)<br>Телефон: +7 (495) 995-14-59<br>Время работы: 10:00 – 23:00, пятница и суббота: 10:00 – 00:00<br>Сайт: <a href='http://leonardo.ru/shop/msk23/' target='_blank'>http://leonardo.ru/shop/msk23/</a>"
    }
  },

  {
    center: [55.72812957, 37.47677050],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Океания (3 этаж)<br>Адрес: Кутузовский пр., 57 (м. Славянский бульвар)<br>Телефон: +7 (495) 280-09-65<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk22/' target='_blank'>http://leonardo.ru/shop/msk22/</a>"
    }
  },
  {
    center: [55.85040857, 37.44408950],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТРЦ Калейдоскоп (3 этаж)<br>Адрес: ул. Сходненская, д. 56<br>Телефон: +7 (495) 730-41-33<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://leonardo.ru/shop/msk26/' target='_blank'>http://leonardo.ru/shop/msk26/</a>"
    }
  },

  {
    center: [55.82288807, 37.49675800],
    properties: {
      balloonContentHeader: 'Леонардо',
      balloonContentBody: "ТЦ Метрополис<br>Адрес: Ленинградское ш., 16а, стр. 4 (м. Войковская)<br>Телефон: +7 (495) 782-89-84<br>Сайт: <a href='http://leonardo.ru/shop/msk27/' target='_blank'>http://leonardo.ru/shop/msk27/</a>"
    }
  },

  {
    center: [55.84902357, 37.57659150],
    properties: {
      balloonContentHeader: 'ШопНтойз',
      balloonContentBody: "Адрес: Сигнальный пр-д, 3 (м. Владыкино)<br>Телефон: +7 (499) 350-11-70, 8-800-350-11-70<br>Время работы: Пн - Пт с 10-00 до 19-00. Суббота с 10-00 до 15-00. Выходной – воскресенье.<br>Сайт: <a href='https://shopntoys.ru/' target='_blank'>https://shopntoys.ru/</a>"
    }
  },

  {
    center: [55.64788957, 37.60148350],
    properties: {
      balloonContentHeader: 'Плацдарм',
      balloonContentBody: "Адрес: ул. Азовская, д. 35, корп. 3 (м. Севастопольская)<br>Телефон: +7 (495) 722-79-67<br>Время работы: Пн-Пт с 10:30 до 20:00, Сб-Вс с 11:00 до 19:00.<br>Сайт: <a href='http://www.platcdarm.ru/' target='_blank'>http://www.platcdarm.ru/</a>"
    }
  },

  {
    center: [55.73758307, 37.59442250],
    properties: {
      balloonContentHeader: 'Мир Моделиста',
      balloonContentBody: "Адрес: Кропоткинский пер. д. 4, стр. 1 (м. Парк Культуры)<br>Телефон: +7 (926) 799-01-49<br>Время работы: с 10:00 до 20:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.mirmodelista.ru/' target='_blank'>http://www.mirmodelista.ru/</a>"
    }
  },

  {
    center: [55.72518907, 37.46188550],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "Адрес: Славянский бульвар, 15, к.1 (м. Славянский Бульвар)<br>Телефон: +7 (499) 110-20-86 доб.402, 8-800-500-28-86<br>Время работы: с 10:00 до 21:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.67910257, 37.62387850],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "Адрес: Варшавское шоссе, 36, корпус 1 (м. Нагатинская)<br>Телефон: +7 (499) 110-20-86 доб.408, 8-800-500-28-86<br>Время работы: с 10:00 до 21:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.84611257, 37.35821050],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "ТЦ Ладья (цокольный этаж)<br>Адрес: ул. Дубравная, 34/29 (м. Митино)<br>Телефон: +7 (499) 110-20-86 доб.410, 8-800-500-28-86<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.69237907, 37.52777650],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "ТЦ Ашан-Сити Капитолий (3 этаж, павильон 43)<br>Адрес: пр. Вернадского, д.6 (м. Университет)<br>Телефон: +7 (499) 110-20-86 доб.415, 8-800-500-28-86<br>Время работы: с 09:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.76649057, 37.62233350],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "ТЦ Галерея Неглинная (цокольный этаж)<br>Адрес: Трубная пл., 2 (м. Трубная)<br>Телефон: +7 (499) 110-20-86 доб.417, 8-800-500-28-86<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.89866407, 37.62932250],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "ТЦ ЧасПик (1 этаж, павильон А-31)<br>Адрес: 87 км МКАД, дом №8 (м. Медведково)<br>Телефон: +7 (499) 110-20-86 доб.420, 8-800-500-28-86<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.78949707, 37.53400200],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "ТЦ Авиапарк (3 этаж, помещение 8011-3056)<br>Адрес: ул. Авиаконструктора Микояна, 10<br>Телефон: +7 (499) 110-20-86 доб.429, 8-800-500-28-86<br>Время работы: Пн, Вт, Ср, Чт, Вс – с 10.00 до 22.00, Пт, Сб – с 10.00 до 23.00<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.85040857, 37.44408950],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "ТЦ Калейдоскоп (4 этаж, павильон 407)<br>Адрес: ул. Сходненская, д. 56 (м. Сходненская)<br>Телефон: +7 (499) 110-20-86 доб.434, 8-800-500-28-86<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.78551357, 37.66540750],
    properties: {
      balloonContentHeader: 'Пилотаж',
      balloonContentBody: "ТДК Тройка (павильон 321)<br>Адрес: ул. Верхняя Красносельская, д.3А (м. Красносельская)<br>Телефон: +7 (499) 110-20-86 доб.435, 8-800-500-28-86<br>Время работы: с 09:00 до 22:00 (без перерывов и выходных)<br>Сайт: <a href='http://www.pilotage-rc.ru/' target='_blank'>http://www.pilotage-rc.ru/</a>"
    }
  },

  {
    center: [55.65404057, 37.64518650],
    properties: {
      balloonContentHeader: 'RC-GO',
      balloonContentBody: "Адрес: Каширское шоссе, д.24, стр.7, офис 12, 1 этаж (м. Каширская)<br>Телефон: +7 (495) 662-97-94, 8-800-555-57-94<br>Время работы: с 10:00 до 20:00 (без перерывов и выходных)<br>Сайт: <a href='https://rc-go.ru/' target='_blank'>https://rc-go.ru/</a>"
    }
  },

  {
    center: [55.73653357, 37.63628450],
    properties: {
      balloonContentHeader: 'RC-TODAY.RU',
      balloonContentBody: "Адрес: ул. Большая Татарская, д.35 стр.5, офис 1 (м. Павелецкая)<br>Телефон: +7 (495) 215-19-66, 8-800-333-13-84<br>Время работы: с 10:00 до 20:00 (без перерывов и выходных)<br>Сайт: <a href='https://rc-today.ru/' target='_blank'>https://rc-today.ru/</a>"
    }
  },

  {
    center: [55.80958507, 37.77198350],
    properties: {
      balloonContentHeader: 'Хэппикон',
      balloonContentBody: "Адрес офиса-склада: ул. Монтажная, д.8 стр.7, оф. 103<br>Телефон: +7 (495) 115-78-12, 8-800-302-05-73<br>Время работы: Пн-Пт с 09:00 до 18:00, Сб-Вс - выходной.<br>Сайт: <a href='http://happykon.ru/brands/22/' target='_blank'>http://happykon.ru/brands/22/</a>"
    }
  },

  {
    center: [55.84942857, 37.57649250],
    properties: {
      balloonContentHeader: 'Emit.ru',
      balloonContentBody: "Адрес пункта самовывоза: Сигнальный проезд д.3 стр.1, (3 этаж)<br>Телефон: +7 (499) 677-64-94<br>Время работы: Пн-Сб с 10:00 до 19:00, Вс - выходной.<br>Сайт: <a href='http://emit.ru/183-ls-model/' target='_blank'>http://emit.ru/183-ls-model/</a>"
    }
  },

  {
    center: [55.80514357, 37.45474350],
    properties: {
      balloonContentHeader: 'RCMOTORS.RU',
      balloonContentBody: "Адрес: ул. Новощукинская, дом 7, к. 1, стр. 3, подъезд 2 (м. Щукинская)<br>Телефон: +7 (495) 223-92-35, 8-800-333-11-35<br>Время работы: Пн-Пт с 10:00 до 20:00, Сб-Вс - выходной.<br>Сайт: <a href='https://www.rcmotors.ru/' target='_blank'>https://www.rcmotors.ru/</a>"
    }
  },

  {
    center: [55.80829507, 37.58679600],
    properties: {
      balloonContentHeader: 'ЦВЕТНОЕ/Zvetnoe.ru',
      balloonContentBody: "Адрес офиса: ул. Новодмитровская д. 5а стр. 3 офис 634 (м. Дмитровская)<br>Телефон: +7 (495) 125-20-37, 8-800-200-55-36<br>Время работы: Пн-Пт с 09:00 до 21:00, Сб-Вс с 10:00 до 19:00.<br>Сайт: <a href='http://zvetnoe.ru/' target='_blank'>http://zvetnoe.ru/</a>"
    }
  },

  {
    center: [55.76649057, 37.62233350],
    properties: {
      balloonContentHeader: 'Евротрейн / SuperPilot',
      balloonContentBody: "Адрес: Трубная площадь д. 2, ТЦ «Неглинная галерея», 1 этаж (м. Трубная)<br>Телефон: +7 (495) 229-22-69<br>Время работы: с 10:00 до 22:00 (без перерывов и выходных).<br>Сайт: <a href='http://www.eurotrain.ru/' target='_blank'>http://www.eurotrain.ru/</a> <br> Сайт: <a href='http://www.super-pilot.ru/' target='_blank'>http://www.super-pilot.ru/</a>"
    }
  },

  {
    center: [55.77195007, 37.59633600],
    properties: {
      balloonContentHeader: 'Евротрейн / SuperPilot',
      balloonContentBody: "Адрес: 3-я Тверская-Ямская улица, д. 12, строение 1 (м. Маяковская)<br>Телефон: +7 (499) 251-92-40<br>Время работы: Пн-Пт с 10:00 до 20:00, Сб-Вс с 11:00 до 20:00<br>Сайт: <a href='http://www.eurotrain.ru/' target='_blank'>http://www.eurotrain.ru/</a> <br> Сайт: <a href='http://www.super-pilot.ru/' target='_blank'>http://www.super-pilot.ru/</a>"
    }
  },

  {
    center: [55.65266407, 37.76771650],
    properties: {
      balloonContentHeader: 'Хобби для ВсеХ',
      balloonContentBody: "Адрес: ул. Братиславская д. 31 к. 1 (м. Братиславская)<br>Телефон: +7 (495) 346-99-77, +7 (495) 347-38-00, +7 (495) 346-99-84<br>Время работы: Пн-Сб с 11:00 до 20:30, Вс с 11:00 до 20:30<br>Сайт: <a href='http://www.hobbyforyou.ru/catalog/9925.html' target='_blank'>http://www.hobbyforyou.ru/catalog/9925.html</a>"
    }
  }

];