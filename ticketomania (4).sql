-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 13 Μαρ 2024 στις 23:25:47
-- Έκδοση διακομιστή: 8.0.17
-- Έκδοση PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `ticketomania`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cinema_hall`
--

CREATE TABLE `cinema_hall` (
  `hall_id` int(11) NOT NULL,
  `hall_name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `hall_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `cinema_hall`
--

INSERT INTO `cinema_hall` (`hall_id`, `hall_name`, `hall_seats`) VALUES
(1, 'ΑΙΘΟΥΣΑ 1', 50),
(2, 'ΑΙΘΟΥΣΑ 2', 80),
(3, 'ΑΙΘΟΥΣΑ 3', 20),
(4, 'ΑΙΘΟΥΣΑ 4', 40),
(5, 'ΑΙΘΟΥΣΑ 5', 25),
(7, 'ΑΙΘΟΥΣΑ 6', 50),
(8, 'ΑΙΘΟΥΣΑ 7', 60),
(9, 'ΑΙΘΟΥΣΑ 8', 87),
(10, 'ΑΙΘΟΥΣΑ 9', 100);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cinema_shows`
--

CREATE TABLE `cinema_shows` (
  `show_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `show_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `cinema_shows`
--

INSERT INTO `cinema_shows` (`show_id`, `movie_id`, `hall_id`, `show_time`, `start_date`, `end_date`) VALUES
(1, 1, 1, '20:00:00', '2024-02-19', '2024-04-27'),
(2, 1, 3, '19:00:00', '2024-02-20', '2024-03-28'),
(3, 24, 2, '18:00:00', '2024-02-21', '2024-03-29'),
(4, 25, 4, '15:00:00', '2024-02-03', '2024-05-07'),
(10, 34, 7, '16:30:00', '2024-02-26', '2024-04-16'),
(11, 28, 4, '17:30:00', '2024-02-26', '2024-04-16'),
(12, 26, 5, '22:14:00', '2024-02-04', '2024-05-08'),
(14, 27, 1, '14:00:00', '2024-02-28', '2024-03-26'),
(15, 32, 8, '21:15:00', '2024-02-28', '2024-03-26'),
(16, 33, 9, '21:35:00', '2024-02-28', '2024-04-26'),
(17, 24, 8, '17:30:00', '2024-02-26', '2024-04-04'),
(18, 28, 1, '16:15:00', '2024-03-03', '2024-04-11'),
(19, 28, 9, '23:15:00', '2024-03-05', '2024-04-02'),
(20, 34, 5, '20:00:00', '2024-03-05', '2024-03-13'),
(21, 1, 9, '23:10:00', '2024-03-05', '2024-04-26'),
(22, 32, 7, '22:30:00', '2024-03-04', '2024-05-15'),
(23, 25, 5, '20:25:00', '2024-03-05', '2024-04-23'),
(24, 26, 8, '15:00:00', '2024-03-03', '2024-04-30'),
(25, 27, 9, '11:00:00', '2024-03-05', '2024-05-31'),
(26, 33, 3, '20:00:00', '2024-03-04', '2024-05-14'),
(27, 33, 10, '21:45:00', '2024-03-05', '2024-05-09'),
(28, 32, 3, '23:10:00', '2024-03-08', '2024-04-26');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_title1` varchar(255) NOT NULL,
  `movie_title2` varchar(255) NOT NULL,
  `movie_image` varchar(255) NOT NULL,
  `movie_category` varchar(255) NOT NULL,
  `movie_description` varchar(1024) NOT NULL,
  `movie_duration` int(11) NOT NULL,
  `movie_youtube` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `movie_director` varchar(255) NOT NULL,
  `movie_script` varchar(255) NOT NULL,
  `movie_actors` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_title1`, `movie_title2`, `movie_image`, `movie_category`, `movie_description`, `movie_duration`, `movie_youtube`, `movie_director`, `movie_script`, `movie_actors`) VALUES
