SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--
CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `library`;

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `diedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `author`
--

TRUNCATE TABLE `author`;
--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `name`, `surname`, `patronymic`, `about`, `birthdate`, `diedate`) VALUES
(1, 'Александр ', 'Сергеевич', 'Пушкин', '', '1799-06-06', NULL),
(2, 'Лев ', 'Николаевич ', 'Толстой', NULL, '1828-09-09', '1910-11-20'),
(3, 'Михаил ', 'Юрьевич ', 'Лермонтов', '', '1814-10-15', '1841-07-27'),
(4, 'Николай ', 'Васильевич ', 'Гоголь', NULL, '1809-03-31', '1852-02-21'),
(5, 'Иван', 'Алексеевич ', 'Бунин', NULL, '1870-10-22', '1953-11-08'),
(6, 'Максим ', 'Горький ', NULL, NULL, '1868-03-28', '1936-06-18'),
(7, 'Антон', 'Павлович ', 'Чехов', NULL, '1860-01-29', '1904-07-15'),
(8, 'Фёдор ', 'Михайлович ', 'Достоевский', NULL, '1821-11-11', '1881-02-09'),
(9, 'Сергей', 'Александрович ', 'Есенин', NULL, '1895-10-03', '1925-12-28'),
(10, 'Анна ', 'Андреевна ', 'Ахматова ', NULL, '1889-06-23', '1966-03-05'),
(11, 'Джон', 'Стрелеки', 'П.', 'Родился и вырос в пригороде Чикаго.\r\n<br><br>\r\nВ 2002 году Стрелеки написал свою первую книгу «Кафе на краю земли» и издал её самостоятельно, но только после того, как за год было продано более 10 000 экземпляров в 24 странах, он подписал договор с литературным агентом.\r\n<br><br>\r\nКнига попала в списки бестселлеров в Сингапуре, а затем и на Тайване. В 2009 году издана во французской Канаде под названием «Le Why Cafe». ВВ Германии, переведённая как «Das Café am Rande der Welt» и с 2015 года входит в список бестселлеров в своей категории по версии Der Spiegel.', '1969-04-09', NULL),
(12, 'Братья', 'Стругацкие', NULL, 'Братья Стругацкие — советские и российские писатели, сценаристы, авторы современной научной и социальной фантастики.\r\n<br><br>\r\nАркадий Натанович родился 28 августа 1925 года в Батуми,<br>\r\nБорис Натанович — 15 апреля 1933 года в Ленинграде.', NULL, NULL),
(13, 'Анастасия', 'Гагаркина', NULL, NULL, NULL, NULL),
(14, 'Михаил', 'Жебрак', NULL, 'Михаил Жебрак – москвич, экскурсовод, автор и ведущий программы «Пешком» на телеканале «Культура».', NULL, NULL),
(15, 'Шон', 'Кэрролл', NULL, 'Шон Кэрролл – физик-теоретик и один из самых известных в мире популяризаторов науки – заставляет нас по-новому взглянуть на физику. Столкновение с главной загадкой квантовой механики полностью поменяет наши представления о пространстве и времени.', NULL, NULL),
(16, 'Тимофей', 'Кармацкий', NULL, 'Тимофей Кармацкий – врач в третьем поколении, невролог, автор YouTube-канала с миллионной аудиторией. Уже более 10 лет он активно занимается изучением и развитием естественных методов оздоровления, которые реально работают.', NULL, NULL),
(17, 'Уолтер', 'Айзексон', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `batch`
--

CREATE TABLE `batch` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `batch`
--

TRUNCATE TABLE `batch`;
--
-- Дамп данных таблицы `batch`
--

INSERT INTO `batch` (`id`, `name`, `date`) VALUES
(1, 'Библиотека классики', '1833-01-01'),
(2, 'Русская классика', '1869-01-01'),
(3, 'Классика', '1840-01-01'),
(4, 'Школьная библиотека', '1836-01-01'),
(5, 'Собрание сочинений', '1904-01-01'),
(6, 'Литературные памятники', '1970-01-01'),
(7, 'Ленинградские писатели', '1987-01-01'),
(8, 'Золотая коллекция', '1904-01-01'),
(9, 'Кафе на краю земли', '2024-04-10'),
(10, 'Лучшие книги братьев Стругацких', '2019-01-09'),
(11, 'Коллекционное иллюстрированное издание', '2021-06-24'),
(12, ' Кулинария. Домашний хлеб', '2023-08-31'),
(13, 'Пешком по городу', '2022-04-19'),
(14, 'New Science', '2018-05-16'),
(15, 'Настоящая медицина', '2019-11-29'),
(16, 'Известные люди', '2021-03-16');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int NOT NULL,
  `author_id` int DEFAULT NULL,
  `publisher_id` int DEFAULT NULL,
  `batch_id` int DEFAULT NULL,
  `cover_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int NOT NULL,
  `pages_count` int NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `genre_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `book`
--

TRUNCATE TABLE `book`;
--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `author_id`, `publisher_id`, `batch_id`, `cover_url`, `title`, `description`, `count`, `pages_count`, `rating`, `genre_id`) VALUES
(1, 11, 8, 9, 'kafe.jpg', 'Кафе на краю земли. Как перестать плыть по течению и вспомнить, зачем ты живёшь', 'Удивительная и вдохновляющая история о том, как избавиться от мимолетной суеты современного мира, отбросить страхи и сомнения и открыться для счастливых перемен. Каждый из нас время от времени задает себе вопросы: «кто я?», «куда я иду?», «счастлив ли я?». Но найти ответы и следовать своему собственному пути не так-то просто. Главный герой этой книги Джон едва ли пытался осмыслить свою жизнь до того момента, как случайно оказался в загадочном кафе «Почему». Одна ночь в этом месте на краю земли заставила его задуматься о себе и осознать, что в жизни для него действительно важно и ценно. Эта книга превратила бизнес-консультанта Джона П. Стрелеки в знаменитого писателя и вдохновляющего коуча. Она издана миллионными тиражами и переведена на 30 языков.', 14, 160, 3.6667, NULL),
(11, 12, 12, 10, 'piknik.jpg', 'Пикник на обочине', 'Книга «Пикник на обочине» братьев Стругацких рассказывает о том, как контакты инопланетян с Землёй навсегда изменили ход истории человечества. В местах приземления образовались загадочные «Зоны» — участки, где законы физики и здравого смысла перестали действовать.\r\n<br><br>\r\nОдна из основных тем произведения — нравственный выбор тех, в чьи руки попадают артефакты Зоны, то, как ими воспользуется человечество, которое плохо понимает, в чём предназначение этих опасных вещей, неизвестно зачем оставленных пришельцами.\r\n<br><br>\r\nКлючевая тема — трансформация человека, стремящегося любыми средствами достичь желаемого, в покорного раба своих амбиций, утрата внутренней целостности.\r\n<br><br>\r\nТакже в книге поднимается вопрос о том, что делает человека человеком, что допустимо и что — нет, на пути к личному счастью.', 22, 256, 5, 5),
(12, 12, 12, 10, 'ostrov.webp', 'Обитаемый остров', 'Книга братьев Стругацких «Обитаемый остров» рассказывает о судьбе молодого землянина, человека XXII века, попавшего на неизвестную планету. \r\n<br><br>\r\nЕго космический корабль терпит крушение, и он оказывается один в совершенно чуждом ему, непонятном и враждебном мире. Много необыкновенных приключений приходится ему испытать, прежде чем он находит друзей и определяет своё место в этом странном мире.\r\n<br><br>\r\nВ центре повествования — Страна Неизвестных Отцов, которой управляют тираны, скрывающие свои личности. В недавнем прошлом отгремела опустошительная ядерная война, и многие территории заражены радиацией. Саму же страну терзают внутренние социальные проблемы, которые Отцы практически не пытаются исправить. Самое странное, что при всём этом, народ счастлив и всем доволен. Эту загадку Максиму и предстоит разрешить.\r\n<br><br>\r\nКнига сочетает в себе сразу несколько жанров: социальная фантастика с элементами антиутопии, планетарная и приключенческая фантастика. Один из ключевых проблемных вопросов романа — противопоставление революции и эволюции, как противоположных типов изменений в обществе. И ответа, что же лучше, в книге нет, читателю предоставляется право сделать выводы самому.', 9, 416, 5, NULL),
(13, 2, 6, 11, 'war_and_piace.webp', 'Война и мир', 'Роман «Война и мир», одно из величайших произведений русской и мировой литературы, создавался Л.Н. Толстым на протяжении шести лет, восемь раз переписывался, а отдельные эпизоды – более двадцати раз. Исследователи насчитывают пятнадцать вариантов одного только начала романа. В данной книге использована вторая редакция «Войны и мира» (1873 год), наиболее полная и удобная для чтения, поскольку Толстой перевёл на русский весь французский текст романа.\r\n<br><br>\r\nКнига снабжена большим количеством иллюстраций, показывающих прототипов главных героев, исторических персонажей, а также хронику нашествия Наполеона на Россию. Развернутые комментарии к ним дал российский литературовед, доктор филологических наук Борис Соколов. Из этих комментариев можно узнать много интересных и неожиданных подробностей об исторической канве «Войны и мира».', 42, 1360, 4.1429, NULL),
(14, 13, 13, 12, 'bread.webp', 'Хлеб, который можно всем', 'Новая книга Анастасии Гагаркиной – гораздо больше, чем просто собрание рецептов, она посвящена пониманию закваски и обмену знаниями о том, почему волшебный процесс ферментации является неотъемлемой частью приготовления самого питательного, полезного и вкусного хлеба. С автором вы пройдете увлекательный путь от подробного изучения ингредиентов до приготовления закваски и выпечки. Узнаете, какая выпечка не приносит вреда здоровью, а главное, как ее приготовить. Научитесь готовить настоящий русский хлеб и выпечку без глютена, веганские десерты.', 30, 82, 3.5, NULL),
(15, 14, 7, 13, 'moskow.webp', 'Пешком по Москве', 'Москва – город идеальный для прогулок. Узнавая с каждым годом все новые факты о достопримечательностях столицы, автор собрал свои любимые маршруты и поделился ими с вами. В этой книге показаны лучшие и характерные здания, но в деталях, которые знает только местный, подробно описаны маршруты – «Царь горы», «Купец идет», «На фоне Пушкина», «Опричная сторонка», «Граница Белого», «Карман Замоскворечья», «Под горой». Семь маршрутов, как семь московских холмов, позволят полюбоваться городом и узнать о нем много нового.\r\n\r\nЭтот иллюстрированный путеводитель, с рассказом об архитектурных шедеврах и занимательными историями о знаменитостях столицы, будет интересен и полезен жителям и гостям Москвы. Читайте книгу, рассматривайте фотографии, надеемся, это побудит вас совершить прогулку по предложенным маршрутам. Для удобства, в начале каждой главы представлена подробная схема.', 22, 88, 2, NULL),
(16, 14, 7, 13, 'sochi.webp', 'Сочи. Путешествие в мир легенд Сочинского Причерноморья. Современная версия', 'Территория, которую ныне занимает Сочинский национальный парк и частично Кавказский государственный заповедник, привлекает туристов. Завораживают горные образования, поражает природа этих мест. Здесь в ходу легенды, походные рассказы и сказки старожилов, зачастую не имеющие под собой исторической подоплеки, но по-своему оживляющие малознакомые для широкого турсообщества жемчужины природы удивительной красоты. Множество артефактов неизвестного назначения, белые пятна в истории заселения региона, странные метеорологические и геомагнитные аномалии служат хорошей почвой для создания легенд и современной интерпретации древних сказаний.\r\n<br><br>\r\nАтмосферу Сочинского Причерноморья передают яркие фотографии, а рисунки, подготовленные специально для этого издания, дополняют таинственности рассказам. Но кто, по-настоящему, уверен в том, что все это только сказки?', 8, 75, 4, NULL),
(17, 15, 13, 14, 'quant.webp', 'Квантовые миры и возникновение пространства-времени', 'Большинство физиков не сознают неприятный факт: их любимая наука находится в кризисе с 1927 года. В квантовой механике с самого начала существовали бросающиеся в глаза пробелы, которые просто игнорировались. Популяризаторы постоянно твердят, что квантовая механика – это что-то странное, недоступное для понимания… Чтобы все встало на свои места, достаточно признать, что во Вселенной мы существуем не в одном экземпляре. Шонов Кэрроллов бесконечно много. Как и каждого из нас.\r\n<br><br>\r\nТысячи раз в секунду во Вселенной возникают все новые и новые наши копии. Каждый раз, когда происходит квантовое событие, мир дублируется, создавая копию, в которой квантовое событие так и не произошло.\r\n<br><br>\r\nВ квантовой механике нет ничего мистического или необъяснимого. Это просто физика.', 9, 256, 5, 13),
(20, 17, 5, 16, '697b578e97cbe1.34129395951LbnCP.webp', 'Илон Маск', 'Вероятно, в сознании каждого обитателя нашей планеты Илон Маск – это как будто два разных человека. Один – визионер, новатор, одержимый идеями о лучшем будущем для человечества и активно это будущее приближающий. Другой – одиозный, деспотичный, несдержанный на язык провокатор, который, кажется нам порой, способен довести свое любимое человечество до коллективного нервного срыва.\r\n<br><br>\r\nЧтобы понять, кто такой Илон Маск в реальной жизни, чем он занят изо дня в день, как в нем уживаются “гений и злодейство” и что все это значит для нашей судьбы как вида, нужен самый беспристрастный на свете наблюдатель – то есть Уолтер Айзексон.\r\n<br><br>\r\nПроведя с Маском два года почти неразлучно, собрав огромное количество материалов и интервью, Айзексон создал объемный, динамичный портрет одного из самых значимых и знаменитых героев нашего времени.', 20, 93, 3.5, 2),
(21, 6, NULL, NULL, '697b6cbbbdca19.506679561mHBXtsh.jpeg', 'А.П. Чехов', '«А.П. Чехов» — произведение русского прозика и драматурга, одного из самых известных в мире русских писателей и мыслителей Макси́ма Го́рького (настоящее имя — Алексе́й Макси́мович Пешко́в, 1868–1936).*** Свои воспоминания автор пометил датами 1905 — 1923 гг. Это очень интересное свидетельство о личности Чехова. «Он обладал искусством всюду находить и оттенять пошлость, искусством, которое доступно только человеку высоких требований к жизни, которое создается лишь горячим желанием видеть людей простыми, красивыми, гармоничными. Пошлость всегда находила в нем жестокого и строгого судью», — пишет Горький. И далее: «Читая рассказы Антона Чехова, чувствуешь себя точно в грустный день поздней осени», «Хорошо вспомнить о таком человеке, тотчас в жизнь твою возвращается бодрость, снова входит в нее ясный смысл». Перу Горького принадлежат и такие произведения: «Бабушка Акулина», «Барышня и дурак», «Болесь», «Букоемов, Карп Иванович», «Бывшие люди».', 1, 24, 0, NULL),
(23, 12, 12, 10, '697f057401dab7.596896770bEsgXJ5.webp', 'Хищные вещи века', 'XXI век – эпоха перемен… В этот мир окунается космонавт Иван Жилин, навсегда возвратившийся на Землю, где его ждут «хищные вещи века».', 90, 190, 0, 6),
(24, 12, 12, 10, '697f05cb4f3056.62598180ByarH8bI.webp', 'Трудно быть богом', 'В государстве Анканар, что находится на другой планете, живут существа, внешне очень похожие на людей. Если брать по земным меркам, их цивилизация достигла уровня позднего Средневековья.\r\n<br><br>\r\nВ Анканаре много землян, но они не афишируют своего присутствия, а работают как бы под прикрытием. Это специально обученные бойцы, умные и опытные, которые наблюдают за ходом истории. Вмешиваться в нее им нельзя. Лишь в крайнем случае, если действия аборигенов смогут привести к катастрофическим последствиям.\r\n<br><br>\r\nИ вот в государстве происходит истребление интеллигенции. На самом деле эти события – лишь верхушка айсберга. Ведь в стране готовится государственный переворот. Вмешается ли Антон – один из земных наблюдателей – на этот раз?\r\n<br><br>\r\nНа нашем сайте вы можете прочитать фрагменты романа или купить его полную бумажную или электронную версию.', 50, 210, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `estimation` int NOT NULL,
  `comment` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `feedback`
--

TRUNCATE TABLE `feedback`;
--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `book_id`, `estimation`, `comment`) VALUES
(4, 6, 1, 2, NULL),
(7, 17, 1, 5, 'Имба!'),
(8, 17, 1, 3, ''),
(9, 17, 1, 4, ''),
(10, 17, 1, 4, ''),
(11, 17, 1, 1, 'А у СПИРИЧА САЙТ ГОВНО!'),
(12, 17, 1, 5, ''),
(13, 17, 1, 5, ''),
(14, 17, 1, 1, ''),
(15, 17, 1, 4, ''),
(16, 17, 1, 3, ''),
(17, 17, 1, 1, ''),
(18, 17, 1, 4, ''),
(19, 17, 1, 5, ''),
(20, 17, 1, 5, ''),
(21, 17, 13, 4, '42 страницы с описание дуба -_-'),
(23, 6, 13, 2, 'Когда увидел французский посреди русской классики, понял что это не для меня...'),
(24, 9, 13, 5, 'Панки, хой!'),
(28, 17, 11, 5, ''),
(29, 18, 11, 5, ''),
(30, 18, 1, 4, ''),
(31, 18, 13, 4, ''),
(32, 18, 14, 4, ''),
(33, 18, 15, 3, ''),
(34, 18, 16, 3, ''),
(35, 18, 17, 5, ''),
(38, 18, 20, 4, ''),
(49, 22, 11, 5, ''),
(50, 22, 16, 5, '');

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `id` int NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `genre`
--

TRUNCATE TABLE `genre`;
--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Психология'),
(2, 'Саморазвитие'),
(5, 'Научная фантастика'),
(6, 'Социальная фантастика'),
(7, 'Антиутопия'),
(8, 'Роман'),
(9, 'Города и люди'),
(10, 'Городские истории'),
(11, 'Сборник рецептов'),
(12, 'Интересные факты'),
(13, 'Физика'),
(14, 'Биография');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `status` enum('Ожидает оплаты','Собирается','В пути','Доставлен','Получен') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ожидает оплаты',
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `order`
--

TRUNCATE TABLE `order`;
--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `created_at`, `status`, `total`) VALUES
(11, 22, '2026-02-01 12:53:51', 'В пути', 2949),
(12, 22, '2026-02-01 13:26:23', 'Ожидает оплаты', 2400);

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE `order_item` (
  `id` int NOT NULL,
  `book_id` int NOT NULL,
  `order_id` int NOT NULL,
  `price_id` int NOT NULL,
  `count` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `order_item`
--

TRUNCATE TABLE `order_item`;
--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `book_id`, `order_id`, `price_id`, `count`) VALUES
(13, 20, 11, 3, 1),
(14, 16, 11, 11, 1),
(15, 14, 12, 12, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `price`
--

CREATE TABLE `price` (
  `id` int NOT NULL,
  `book_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '500.00',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `price`
