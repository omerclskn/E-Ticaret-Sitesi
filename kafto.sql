-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Oca 2021, 23:12:01
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kafto`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `eposta` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`eposta`, `parola`) VALUES
('info@kafto.com', 'b8c8dab33dfbae8d4d784b10ca5bb275');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `userid` int(10) NOT NULL,
  `productid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sepet`
--

INSERT INTO `sepet` (`userid`, `productid`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `id` int(10) NOT NULL,
  `gorsel` varchar(255) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  `urunad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`id`, `gorsel`, `baslik`, `aciklama`, `urunad`) VALUES
(1, '1096_1.jpg', '2021 T-Shirt Koleksiyonu', 'Bir rüyada olmadığınızı anlamak için, ellerinize bakın.', 'MANO UNUS - by Albin Bousquet'),
(2, '1375_1.jpg', '2021 Sweatshirt Koleksiyonu', 'Süzülürken iyi güzel de, her seferinde de bir parça eksiliyor. Bozukluklar mı düştü acaba?', 'FLUGI'),
(3, '1416_1.jpg', '2021 Kapşonlu Koleksiyonu', 'X formunu bu sefer ceplerde kullandık. İç dokusu yumuşacık,\r\ncepleri derin ve kullanışlı.', 'XPOCKET - RAVEN');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(10) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `kategori` varchar(225) NOT NULL,
  `cinsiyet` int(10) NOT NULL,
  `fiyat` int(10) NOT NULL,
  `gorsel` varchar(255) NOT NULL,
  `s` int(10) NOT NULL DEFAULT 99,
  `m` int(10) NOT NULL DEFAULT 99,
  `l` int(10) NOT NULL DEFAULT 99
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `ad`, `kategori`, `cinsiyet`, `fiyat`, `gorsel`, `s`, `m`, `l`) VALUES
(1, 'Mano Unus', 'tshirt', 1, 80, '1096_1.jpg', 0, 99, 99),
(2, 'Lentaa', 'tshirt', 0, 60, '1272.jpg', 99, 99, 99),
(3, 'VRTT', 'tshirt', 1, 80, '1337.jpg', 99, 0, 99),
(4, 'Flugi', 'sweatshirt', 2, 100, '1375_1.jpg', 99, 99, 99),
(5, 'Xpocket Raven', 'kapuson', 2, 80, '1416_1.jpg', 99, 99, 0),
(6, 'Planterra', 'tshirt', 1, 80, '1540.jpg', 99, 99, 99),
(7, 'Lucka', 'tshirt', 2, 60, '1315_1.jpg', 99, 0, 99),
(8, 'Obitus', 'tshirt', 0, 80, '1105_1.jpg', 99, 99, 99),
(9, 'Apenda Sulphur', 'kapuson', 1, 120, '1410_1.jpg', 99, 99, 99),
(10, 'Blaska', 'sweatshirt', 0, 100, '1369_1.jpg', 0, 99, 99),
(11, 'Apenda Jungle', 'kapuson', 0, 120, '1412_1.jpg', 99, 99, 99),
(12, 'Flowinga Coral', 'sweatshirt', 0, 110, '1421_1.jpg', 99, 99, 99);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(10) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `soyad` varchar(255) NOT NULL,
  `eposta` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `ceptelefonu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `ad`, `soyad`, `eposta`, `parola`, `ceptelefonu`) VALUES
(1, 'Omer', 'Caliskan', 'omercaliskan99@gmail.com', 'b8c8dab33dfbae8d4d784b10ca5bb275', '5063668731');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
