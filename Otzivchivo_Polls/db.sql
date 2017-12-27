-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.19 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица proto_loc.ads
CREATE TABLE IF NOT EXISTS `ads` (
  `id`       INT(11)   NOT NULL AUTO_INCREMENT,
  `users_id` INT(11)   NOT NULL,
  `title`    VARCHAR(255)       DEFAULT NULL,
  `desc`     TEXT,
  `created`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT 'дата создания',
  `ext`      VARCHAR(255)       DEFAULT NULL
  COMMENT 'расширение файла',
  PRIMARY KEY (`id`),
  KEY `fk_ads_users1_idx` (`users_id`),
  CONSTRAINT `fk_ads_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 15
  DEFAULT CHARSET = utf8
  COMMENT ='акции';

-- Дамп данных таблицы proto_loc.ads: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `ads`
  DISABLE KEYS */;
INSERT INTO `ads` (`id`, `users_id`, `title`, `desc`, `created`, `ext`) VALUES
  (8, 2, 'Тестовая акция',
   '<h3 style="color:#aaa;font-style:italic;">Спасибо за Ваш отзыв. Вы помогли стать нам лучше - получите приятный бонус в размере 20% на сумму следующего заказа!</h3>\n',
   '2015-10-03 11:47:29', 'jpg'),
  (10, 2, 'Заголовок ',
   '',
   '2015-10-30 12:58:31', 'jpg'),
  (14, 198, '111', '<p>111</p>\n', '2016-04-04 09:13:24', NULL);
/*!40000 ALTER TABLE `ads`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id`           INT(11)                             NOT NULL AUTO_INCREMENT,
  `reviews_id`   INT(11)                             NOT NULL
  COMMENT 'отзыв',
  `questions_id` INT(11)                             NOT NULL
  COMMENT 'вопрос',
  `options_id`   INT(11)                                      DEFAULT NULL
  COMMENT 'вариант ответа на вопрос',
  `intfield`     INT(11)                                      DEFAULT NULL
  COMMENT 'цифровое поле ответа',
  `textfield`    TEXT COMMENT 'текстовое поле ответа',
  `smilefield`   ENUM ('0', '1', '2', '3', '4', '5') NOT NULL DEFAULT '0'
  COMMENT 'ответ смайликом',
  `circlefield`  ENUM ('0', '1', '2', '3', '4', '5') NOT NULL DEFAULT '0'
  COMMENT 'ответ цифрой',
  PRIMARY KEY (`id`),
  KEY `fk_answers_options` (`options_id`),
  KEY `fk_answers_questions` (`questions_id`),
  KEY `fk_answers_reviews` (`reviews_id`),
  CONSTRAINT `fk_answers_options` FOREIGN KEY (`options_id`) REFERENCES `options` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_answers_questions` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_answers_reviews` FOREIGN KEY (`reviews_id`) REFERENCES `reviews` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 515
  DEFAULT CHARSET = utf8
  COMMENT ='ответы пользователей';

-- Дамп данных таблицы proto_loc.answers: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `answers`
  DISABLE KEYS */;
INSERT INTO `answers` (`id`, `reviews_id`, `questions_id`, `options_id`, `intfield`, `textfield`, `smilefield`, `circlefield`)
VALUES
  (514, 233, 425, NULL, 771, NULL, '0', '0');
/*!40000 ALTER TABLE `answers`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.atc
CREATE TABLE IF NOT EXISTS `atc` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `title`    TEXT COMMENT 'фраза',
  `original` TEXT COMMENT 'оригинал фразы',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 13
  DEFAULT CHARSET = utf8
  COMMENT ='фразы АТС';

-- Дамп данных таблицы proto_loc.atc: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `atc`
  DISABLE KEYS */;
INSERT INTO `atc` (`id`, `title`, `original`) VALUES
  (1, 'Здравствуйте! Вы позвонили в службу отзывов .',
   'Здравствуйте! Вы позвонили в службу отзывов .'),
  (2, 'Ваш звонок прервался и будет продолжен с прерванного момента.', 'Ваш звонок прервался и будет продолжен с прерванного момента.'),
  (3, 'В тональном режиме введите добавочный номер.', 'В тональном режиме введите добавочный номер.'),
  (4, 'Пожалуйста, ответьте на следующие вопросы в тональном режиме.', 'Пожалуйста ответьте на следующие вопросы в тональном режиме.'),
  (5, 'К сожалению, введенный вами добавочный номер не зарегистрирован. Попробуйте повторить ввод.', 'К сожалению, введенный вами добавочный номер не зарегистрирован у нас. Попробуйте повторить ввод.'),
  (6, 'Благодарим вас за отзыв. Ваше мнение очень важно для нас. Всего вам доброго.', 'Благодарим вас за отзыв. Ваше мнение очень важно для нас. Всего вам доброго, до свидания.'),
  (7, 'Здравствуйте! Вы вендор и не можете оставлять отзывы. До свидания.', 'Здравствуйте! Вы вендор и не можете оставлять отзывы. Досвидания.'),
  (8, 'Неправильный ввод.', 'Неправильный ввод.'),
  (9, '+7 (903) 7676 181', 'SMS-номер'),
  (10, '+7 (812) 244 9472', 'АТС-номер'),
  (11, '<p>Добро пожаловать на .ру!</p><p>&nbsp;</p><p>Ваш личный кабинет готов и Вы можете начать получать отзывы Ваших клиентов прямо сейчас!</p><p>Создать опрос прямо сейчас - http://.ru/createpoll</p><p>Войти в Ваш личный кабинет - http://.ru/login/login</p><p>&nbsp;</p><p>Если у Вас остались вопросы, пожалуйста, напишите нам о них здесь http://.ru/question</p><p>Или позвоните на +7 911 751 51 42 и наш менеджер ответит на все ваши вопросы.</p><p>&nbsp;</p><p>С уважением, команда <strong>.ру</strong>.</p><p>www..ru&nbsp;</p>', 'велком-сообщение новому вендору на почту'),
  (12,
   '<p>Добро пожаловать на .ру!</p>\n<p>&nbsp;</p>\n<p>Войти в Ваш личный кабинет http://.ru/login/login</p>',
   'велком-сообщение новому вендору на смс');
/*!40000 ALTER TABLE `atc`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id`        INT(11) NOT NULL AUTO_INCREMENT,
  `parent_id` INT(11) NOT NULL DEFAULT '0'
  COMMENT 'родительская категория',
  `title`     VARCHAR(255)     DEFAULT NULL
  COMMENT 'название',
  `ext`       VARCHAR(255)     DEFAULT NULL
  COMMENT 'расширение файла',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 27
  DEFAULT CHARSET = utf8
  COMMENT ='категории объектов';

-- Дамп данных таблицы proto_loc.categories: ~25 rows (приблизительно)
/*!40000 ALTER TABLE `categories`
  DISABLE KEYS */;
INSERT INTO `categories` (`id`, `parent_id`, `title`, `ext`) VALUES
  (1, 1, 'Без категории', NULL),
  (2, 0, 'Авто', NULL),
  (3, 2, 'Автомойки', NULL),
  (5, 0, 'Развлечения', NULL),
  (6, 5, 'Рестораны', NULL),
  (7, 5, 'Клубы', NULL),
  (8, 2, 'Автосервисы', NULL),
  (9, 5, 'Кафе', NULL),
  (10, 0, 'Event', NULL),
  (11, 0, 'Образование', NULL),
  (12, 11, 'Тренинговый центр/образовательная плошадка', NULL),
  (13, 11, 'Школа/детский сад/секция', NULL),
  (14, 0, 'Другие услуги', NULL),
  (15, 14, 'Химчистка', NULL),
  (16, 14, 'Ателье/пошив одежды', NULL),
  (17, 14, 'Копи-центр/типография', NULL),
  (18, 11, 'Коуч/тренер/репетитор (индивидуальные услуги)', NULL),
  (19, 10, 'Бизнес-мероприятие', NULL),
  (20, 10, 'Образовательное мероприятие', NULL),
  (21, 10, 'Тренинг/семинар', NULL),
  (22, 10, 'Детское мероприятие', NULL),
  (23, 10, 'Другое', NULL),
  (24, 24, 'Без категории', NULL),
  (25, 0, 'Без категории', NULL),
  (26, 0, 'Магазин', NULL);
/*!40000 ALTER TABLE `categories`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id`         INT(11)   NOT NULL AUTO_INCREMENT,
  `reviews_id` INT(11)   NOT NULL
  COMMENT 'отзыв',
  `users_id`   INT(11)   NOT NULL
  COMMENT 'пользователь',
  `desc`       TEXT COMMENT 'текст коммента',
  `created`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT 'дата создания',
  PRIMARY KEY (`id`),
  KEY `fk_comments_users` (`users_id`),
  KEY `fk_comments_reviews` (`reviews_id`),
  CONSTRAINT `fk_comments_reviews` FOREIGN KEY (`reviews_id`) REFERENCES `reviews` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT ='комменты к отзывам';

-- Дамп данных таблицы proto_loc.comments: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `comments`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `comments`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.documents
CREATE TABLE IF NOT EXISTS `documents` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `users_id` INT(11) NOT NULL
  COMMENT 'пользователь',
  `ext`      VARCHAR(255)     DEFAULT NULL
  COMMENT 'расширение файла',
  PRIMARY KEY (`id`),
  KEY `fk_documents_users1_idx` (`users_id`),
  CONSTRAINT `fk_documents_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT ='документы пользователей';

-- Дамп данных таблицы proto_loc.documents: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `documents`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `documents`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.faq
CREATE TABLE IF NOT EXISTS `faq` (
  `id`        INT(11)   NOT NULL AUTO_INCREMENT,
  `question`  TEXT,
  `answercat` TEXT,
  `answer`    TEXT,
  `ext`       VARCHAR(255)       DEFAULT NULL,
  `created`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug`      VARCHAR(255)       DEFAULT NULL
  COMMENT 'ЧПУ',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 116
  DEFAULT CHARSET = utf8
  COMMENT ='блог';

-- Дамп данных таблицы proto_loc.faq: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `faq`
  DISABLE KEYS */;
INSERT INTO `faq` (`id`, `question`, `answercat`, `answer`, `ext`, `created`, `slug`) VALUES
  (106, 'Способы сбора отзывов клиентов',
   '',
   '',
   'jpg', '2015-10-30 18:01:57', 'sposobi-sbora-otzivov'),
  (107, 'Как правильно составить опрос для сбора отзывов, который действительно будет работать.',
   '',
   '',
   'jpg', '2015-10-30 18:02:30', 'kak-pravilno-sostavit-opros'),
  (108, 'Конкурентные преимущества .ру',
   '',
   '',
   'jpg', '2015-10-30 18:02:44', 'konkurentniye-preimushestva-o4'),
  (109, 'Как начать получать отзывы клиентов прямо сейчас.',
   '',
   '',
   'JPG', '2016-01-16 05:44:25', 'kak-nachat-poluchat-otzivi'),
  (111, 'Типы вопросов которые вы можете задавать вашим клиентам используя .ру',
   '<p><big><strong>В своих опросах на</strong><strong>&nbsp;<a href="http://www..ru/">.ру</a></strong><strong>,</strong><strong>&nbsp;</strong><strong>вы сможете создавать следующие типы вопросов:</strong></big></p>\n\n<ul>\n	<li><big>Одиночный выбор из вариантов</big></li>\n	<li><big>Множественный выбор из вариантов</big></li>\n	<li><big>Шкала от 1 до 5</big></li>\n	<li><big>Смайлики</big></li>\n	<li><big>Цифровой интервал</big></li>\n	<li><big>Текстовой ответ</big></li>\n</ul>\n\n<p><big>Подробнее в нашей статье...</big></p>\n',
   '',
   'JPG', '2016-01-16 07:06:52', 'tipy-voprosov'),
  (112, 'За что .ру берет деньги?',
   '<ul>\n	<li><big>Без абонентской платы</big></li>\n	<li><big>100 первых отзывов бесплатно</big></li>\n	<li><big>Количество объектов оценки, опросов и вопросов неограничено и бесплатно.</big></li>\n	<li><big>Все каналы сюора отзывов - бесплатно</big></li>\n	<li><big>За что же мы берем деньги?</big></li>\n</ul>\n\n<p><big>Читайте в статье...</big></p>\n',
   '',
   'jpg', '2016-01-16 07:21:44', 'za-cho-o4-beret-dengi'),
  (113, 'Важные правила создания опроса участников мероприятия',
   '<p><big>- как получить обратную связь от участников мероприятия?</big></p>\n\n<p><big>- когда ее получать? До, во время или после мероприятия?</big></p>\n\n<p><big>- какие вопросы задавать?</big></p>\n\n<p><big>Об этом читайте в нашей статье...</big></p>\n',
   '',
   'jpg', '2016-02-27 09:44:15', 'opros-event'),
  (114, 'Как провести опрос клиентов через смс? Какие преимущества этого способа?',
   '<p><big>Современные технологии позволяют узнать мнения ваших клиентов десятками способов. Сегодня мы рассмотрим смс-опрос. Под опросом будем понимать отзыв клиента, который вы получаете через смс.</big></p>\n\n<p>&nbsp;</p>\n',
   '',
   'jpg', '2016-03-13 13:49:43', 'sms-opros'),
  (115, 'Обратная связь с клиентами на вашем сайте',
   '<p><big>Большая часть клиентов узнает о ваших товарах и услугах через ваш сайт. Крайне важно дать возможность клиентам легко и просто давайть вам обратную связь, т.к. эта&nbsp;информация является бесценной для любого бизнеса и собственника.&nbsp;&nbsp;</big></p>\n',
   '',
   'jpg', '2016-04-02 10:47:28', 'obratnaya-svyaz-nasayte');
/*!40000 ALTER TABLE `faq`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.flayers
CREATE TABLE IF NOT EXISTS `flayers` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `title`    VARCHAR(255)     DEFAULT NULL
  COMMENT 'название',
  `size`     VARCHAR(255)     DEFAULT NULL
  COMMENT 'размер в мм',
  `delivery` TEXT COMMENT 'условия доставки',
  `term`     VARCHAR(255)     DEFAULT NULL
  COMMENT 'срок доставки',
  `ext`      VARCHAR(255)     DEFAULT NULL,
  `cost_h`   FLOAT            DEFAULT NULL
  COMMENT 'цена за 100шт горизонтальных',
  `cost_v`   FLOAT            DEFAULT NULL
  COMMENT 'цена за 100шт вертикальных',
  `cost_s`   FLOAT            DEFAULT NULL
  COMMENT 'цена за 100шт квадратных',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 14
  DEFAULT CHARSET = utf8
  COMMENT ='носители';

-- Дамп данных таблицы proto_loc.flayers: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `flayers`
  DISABLE KEYS */;
INSERT INTO `flayers` (`id`, `title`, `size`, `delivery`, `term`, `ext`, `cost_h`, `cost_v`, `cost_s`) VALUES
  (1, 'Визитки', '90*50 мм', 'от 1 дня', 'Уточняйте у менеджера', 'png', 450, 450, 450),
  (6, 'Листовки', 'А4', 'от 1 дня', 'Уточняйте у менеджера', 'png', 800, 800, 800),
  (7, 'Наклейки, стикеры', 'А4, А5', 'от 1 дня', 'Уточняйте у менеджера', 'png', 1900, 1100, 700),
  (8, 'Футболки/кружки/др.', 'Размер изображения, объем тиража и другие детали уточняются при формировании заказа',
   'от 1 дня', 'Уточняйте у менеджера', 'png', 250, 300, 0),
  (10, 'Флаеры', '97*210 мм; 80*150 мм', 'от 1 дня', 'от 1 дня', 'png', 650, 450, 0),
  (11, 'Плакаты, постеры', 'А3 (297*420мм), i4 (350*640 мм)', 'от 1 дня', 'от 3 дней', 'png', 3100, 5000, 0),
  (12, 'Календари', 'Карманные', 'от 1 дня', 'от 3 дней', 'png', 800, 800, 0),
  (13, 'Без носителей', 'Выберите этот вариант, если не хотите печатать носители', '-', '-', NULL, 0, 0, 0);
/*!40000 ALTER TABLE `flayers`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.fotos
CREATE TABLE IF NOT EXISTS `fotos` (
  `id`         INT(11)         NOT NULL AUTO_INCREMENT,
  `objects_id` INT(11)         NOT NULL
  COMMENT 'объект',
  `ext`        VARCHAR(255)             DEFAULT NULL
  COMMENT 'расширение файла',
  `main`       ENUM ('0', '1') NOT NULL DEFAULT '0'
  COMMENT 'тип: 0-обычная,1-главная фотка',
  PRIMARY KEY (`id`),
  KEY `fk_fotos_objects` (`objects_id`),
  CONSTRAINT `fk_fotos_objects` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 50
  DEFAULT CHARSET = utf8
  COMMENT ='фотки объектов';

-- Дамп данных таблицы proto_loc.fotos: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `fotos`
  DISABLE KEYS */;
INSERT INTO `fotos` (`id`, `objects_id`, `ext`, `main`) VALUES
  (23, 78, 'png', '1'),
  (24, 22, 'jpg', '1'),
  (25, 79, 'jpg', '1'),
  (26, 80, 'jpg', '1'),
  (27, 81, 'jpg', '1'),
  (28, 74, 'png', '1'),
  (31, 89, 'jpg', '1'),
  (35, 98, 'jpg', '1'),
  (38, 144, 'jpg', '1'),
  (47, 157, 'jpg', '1'),
  (48, 157, 'jpg', '0'),
  (49, 157, 'jpg', '0');
/*!40000 ALTER TABLE `fotos`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.objects
CREATE TABLE IF NOT EXISTS `objects` (
  `id`             INT(11)         NOT NULL AUTO_INCREMENT,
  `categories_id`  INT(11)         NOT NULL
  COMMENT 'категория',
  `users_id`       INT(11)         NOT NULL
  COMMENT 'пользователь',
  `polls_id`       INT(11)         NOT NULL
  COMMENT 'опрос',
  `title`          VARCHAR(255)             DEFAULT NULL
  COMMENT 'название',
  `desc`           TEXT COMMENT 'описание',
  `address`        VARCHAR(255)             DEFAULT NULL
  COMMENT 'адрес',
  `tel`            VARCHAR(255)             DEFAULT NULL
  COMMENT 'телефон',
  `place_id`       VARCHAR(255)             DEFAULT NULL
  COMMENT 'id места на гуглокартах',
  `lat`            FLOAT(10, 6)             DEFAULT NULL
  COMMENT 'координата google maps',
  `lng`            FLOAT(10, 6)             DEFAULT NULL
  COMMENT 'координата google maps',
  `maparray`       TEXT COMMENT 'все данные google map по месту',
  `created`        TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT 'дата создания',
  `defaultcomment` TEXT COMMENT 'коммент по-умолчанию для ответов вендора пользователям',
  `delitem`        ENUM ('0', '1') NOT NULL DEFAULT '0'
  COMMENT 'удаление: 0-неудалено, 1-удалено',
  `hashtag`        VARCHAR(255)             DEFAULT NULL,
  `viewreviews`    ENUM ('0', '1') NOT NULL DEFAULT '0'
  COMMENT '0-отзывы публичны, 1-отзывы непубличны',
  PRIMARY KEY (`id`),
  KEY `fk_objects_categories` (`categories_id`),
  KEY `fk_objects_users1_idx` (`users_id`),
  KEY `fk_objects_polls1_idx` (`polls_id`),
  CONSTRAINT `fk_objects_categories` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_objects_polls1` FOREIGN KEY (`polls_id`) REFERENCES `polls` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_objects_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 755
  DEFAULT CHARSET = utf8
  COMMENT ='объекты';

-- Дамп данных таблицы proto_loc.objects: ~19 rows (приблизительно)
/*!40000 ALTER TABLE `objects`
  DISABLE KEYS */;
INSERT INTO `objects` (`id`, `categories_id`, `users_id`, `polls_id`, `title`, `desc`, `address`, `tel`, `place_id`, `lat`, `lng`, `maparray`, `created`, `defaultcomment`, `delitem`, `hashtag`, `viewreviews`)
VALUES
  (22, 23, 2, 42, '.ру', 'Автоматизированный сервис сбора отзывов .ру', 'Санкт-Петербург, Россия', '',
       '', 0.000000, 0.000000, '', '2015-05-21 09:44:14',
   'Спасибо за вашу сть! Оставайтесь с нами на .ру', '0', NULL, '0'),
  (72, 9, 2, 115, 'Кафе №1', '', '', '', '', 0.000000, 0.000000, '', '2015-09-22 14:51:37', 'Спасибо за Ваш отзыв!', '0', NULL, '0'),
  (74, 23, 2, 48, 'Интернет-магазин', '', '', '', '', 0.000000, 0.000000, '', '2015-09-22 16:34:02', 'Спасибо за Ваш отзыв!', '0', '124YvhUShiwfY', '0'),
  (75, 23, 2, 46, 'Магазин на Кирочной', '', '', '', '', 0.000000, 0.000000, '', '2015-09-23 06:59:32', 'Спасибо за Ваш отзыв! ', '0', '12J8QUjmlOCxQ', '0'),
  (78, 19, 2, 45, 'Форум iPlace', 'Ежегодный форум по продажам и маркетингу для поддержки малого и среднего бизнеса в Санкт-Петербурге. http://iplaceconf.ru/', 'Лермонтовский пр., Санкт-Петербург, Россия', '', '', 0.000000, 0.000000, '', '2015-10-04 16:55:15', 'Спасибо за Ваш ответ! С уважением, команда организаторов форума iPlace', '0', NULL, '0'),
  (79, 19, 2, 45, 'Российская Неделя Продаж 2015', 'Крупнейшее мероприятие в сфере продаж и маркетинга в России. 25-28 ноября, Москва+ онлайн', 'Москва, Россия', '', 'ChIJybDUc_xKtUYRTM9XV8zWRD0', 0.000000, 0.000000, '{"address_components":[{"long_name":"Москва","short_name":"Москва","types":["locality","political"]},{"long_name":"город Москва","short_name":"г. Москва","types":["administrative_area_level_2","political"]},{"long_name":"город Москва","short_name":"г. Москва","types":["administrative_area_level_1","political"]},{"long_name":"Россия","short_name":"RU","types":["country","political"]}],"adr_address":"<span class=\\"locality\\">Москва</span>, <span class=\\"country-name\\">Россия</span>","formatted_address":"Москва, Россия","geometry":{"location":{"H":55.755826,"L":37.6173},"viewport":{"Ka":{"H":55.48992699999999,"j":56.009657},"Ga":{"j":37.319328799999994,"H":37.94566110000005}}},"icon":"https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png","id":"1a0f08fcbc047354782f00ab52e66fb56d1aadf7","name":"Москва","place_id":"ChIJybDUc_xKtUYRTM9XV8zWRD0","reference":"CoQBdwAAAI5lE8xKgqhnw6E9tF260Fob_ScRY6Aw_3GO1hwMTSCNX2Hyr3-SOrbfNb0s4b9Fn9yBASAFGJg-Cx-OPlKHVrvYDtzcoQn9W8QNexKDco9WF9_tyQpVpW-xx1L8eFT3-ueDmfqUrS_BKV_WopcdgCFlMV-Hpl_LaNqb1-jSUF1REhCwkj2BZBh0xIBx536QQEqVGhSWqhbQ1CUwhpqqcsMuY2IZMzNOkA","scope":"GOOGLE","types":["locality","political"],"url":"https://maps.google.com/maps/place?q=%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F&ftid=0x46b54afc73d4b0c9:0x3d44d6cc5757cf4c","vicinity":"Москва","html_attributions":[]}', '2015-10-04 23:08:32', 'Для нас не ничего ценнее, чем Ваше мнение. Благодарим! До встрече на Российском Форуме Продаж в следующем году!', '1', NULL, '0'),
  (80, 19, 2, 45, 'Российский Форум Маркетинга 2015', 'Крупнейшее бизнес-мероприятие года, посвященное самым последним маркетинговым технологиям и трендам. 11-14 ноября, Москва', 'Москва, Россия', '', 'ChIJybDUc_xKtUYRTM9XV8zWRD0', 0.000000, 0.000000, '{"address_components":[{"long_name":"Москва","short_name":"Москва","types":["locality","political"]},{"long_name":"город Москва","short_name":"г. Москва","types":["administrative_area_level_2","political"]},{"long_name":"город Москва","short_name":"г. Москва","types":["administrative_area_level_1","political"]},{"long_name":"Россия","short_name":"RU","types":["country","political"]}],"adr_address":"<span class=\\"locality\\">Москва</span>, <span class=\\"country-name\\">Россия</span>","formatted_address":"Москва, Россия","geometry":{"location":{"H":55.755826,"L":37.6173},"viewport":{"Ka":{"H":55.48992699999999,"j":56.009657},"Ga":{"j":37.319328799999994,"H":37.94566110000005}}},"icon":"https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png","id":"1a0f08fcbc047354782f00ab52e66fb56d1aadf7","name":"Москва","place_id":"ChIJybDUc_xKtUYRTM9XV8zWRD0","reference":"CoQBdwAAAI5lE8xKgqhnw6E9tF260Fob_ScRY6Aw_3GO1hwMTSCNX2Hyr3-SOrbfNb0s4b9Fn9yBASAFGJg-Cx-OPlKHVrvYDtzcoQn9W8QNexKDco9WF9_tyQpVpW-xx1L8eFT3-ueDmfqUrS_BKV_WopcdgCFlMV-Hpl_LaNqb1-jSUF1REhCwkj2BZBh0xIBx536QQEqVGhSWqhbQ1CUwhpqqcsMuY2IZMzNOkA","scope":"GOOGLE","types":["locality","political"],"url":"https://maps.google.com/maps/place?q=%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F&ftid=0x46b54afc73d4b0c9:0x3d44d6cc5757cf4c","vicinity":"Москва","html_attributions":[]}', '2015-10-05 02:25:17', 'Для нас нет ничего ценнее, чем Ваше мнение. Спасибо за Ваш отзыв. До встречи на Российской Неделе Маркетинга 2016!', '1', NULL, '0'),
  (81, 20, 2, 152, 'Фестиваль Живой Диалог', 'Первый городской молодежный фестиваль "Живой диалог".', 'пр-кт Крестовский, 23А, Санкт-Петербург, Россия', '', '', 0.000000, 0.000000, '', '2015-10-05 02:29:56', 'Спасибо за Ваше честное мнение! До встречи в следующем году!', '0', '86pmatajZpj8o', '0'),
  (82, 18, 2, 42, 'тест объект', '', 'пр-т Мира, 211, Москва, Россия', '1111111111', '', 0.000000, 0.000000, '', '2015-10-05 11:42:00', 'Спасибо за Ваш отзыв. тест объект', '1', NULL, '0'),
  (83, 3, 2, 122, 'тест объект (debug)', '', '', '', '', 0.000000, 0.000000, '', '2015-10-06 09:49:09', 'Спасибо за Ваш отзыв. тест объект (debug)', '1', NULL, '0'),
  (89, 21, 2, 45, 'Атланты Бизнеса', 'Школа Продающих Технологий "Атланты Бизнеса". Успех не случаен!', '', '', '', 0.000000, 0.000000, '', '2015-10-12 15:34:42', 'Благодарим за мнение. До встречи!', '1', NULL, '0'),
  (98, 20, 2, 118, 'Центр предпринимательства LIKE Санкт-Петербург',
       'Привет! Нам очень важно твое мнение о качестве работы центра!',
       'Лиговский пр., 150, Санкт-Петербург, Россия, 192007', '', '', 0.000000, 0.000000, '', '2015-10-22 12:08:32',
   'Спасибо, ты помог нам стать лучше!', '0', NULL, '0'),
  (134, 1, 2, 176, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-05 10:11:25', 'Спасибо за Ваш отзыв. 1', '0',
   '23FFimc8acWPI', '0'),
  (135, 1, 2, 177, 'awd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-05 10:17:26', 'Спасибо за Ваш отзыв. awd',
   '0', '45bIE9H9XvHH2', '0'),
  (136, 1, 2, 799, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-05 13:16:07', 'Спасибо за Ваш отзыв. 1', '0',
   '12MW8cMMjaCY8', '0'),
  (137, 1, 2, 179, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-05 13:26:20', 'Спасибо за Ваш отзыв. 1', '0',
   '92gEHSsko8YTI', '0'),
  (144, 6, 2, 800, 'Ресторан Аэлита', '', 'Москва, Россия', '', '', 0.000000, 0.000000, '', '2015-11-09 12:54:38',
   'Спасибо за Ваш отзыв! Ресторан Аэлита', '0', '91mw7p7GvsTOU', '0'),
  (157, 8, 198, 200, 'название объекта', 'описание объекта', 'Красная пл., 3, Москва, Россия, 101000', '', '', 0.000000,
        0.000000, '', '2015-11-21 09:58:30', 'Спасибо за Ваш отзыв. объект 1', '0', NULL, '0'),
  (754, 3, 198, 200, '123', '', '', '', '', 0.000000, 0.000000, '', '2015-12-23 19:55:32', 'Спасибо за Ваш отзыв. 123',
   '0', NULL, '0');
/*!40000 ALTER TABLE `objects`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.options
CREATE TABLE IF NOT EXISTS `options` (
  `id`            INT(11) NOT NULL AUTO_INCREMENT,
  `questions_id`  INT(11) NOT NULL
  COMMENT 'вопрос',
  `var_field`     VARCHAR(255)     DEFAULT NULL
  COMMENT 'текстовое поле',
  `min_int_field` INT(11)          DEFAULT NULL
  COMMENT 'цифровое поле min',
  `max_int_field` INT(11)          DEFAULT NULL
  COMMENT 'цифровое поле max',
  PRIMARY KEY (`id`),
  KEY `fk_options_questions` (`questions_id`),
  CONSTRAINT `fk_options_questions` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 5717
  DEFAULT CHARSET = utf8
  COMMENT ='варианты ответов на вопросы';

-- Дамп данных таблицы proto_loc.options: ~203 rows (приблизительно)
/*!40000 ALTER TABLE `options`
  DISABLE KEYS */;
INSERT INTO `options` (`id`, `questions_id`, `var_field`, `min_int_field`, `max_int_field`) VALUES
  (325, 148, 'Около 10 секунд', NULL, NULL),
  (326, 148, 'Примерно минуту', NULL, NULL),
  (327, 148, 'Около 5 минут', NULL, NULL),
  (328, 149, 'Нашел в Интернете (Яндекс, Google)', NULL, NULL),
  (329, 149, 'Зашел на сайт по рекомендации друзей/коллег', NULL, NULL),
  (330, 149, 'Проходит опрос с помощью ', NULL, NULL),
  (331, 150, 'Вещи почищены хорошо', NULL, NULL),
  (332, 150, 'Вещи почищены нормально', NULL, NULL),
  (333, 150, 'Вещи почищены плохо', NULL, NULL),
  (334, 151, 'Быстро, заняло мало времени', NULL, NULL),
  (335, 151, 'Нормально, ждал не долго', NULL, NULL),
  (336, 151, 'Пришлось долго ждать', NULL, NULL),
  (337, 152, 'Верхняя одежда', NULL, NULL),
  (338, 152, 'Подушки/одеяла/пуховики', NULL, NULL),
  (339, 152, 'Вещи со сложными пятнами', NULL, NULL),
  (340, 154, 'очень вкусно ', NULL, NULL),
  (341, 154, 'хорошо', NULL, NULL),
  (342, 154, 'так себе', NULL, NULL),
  (343, 154, 'ужасно', NULL, NULL),
  (351, 157, 'Да', NULL, NULL),
  (352, 157, 'Нет', NULL, NULL),
  (353, 159, 'Актуально, много полезной информации', NULL, NULL),
  (354, 159, 'В целом интересно и полезно', NULL, NULL),
  (355, 159, 'Мероприятие не соответствовало моим ожиданиям, анонсам', NULL, NULL),
  (356, 160, 'Время и место хорошо продуманы', NULL, NULL),
  (357, 160, 'Не совсем удобное место', NULL, NULL),
  (358, 160, 'Не совсем удобное время начала', NULL, NULL),
  (359, 161, 'Отлично', NULL, NULL),
  (360, 161, 'Хорошо', NULL, NULL),
  (361, 161, 'Можно было бы и лучше', NULL, NULL),
  (362, 161, 'Плохо', NULL, NULL),
  (363, 162, 'Очень много', NULL, NULL),
  (364, 162, 'Достаточно', NULL, NULL),
  (365, 164, 'Да, могу найти всё, что мне нужно', NULL, NULL),
  (366, 164, 'Да, но иногда не нахожу чего-то', NULL, NULL),
  (367, 164, 'Нет, сложно найти то, что мне нужно', NULL, NULL),
  (368, 165, 'Накопления на карту с каждой покупки', NULL, NULL),
  (369, 165, 'Скидки при каждой покупке', NULL, NULL),
  (370, 165, 'Специальные предложения и акции', NULL, NULL),
  (371, 166, 'Вежливые, отзывчивые и спешат на помощь', NULL, NULL),
  (372, 166, 'Стандартные, работающие ', NULL, NULL),
  (373, 166, 'Невнимательные, грубые', NULL, NULL),
  (374, 167, 'Высокое', NULL, NULL),
  (375, 167, 'Приемлемое', NULL, NULL),
  (376, 167, 'Низкое', NULL, NULL),
  (377, 169, 'Да', NULL, NULL),
  (378, 169, 'Нет', NULL, NULL),
  (379, 170, 'С открытия до обеда', NULL, NULL),
  (380, 170, 'после обеда и до шести вечера', NULL, NULL),
  (381, 171, 'Да', NULL, NULL),
  (382, 171, 'Нет', NULL, NULL),
  (383, 172, 'Да', NULL, NULL),
  (384, 172, 'Нет', NULL, NULL),
  (391, 175, 'Информации достаточно', NULL, NULL),
  (392, 175, 'Информации не хватает', NULL, NULL),
  (393, 175, 'Информации очень мало', NULL, NULL),
  (394, 176, 'Да, доставили вовремя', NULL, NULL),
  (395, 176, 'Нет, оставили невовремя, возникли проблемы', NULL, NULL),
  (396, 177, 'Да, это то, что я ожидал!', NULL, NULL),
  (397, 177, 'Приемлемый уровень качества', NULL, NULL),
  (398, 177, 'Качество ниже моих ожиданий...', NULL, NULL),
  (399, 179, 'отлично', NULL, NULL),
  (400, 179, 'хорошо', NULL, NULL),
  (401, 179, 'нормально', NULL, NULL),
  (402, 179, 'плохо', NULL, NULL),
  (403, 180, 'отлично', NULL, NULL),
  (404, 180, 'хорошо', NULL, NULL),
  (405, 180, 'нормально', NULL, NULL),
  (406, 180, 'плохо', NULL, NULL),
  (407, 181, 'хорошо и уютно', NULL, NULL),
  (408, 181, 'нормально', NULL, NULL),
  (409, 181, 'не очень уютно и комфортно', NULL, NULL),
  (410, 182, 'да', NULL, NULL),
  (411, 182, 'нет', NULL, NULL),
  (412, 184, 'отлично', NULL, NULL),
  (413, 184, 'хорошо', NULL, NULL),
  (414, 184, 'нормально', NULL, NULL),
  (415, 184, 'плохо', NULL, NULL),
  (416, 185, 'отлично', NULL, NULL),
  (417, 185, 'хорошо', NULL, NULL),
  (418, 185, 'нормально', NULL, NULL),
  (419, 185, 'плохо', NULL, NULL),
  (420, 186, 'хорошо и уютно', NULL, NULL),
  (421, 186, 'нормально', NULL, NULL),
  (422, 186, 'не очень уютно и комфортно', NULL, NULL),
  (423, 187, 'да', NULL, NULL),
  (424, 187, 'нет', NULL, NULL),
  (878, 387, NULL, 1, 100),
  (920, 425, NULL, 100, 1000),
  (921, 426, NULL, 100, 1000),
  (922, 427, 'Отлично', NULL, NULL),
  (923, 427, 'Хорошо', NULL, NULL),
  (924, 427, 'Можно было и лучше', NULL, NULL),
  (925, 427, 'Плохо', NULL, NULL),
  (926, 428, 'Захожу к вам позавтракать', NULL, NULL),
  (927, 428, 'Мне нравится бизнес-ланчи', NULL, NULL),
  (928, 428, 'Предпочитаю ужинать ', NULL, NULL),
  (929, 428, 'Захожу изредка, когда есть возможность', NULL, NULL),
  (930, 429, 'Постоянно', NULL, NULL),
  (931, 429, 'Иногда', NULL, NULL),
  (932, 429, 'Еще не пользовался', NULL, NULL),
  (933, 430, 'Да!', NULL, NULL),
  (934, 430, 'Нет...', NULL, NULL),
  (959, 149, 'Увидел информацию на выставке, форуме, соц.сетях', NULL, NULL),
  (960, 160, 'Неудобные место и время', NULL, NULL),
  (961, 162, 'Не общался', NULL, NULL),
  (963, 152, NULL, NULL, NULL),
  (964, 448, 'Е-mail рассылка', NULL, NULL),
  (965, 448, 'Партнерские программы и бонусы', NULL, NULL),
  (966, 448, 'Интеграция с внешними сайтами', NULL, NULL),
  (967, 448, 'Меня устраивает функционал сайта', NULL, NULL),
  (968, 446, NULL, 1, 1000),
  (969, 449, 'интернет', NULL, NULL),
  (970, 449, 'от знакомых', NULL, NULL),
  (971, 449, 'реклама', NULL, NULL),
  (972, 449, 'другое ', NULL, NULL),
  (991, 460, '1', NULL, NULL),
  (992, 461, '1', NULL, NULL),
  (993, 462, NULL, 1, 1),
  (994, 466, 'ответ 11', NULL, NULL),
  (995, 466, 'ответ 21', NULL, NULL),
  (996, 466, 'ответ 31', NULL, NULL),
  (997, 467, 'ответ 12', NULL, NULL),
  (998, 467, 'ответ 22', NULL, NULL),
  (999, 467, 'ответ 32', NULL, NULL),
  (1000, 468, NULL, 100, 1000),
  (1041, 509, 'Да', NULL, NULL),
  (1042, 509, 'Нет', NULL, NULL),
  (1190, 593, 'Интернет', NULL, NULL),
  (1191, 593, 'Рекомендация друзей/коллег', NULL, NULL),
  (1192, 593, 'Реклама на ТВ, радио, метро, СМИ', NULL, NULL),
  (1193, 593, 'Нашел случайно', NULL, NULL),
  (1194, 595, 'Да', NULL, NULL),
  (1195, 595, 'Нет', NULL, NULL),
  (1374, 696, 'Интернет', NULL, NULL),
  (1375, 696, 'Рекомендация друзей/коллег', NULL, NULL),
  (1376, 696, 'Реклама на ТВ, радио, метро, СМИ', NULL, NULL),
  (1377, 696, 'Нашел случайно', NULL, NULL),
  (1378, 698, 'Да', NULL, NULL),
  (1379, 698, 'Нет', NULL, NULL),
  (1380, 700, 'Интернет', NULL, NULL),
  (1381, 700, 'Рекомендация друзей/коллег', NULL, NULL),
  (1382, 700, 'Реклама на ТВ, радио, метро, СМИ', NULL, NULL),
  (1383, 700, 'Нашел случайно', NULL, NULL),
  (1384, 702, 'Да', NULL, NULL),
  (1385, 702, 'Нет', NULL, NULL),
  (1386, 704, 'Интернет', NULL, NULL),
  (1387, 704, 'Рекомендация друзей/коллег', NULL, NULL),
  (1388, 704, 'Реклама на ТВ, радио, метро, СМИ', NULL, NULL),
  (1389, 704, 'Нашел случайно', NULL, NULL),
  (1390, 706, 'Да', NULL, NULL),
  (1391, 706, 'Нет', NULL, NULL),
  (1392, 708, 'Интернет', NULL, NULL),
  (1393, 708, 'Рекомендация друзей/коллег', NULL, NULL),
  (1394, 708, 'Реклама на ТВ, радио, метро, СМИ', NULL, NULL),
  (1395, 708, 'Нашел случайно', NULL, NULL),
  (1396, 710, 'Да', NULL, NULL),
  (1397, 710, 'Нет', NULL, NULL),
  (5672, 509, 'не уверен', NULL, NULL),
  (5673, 3105, 'Интернет', NULL, NULL),
  (5674, 3105, 'Реклама ', NULL, NULL),
  (5675, 3105, 'От знакомых', NULL, NULL),
  (5676, 3105, 'Не помню', NULL, NULL),
  (5677, 3106, 'Да', NULL, NULL),
  (5678, 3106, 'Нет', NULL, NULL),
  (5679, 3106, 'Не уверен', NULL, NULL),
  (5680, 3109, 'Интернет', NULL, NULL),
  (5681, 3109, 'Реклама ', NULL, NULL),
  (5682, 3109, 'От знакомых', NULL, NULL),
  (5683, 3109, 'Не помню', NULL, NULL),
  (5684, 3111, 'Да', NULL, NULL),
  (5685, 3111, 'Нет', NULL, NULL),
  (5686, 3111, 'Не уверен', NULL, NULL),
  (5687, 3114, 'Интернет', NULL, NULL),
  (5688, 3114, 'Реклама ', NULL, NULL),
  (5689, 3114, 'От знакомых', NULL, NULL),
  (5690, 3114, 'Не помню', NULL, NULL),
  (5691, 3117, 'Да', NULL, NULL),
  (5692, 3117, 'Нет', NULL, NULL),
  (5693, 3117, 'Не уверен', NULL, NULL),
  (5694, 157, NULL, NULL, NULL),
  (5695, 3121, 'Интернет', NULL, NULL),
  (5696, 3121, 'Реклама ', NULL, NULL),
  (5697, 3121, 'От знакомых', NULL, NULL),
  (5698, 3121, 'другое', NULL, NULL),
  (5699, 3124, 'Да', NULL, NULL),
  (5700, 3124, 'Нет', NULL, NULL),
  (5701, 3124, 'Не уверен', NULL, NULL),
  (5702, 170, NULL, NULL, NULL),
  (5703, 3127, 'Интернет', NULL, NULL),
  (5704, 3127, 'Реклама ', NULL, NULL),
  (5705, 3127, 'От знакомых', NULL, NULL),
  (5706, 3127, 'другое', NULL, NULL),
  (5707, 3130, 'Да', NULL, NULL),
  (5708, 3130, 'Нет', NULL, NULL),
  (5709, 3130, 'Не уверен', NULL, NULL),
  (5710, 3132, 'Интернет', NULL, NULL),
  (5711, 3132, 'Реклама ', NULL, NULL),
  (5712, 3132, 'От знакомых', NULL, NULL),
  (5713, 3132, 'другое', NULL, NULL),
  (5714, 3135, 'Да', NULL, NULL),
  (5715, 3135, 'Нет', NULL, NULL),
  (5716, 3135, 'Не уверен', NULL, NULL);
/*!40000 ALTER TABLE `options`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.polls
CREATE TABLE IF NOT EXISTS `polls` (
  `id`         INT(11)         NOT NULL AUTO_INCREMENT,
  `users_id`   INT(11)         NOT NULL
  COMMENT 'пользователь',
  `title`      VARCHAR(255)             DEFAULT NULL
  COMMENT 'название',
  `start_text` VARCHAR(255)             DEFAULT NULL
  COMMENT 'стартовый текст',
  `end_text`   VARCHAR(255)             DEFAULT NULL
  COMMENT 'заключительный текст',
  `created`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT 'дата создания',
  `ext`        VARCHAR(255)             DEFAULT NULL
  COMMENT 'расширение файла',
  `delitem`    ENUM ('0', '1') NOT NULL DEFAULT '0'
  COMMENT 'удаление: 0-неудалено, 1-удалено',
  PRIMARY KEY (`id`),
  KEY `fk_polls_users1_idx` (`users_id`),
  CONSTRAINT `fk_polls_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 801
  DEFAULT CHARSET = utf8
  COMMENT ='опросы';

-- Дамп данных таблицы proto_loc.polls: ~48 rows (приблизительно)
/*!40000 ALTER TABLE `polls`
  DISABLE KEYS */;
INSERT INTO `polls` (`id`, `users_id`, `title`, `start_text`, `end_text`, `created`, `ext`, `delitem`) VALUES
  (42, 2, 'Опрос об .ру',
   'Нам важно услышать отзыв о том, как Вы собираете отзывы с нашей помощью. Это поможет нам стать еще полезнее для Вашего бизнеса.',
   'Спасибо!', '2015-05-21 09:45:19', 'png', '0'),
  (43, 2, 'Химчистка', 'Спасибо, что воспользовались нашими услугами!', 'Спасибо за отзыв. Ваше мнение очень важно для нас! Ждём Вас снова!', '2015-05-27 06:51:47', 'png', '0'),
  (44, 2, 'Ресторан, Кафе', 'Благодарим за выбор нашего заведения!', 'Спасибо за Ваш отзыв. Ждем вас снова!', '2015-05-27 06:57:21', 'png', '0'),
  (45, 2, 'Опрос участников Event-a', 'Команда организаторов приветствует Вас! ', 'Мы очень благодарны за Ваше мнение. До встречи! С уважением, команда организаторов.', '2015-05-27 06:59:01', 'png', '0'),
  (46, 2, 'Опрос покупателей магазина', 'Спасибо, что выбрали наш магазин!', 'Вы только что помогли нам стать лучше и удобнее. Спасибо за Ваш отзыв. Ждем Вас снова!', '2015-05-27 07:00:39', 'png', '0'),
  (47, 2, 'Автосалон, Автосервис, автотехцентр', 'Спасибо, что воспользовались услугами нашего сервиса! ', 'Спасибо за Ваш отзыв. Ждем Вас снова!', '2015-05-27 07:15:40', 'png', '0'),
  (48, 2, 'Интернет-магазин', 'Спасибо,что выбрали нас!', 'Спасибо за Ваш отзыв. Ждем Вас снова!', '2015-05-27 07:17:53', 'png', '0'),
  (49, 2, 'Опрос посетителей кафе (Стандартный опрос)', 'Добро пожаловать в наше кафе!', 'Спасибо за Ваш отзыв!\nЖдем вас снова.', '2015-05-27 07:19:31', NULL, '1'),
  (50, 2, 'Опрос посетителей кафе (Стандартный опрос)', 'Добро пожаловать в наше кафе!', 'Спасибо за Ваш отзыв!\nЖдем вас снова.', '2015-05-27 14:36:45', NULL, '1'),
  (94, 2, 'price', '123', '321', '2015-06-08 16:19:20', NULL, '1'),
  (113, 2, 'тест опрос', '', '', '2015-09-22 14:51:22', NULL, '1'),
  (114, 2, 'тест опрос', '', '', '2015-09-22 16:34:02', NULL, '1'),
  (115, 2, 'Кафе', 'Здравствуйте. Ваше мнение важно для нас!', 'Спасибо за Ваш отзыв, ждем Вас снова!', '2015-09-23 06:59:32', 'png', '0'),
  (118, 2, 'Универсальный опрос', 'Здравствуйте. Ваше мнение очень важно для нас!', 'Спасибо за Ваш отзыв, ждем Вас снова!', '2014-10-05 08:51:00', 'png', '0'),
  (121, 2, 'тест опрос 1', '', '', '2015-10-05 11:41:32', NULL, '1'),
  (122, 2, 'тест опрос (debug)', '', '', '2015-10-06 09:48:53', NULL, '1'),
  (152, 2, 'Создать Мой опрос', 'Спасибо, что выбрали нас!', 'Вы только что помогли нам стать лучше. Спасибо за Ваш отзыв. Ждем Вас снова!', '2015-11-02 17:39:00', NULL, '1'),
  (176, 2, 'Создать Мой опрос', 'Спасибо, что выбрали нас!', 'Вы только что помогли нам стать лучше. Спасибо за Ваш отзыв. Ждем Вас снова!', '2015-11-05 10:11:25', NULL, '1'),
  (177, 2, 'Создать Мой опрос', 'Спасибо, что выбрали нас!', 'Вы только что помогли нам стать лучше. Спасибо за Ваш отзыв. Ждем Вас снова!', '2015-11-05 10:17:26', NULL, '1'),
  (178, 2, 'Создать Мой опрос', 'Спасибо, что выбрали нас!', 'Вы только что помогли нам стать лучше. Спасибо за Ваш отзыв. Ждем Вас снова!', '2015-11-05 13:16:07', NULL, '1'),
  (179, 2, 'Создать Мой опрос', 'Спасибо, что выбрали нас!', 'Вы только что помогли нам стать лучше. Спасибо за Ваш отзыв. Ждем Вас снова!', '2015-11-05 13:26:20', NULL, '1'),
  (200, 198, 'название опроса', 'стартовый текст', 'заключительный текст', '2015-11-21 09:58:30', 'jpg', '0'),
  (208, 1, NULL, NULL, NULL, '2015-12-07 14:07:20', NULL, '0'),
  (209, 1, NULL, NULL, NULL, '2015-12-07 14:10:19', NULL, '0'),
  (317, 1, NULL, NULL, NULL, '2015-12-07 15:05:01', NULL, '0'),
  (318, 1, NULL, NULL, NULL, '2015-12-07 15:05:02', NULL, '0'),
  (319, 1, NULL, NULL, NULL, '2015-12-07 15:05:08', NULL, '0'),
  (320, 1, NULL, NULL, NULL, '2015-12-07 15:05:09', NULL, '0'),
  (321, 1, NULL, NULL, NULL, '2015-12-07 15:05:14', NULL, '0'),
  (322, 1, NULL, NULL, NULL, '2015-12-07 15:05:15', NULL, '0'),
  (323, 1, NULL, NULL, NULL, '2015-12-07 15:05:21', NULL, '0'),
  (324, 1, NULL, NULL, NULL, '2015-12-07 15:05:24', NULL, '0'),
  (779, 1, NULL, NULL, NULL, '2015-12-07 21:24:54', NULL, '0'),
  (780, 1, NULL, NULL, NULL, '2015-12-07 21:24:54', NULL, '0'),
  (781, 1, NULL, NULL, NULL, '2015-12-07 21:25:34', NULL, '0'),
  (782, 1, NULL, NULL, NULL, '2015-12-07 21:25:34', NULL, '0'),
  (783, 1, NULL, NULL, NULL, '2015-12-07 21:25:34', NULL, '0'),
  (784, 1, NULL, NULL, NULL, '2015-12-07 21:25:34', NULL, '0'),
  (788, 1, NULL, NULL, NULL, '2015-12-07 21:48:05', NULL, '0'),
  (789, 1, NULL, NULL, NULL, '2015-12-07 21:48:05', NULL, '0'),
  (790, 1, NULL, NULL, NULL, '2015-12-07 21:48:05', NULL, '0'),
  (791, 1, NULL, NULL, NULL, '2015-12-07 21:48:05', NULL, '0'),
  (795, 2, 'Юридические услуги', 'Здравствуйте. Ваше мнение очень важно для нас!',
   'Спасибо за Ваш отзыв, ждем Вас снова!', '2015-12-24 13:22:28', NULL, '0'),
  (796, 2, 'Медцентр, клиника, Стоматологическая клиника', 'Здравствуйте. Ваше мнение очень важно для нас!',
   'Спасибо за Ваш отзыв, ждем Вас снова!', '2015-12-24 13:23:36', NULL, '0'),
  (797, 2, 'Салон красоты, Косметология, Ногтевая студия, Солярий', 'Здравствуйте. Ваше мнение очень важно для нас!',
   'Спасибо за Ваш отзыв, ждем Вас снова!', '2015-12-24 13:28:53', NULL, '0'),
  (798, 2, 'Детский сад', 'Здравствуйте. Ваше мнение очень важно для нас!', 'Спасибо за Ваш отзыв, ждем Вас снова!',
   '2015-12-24 14:09:14', NULL, '0'),
  (799, 2, 'Детский сад', 'Здравствуйте. Ваше мнение очень важно для нас!', 'Спасибо за Ваш отзыв, ждем Вас снова!',
   '2016-05-27 18:58:01', NULL, '0'),
  (800, 2, 'Детский сад', 'Здравствуйте. Ваше мнение очень важно для нас!', 'Спасибо за Ваш отзыв, ждем Вас снова!',
   '2016-05-28 13:35:19', NULL, '0');
/*!40000 ALTER TABLE `polls`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.prices
CREATE TABLE IF NOT EXISTS `prices` (
  `id`    INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255)     DEFAULT NULL,
  `desc`  TEXT,
  `slug`  VARCHAR(255)     DEFAULT NULL,
  `cost`  FLOAT   NOT NULL DEFAULT '0.1',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 11
  DEFAULT CHARSET = utf8
  COMMENT ='цены на смс и отзывы';

-- Дамп данных таблицы proto_loc.prices: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `prices`
  DISABLE KEYS */;
INSERT INTO `prices` (`id`, `title`, `desc`, `slug`, `cost`) VALUES
  (1, 'Входящие SMS', 'Юзер оставляет отзыв (через SMS).', 'count_sms1', 0.11),
  (2, 'Исходящие SMS',
   'Юзер оставляет отзыв (через SMS) - SMS-ошибки в ответ.<br>\r\nЮзер оставляет отзыв (любым способом) - в ответ приходит SMS.<br>\r\nВендор рассылает промо (через SMS).<br>\r\nВендор оставляет комментарий в чате (через SMS).',
   'count_sms2', 0.22),
  (3, 'Отзывы через Web', 'Юзер оставляет отзыв (через Web).', 'count_review_0', 0.33),
  (4, 'Отзывы через SMS', 'Юзер оставляет отзыв (через SMS).', 'count_review_1', 0.44),
  (5, 'Отзывы через АТС', 'Юзер оставляет отзыв (через АТС).', 'count_review_2', 0.55),
  (6, 'Отзывы через QR-код', 'Юзер оставляет отзыв (через QR-код).', 'count_review_3', 0.66),
  (7, 'Коментарии юзера', 'Юзер оставляет комментарий в чате.', 'count_comments', 0.77),
  (8, 'Коментарии вендора', 'Вендор оставляет комментарий в чате.', 'count_comments2', 0.77),
  (9, 'Рассылка по Email', 'Вендор рассылает промо (через Email).', 'count_ads_1', 0.88),
  (10, 'Рассылка по SMS', 'Вендор рассылает промо (через SMS).', 'count_ads_2', 99.99);
/*!40000 ALTER TABLE `prices`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.promos
CREATE TABLE IF NOT EXISTS `promos` (
  `id`        INT(11) NOT NULL AUTO_INCREMENT,
  `users_id`  INT(11) NOT NULL,
  `vendor_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_promos_users1_idx` (`users_id`),
  KEY `fk_promos_users2_idx` (`vendor_id`),
  CONSTRAINT `fk_promos_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_promos_users2` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT ='юзеры подписанные на рассылку вендоров';

-- Дамп данных таблицы proto_loc.promos: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `promos`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `promos`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id`        INT(11) NOT NULL AUTO_INCREMENT,
  `types_id`  INT(11) NOT NULL
  COMMENT 'тип',
  `polls_id`  INT(11) NOT NULL
  COMMENT 'опрос',
  `title`     VARCHAR(255)     DEFAULT NULL
  COMMENT 'текст вопроса',
  `sortorder` VARCHAR(255)     DEFAULT NULL
  COMMENT 'сортировка вопросов',
  `ext`       VARCHAR(255)     DEFAULT NULL
  COMMENT 'расширение фотки',
  PRIMARY KEY (`id`),
  KEY `fk_questions_polls` (`polls_id`),
  KEY `fk_questions_types` (`types_id`),
  CONSTRAINT `fk_questions_polls` FOREIGN KEY (`polls_id`) REFERENCES `polls` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_questions_types` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 3137
  DEFAULT CHARSET = utf8
  COMMENT ='вопросы';

-- Дамп данных таблицы proto_loc.questions: ~122 rows (приблизительно)
/*!40000 ALTER TABLE `questions`
  DISABLE KEYS */;
INSERT INTO `questions` (`id`, `types_id`, `polls_id`, `title`, `sortorder`, `ext`) VALUES
  (148, 1, 42, 'Сколько времени у Вас заняло составление опроса? ', '2', 'png'),
  (149, 2, 42, 'Как вы узнали о нашем сайте?', '3', 'png'),
  (150, 1, 43, 'Оцените качество очистки Ваших вещей', '1', 'png'),
  (151, 1, 43, 'Оцените процесс приема-сдачи Ваших вещей', '2', 'png'),
  (152, 1, 43, 'Какую одежду Вы сдаете на чистку чаще всего?', '3', 'png'),
  (153, 4, 43, 'Подскажите, как нам стать лучше?', '4', 'png'),
  (154, 1, 44, 'Оцените нашу кухню', '1', 'png'),
  (157, 1, 44, 'Вы рекомендовали бы нас друзьям?', '5', 'png'),
  (159, 1, 45, 'Насколько актуальны тематика, состав спикеров и участников? ', '1', 'png'),
  (160, 1, 45, 'Оцените время и место проведения мероприятия', '2', 'png'),
  (161, 1, 45, 'Оцените уровень организации (регистрация, помощь организаторов)', '3', 'png'),
  (162, 1, 45, 'Сколько полезных контактов Вы получили на мероприятии?', '4', 'png'),
  (163, 4, 45, 'Что нужно сделать, чтобы мероприятие было еще более полезным и интересным для Вас?', '5', 'png'),
  (164, 1, 46, 'Довольны ли Вас ассортиментом нашего магазина?', '1', 'png'),
  (165, 1, 46, 'Какие виды бонусов Вы бы предпочли?', '2', 'png'),
  (166, 1, 46, 'Выберите, какое описание подходит нашему персоналу', '3', 'png'),
  (167, 1, 46, 'Как бы Вы оценили качество наших товаров?', '4', 'png'),
  (168, 4, 46, 'Подскажите, как нам стать лучше?', '5', 'png'),
  (169, 1, 47, 'Вам удобно было записаться в наш сервис?', '1', 'png'),
  (170, 1, 47, 'В какое время Вам удобнее пользоваться нашими услугами?', '2', 'png'),
  (171, 1, 47, 'Вам рассказали о предстоящем ремонте и стоимости заранее?', '3', 'png'),
  (172, 1, 47, 'Вы довольны качеством проведенных работ?', '4', 'png'),
  (175, 1, 48, 'Информации в описании достаточно, чтобы подобрать оптимальный товар?', '2', 'png'),
  (176, 1, 48, 'Вы довольны работой службы доставки?', '3', 'png'),
  (177, 1, 48, 'Как бы Вы оценили качество купленных товаров?', '4', 'png'),
  (178, 4, 48, 'Подскажите, что нам сделать, чтобы стать лучше?', '5', 'png'),
  (179, 1, 49, 'Оцените качество нашей кухни', '1', NULL),
  (180, 1, 49, 'Оцените дружелюбие и скорость обслуживания персонала', '2', NULL),
  (181, 1, 49, 'Оцените наш интерьер ', '3', NULL),
  (182, 1, 49, 'Вы бы рекомендовали наше кафе своим знакомым?', '4', NULL),
  (183, 4, 49, 'Подскажите, что нам изменить к лучшему', '5', NULL),
  (184, 1, 50, 'Оцените качество нашей кухни', '1', NULL),
  (185, 1, 50, 'Оцените дружелюбие и скорость обслуживания персонала', '2', NULL),
  (186, 1, 50, 'Оцените наш интерьер ', '3', NULL),
  (187, 1, 50, 'Вы бы рекомендовали наше кафе своим знакомым?', '4', NULL),
  (188, 4, 50, 'Подскажите, что нам изменить к лучшему', '5', NULL),
  (387, 3, 94, 'skoko', '1', NULL),
  (394, 5, 94, 'вопрос типа 5', '2', NULL),
  (425, 3, 113, 'dawdawdawdaw', '1', NULL),
  (426, 3, 114, 'dawdawdawdaw', '1', NULL),
  (427, 1, 115, 'Оцените разнообразие меню и качество блюд', '', 'png'),
  (428, 1, 115, 'В какое время Вы бываете у нас чаще всего?', '1', 'png'),
  (429, 1, 115, 'Как часто Вы пользуетесь акциями и специальными предложениями?', '2', 'png'),
  (430, 1, 115, 'Вы бы рекомендовали наше кафе друзьям, коллегам?', '4', 'png'),
  (431, 4, 115, 'Подскажите, что нам стоило бы улучшить. ', '5', 'png'),
  (442, 6, 42, 'Оцените от 1 до 5 удобство навигации по сайту', '1', 'png'),
  (443, 6, 115, 'Оцените по шкале от 1 от 5 качество обслуживания персонала', '3', 'png'),
  (444, 6, 48, 'Оцените от 1 до 5 удобство навигации по сайту', '', 'png'),
  (445, 6, 44, 'Оцените наш персонал', '2', 'png'),
  (446, 3, 42, 'Сколько отзывов в среднем Вы получаете в месяц?', '4', 'png'),
  (448, 2, 42, 'Какие функции Вы хотели бы увидеть на нашем сайте?', '6', 'png'),
  (449, 1, 118, 'Как Вы о нас узнали?', '1', 'png'),
  (450, 4, 118, 'Подскажите, как нам стать лучше для Вас?', '5', 'png'),
  (451, 6, 118, 'Оцените качество работы персонала', '3', 'png'),
  (460, 1, 121, '1', '1', 'jpg'),
  (461, 2, 121, '1', '2', 'jpg'),
  (462, 3, 121, '1', '3', 'jpg'),
  (463, 4, 121, '1', '4', 'jpg'),
  (464, 5, 121, '1', '5', 'jpg'),
  (465, 6, 121, '1', '6', 'jpg'),
  (466, 1, 122, 'вопрос 1', '1', NULL),
  (467, 2, 122, 'вопрос 2', '2', NULL),
  (468, 3, 122, 'вопрос 3', '3', NULL),
  (469, 4, 122, 'вопрос 4', '4', NULL),
  (470, 5, 122, 'вопрос 5', '5', NULL),
  (471, 6, 122, 'вопрос 6', '6', NULL),
  (509, 1, 118, 'Вы бы рекомендовали нас друзьям?', '4', 'png'),
  (593, 1, 152, 'Как Вы о нас узнали?', '', NULL),
  (594, 6, 152, 'Оцените по шкале от 1 до 5 качество работы персонала, где 5 - очень хорошо', '1', NULL),
  (595, 1, 152, 'Вы рекомендовали бы нас друзьям?', '2', NULL),
  (596, 4, 152, 'Подскажите, как нам стать лучше для Вас?', '3', NULL),
  (696, 1, 176, 'Как Вы о нас узнали?', '', NULL),
  (697, 6, 176, 'Оцените по шкале от 1 до 5 качество работы персонала, где 5 - очень хорошо', '1', NULL),
  (698, 1, 176, 'Вы рекомендовали бы нас друзьям?', '2', NULL),
  (699, 4, 176, 'Подскажите, как нам стать лучше для Вас?', '3', NULL),
  (700, 1, 177, 'Как Вы о нас узнали?', '', NULL),
  (701, 6, 177, 'Оцените по шкале от 1 до 5 качество работы персонала, где 5 - очень хорошо', '1', NULL),
  (702, 1, 177, 'Вы рекомендовали бы нас друзьям?', '2', NULL),
  (703, 4, 177, 'Подскажите, как нам стать лучше для Вас?', '3', NULL),
  (704, 1, 178, 'Как Вы о нас узнали?', '', NULL),
  (705, 6, 178, 'Оцените по шкале от 1 до 5 качество работы персонала, где 5 - очень хорошо', '1', NULL),
  (706, 1, 178, 'Вы рекомендовали бы нас друзьям?', '2', NULL),
  (707, 4, 178, 'Подскажите, как нам стать лучше для Вас?', '3', NULL),
  (708, 1, 179, 'Как Вы о нас узнали?', '', NULL),
  (709, 6, 179, 'Оцените по шкале от 1 до 5 качество работы персонала, где 5 - очень хорошо', '1', NULL),
  (710, 1, 179, 'Вы рекомендовали бы нас друзьям?', '2', NULL),
  (711, 4, 179, 'Подскажите, как нам стать лучше для Вас?', '3', NULL),
  (736, 4, 44, 'Подскажите, как нам стать лучше для Вас?', '5', 'png'),
  (781, 5, 200, 'вопрос смайл', '1', NULL),
  (782, 6, 200, 'вопрос шкала', '2', NULL),
  (3105, 1, 795, 'Как Вы о нас узнали?', '1', NULL),
  (3106, 1, 795, 'Вы рекомендовали бы нас друзьям?', '3', NULL),
  (3107, 4, 795, 'Подскажите, как нам стать лучше для Вас?', '4', NULL),
  (3108, 5, 795, 'Оцените качество полученных услуг ', '2', NULL),
  (3109, 1, 796, 'Как Вы о нас узнали?', '', NULL),
  (3110, 5, 796, 'Оцените качество полученных услуг ', '1', NULL),
  (3111, 1, 796, 'Вы рекомендовали бы нас друзьям?', '3', NULL),
  (3112, 4, 796, 'Подскажите, как нам стать лучше для Вас?', '4', NULL),
  (3113, 5, 796, 'Оцените качество работы персонала', '2', NULL),
  (3114, 1, 797, 'Как Вы о нас узнали?', '', NULL),
  (3115, 5, 797, 'Оцените качество полученных услуг ', '1', NULL),
  (3116, 5, 797, 'Оцените качество работы персонала', '2', NULL),
  (3117, 1, 797, 'Вы рекомендовали бы нас друзьям?', '3', NULL),
  (3118, 4, 797, 'Подскажите, как нам стать лучше для Вас?', '4', NULL),
  (3119, 5, 44, 'Оцените соотношение цена и качество', '4', NULL),
  (3120, 5, 118, 'Оцените качество наших товаров или услуг', '2', NULL),
  (3121, 1, 798, 'Как Вы о нас узнали?', '', NULL),
  (3122, 5, 798, 'Оцените качество полученных услуг ', '1', NULL),
  (3123, 5, 798, 'Оцените качество работы персонала', '2', NULL),
  (3124, 1, 798, 'Вы рекомендовали бы нас друзьям?', '3', NULL),
  (3125, 4, 798, 'Подскажите, как нам стать лучше для Вас?', '4', NULL),
  (3126, 4, 47, 'Подскажите как нам стать лучше для Вас', '5', NULL),
  (3127, 1, 799, 'Как Вы о нас узнали?', '', NULL),
  (3128, 5, 799, 'Оцените качество полученных услуг ', '1', NULL),
  (3129, 5, 799, 'Оцените качество работы персонала', '2', NULL),
  (3130, 1, 799, 'Вы рекомендовали бы нас друзьям?', '3', NULL),
  (3131, 4, 799, 'Подскажите, как нам стать лучше для Вас?', '4', NULL),
  (3132, 1, 800, 'Как Вы о нас узнали?', '', NULL),
  (3133, 5, 800, 'Оцените качество полученных услуг ', '1', NULL),
  (3134, 5, 800, 'Оцените качество работы персонала', '2', NULL),
  (3135, 1, 800, 'Вы рекомендовали бы нас друзьям?', '3', NULL),
  (3136, 4, 800, 'Подскажите, как нам стать лучше для Вас?', '4', NULL);
/*!40000 ALTER TABLE `questions`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id`         INT(11)                             NOT NULL AUTO_INCREMENT,
  `users_id`   INT(11)                             NOT NULL
  COMMENT 'пользователь',
  `polls_id`   INT(11)                             NOT NULL
  COMMENT 'опрос',
  `objects_id` INT(11)                             NOT NULL
  COMMENT 'объект',
  `rating`     ENUM ('0', '1', '2', '3', '4', '5') NOT NULL DEFAULT '0'
  COMMENT 'рейтинг',
  `comment`    TEXT COMMENT 'коммент',
  `created`    TIMESTAMP                           NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT 'дата создания',
  `source`     ENUM ('0', '1', '2', '3')           NOT NULL DEFAULT '0'
  COMMENT 'источник: 0-веб,1-смс,2-атс,3-qrcode',
  `status`     ENUM ('0', '1')                     NOT NULL DEFAULT '0'
  COMMENT 'статус: 0-непрочитано,1-прочитано',
  `active`     ENUM ('0', '1')                     NOT NULL DEFAULT '0'
  COMMENT '0-не подтвердил отзыв ссылкой, 1-подтвердил',
  `hashtag`    VARCHAR(255)                                 DEFAULT NULL
  COMMENT 'хештег для автологина',
  `vendorhash` VARCHAR(50)                                  DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reviews_polls` (`polls_id`),
  KEY `fk_reviews_users` (`users_id`),
  KEY `fk_reviews_objects1_idx` (`objects_id`),
  CONSTRAINT `fk_reviews_objects1` FOREIGN KEY (`objects_id`) REFERENCES `objects` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reviews_polls` FOREIGN KEY (`polls_id`) REFERENCES `polls` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_reviews_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 4650
  DEFAULT CHARSET = utf8
  COMMENT ='отзывы пользователей';

-- Дамп данных таблицы proto_loc.reviews: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `reviews`
  DISABLE KEYS */;
INSERT INTO `reviews` (`id`, `users_id`, `polls_id`, `objects_id`, `rating`, `comment`, `created`, `source`, `status`, `active`, `hashtag`, `vendorhash`)
VALUES
  (230, 3, 42, 22, '0', '', '2015-09-22 12:41:19', '0', '0', '1', '', '6fa1aad6e6efd295b3fe085f607ae11b'),
  (231, 3, 42, 22, '1', '', '2015-09-22 13:05:37', '0', '0', '1', NULL, ''),
  (232, 3, 42, 22, '2', '', '2015-09-22 13:05:49', '0', '0', '1', NULL, ''),
  (233, 3, 113, 72, '0', '', '2015-09-22 14:54:21', '0', '0', '1', '', ''),
  (4645, 199, 200, 157, '0', '', '2016-01-28 15:26:37', '0', '0', '1', NULL, NULL),
  (4646, 199, 200, 157, '0', '', '2016-01-28 15:28:28', '0', '0', '1', NULL, NULL),
  (4647, 200, 200, 157, '0', '', '2016-10-12 07:42:03', '0', '0', '0', '98hemESm810PM', NULL),
  (4648, 200, 200, 157, '0', '', '2016-10-12 07:42:32', '0', '0', '0', '701dLdNxsp4Dw', NULL),
  (4649, 200, 200, 157, '0', '', '2016-10-12 07:44:00', '0', '0', '0', '45VUn4X0vlJJ2', NULL);
/*!40000 ALTER TABLE `reviews`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id`          INT(11) NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255)     DEFAULT NULL
  COMMENT 'название',
  `description` VARCHAR(255)     DEFAULT NULL
  COMMENT 'описание',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8
  COMMENT ='роли пользователей';

-- Дамп данных таблицы proto_loc.roles: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `roles`
  DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `description`) VALUES
  (1, 'admin', 'администратор'),
  (2, 'vendor', 'вендор'),
  (3, 'user', 'пользователь');
/*!40000 ALTER TABLE `roles`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.roles_users
CREATE TABLE IF NOT EXISTS `roles_users` (
  `users_id` INT(11) NOT NULL,
  `roles_id` INT(11) NOT NULL,
  PRIMARY KEY (`users_id`, `roles_id`),
  KEY `fk_users_roles_roles1_idx` (`roles_id`),
  KEY `fk_users_roles_users1_idx` (`users_id`),
  CONSTRAINT `fk_users_roles_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_users_roles_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT ='роли <-> пользователи';

-- Дамп данных таблицы proto_loc.roles_users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `roles_users`
  DISABLE KEYS */;
INSERT INTO `roles_users` (`users_id`, `roles_id`) VALUES
  (1, 1),
  (2, 2),
  (198, 2),
  (3, 3),
  (199, 3),
  (200, 3);
/*!40000 ALTER TABLE `roles_users`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.table1
CREATE TABLE IF NOT EXISTS `table1` (
  `id` INT(11) DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- Дамп данных таблицы proto_loc.table1: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `table1`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `table1`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.tellclients
CREATE TABLE IF NOT EXISTS `tellclients` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `name`     VARCHAR(255)     DEFAULT NULL,
  `position` VARCHAR(255)     DEFAULT NULL,
  `desc`     TEXT,
  `ext`      VARCHAR(255)     DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8
  COMMENT ='отзывы клиентов на главной';

-- Дамп данных таблицы proto_loc.tellclients: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `tellclients`
  DISABLE KEYS */;
INSERT INTO `tellclients` (`id`, `name`, `position`, `desc`, `ext`) VALUES
  (1, 'Лилия Габдуллина', 'Психолог, коуч, организатор мероприятий',
   'Интересный новый сервис, аналогов которого я пока не встречала. Основные удобства, на мой взгляд - полная автоматизированность сервиса и возможность моментального реагирования на мнения участников. Пользуюсь недавно, и планирую продолжать использовать сервис как удобный инструмент для сбора отзывов с крупных мероприятий.',
   'jpg'),
  (2, 'Светлана Ершова', 'Технический директор супермаркета “Сильпо”',
   'В первую очередь, хочу отметить функционал сайта - продумано все, чтобы быть "на связи" с клиентами. <em>Удобно редактировать опросы</em>, создавать и менять вопросы, загружать лого и т.д. Планируем внедрить систему поощрения за бонусы с помощью функции "Акции". От себя желаю успехов в развитии сервиса и больше довольных клиентов!',
   'jpg'),
  (3, 'Виктория Нем', 'Менеджер пиццерии “NY Pizza”',
   'Я бы назвала сервис аналогом всем привычной книги отзывов, только гораздо удобнее, потому что информация поступает мгновенно. И возможность ответить на отзыв гостя сразу же очень нравится, так лояльных посетителей становится больше - это важный для любого заведения результат. Главный плюс "" в том, что можно использовать и смс, и звонок, и qr, и ссылки, этого, как правило, в других сервисах делать нельзя. Надеюсь, вы поможете собирать нам только положительные отзывы!',
   'jpg');
/*!40000 ALTER TABLE `tellclients`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.types
CREATE TABLE IF NOT EXISTS `types` (
  `id`    INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255)     DEFAULT NULL
  COMMENT 'название',
  `name`  VARCHAR(255)     DEFAULT NULL
  COMMENT 'краткое название',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8
  COMMENT ='типы вопросов';

-- Дамп данных таблицы proto_loc.types: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `types`
  DISABLE KEYS */;
INSERT INTO `types` (`id`, `title`, `name`) VALUES
  (1, 'выберите один ответ из предложенных вариантов', 'radio'),
  (2, 'выберите несколько ответов из предложенных вариантов', 'checkbox'),
  (3, 'укажите цифру в указанном диапазоне', 'range'),
  (4, 'напишите текстовый ответ', 'text'),
  (5, 'выберите один из 5 предустановленных ответов', 'smile'),
  (6, 'выберите оценку от 1 до 5', 'circle');
/*!40000 ALTER TABLE `types`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id`                  INT(11)              NOT NULL AUTO_INCREMENT,
  `email`               VARCHAR(255)                  DEFAULT NULL
  COMMENT 'почта',
  `tel`                 VARCHAR(255)                  DEFAULT NULL
  COMMENT 'телефон',
  `password`            VARCHAR(255)                  DEFAULT NULL
  COMMENT 'пароль',
  `firstname`           VARCHAR(255)                  DEFAULT NULL
  COMMENT 'имя у пользвателя, название бренда у вендора',
  `secondname`          VARCHAR(255)                  DEFAULT NULL
  COMMENT 'фамилия',
  `borndate`            TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT 'дата рождения',
  `sex`                 ENUM ('1', '2')      NOT NULL DEFAULT '1'
  COMMENT 'пол: 1-муж,2-жен',
  `city`                VARCHAR(255)                  DEFAULT NULL
  COMMENT 'город',
  `ext`                 VARCHAR(255)                  DEFAULT NULL
  COMMENT 'расширение файла',
  `logins`              INT(11)                       DEFAULT NULL,
  `last_login`          INT(11)                       DEFAULT NULL,
  `ban`                 ENUM ('0', '1')      NOT NULL DEFAULT '0'
  COMMENT 'бан: 0-активен,1-забанен',
  `status`              ENUM ('0', '1')      NOT NULL DEFAULT '0'
  COMMENT 'статус вендора: 0-непроверен,1-проверен',
  `network`             VARCHAR(255)                  DEFAULT NULL
  COMMENT 'название социалки',
  `profile`             VARCHAR(255)                  DEFAULT NULL
  COMMENT 'профиль пользователя социалки',
  `uid`                 VARCHAR(255)                  DEFAULT NULL
  COMMENT 'id пользователя социалки',
  `metodsend`           ENUM ('0', '1', '2') NOT NULL DEFAULT '0'
  COMMENT 'способ оповещения: 0-не указано, 1-почта,2-тел',
  `active`              ENUM ('0', '1')      NOT NULL DEFAULT '0'
  COMMENT '0-не подтвердил профиль ссылкой, 1-подтвердил',
  `count_sms1`          INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Входящие смс',
  `count_sms2`          INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Исходящие смс',
  `count_review_0`      INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Отзывы через веб-сайт',
  `count_review_1`      INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Отзывы через SMS',
  `count_review_2`      INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Отзывы через АТС',
  `count_review_3`      INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Отзывы через QR-код',
  `count_comments`      INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Коментарии юзера',
  `count_comments2`     INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Коментарии вендора',
  `count_ads_1`         INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Рассылка по почте',
  `count_ads_2`         INT(11)              NOT NULL DEFAULT '0'
  COMMENT 'Рассылка по смс',
  `dedicated_sms_count` INT(11)              NOT NULL DEFAULT '0',
  `code`                VARCHAR(45)                   DEFAULT NULL
  COMMENT 'код подтверждения',
  `hashtag`             VARCHAR(50)                   DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `tel_UNIQUE` (`tel`),
  UNIQUE KEY `social_UNIQUE` (`uid`, `network`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 201
  DEFAULT CHARSET = utf8
  COMMENT ='пользователи';

-- Дамп данных таблицы proto_loc.users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `users`
  DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `tel`, `password`, `firstname`, `secondname`, `borndate`, `sex`, `city`, `ext`, `logins`, `last_login`, `ban`, `status`, `network`, `profile`, `uid`, `metodsend`, `active`, `count_sms1`, `count_sms2`, `count_review_0`, `count_review_1`, `count_review_2`, `count_review_3`, `count_comments`, `count_comments2`, `count_ads_1`, `count_ads_2`, `dedicated_sms_count`, `code`, `hashtag`)
VALUES
  (1, 'admin@a.com', NULL, 'fe254d8036544718acbbe82f2158a1722834aace9829269846fbebd48b9ee5ec', 'Администратор', '',
      '2015-01-27 21:00:00', '1', '', 'png', NULL, 1461845880, '0', '1', NULL, NULL, NULL, '1', '1', 0, 0, 0, 0, 0, 0,
                                                                                                           0, 0, 0, 0,
                                                                                                           26, NULL,
   ''),
  (2, 'vendor@a.com', NULL, 'fe254d8036544718acbbe82f2158a1722834aace9829269846fbebd48b9ee5ec', 'Владелец заведения',
      NULL, '2015-05-19 08:55:22', '1', '', NULL, NULL, 1461865858, '0', '1', NULL, NULL, NULL, '1', '1', 13, 3394,
    3387, 13, 9, 1, 2, 15, 3, 0, 87, '', ''),
  (3, 'user@a.com', NULL, 'fe254d8036544718acbbe82f2158a1722834aace9829269846fbebd48b9ee5ec', '', NULL,
      '2015-05-19 08:55:35', '1', NULL, NULL, NULL, 1455975199, '0', '1', NULL, NULL, NULL, '1', '1', 0, 0, 0, 0, 0, 0,
                                                                                                            0, 0, 0, 0,
                                                                                                            100, NULL,
   ''),
  (198, 'testvendor@testvendor.testvendor', NULL, 'fe254d8036544718acbbe82f2158a1722834aace9829269846fbebd48b9ee5ec',
        'Тестовый Вендор', NULL, '2015-11-21 09:58:30', '1', 'Питер, город Санкт-Петербург, Россия', NULL, NULL,
    1476255912, '0', '0', NULL, NULL, NULL, '1', '1', 7, 18, 13, 7, 5, 0, 0, 0, 0, 2, 100, '', ''),
  (199, 'testuser@testuser.testuser', NULL, 'fe254d8036544718acbbe82f2158a1722834aace9829269846fbebd48b9ee5ec', NULL,
        NULL, '2015-11-21 09:58:42', '1', NULL, NULL, NULL, 1476255890, '0', '0', NULL, NULL, NULL, '1', '1', 0, 0, 0,
                                                                                                                    0,
                                                                                                                    0,
                                                                                                                    0,
                                                                                                                    0,
                                                                                                                    0,
                                                                                                                    0,
                                                                                                                    0,
                                                                                                                    100,
                                                                                                                    NULL,
   ''),
  (200, NULL, '1111111111', '1f20415f224120f5aff43f8a07bf9bb05622406728220b1f7195489b3a4425a1', NULL, NULL,
        '2016-10-12 07:42:03', '1', NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, '2', '0', 0, 0, 0, 0, 0, 0, 0,
                                                                                                        0, 0, 0, 0,
                                                                                                        NULL, NULL);
/*!40000 ALTER TABLE `users`
  ENABLE KEYS */;

-- Дамп структуры для таблица proto_loc.user_tokens
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id`         INT(11) NOT NULL AUTO_INCREMENT,
  `users_id`   INT(11) NOT NULL,
  `user_agent` VARCHAR(255)     DEFAULT NULL,
  `token`      VARCHAR(255)     DEFAULT NULL,
  `created`    INT(11)          DEFAULT NULL,
  `expires`    INT(11)          DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  KEY `fk_user_tokens_users` (`users_id`),
  CONSTRAINT `fk_user_tokens_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT ='токены';

-- Дамп данных таблицы proto_loc.user_tokens: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_tokens`
  DISABLE KEYS */;
/*!40000 ALTER TABLE `user_tokens`
  ENABLE KEYS */;

/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS = IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
