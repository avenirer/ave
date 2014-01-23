-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Gazda: localhost
-- Timp de generare: 23 Ian 2014 la 16:50
-- Versiune server: 5.5.16
-- Versiune PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza de date: `ave`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `title_tag` varchar(255) NOT NULL,
  `teaser` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `url` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `edited_by` int(11) NOT NULL,
  `id_author` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `articles`
--

INSERT INTO `articles` (`id`, `id_category`, `title`, `title_tag`, `teaser`, `description`, `body`, `keywords`, `url`, `created_at`, `created_by`, `edited_at`, `edited_by`, `id_author`, `status`) VALUES
(1, 5, 'test thassos', 'Produse locale din Insula Thassos', 'Dintre toate celelalte insule greceşti, Thassos se evidenţiază prin unicitatea mondială a marmurei albe şi prin cultivarea celebrelor măsline de calitate superioară „throuba”.', 'Dintre toate celelalte insule greceşti, Thassos se evidenţiază prin unicitatea mondială a marmurei albe şi prin cultivarea celebrelor măsline de calitate s', '<p>Dintre toate celelalte insule greceşti, Thassos se evidenţiază prin unicitatea mondială a marmurei albe şi prin cultivarea celebrelor măsline de calitate superioară &bdquo;throuba&rdquo;. Printre produsele naturale, tradiţionale, pe care le poţi găsi &icirc;n timpul unei vacanţe pe Insula Thassos, se află celebrul ulei de măsline, mierea, br&acirc;nza feta, dulceţurile din fructe proaspete şi băuturile uzo şi tsipouro.</p>\r\n<p>Măsline şi ulei de măsline</p>\r\n<p>Insula Thassos abundă &icirc;n culturi de măslini, iar producţia uleiului de măsline a susţinut financiar multe generaţii de locuitori. &Icirc;n Thassos, măslinul este considerat un copac binecuv&acirc;ntat, tocmai de aceea nimic din ceea ce produce el nu se pierde. Frunzele sunt utilizate ca hrană pentru animale, lemnul este folosit &icirc;n sculpturi şi la &icirc;ncălzirea caselor pe timp de iarnă, iar măslinele fie sunt presate pentru ulei, fie sunt conservate şi utilizate &icirc;n gastronomie.</p>\r\n<p>&Icirc;n Thassos se cultivă măslinele de calitate superioară &bdquo;throuba&rdquo;, bogate &icirc;n calităţi nutritive şi din care se produce un ulei de măsline extravirgin, cu aciditate foarte scăzută. Uleiul de măsline conţine cantităţi mari de antioxidanti, fiind recunoscut internaţional pentru beneficiile privind sănătatea inimii. Uleiul din măsline throuba se găseşte &icirc;n ambalaje şi cu arome diferite şi poate fi cumpărat direct de la localnici sau din magazinele de pe insulă. Uleiul de măsline este comercializat şi ca suvenir, fiind &icirc;mputeliat &icirc;n sticle mici, transparente, &icirc;mpreună cu crenguţe de măslin, lăm&acirc;i, portocal sau smochin, pentru aromă. Uleiul din măsline throuba este exportat pe scară largă, put&acirc;nd fi găsit &icirc;n multe locuri ale lumii, &icirc;nsă preţul este mult mai mare. De asemenea, dacă ajungi &icirc;n Thassos, &icirc;ncearcă să cumperi ulei de măsline nerafinat, direct de la localnici, pentru a simţi cu gustul pur al măslinei.</p>\r\n<p>Miere</p>\r\n<p>Producţia de miere este o industrie dezvoltată a insulei Thassos, susţinută de pinii, castanii şi florile arbuştilor (găsiţi &icirc;n abundenţă) care constituie principala sursă de hrană a albinelor. &Icirc;n Thassos, mierea este un produs complet natural și se prepară la nivel local, &icirc;n modul cel mai pur. Poţi cumpăra miere, ceară de albine şi alte produse, precum polen şi dulciuri tradiţionale naturale de la localnici, care obişnuiesc să producă &icirc;n propriile case aceste preparate. Mai mult, poţi &icirc;ncerca şi mierea de fagure, lăptișor de matcă şi propolis. Localnicii comercianţi obişnuiesc să stea la marginea drumului cu produsele naturale din miere, astfel că este imposibil să nu &icirc;i zăreşti. De asemenea, poţi cumpăra miere şi de la magazinele existente pe insulă.</p>\r\n<p>Dulceţuri</p>\r\n<p>Gustul dulceţurilor tradiţionale din Thassos este greu de reprodus, datorită gustului dat de mierea naturală şi de aroma fructelor proaspete, abia culese. Cele mai cunoscute dulceţuri sunt cele preparate din nuci dulci, culese la &icirc;nceput de primăvară. Gustul dulce-amărui şi consistenţa fructului, păstrat aproape intact sunt două dintre cele mai importante proprietăţi ale acestor delicatese greceşti. Alte dulceţuri pe care le poţi degusta &icirc;n Thassos sunt din dovleac, portocale, trandafir și gutui, toate fiind preparate după aceeaşi reţetă tradiţională, care permite fructului să-şi păstreze consistenţa. C&acirc;t despre dulciuri, cele mai cunoscute sunt &bdquo;halvas&rdquo; (halva cu miere) şi &bdquo; saragli&rdquo; (foietaj umplut cu miere și nuci, preparat &icirc;n cuptor), care se prepară, adesea, &icirc;n satul Kallirachi.</p>\r\n<p>Vinul</p>\r\n<p>Epoca de aur a vinului Thassian, din perioadele elenistice și clasice, a jucat un rol important &icirc;n dezvoltarea economiei insulei. De-a lungul timpului, producţia de vin a fost &icirc;nlocuită de actuala industrie a insulei: măslinele. Astăzi, nu există o producţie &icirc;n masă, ci doar c&acirc;teva soiuri limitate de vin Thassian, care se comercializează adesea &icirc;n satul de munte Kazaviti, renumit pentru calitatea produselor sale.</p>\r\n<p>Tsipouro</p>\r\n<p>Tsipuro este o băutură tare şi aromată, produsă de localnici, care nu se găseşte &icirc;n nicio altă zonă a lumii. La sf&acirc;rșitul lui octombrie și &icirc;nceputul lunii noiembrie, după recolta de viţă-de-vie, boabe de struguri şi diferite fructe aromate, precum anasonul, sunt puse &icirc;n vase mari pentru producţia de tsipuro. Este băutura preferată de mulţi localnici pentru că se prepară doar din ingrediente naturale. &Icirc;n plus, are beneficiul că, &icirc;n ciuda consumului mare, marmureala nu &icirc;şi face simţită prezenţa. Tsipouro seamănă cu ouzo, o altă băutură tradițională din Grecia familiară multora pentru aroma proaspătă. Diferența de bază dintre cele două este că tsipouro este un produs total natural prin distilarea strugurilor, &icirc;n timp ce ouzo este distilat cu substanțe chimice care conțin alcool. Aroma tsipouro este mai bl&acirc;ndă dec&acirc;t aroma ouzo, &icirc;nsă ambele pot fi băute &icirc;ntr-o companie bună şi, bine&icirc;nţeles, cu moderaţie. Băutura merge foarte bine alături de aperitive şi fructe de mare sărate sau afumate. Cele mai multe taverne și restaurante servesc propria lor băutură tsipouro, la cererea clientului.</p>\r\n<p>Lactate</p>\r\n<p>Branza feta din Thassos este preparată din lapte de capră, la fel ca multe alte br&acirc;nzeturi şi creme locale. &Icirc;n zilele noastre, industria produselor lactate este relativ mică. Cu toate acestea, &icirc;ncă se mai găsesc localnici care v&acirc;nd produse din lapte de capră. Aşadar, dacă ai norocul să găseşti br&acirc;nzeturi şi lactate naturale &icirc;n Thassos, nu ezita să cumperi. G&acirc;ndeşte-te că feta este br&acirc;nza grecească naturală recunoscută la nivel internaţional pentru savoarea şi proprietăţile ei.</p>\r\n<p>Ceaiul şi ierburile montane</p>\r\n<p>Proprietăţile curative ale plantelor și ale ierburilor care se găsesc &icirc;n Thassos au fost şi sunt, chiar şi la ora actuală, subiectul multor documentare despre sănătate. &Icirc;n timpul vieţii sale pe insula Thassos, marele medic Hippocrates (460-370 &icirc;.Hr.), considerat astăzi părintele medicinei occidentale, a relatat pe larg proprietăţile terapeutice ale plantelor şi ceaiurilor de pe insulă, folosindu-le &icirc;n tratarea pacienţilor săi. Frunzele de dafin, rozmarinul şi muşeţelul abundă &icirc;n Thassos şi sunt adesea folosite &icirc;n tratarea răcelii. Alte plante care cresc aici sunt melisa, sunătoarea şi salvia. Amestecate cu ulei de măsline, acestea au proprietăţi de vindecare a rănilor pielii. Mai mult, pe insulă cresc 12 de specii de plante medicinale, care nu există &icirc;n nicio altă zonă din Grecia.</p>\r\n<p>Carnea şi fructe de mare</p>\r\n<p>&Icirc;ncă din cele mai vechi timpuri, agricultura a fost o parte importantă din economia insulei Thassos. Datorită vegetaţiei luxuriante şi a aerului curat, pe insulă cresc capre şi miei. Carnea roşie este consumată adesea &icirc;n satele montane Theologos, Kazaviti, Panagia și Maries, iar &icirc;n rest predomină peştele şi fructele de mare. Cele mai multe preparate din gastronomia tradiţională au ca bază peşte şi fructe de mare proaspete. De la sardine, hamsii și creveți, şi p&acirc;năla dorada și chefal, există o mare varietate din care poţi alege. &Icirc;n apele coastei de sud a insulei se găsesc din abundenţă specii marine precum caracatiță, calmar, arici de mare și stridii. Toate acestea sunt preparate simplist, pun&acirc;ndu-se valoare pe savoarea peştelui sau a fructelor de mare.</p>\r\n<p>Marmura</p>\r\n<p>Marmura produsă &icirc;n Thassos a fost şi este apreciată &icirc;ncă din antichitate pentru rezistenţa şi culoarea albă, a zăpezii pure. Este singura marmură albă din lume, descoperită p&acirc;nă la ora actuală. Se zvoneşte că prima extracţie de marmură a avut loc &icirc;n jurul anilor 18.000 &icirc;.HR, &icirc;ntre Limenaria și Maries, fiind cea mai veche extracţie minieră din Europa. Extracţiile intensive de marmură au &icirc;nceput odată cu venirea coloniştilor, iar primele exporturi s-au &icirc;nregistrat &icirc;n secolul al 6-lea &icirc;.Hr., de la carierele vechi din Alyki către insula Samothraki şi alte insule din apropiere, p&acirc;nă la coasta Asiei Mici, la Atena și &icirc;n sudul Greciei. Cu timpul, &icirc;n jurul secolului 3 d.Hr, marmura albă a ajuns &icirc;n Roma antică şi apoi la Imperiul Bizantin. Marmura din Thassos este apreciată pentru strălucirea fină şi culoarea albă, pură, fiind prielnică &icirc;ndeosebi &icirc;n zonele cu climat cald, precum Orientul Mijlociu , datorită proprietăţilor de izolare a luminii și a capacităţii de a reflecta căldura. &Icirc;n jurul Limenas există cariere din care se extrag şi astăzi marmură albă, care trimisă la fabrici cu utilaje grele unde este procesată și tratată pentru utilizarea &icirc;n construcţii şi amenajări interioare. Proprietăţile reflectorizante ale marmurei albe sunt at&acirc;t de unice, &icirc;nc&acirc;t a inspirat echipa de efecte vizuale a filmului Saga Amurg. Praful de marmură albă din Thassos a fost amestecat cu machiajul aplicat pe chipurile vampirilor, cu scopul de a &bdquo;crea efectul spumant c&acirc;nd razele soarelui le luminează feţele&rdquo;.</p>\r\n<p>- See more at: http://www.thassos.ro/produse-locale-thassos.php#sthash.qRDvNRPW.dpuf</p>', 'thassos, masline', 'Produse-locale-din-Insula-Thassos', '2014-01-23 10:28:56', 2, '2014-01-23 14:30:56', 2, 1, 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `display_as` varchar(100) NOT NULL,
  `personal_page` varchar(255) NOT NULL,
  `google_plus` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `edited_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `display_as`, `personal_page`, `google_plus`, `facebook`, `twitter`, `linkedin`, `about`, `status`, `url`, `created_at`, `created_by`, `edited_at`, `edited_by`) VALUES
(1, 'Adrian', 'Voicu', 'Avenirer', '', '', '', '', '', '', 1, 'Avenirer', '2014-01-23 13:25:28', 2, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `category` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `edited_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `edited_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Salvarea datelor din tabel `categories`
--

INSERT INTO `categories` (`id`, `id_parent`, `category`, `created_at`, `created_by`, `edited_at`, `edited_by`, `status`) VALUES
(1, 2, 'testz0r', '0000-00-00 00:00:00', 0, '2014-01-21 06:55:09', 2, 1),
(2, 0, 'test 3', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(3, 0, 'test 3', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(4, 2, 'test 4', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(5, 1, 'edited too', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(6, 0, 'editedagainwithtimestampanduser', '0000-00-00 00:00:00', 0, '2014-01-20 13:52:28', 2, 1),
(7, 0, 'test data', '2014-01-20 14:45:40', 0, '0000-00-00 00:00:00', 0, 1),
(8, 6, 'test add categ', '2014-01-20 14:54:24', 2, '0000-00-00 00:00:00', 0, 1),
(9, 0, 'testmodificat', '2014-01-23 15:34:36', 2, '2014-01-23 14:35:44', 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
