-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 02 2016 г., 19:26
-- Версия сервера: 5.7.11-log
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fransgaat2ehands`
--

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_assessment`
--

DROP TABLE IF EXISTS `#__bookstore_assessment`;
CREATE TABLE IF NOT EXISTS `#__bookstore_assessment` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_association_assessment`
--

DROP TABLE IF EXISTS `#__bookstore_association_assessment`;
CREATE TABLE IF NOT EXISTS `#__bookstore_association_assessment` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
--
-- Структура таблицы `#__bookstore_association_assessment`
--

DROP TABLE IF EXISTS `#__bookstore_association_translator`;
CREATE TABLE IF NOT EXISTS `#__bookstore_association_translator` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_association_object_type`
--

DROP TABLE IF EXISTS `#__bookstore_association_object_type`;
CREATE TABLE IF NOT EXISTS `#__bookstore_association_object_type` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_association_subcategory`
--

DROP TABLE IF EXISTS `#__bookstore_association_subcategory`;
CREATE TABLE IF NOT EXISTS `#__bookstore_association_subcategory` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_association_writer`
--

DROP TABLE IF EXISTS `#__bookstore_association_writer`;
CREATE TABLE IF NOT EXISTS `#__bookstore_association_writer` (
  `book` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_book`
--

DROP TABLE IF EXISTS `#__bookstore_book`;
CREATE TABLE IF NOT EXISTS `#__bookstore_book` (
  `id` int(11) unsigned NOT NULL,
  `asset_id` int(11) unsigned NOT NULL DEFAULT '0',
  `publisher` int(10) unsigned NOT NULL DEFAULT '0',
  `location` int(10) unsigned NOT NULL DEFAULT '0',
  `translator` int(10) unsigned NOT NULL DEFAULT '0',
  `illistrator` int(10) unsigned NOT NULL DEFAULT '0',
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
  `selling_price` float NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_illistrator`
--

DROP TABLE IF EXISTS `#__bookstore_illistrator`;
CREATE TABLE IF NOT EXISTS `#__bookstore_illistrator` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_location`
--

DROP TABLE IF EXISTS `#__bookstore_location`;
CREATE TABLE IF NOT EXISTS `#__bookstore_location` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_object_type`
--

DROP TABLE IF EXISTS `#__bookstore_object_type`;
CREATE TABLE IF NOT EXISTS `#__bookstore_object_type` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_publisher`
--

DROP TABLE IF EXISTS `#__bookstore_publisher`;
CREATE TABLE IF NOT EXISTS `#__bookstore_publisher` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_purchase_code`
--

DROP TABLE IF EXISTS `#__bookstore_purchase_code`;
CREATE TABLE IF NOT EXISTS `#__bookstore_purchase_code` (
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
-- Структура таблицы `#__bookstore_subcategory`
--

DROP TABLE IF EXISTS `#__bookstore_subcategory`;
CREATE TABLE IF NOT EXISTS `#__bookstore_subcategory` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_translator`
--

DROP TABLE IF EXISTS `#__bookstore_translator`;
CREATE TABLE IF NOT EXISTS `#__bookstore_translator` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `#__bookstore_writer`
--

DROP TABLE IF EXISTS `#__bookstore_writer`;
CREATE TABLE IF NOT EXISTS `#__bookstore_writer` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `#__bookstore_assessment`
--
ALTER TABLE `#__bookstore_assessment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_book`
--
ALTER TABLE `#__bookstore_book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_illistrator`
--
ALTER TABLE `#__bookstore_illistrator`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_location`
--
ALTER TABLE `#__bookstore_location`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_object_type`
--
ALTER TABLE `#__bookstore_object_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_publisher`
--
ALTER TABLE `#__bookstore_publisher`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_purchase_code`
--
ALTER TABLE `#__bookstore_purchase_code`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_subcategory`
--
ALTER TABLE `#__bookstore_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_translator`
--
ALTER TABLE `#__bookstore_translator`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `#__bookstore_writer`
--
ALTER TABLE `#__bookstore_writer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `#__bookstore_assessment`
--
ALTER TABLE `#__bookstore_assessment`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_book`
--
ALTER TABLE `#__bookstore_book`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_illistrator`
--
ALTER TABLE `#__bookstore_illistrator`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_location`
--
ALTER TABLE `#__bookstore_location`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_object_type`
--
ALTER TABLE `#__bookstore_object_type`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_publisher`
--
ALTER TABLE `#__bookstore_publisher`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_purchase_code`
--
ALTER TABLE `#__bookstore_purchase_code`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_subcategory`
--
ALTER TABLE `#__bookstore_subcategory`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_translator`
--
ALTER TABLE `#__bookstore_translator`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `#__bookstore_writer`
--
ALTER TABLE `#__bookstore_writer`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
