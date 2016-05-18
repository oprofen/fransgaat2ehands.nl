--
-- Структура таблицы `#__dvdstore_actor`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_actor` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` char(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_assessment`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_assessment` (
  `id` int(11) unsigned NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_nl` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_association_actor`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_association_actor` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_association_assessment`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_association_assessment` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_association_language`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_association_language` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_association_object_type`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_association_object_type` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_association_subcategory`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_association_subcategory` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_association_sub_language`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_association_sub_language` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_director`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_director` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` char(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_dvd`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_dvd` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `publisher` int(10) unsigned NOT NULL DEFAULT '0',
  `location` int(10) unsigned NOT NULL DEFAULT '0',
  `translator` int(10) unsigned NOT NULL DEFAULT '0',
  `country_publication` int(10) unsigned NOT NULL DEFAULT '0',
  `country_production` int(10) unsigned NOT NULL DEFAULT '0',
  `overall_assessment` int(10) unsigned NOT NULL DEFAULT '0',
  `book_language` int(10) unsigned NOT NULL DEFAULT '0',
  `title` char(50) NOT NULL COMMENT 'Title',
  `isbn10` char(13) NOT NULL COMMENT 'Field requires first 9 characters digits + 4 characters',
  `isbn13` char(13) NOT NULL COMMENT 'Field requires 13 digits',
  `print` char(20) NOT NULL,
  `year_issue` year(4) NOT NULL,
  `year_original` year(4) NOT NULL,
  `pages` int(10) NOT NULL,
  `blurb` text NOT NULL,
  `summary` text NOT NULL,
  `weigth` mediumint(9) unsigned NOT NULL,
  `length` mediumint(9) unsigned NOT NULL,
  `width` mediumint(9) unsigned NOT NULL,
  `depth` mediumint(9) unsigned NOT NULL,
  `selling_price` float(6,2) NOT NULL,
  `puchasecode` int(11) NOT NULL,
  `purchase_serialnumber` int(11) NOT NULL,
  `undertitle` varchar(50) NOT NULL,
  `original_title` varchar(50) NOT NULL,
  `ean13` varchar(13) NOT NULL,
  `upc12` varchar(12) NOT NULL,
  `illustrated` tinyint(1) unsigned NOT NULL,
  `publication_date` datetime NOT NULL,
  `serie` char(30) NOT NULL,
  `serie_number` char(5) NOT NULL,
  `catalog_number` char(20) NOT NULL,
  `barcode` char(20) NOT NULL,
  `review_en` text NOT NULL,
  `review_nl` text NOT NULL,
  `edition` char(20) NOT NULL,
  `original_retailprice` float NOT NULL,
  `date_original_retailprice` datetime NOT NULL,
  `particulars_en` char(200) NOT NULL,
  `particulars_nl` char(200) NOT NULL,
  `extra_information_en` char(200) NOT NULL,
  `extra_information_nl` char(200) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_film_production`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_film_production` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_nl` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------



--
-- Структура таблицы `#__dvdstore_object_type`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_object_type` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title_en` char(255) NOT NULL,
  `title_nl` char(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_publisher`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_publisher` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_subcategory`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_subcategory` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title_en` varchar(255) NOT NULL,
  `title_nl` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Структура таблицы `#__dvdstore_translator`
--

CREATE TABLE IF NOT EXISTS `#__dvdstore_translator` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `#__dvdstore_actor`
--
ALTER TABLE `#__dvdstore_actor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__dvdstore_assessment`
--
ALTER TABLE `#__dvdstore_assessment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__dvdstore_director`
--
ALTER TABLE `#__dvdstore_director`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__dvdstore_dvd`
--
ALTER TABLE `#__dvdstore_dvd`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__dvdstore_film_production`
--
ALTER TABLE `#__dvdstore_film_production`
  ADD PRIMARY KEY (`id`);



--
-- Индексы таблицы `#__dvdstore_object_type`
--
ALTER TABLE `#__dvdstore_object_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__dvdstore_publisher`
--
ALTER TABLE `#__dvdstore_publisher`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__dvdstore_subcategory`
--
ALTER TABLE `#__dvdstore_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__dvdstore_translator`
--
ALTER TABLE `#__dvdstore_translator`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `#__dvdstore_actor`
--
ALTER TABLE `#__dvdstore_actor`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__dvdstore_assessment`
--
ALTER TABLE `#__dvdstore_assessment`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__dvdstore_director`
--
ALTER TABLE `#__dvdstore_director`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__dvdstore_dvd`
--
ALTER TABLE `#__dvdstore_dvd`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__dvdstore_film_production`
--
ALTER TABLE `#__dvdstore_film_production`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `#__dvdstore_object_type`
--
ALTER TABLE `#__dvdstore_object_type`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__dvdstore_publisher`
--
ALTER TABLE `#__dvdstore_publisher`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__dvdstore_subcategory`
--
ALTER TABLE `#__dvdstore_subcategory`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__dvdstore_translator`
--
ALTER TABLE `#__dvdstore_translator`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