(1, 'ΛΑΤΡΕΥΩ ΝΑ ΣΕ ΜΙΣΩ', 'ANYONE BUT YOU', 'AnyOneButYou.jpg', 'ΡΟΜΑΝΤΙΚΗ ΚΟΜΕΝΤΙ', 'Στην κωμωδία Λατρεύω να σε μισώ (Anyone But You), η Bea (Sydney Sweeney) και ο Ben (Glen Powell) μοιάζουν να είναι το ιδανικό ζευγάρι, αλλά μετά από ένα απίστευτο πρώτο ραντεβού κάτι συμβαίνει και η καυτή μεταξύ τους έλξη τους παγώνει. Η μοίρα, όμως, τα φέρνει έτσι και βρίσκονται και οι δύο καλεσμένοι σε ένα γάμο στη μακρινή Αυστραλία όπου, κάνουν ό,τι θα έκανε κάθε ενήλικος, παριστάνουν το ζευγάρι.', 103, '-THV9UjIlcA', 'Will Gluck', 'Ilana Wolpert & Will Gluck', 'Glen Powell, Alexandra Shipp, Sydney Sweeney, Nat Buchanan,κκκ'),
(24, 'ΦΟΝΙΣΣΑ', 'ΦΟΝΙΣΣΑ', 'fonisa.jfif', 'ΔΡΑΜΑ', 'Σε ένα δυστοπικό νησί της Ελλάδας γύρω στο 1900, η Χαδούλα, χήρα Ιωάννου Φράγκου είναι μια γυναίκα που έχει μάθει να επιβιώνει στην ανδροκρατούμενη, πατριαρχική κοινωνία υπηρετώντας αυτό που της πέρασε η μητέρα της – μια σκυτάλη δύσκολη, που διαιωνίζει την υποτίμηση και την κατώτερη μοίρα της γυναίκας. Η Χαδούλα επαναστατεί μέσα της και αυτό δεν θα αργήσει να συμβεί και προς τα έξω. Τα μικρά κορίτσια του νησιού γίνονται θύματα του ξεσπάσματός της. Αφαιρώντας τους τη ζωή, η ίδια νιώθει ότι τα απαλλάσσει από το κοινωνικό φορτίο που η ύπαρξή τους επιφέρει. Οι πράξεις της κάποια στιγμή αυτονομούνται και τη φέρνουν αντιμέτωπη με τον νόμο. Εγκαταλείπει το σπίτι της και βρίσκει καταφύγιο στη φύση. Όμως, όσο και αν η ηθική της τής υπαγορεύει ότι έπραξε σωστά, στην πραγματικότητα το χρόνιο τραύμα της την ακολουθεί παντού. Το τέλος έρχεται σαν λύτρωση.', 113, 'wgcxz0b6tnE', 'Εύα Νάθενα', 'Κατερίνα Μπέη', 'Όλγα Δαμάνη, Στάθης Σταμουλακάτος, Καρυοφυλλιά Καραμπέτη, Μαρία Πρωτόπαππα, Έλενα Τοπαλίδου, Πηνελόπη Τσιλίκα, Γεωργιάννα Νταλάρα, Χρήστος Στέργιογλου, Δημήτρης Ήμελλος, Χριστίνα Μαξούρη, Αγορίτσα Οικονόμου, Μιχάλης Οικονόμου, Βερόνικα Δαβάκη, Νίκη Παπανδ'),
(25, 'ΑΓΝΩΣΤΟΙ ΜΕΤΑΞΥ ΜΑΣ', 'ALL OF US STRANGERS', 'AgnostoiMetajymas.jpg', 'ΑΙΣΘΗΜΑΤΙΚΟ ΔΡΑΜΑ', 'Μια νύχτα σε ένα σχεδόν άδειο ουρανοξύστη στο σύγχρονο Λονδίνο, ο Adam (Andrew Scott) συναντά τυχαία έναν μυστηριώδη γείτονα, τον Harry (Paul Mescal), και η καθημερινότητά του αλλάζει. Καθώς η σχέση μεταξύ τους εξελίσσεται, ο Adam κατακλύζεται από μνήμες του παρελθόντος και βρίσκεται να επιστρέφει στην επαρχιακή πόλη όπου μεγάλωσε και στο σπίτι της παιδικής του ηλικίας, όπου μοιάζει να ζουν ακόμα οι γονείς του (Claire Foy και Jamie Bell), όπως ακριβώς τη μέρα που σκοτώθηκαν, πριν από 30 χρόνια.', 109, 'ukYbzz0r6jE', 'Andrew Haigh', 'Andrew Haigh & Taichi Yamada', 'Claire Foy, Andrew Scott, Paul Mescal, Jamie Bell'),
(26, 'BOB', 'BOB MARLEY: ONE LOVE', 'ImageGen.jfif', 'Δράμα', 'Η ταινία \"BOB MARLEY: ONE LOVE\" είναι ένας ύμνος στη ζωή και τη μουσική ενός ειδώλου που ενέπνευσε γενεές με το μήνυμα αγάπης και ενότητας που πρέσβευε. Για πρώτη φορά στη μεγάλη οθόνη, ανακαλύψτε την δυνατή ιστορία υπέρβασης της διαφορετικότητας και το ταξίδι πίσω από την επαναστατική του μουσική.\n\nΜια παραγωγή σε συνεργασία με την οικογένεια του Marley.', 234, 'GzK_Yj9c_HE', 'Reinaldo Marcus Green', 'Terence Winter, Frank E. Flowers & Zach Baylin', 'Lashana Lynch, Kingsley Ben-Adir, James Norton, Jesse Cilio'),
(27, 'Ο ΚΑΡΥΟΘΡΑΥΣΤΗΣ', 'THE NUTCRACKER AND THE MAGIC FLUTE', 'kariothrafths.jfif', 'ΚΙΝΟΥΜΕΝΑ ΣΧΕΔΙΑ', 'Είναι παραμονή Χριστουγέννων. Η νεαρή Μαρί, κάνει μια ευχή: να γινόταν ένα θαύμα που θα την κάνει και πάλι μικρή και ξέγνοιαστη, σε έναν κόσμο όπου όλα είναι ομορφότερα.\nΌμως, η ευχή της πιάνει κάπως υπερβολικά καλά! Η Μαρί συρρικνώνεται στο μέγεθος κούκλας, ενώ ταυτόχρονα όλα της τα παιχνίδια ζωντανεύουν. Μια κούκλα καρυοθραύστης αποδεικνύεται ότι στην πραγματικότητα είναι ένας πρίγκιπας με το όνομα Τζορτζ, ο οποίος μετατράπηκε σε παιχνίδι από ένα σκοτεινό ξόρκι της βασίλισσας των αρουραίων.\nΣτην περιπέτεια που ακολουθεί, η Μαρί, ο Τζορτζ και οι φίλοι τους, τα παιχνίδια, ταξιδεύουν στη μαγική χώρα των λουλουδιών με αποστολή να σώσουν τον κόσμο από τους ανθρώπους των αρουραίων - γιατί η ζωή χρειάζεται πάντα λίγη μαγεία!', 88, 'yiE2xv3EOQQ', 'Viktor Glukhushin', 'Vasiliy Rovenskiy', ''),
(28, 'MADAME WEB', 'MADAME WEB', 'MadameWeb.jpg', 'ΠΕΡΙΠΕΤΕΙΑ ΔΡΑΣΗΣ', '«Στο μεταξύ, σε ένα άλλο σύμπαν…» Σε μια ανατροπή των κλασικών ταινιών του συγκεκριμένου είδους, η ταινία Madame Web εξιστορεί την αυτοτελή ιστορία της γέννησης μιας από τις πλέον αινιγματικές ηρωίδες των εκδόσεων Marvel. Στο γεμάτο αγωνία θρίλερ πρωταγωνιστεί η Dakota Johnson στο ρόλο της Cassandra Webb, μιας διασώστριας με ικανότητες μέντιουμ. Όταν έρχεται αντιμέτωπη με αποκαλύψεις για το παρελθόν της, δημιουργεί μια ιδιαίτερη σχέση με τρεις νεαρές κοπέλες, που μαζί προορίζονται για ένα δυναμικό μέλλον... αν καταφέρουν να επιβιώσουν το θανατηφόρο παρόν.»', 116, 'Otv1ibXdlZs', 'S.J. Clarkson', 'Matt Sazama, Burk Sharpless & Claire Parker', '	Emma Roberts, Zosia Mamet, Tahar Rahim, Sydney Sweeney, Isabela Merced, Dakota Johnson, Adam Scott'),
(32, 'POOR THINGS', 'POOR THINGS', 'PoorThings.jpg', 'ΔΡΑΜΑΤΙΚΗ ΚΟΜΕΝΤΙ', 'Από τον δημιουργό Γιώργο Λάνθιμο και σε παραγωγή της Emma Stone, έρχεται η απίστευτη ιστορία και η φανταστική εξέλιξη της Bella Baxter (Stone), μιας νεαρής γυναίκας που ανασταίνεται χάρη στον ιδιοφυή και αντισυμβατικό επιστήμονα Δρ. Godwin Baxter (Willem Dafoe). Υπό την προστασία του Baxter, η Bella ανυπομονεί να μάθει. Διψασμένη από την εμπειρία που στερείται, η Bella το σκάει με τον Duncan Wedderburn (Mark Ruffalo), έναν ικανό και με αμβλυμμένη ηθική δικηγόρο, σε μια περιπέτεια περιπλάνησης σε όλες τις ηπείρους. Απελευθερωμένη από τις προκαταλήψεις και τα στεγανά της εποχής της, η Bella αποφασιστικά επιδιώκει να δώσει τη μάχη της για την ισότητα και την ελευθερία.', 150, 'ARw1SrWddUE', 'Yorgos Lanthimos', 'Tony McNamara & Alasdair Gray', 'Emma Stone, Mark Ruffalo, Ramy Youssef, Willem Dafoe'),
(33, 'FERRARI', 'FERRARI', 'frrari.jfif', 'Δράμα', 'Το καλοκαίρι του 1967, ο πρώην οδηγός αγώνων αυτοκινήτων, Έντσο Φεράρι βρίσκεται σε κρίση. Με την εταιρεία του στα πρόθυρα της πτώχευσης και τον γάμο του να βιώνει την τραυματική απώλεια του ενός γιου, ο Φερράρι εναποθέτει την ελπίδα για την σωτηρία τους σε έναν αγώνα δρόμου 1000 μιλίων στην Ιταλία, τον εμβληματικό Mille Miglia.', 130, 'H-DZfcw80-g', 'Michael Mann', 'Troy Kennedy Martin & Brock Yates', 'Penelope Cruz, Adam Driver, Shailene Woodley, Patrick Dempsey, Giuseppe Festinese, Jack OConnell'),
(34, 'Ο ΜΕΛΙΣΣΟΚΟΜΟΣ', 'THE BEEKEEPER', 'melisokomos.jfif', 'ΠΕΡΙΠΕΤΕΙΑ ΔΡΑΣΗΣ', 'Η βίαιη εκστρατεία εκδίκησης ενός άνδρα αποκτά εθνικές διαστάσεις όταν αποκαλύπτεται ότι είναι ένας πρώην πράκτορας μίας πανίσχυρης και μυστικής οργάνωσης, γνωστή ως ‘’Οι Μελισσοκόμοι’’.', 90, 'f0_EOku8sAI', 'David Ayer', 'Kurt Wimmer', 'Jason Statham, Josh Hutcherson, Jeremy Irons, David Witts, Emmy Raver Lampman');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reservations`
--

CREATE TABLE `reservations` (
  `res_id` int(11) NOT NULL,
  `res_date` date NOT NULL,
  `res_seats` int(11) NOT NULL,
  `res_user_id` int(11) NOT NULL,
  `res_show_id` int(11) NOT NULL,
  `res_status` int(11) NOT NULL,
  `res_key` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `reservations`
--

INSERT INTO `reservations` (`res_id`, `res_date`, `res_seats`, `res_user_id`, `res_show_id`, `res_status`, `res_key`) VALUES
(19, '2024-02-26', 4, 1, 1, 1, '11SPJBFP'),
(21, '2024-02-28', 5, 23, 3, 1, '231KPMSJU'),
(25, '2024-02-24', 1, 1, 1, 1, '11OUUIHT'),
(37, '2024-03-15', 1, 1, 11, 0, '111ZPYEBE'),
(38, '2024-02-29', 1, 1, 2, -1, '12LVZOBN'),
(39, '2024-03-13', 2, 23, 11, 0, '2311UIOXEJ'),
(40, '2024-03-26', 2, 4, 17, 0, '417OBQGFD'),
(41, '2024-03-31', 4, 4, 4, 0, '44SNQWPX'),
(42, '2024-03-27', 3, 23, 1, 0, '231IPRFOC'),
(43, '2024-03-29', 1, 23, 11, 1, '2311JLXHUM'),
(44, '2024-03-23', 3, 1, 16, 0, '116ELJLUZ'),
(45, '2024-03-07', 4, 29, 4, 0, '294OGOHLN'),
(46, '2024-03-17', 2, 1, 1, 0, '11MQNSME'),
(47, '2024-03-28', 1, 1, 17, 0, '117XSAAZI'),
(48, '2024-03-26', 3, 4, 15, 0, '415DDHSHG'),
(49, '2024-03-07', 37, 0, 4, -1, '04MLOGZC'),
(50, '2024-03-14', 4, 31, 21, -1, '3121YMXIHF'),
(51, '2024-03-21', 1, 31, 21, 1, '3121AXWPVS'),
(52, '2024-03-26', 1, 1, 17, 0, '117APPOCA'),
(53, '2024-03-19', 1, 1, 17, 0, '117BPWMCB'),
(54, '2024-03-29', 4, 29, 16, 0, '2916CKUIXM'),
(55, '2024-03-18', 3, 1, 15, 0, '115JHXZJE'),
(56, '2024-03-30', 2, 23, 21, 0, '2321QVIYBG'),
(57, '2024-03-19', 1, 1, 17, 0, '117AACIAP');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_type`) VALUES
(1, 'super manager', 'supper@email.com', 'supper', 1),
(2, 'manager', 'manager@email.com', 'manager', 2),
(3, 'controler', 'control@email.com', 'control', 3),
(4, 'ntaina', 'k@ntina', 'user', 4),
(17, 'marianna super manager', 'marianna@otenet.gr', '123456', 1),
(19, 'athina controler', 'athina@1', '1234', 3),
(22, 'tonia', 't@04', '123', 4),
(23, 'mpamphs', 'm@m', '569', 4),
(25, 'marilena', 'm@m1', '779', 4),
(29, 'Αναστασίου Μαριάννα', 'mariannaanastasiou2@gmail.com', '', 4),
(31, 'αθηνα', 'athina@2', '1234', 4);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users_type`
--

CREATE TABLE `users_type` (
  `type_id` int(11) NOT NULL,
  `type_Name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users_type`
--

INSERT INTO `users_type` (`type_id`, `type_Name`) VALUES
(1, 'Super Manager'),
(2, 'Manager'),
(3, 'Ελεγκτης Εισόδου'),
(4, 'Απλός Χρήστης');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `cinema_hall`
--
ALTER TABLE `cinema_hall`
  ADD PRIMARY KEY (`hall_id`);

--
-- Ευρετήρια για πίνακα `cinema_shows`
--
ALTER TABLE `cinema_shows`
  ADD PRIMARY KEY (`show_id`);

--
-- Ευρετήρια για πίνακα `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Ευρετήρια για πίνακα `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`res_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`) USING BTREE;

--
-- Ευρετήρια για πίνακα `users_type`
--
ALTER TABLE `users_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `cinema_hall`
--
ALTER TABLE `cinema_hall`
  MODIFY `hall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `cinema_shows`
--
ALTER TABLE `cinema_shows`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT για πίνακα `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT για πίνακα `reservations`
--
ALTER TABLE `reservations`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT για πίνακα `users_type`
--
ALTER TABLE `users_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