--

TRUNCATE TABLE `price`;
--
-- Дамп данных таблицы `price`
--

INSERT INTO `price` (`id`, `book_id`, `price`, `created_at`) VALUES
(1, 17, 899.00, '2026-01-29 19:19:25'),
(3, 20, 1749.00, '2026-01-29 19:51:44'),
(4, 17, 898.00, '2026-01-29 19:52:08'),
(5, 17, 899.00, '2026-01-29 19:52:45'),
(7, 11, 0.00, '2026-01-29 20:18:17'),
(8, 21, 639.00, '2026-01-29 21:20:43'),
(11, 16, 1200.00, '2026-01-30 01:05:11'),
(12, 14, 1200.00, '2026-02-01 13:26:03'),
(13, 23, 900.00, '2026-02-01 14:49:08'),
(14, 24, 1100.00, '2026-02-01 14:50:35');

-- --------------------------------------------------------

--
-- Структура таблицы `publisher`
--

CREATE TABLE `publisher` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `publisher`
--

TRUNCATE TABLE `publisher`;
--
-- Дамп данных таблицы `publisher`
--

INSERT INTO `publisher` (`id`, `name`, `url`) VALUES
(1, 'Государственное издательство художественной литературы', NULL),
(3, 'Азбука-Аттикус', NULL),
(4, 'Художественная литература', NULL),
(5, 'АСТ', NULL),
(6, 'Советский писатель', NULL),
(7, 'Терра-Книжный клуб', NULL),
(8, 'Эксмо', NULL),
(9, 'Профиздат', NULL),
(12, 'Neoclassic', NULL),
(13, 'Вазелиновое вдохновение', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sys_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `role`
--

TRUNCATE TABLE `role`;
--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`, `sys_name`) VALUES
(1, 'Администратор', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `user`
--

TRUNCATE TABLE `user`;
--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `phone`, `email`, `birthdate`, `role_id`, `password`) VALUES
(2, 'Владислав', 'Спиридонов', NULL, NULL, 'example@email.com', '2006-01-12', NULL, '$2y$12$HLPbRSz3Zkh3amsvjDEBleU32tmjVL9bzf9r.x/c.tFbGXKCAWbB2'),
(3, 'Марина', 'Выходи', 'Олеговна', NULL, 'vigodi@mail.ru', '2005-04-24', NULL, '$2y$12$HLPbRSz3Zkh3amsvjDEBleU32tmjVL9bzf9r.x/c.tFbGXKCAWbB2'),
(6, 'Адольф', 'Мюллер', 'Коломан', NULL, 'yaVernulsya@gmail.com', '1980-11-20', NULL, '$2y$12$HLPbRSz3Zkh3amsvjDEBleU32tmjVL9bzf9r.x/c.tFbGXKCAWbB2'),
(7, 'Анастасия', 'Тварь', 'Валерьевна', NULL, 'example@email.com', '2005-05-30', NULL, '$2y$12$HLPbRSz3Zkh3amsvjDEBleU32tmjVL9bzf9r.x/c.tFbGXKCAWbB2'),
(8, 'Никита', 'Хохлов', 'Артёмович', '89145560102', 'example@email.com', '2006-07-14', NULL, '$2y$12$HLPbRSz3Zkh3amsvjDEBleU32tmjVL9bzf9r.x/c.tFbGXKCAWbB2'),
(9, 'Илья', 'Рац', NULL, NULL, 'RacDwaTri@mial.ru', '2006-01-25', NULL, '$2y$12$HLPbRSz3Zkh3amsvjDEBleU32tmjVL9bzf9r.x/c.tFbGXKCAWbB2'),
(10, 'Максим', 'Хохлов', 'Артёмович', '99142360103', 'example@email.com', '2006-07-14', NULL, '$2y$12$HLPbRSz3Zkh3amsvjDEBleU32tmjVL9bzf9r.x/c.tFbGXKCAWbB2'),
(15, 'Igor', 'Nasralvsunduk', NULL, NULL, 'example@email.com', NULL, NULL, '$2y$12$7Z4ISX.OXyx3xBfIqODpM.Ygh48doFoMfK0cXD0Tjg2l7eHLnPnFi'),
(16, 'Олег Богомолов', 'Nasralvsunduk', '', '', 'mr.mig2046@mail.ru', '2025-04-17', NULL, '$2y$12$QjtGii8X5ctTiVbSYD89zu.BJa5d/CuLTcuGftmFouxtCQ7hydz9a'),
(17, 'Олег', 'Богомолов', 'Олегович', '', 'w@w.w', '2025-04-17', NULL, '$2y$12$HLPbRSz3Zkh3amsvjDEBleU32tmjVL9bzf9r.x/c.tFbGXKCAWbB2'),
(18, 'Игорь', 'Скляр', '', '', 'Q@q.q', '2025-05-15', NULL, '$2y$12$YvSyKnnEW8ab/K2Ng3hq1Od2tzuIG3DtVgLRlFj8zggJYI9hfXsqW'),
(19, 'ркф', 'фкр', '', '', 'b@b.b', '2025-05-22', NULL, '$2y$12$Rd2x5S0eSkPc0Z3ZUlBZnu9giD834pz.ltcc5fZUYwkrB6YSNPcg.'),
(20, 'Артём', 'Калашников', 'Олегович', '89464670026', 'akkk@mail.ru', '1995-02-07', NULL, '$2y$12$relQ2M1N7xKvU6P05WmAo.hNbQF8z/E7LFtiT4249bMfdpS4BZcQS'),
(21, 'Олег', 'Богомолов', 'Олегович', '', 'asd@d.d', '2025-08-23', NULL, '$2y$12$aFtUEdUNjiBPuIEPzHbjfeTBONJ4LOPmo3zZjn8uqFcE0qiVEmaIm'),
(22, 'Олег', 'Богомолов', 'Олегович', '89833561527', 'mr.mig2006@mail.ru', '2006-05-15', 1, '$2y$12$UU7M8xfFwNJK4M1BbCq7oOVbZQTm0dJA8EUx1kOZiU9IdFtPP643e');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_author_FK` (`author_id`),
  ADD KEY `book_publisher_FK` (`publisher_id`),
  ADD KEY `book_batch_FK` (`batch_id`),
  ADD KEY `book_genre_FK` (`genre_id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_book_FK` (`book_id`),
  ADD KEY `feedback_user_FK` (`user_id`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_FK` (`user_id`);

--
-- Индексы таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_book_FK` (`book_id`),
  ADD KEY `order_item_order_FK` (`order_id`),
  ADD KEY `order_item_price_FK` (`price_id`);

--
-- Индексы таблицы `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NewTable_book_FK` (`book_id`);

--
-- Индексы таблицы `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_FK` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `price`
--
ALTER TABLE `price`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_author_FK` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `book_batch_FK` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `book_genre_FK` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `book_publisher_FK` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_book_FK` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_book_FK` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_order_FK` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_price_FK` FOREIGN KEY (`price_id`) REFERENCES `price` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `NewTable_book_FK` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_FK` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
