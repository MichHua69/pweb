        CREATE TABLE dinas_peternakan (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            nama VARCHAR(255),
            no_telepon BIGINT,
            email VARCHAR(255),
            password VARCHAR(255)
        );

        CREATE TABLE peternak (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            NIK BIGINT,
            nama VARCHAR(255),
            no_telepon BIGINT,
            email VARCHAR(255),
            password VARCHAR(255)
        );

        CREATE TABLE kepala_kelompok_ternak (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            NIK BIGINT,
            nama VARCHAR(255),
            no_telepon BIGINT,
            email VARCHAR(255),
            wilayah ENUM(
            '1 (Balung, Wuluhan, Jombang, Kencong, Rambipuji)',
            '2 (Mumbulsari, Ambulu, Tempurejo, Jenggawah Ajung)',
            '3 (Tanggul, Bangsalsari, Sumberbaru)',
            '4 (Sukowono, Jelbuk, Kalisat, Ledokombo, Sumberjambe, Arjasa, Silo)',
            '5 (Puger)',
            '6 (Patrang, Sukorambi, Mangli, Kaliwates, Arjasa)',
            '7 (Sumbersari, Mayang, Pakusari, Tempurejo, Mumbulsari)'), -- adjust ENUM values as needed
            no_surat VARCHAR(255),
            password VARCHAR(255)
        );

        CREATE TABLE berita (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            tanggal DATE,
            judul VARCHAR(255),
            thumbnail VARCHAR(255),
            deskripsi TEXT,
            id_dinas_peternakan INTEGER,
            FOREIGN KEY (id_dinas_peternakan) REFERENCES dinas_peternakan(id)
        );

        CREATE TABLE status_validasi (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            status VARCHAR(255)
        );

        CREATE TABLE status_konfirmasi (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            status VARCHAR(255)
        );

        CREATE TABLE jumlah_populasi_ayam (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            jumlah VARCHAR(255)
        );

        CREATE TABLE tempat_pengambilan (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            nama VARCHAR(255),
            id_kepala_kelompok_ternak INTEGER,
            FOREIGN KEY (id_kepala_kelompok_ternak) REFERENCES kepala_kelompok_ternak(id)
        );

        CREATE TABLE validasi (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            tanggal_pengambilan DATE,
            jumlah_pakan INTEGER,
            surat_validasi VARCHAR(255),
            id_dinas_peternakan INTEGER,
            id_tempat_pengambilan INTEGER,
            FOREIGN KEY (id_dinas_peternakan) REFERENCES dinas_peternakan(id),
            FOREIGN KEY (id_tempat_pengambilan) REFERENCES tempat_pengambilan(id)
        );

        CREATE TABLE konfirmasi (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            tanggal_pengambilan DATE,
            foto_bukti VARCHAR(255),
            id_kepala_kelompok_ternak INTEGER,
            FOREIGN KEY (id_kepala_kelompok_ternak) REFERENCES kepala_kelompok_ternak(id)
        );

        CREATE TABLE pengajuan (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            alamat VARCHAR(255),
            foto_peternakan VARCHAR(255),
            foto_surat_usaha VARCHAR(255),
            jumlah_pakan INTEGER,
            id_jumlah_populasi_ayam INTEGER,
            id_peternak INTEGER,
            id_status_validasi INTEGER,
            id_status_konfirmasi INTEGER,
            id_validasi INTEGER,
            id_konfirmasi INTEGER,
            FOREIGN KEY (id_jumlah_populasi_ayam) REFERENCES jumlah_populasi_ayam(id),
            FOREIGN KEY (id_peternak) REFERENCES peternak(id),
            FOREIGN KEY (id_status_validasi) REFERENCES status_validasi(id),
            FOREIGN KEY (id_status_konfirmasi) REFERENCES status_konfirmasi(id),
            FOREIGN KEY (id_validasi) REFERENCES validasi(id),
            FOREIGN KEY (id_konfirmasi) REFERENCES konfirmasi(id)
        );

        INSERT INTO `dinas_peternakan` (`id`, `nama`, `no_telepon`, `email`, `password`) VALUES
        (1, 'Dinas Peternakan Kabupaten Jember', 331337275, 'Disnak@jemberkab.go.id', '$2y$10$ePd1hHGoh0xIc5oGnhdBc.TVZXG62qiHWBWym1MjZ3jgamNqtdpLO');

        INSERT INTO `jumlah_populasi_ayam` (`id`, `jumlah`) VALUES
        (1, '1000 - 2000'),
        (2, '2000 - 3000');

        INSERT INTO `kepala_kelompok_ternak` (`id`, `NIK`, `nama`, `no_telepon`, `email`, `wilayah`, `no_surat`, `password`) VALUES
        (1, 35200411121314, 'Rassyid', 6289987654321, 'rassyid@gmail.com', '1 (Balung, Wuluhan, Jombang, Kencong, Rambipuji)', '1111129876', '$2y$10$IxIaio1TqOWKUcvmbedQC.VyNudokX5j3ABFSUSeZulRFmoWCPImC'),
        (2, 35200412312312, 'Sunarji', 6285192837465, 'sunarjie567@gmail.com', '2 (Mumbulsari, Ambulu, Tempurejo, Jenggawah Ajung)', '1111256789', '$2y$10$zbnHhhE2hsuFq421hJOyzOqNKuKouGrcyFJJPlvhKHFFPt1fct2fK');
        -- (3, 35200498765432, 'Suhadi', 6285234567891, 'suhadi8900@gmail.com', '3 (Tanggul, Bangsalsari, Sumberbaru)', '1111456789', '$2y$10$u5zQTpj5gqDoT4DqDBSKyO04QnH/P79/uVy8nEUxEeUSC9t9OCEkW'),
        -- (4, 3520045566778, 'Yopie Aditya Prima', 6289562789101, 'yopieaditya@gmail.com', '4 (Sukowono, Jelbuk, Kalisat, Ledokombo, Sumberjambe, Arjasa, Silo)', '1111678910', '$2y$10$KIvMNLzefVmazgPaDa9ore4RCBjzYQ1cmQkKyURJz5s/lyRTSawhS'),
        -- (5, 3520045566896, 'Gatot', 6287809845432, 'gatot678@gmail.com', '5 (Puger)', '1111678999', '$2y$10$H4DCUVkI4BcYRQY72ZM91OL47KnPbr920L1vF2I4oEIMErtuecPVm'),
        -- (6, 3520045509344, 'Toha', 6287612345690, 'toha1111@gmail.com', '6 (Patrang, Sukorambi, Mangli, Kaliwates, Arjasa)', '1111678666', '$2y$10$KZ/ymc.9BJc6PCarE6vH9OIHUlgpPFY2S0OLPFUlH71nKAgIXwL6S'),
        -- (7, 3520045525689, 'Arifandi', 6234678945655, 'arifandi666@gmail.com', '7 (Sumbersari, Mayang, Pakusari, Tempurejo, Mumbulsari)', '111167888', '$2y$10$nUGr/QWN2lEnDu.2SwBi.ual8RCowkdzMEWeG0C7EQ7Yl25C4Ib2O');

        INSERT INTO tempat_pengambilan (nama, id_kepala_kelompok_ternak) VALUES 
        ('Jalan Mangga No. 10, Desa Ampel', 1),
        ('Jalan Raya Jenggawah No. 25, Desa Jenggawah', 2),
        ('Jl. Diponegoro No.123, Desa Kramat Sukoharjo', null),
        ('Jl. Raya Sumberjambe No.45, Desa Sumberpakem', null),
        ('Jl. Ampel No. 10, Desa Ampel', null),
        ('Jl. Sukorambi No.78, Desa Sukorambi', null),
        ('Jl. Raya Mayang No.32, Desa Tegalwaru', null);

        INSERT INTO `peternak` (`id`, `NIK`, `nama`, `no_telepon`, `email`, `password`) VALUES
        (1, 35200410111213, 'Hasanuddin', 629123456101, 'hasanuddin7@gmail.com', '$2y$10$PDXHxLNHIkqbcn.2nGVqa.y9K6BndVSDcxhzc41oP8UU71YB5GOia');

        INSERT INTO `status_konfirmasi` (`id`, `status`) VALUES
        (1, 'Belum Dikonfirmasi'),
        (2, 'Telah Di Konfirmasi');

        INSERT INTO `status_validasi` (`id`, `status`) VALUES
        (1, 'Sedang Di Proses'),
        (2, 'Telah Divalidasi'),
        (3, 'Di Tolak');

        INSERT INTO `konfirmasi` (`id`, `tanggal_pengambilan`, `foto_bukti`, `id_kepala_kelompok_ternak`) VALUES
        (1, NULL, NULL, NULL),
        (2, NULL, NULL, NULL);

        INSERT INTO `validasi` (`id`, `tanggal_pengambilan`, `jumlah_pakan`, `id_dinas_peternakan`, `id_tempat_pengambilan`) VALUES
        (1, NULL, NULL, NULL, NULL),
        (2, NULL, NULL, NULL, NULL);

        INSERT INTO `pengajuan` ( `alamat`, `foto_peternakan`, `foto_surat_usaha`, `jumlah_pakan`, `id_jumlah_populasi_ayam`, `id_peternak`, `id_status_validasi`, `id_status_konfirmasi`, `id_validasi`, `id_konfirmasi`) VALUES
        ( 'Jember', 'Hasanuddin-1-foto_peternakan.png', 'Hasanuddin-1-foto_usaha.png', 21, 1, 1, 1, 1, 1, 1),
        ( 'tes', 'Hasanuddin-2-foto_peternakan.png', 'Hasanuddin-2-foto_usaha.jpeg', 33, 2, 1, 1, 1, 2, 2);


        INSERT INTO berita (tanggal, judul, thumbnail, deskripsi, id_dinas_peternakan) VALUES
        ('2024-06-01', 'Cara Memulai Peternakan Ayam', 'thumbnail1.jpg', '<p>Memulai peternakan ayam bisa menjadi usaha yang menguntungkan jika dilakukan dengan benar. Langkah pertama yang perlu dilakukan adalah memilih lokasi yang strategis dan jauh dari keramaian untuk menghindari gangguan terhadap ayam. Selain itu, persiapkan kandang dengan ventilasi yang baik untuk memastikan ayam mendapatkan sirkulasi udara yang cukup. Pakan yang diberikan juga harus berkualitas tinggi agar ayam tumbuh dengan sehat dan optimal.</p><p>Langkah berikutnya adalah memilih bibit ayam yang berkualitas. Pastikan Anda membeli bibit dari sumber yang terpercaya untuk menghindari risiko penyakit. Setelah bibit ayam tiba, lakukan karantina selama beberapa hari untuk memastikan mereka bebas dari penyakit. Berikan vaksinasi sesuai dengan jadwal yang telah ditentukan untuk melindungi ayam dari berbagai penyakit.</p><p>Manajemen harian yang baik juga penting untuk keberhasilan peternakan ayam. Selalu monitor kesehatan ayam dan segera tangani jika ada yang menunjukkan gejala penyakit. Jaga kebersihan kandang dan lingkungan sekitar untuk mencegah penyebaran penyakit. Dengan perencanaan dan pengelolaan yang baik, peternakan ayam dapat menjadi usaha yang menguntungkan dan berkelanjutan.</p>', 1),
        ('2024-06-02', 'Pentingnya Vaksinasi Ayam', 'thumbnail2.jpg', '<p>Vaksinasi ayam adalah langkah krusial dalam menjaga kesehatan dan produktivitas peternakan ayam. Vaksinasi membantu mencegah berbagai penyakit yang dapat menyerang ayam, seperti Newcastle Disease, Infectious Bronchitis, dan Gumboro. Selain itu, vaksinasi juga berfungsi untuk meningkatkan kekebalan tubuh ayam terhadap penyakit tertentu, sehingga mengurangi risiko kematian dan meningkatkan hasil produksi.</p><p>Peternak harus mengikuti jadwal vaksinasi yang dianjurkan oleh dokter hewan agar ayam tetap sehat. Pastikan vaksin yang digunakan adalah vaksin yang telah teruji dan direkomendasikan oleh pihak berwenang. Selain itu, teknik vaksinasi yang tepat juga penting untuk memastikan vaksin bekerja efektif. Pelatihan tentang cara melakukan vaksinasi yang benar bisa sangat bermanfaat bagi peternak.</p><p>Penting juga untuk mengawasi ayam setelah vaksinasi untuk memastikan tidak ada efek samping yang merugikan. Jika ada reaksi negatif, segera konsultasikan dengan dokter hewan. Dengan vaksinasi yang tepat dan pengelolaan yang baik, peternak dapat menjaga kesehatan ayam dan memastikan produksi yang optimal.</p>', 1),
        ('2024-06-03', 'Jenis Pakan Ayam Terbaik', 'thumbnail3.jpg', '<p>Pakan merupakan faktor utama yang menentukan pertumbuhan dan kesehatan ayam. Ada berbagai jenis pakan yang dapat diberikan kepada ayam, tergantung pada tujuan pemeliharaan. Untuk ayam pedaging, pakan dengan kandungan protein tinggi sangat dianjurkan untuk mempercepat pertumbuhan. Sementara itu, ayam petelur membutuhkan pakan yang kaya akan kalsium untuk memperkuat cangkang telur.</p><p>Peternak juga bisa membuat pakan sendiri dengan bahan-bahan alami seperti jagung, kedelai, dan dedak padi, yang dicampur dengan suplemen vitamin dan mineral. Membuat pakan sendiri bisa menghemat biaya dan memastikan kualitas pakan yang diberikan kepada ayam. Selain itu, variasi pakan juga bisa diberikan untuk menjaga nafsu makan ayam dan mencegah kebosanan.</p><p>Pemberian pakan yang seimbang dan berkualitas tinggi sangat penting untuk kesehatan dan produktivitas ayam. Pastikan ayam mendapatkan cukup air bersih setiap hari untuk mencegah dehidrasi. Dengan manajemen pakan yang baik, peternak dapat meningkatkan hasil produksi dan menjaga kesehatan ayam.</p>', 1),
        ('2024-06-04', 'Tips Meningkatkan Produksi Telur', 'thumbnail4.jpg', '<p>Meningkatkan produksi telur tidak hanya bergantung pada pakan yang diberikan, tetapi juga pada manajemen pemeliharaan yang baik. Ayam petelur membutuhkan lingkungan yang nyaman dan minim stres untuk dapat bertelur secara optimal. Suhu kandang harus dijaga agar tidak terlalu panas atau terlalu dingin. Selain itu, pemberian pakan yang seimbang dan air minum yang bersih juga sangat penting.</p><p>Pencahayaan yang cukup di kandang, sekitar 16 jam per hari, dapat merangsang ayam untuk bertelur lebih banyak. Menggunakan lampu tambahan pada malam hari bisa menjadi solusi untuk memastikan ayam mendapatkan pencahayaan yang cukup. Selain itu, kebersihan kandang harus selalu dijaga untuk mencegah penyakit yang dapat mengurangi produksi telur.</p><p>Memastikan ayam bebas dari stres juga penting untuk produksi telur yang optimal. Hindari suara bising dan gangguan lain yang dapat menyebabkan stres pada ayam. Dengan manajemen yang baik dan perhatian terhadap detail, peternak dapat meningkatkan produksi telur dan mendapatkan hasil yang lebih baik.</p>', 1),
        ('2024-06-05', 'Mengatasi Penyakit Pada Ayam', 'thumbnail5.jpg', '<p>Penyakit merupakan tantangan besar dalam peternakan ayam. Beberapa penyakit yang umum menyerang ayam antara lain Newcastle Disease, Avian Influenza, dan Coccidiosis. Untuk mengatasi penyakit, pencegahan adalah langkah terbaik. Vaksinasi teratur dan menjaga kebersihan kandang dapat membantu mencegah penyebaran penyakit.</p><p>Namun, jika ayam sudah terinfeksi, segera pisahkan ayam yang sakit dari yang sehat dan berikan pengobatan sesuai anjuran dokter hewan. Penggunaan obat yang tepat dan dosis yang sesuai sangat penting untuk mengatasi penyakit. Jangan lupa untuk selalu mencatat setiap kejadian penyakit dan tindakan yang diambil sebagai referensi untuk masa depan.</p><p>Selain itu, meningkatkan kekebalan tubuh ayam melalui pakan yang bergizi dan suplemen juga bisa membantu mencegah penyakit. Selalu konsultasikan dengan dokter hewan untuk mendapatkan saran terbaik tentang pencegahan dan pengobatan penyakit. Dengan tindakan yang tepat, peternak dapat mengurangi risiko penyakit dan menjaga produktivitas ayam.</p>', 1),
        ('2024-06-06', 'Manajemen Kandang Ayam yang Efisien', 'thumbnail6.jpg', '<p>Manajemen kandang yang efisien sangat penting dalam peternakan ayam. Kandang harus memiliki ventilasi yang baik untuk menghindari penumpukan amonia dari kotoran ayam. Selain itu, kebersihan kandang harus selalu dijaga dengan membersihkan tempat pakan dan minum secara rutin.</p><p>Penggunaan alas kandang yang tepat juga dapat membantu menyerap kotoran dan menjaga kebersihan kandang. Selain itu, kontrol suhu dan kelembaban dalam kandang harus diperhatikan untuk menciptakan lingkungan yang nyaman bagi ayam. Pengaturan suhu yang baik dapat mencegah stres panas dan dingin pada ayam.</p><p>Perawatan rutin dan pemeliharaan kandang yang baik akan membantu menjaga kesehatan ayam dan meningkatkan produktivitas. Selalu periksa kondisi kandang secara berkala untuk memastikan tidak ada kerusakan yang dapat membahayakan ayam. Dengan manajemen kandang yang efisien, peternak dapat mencapai hasil yang optimal dalam pemeliharaan ayam.</p>', 1),
        ('2024-06-07', 'Keuntungan Peternakan Ayam Organik', 'thumbnail7.jpg', '<p>Peternakan ayam organik semakin populer karena dianggap lebih sehat dan ramah lingkungan. Ayam organik dipelihara tanpa menggunakan antibiotik atau bahan kimia sintetis, dan diberi pakan organik yang bebas dari pestisida. Meskipun biaya produksi peternakan organik lebih tinggi, harga jual ayam organik juga lebih tinggi, sehingga bisa menjadi usaha yang menguntungkan.</p><p>Selain itu, peternakan ayam organik juga lebih berkelanjutan karena mengurangi dampak negatif terhadap lingkungan. Ayam yang dipelihara secara organik biasanya memiliki kualitas daging dan telur yang lebih baik, karena tidak terpapar bahan kimia berbahaya. Konsumen yang peduli dengan kesehatan dan lingkungan lebih cenderung memilih produk organik.</p><p>Dengan permintaan pasar yang terus meningkat, peternakan ayam organik memiliki prospek yang cerah. Peternak harus memahami standar dan sertifikasi organik untuk memastikan produk mereka memenuhi kriteria yang ditetapkan. Dengan komitmen terhadap praktik organik, peternak dapat meraih keuntungan yang lebih besar dan berkontribusi pada kelestarian lingkungan.</p>', 1),
        ('2024-06-08', 'Teknik Pemuliaan Ayam Unggul', 'thumbnail8.jpg', '<p>Pemuliaan ayam unggul bertujuan untuk menghasilkan keturunan ayam yang memiliki kualitas lebih baik, baik dari segi produktivitas maupun ketahanan terhadap penyakit. Proses pemuliaan melibatkan seleksi ayam dengan sifat-sifat unggul untuk dijadikan indukan. Peternak perlu memahami genetika dasar dan teknik seleksi untuk memilih ayam dengan sifat-sifat yang diinginkan.</p><p>Selain itu, rekayasa genetik juga dapat digunakan untuk meningkatkan kualitas ayam, meskipun masih kontroversial dalam praktiknya. Penggunaan teknologi modern dalam pemuliaan ayam dapat mempercepat proses seleksi dan meningkatkan hasil yang diinginkan. Namun, peternak harus tetap memperhatikan kesejahteraan hewan dan aspek etika dalam proses pemuliaan.</p><p>Pemuliaan yang baik dapat menghasilkan ayam dengan pertumbuhan yang cepat, produktivitas yang tinggi, dan ketahanan terhadap penyakit. Dengan teknik pemuliaan yang tepat, peternak dapat meningkatkan efisiensi dan keuntungan dari peternakan ayam mereka.</p>', 1),
        ('2024-06-09', 'Pemasaran Hasil Peternakan Ayam', 'thumbnail9.jpg', '<p>Pemasaran hasil peternakan ayam merupakan langkah penting untuk memastikan produk sampai ke konsumen dengan harga yang menguntungkan. Peternak perlu memiliki strategi pemasaran yang efektif, seperti menjalin kemitraan dengan pengecer atau menjual langsung ke konsumen melalui pasar atau toko online.</p><p>Branding dan packaging yang menarik juga dapat meningkatkan daya tarik produk di mata konsumen. Selain itu, menjaga kualitas produk dengan penyimpanan yang baik juga sangat penting dalam pemasaran. Pengemasan yang baik tidak hanya melindungi produk tetapi juga memperpanjang masa simpannya.</p><p>Pemanfaatan media sosial dan platform digital lainnya dapat membantu peternak menjangkau lebih banyak konsumen. Dengan strategi pemasaran yang tepat, peternak dapat meningkatkan penjualan dan mendapatkan keuntungan yang lebih besar.</p>', 1),
        ('2024-06-10', 'Pengelolaan Limbah Peternakan Ayam', 'thumbnail10.jpg', '<p>Pengelolaan limbah peternakan ayam adalah aspek penting dalam menjaga lingkungan tetap bersih dan sehat. Limbah ayam, seperti kotoran, bulu, dan sisa pakan, dapat menjadi sumber polusi jika tidak dikelola dengan baik. Salah satu cara mengelola limbah adalah dengan mendaur ulang kotoran ayam menjadi pupuk organik yang dapat digunakan untuk pertanian.</p><p>Selain itu, instalasi biogas juga bisa menjadi solusi untuk mengolah limbah menjadi energi terbarukan. Dengan pengelolaan yang tepat, limbah peternakan ayam dapat dimanfaatkan secara maksimal dan mengurangi dampak negatif terhadap lingkungan. Teknologi biogas tidak hanya membantu mengurangi limbah tetapi juga menyediakan sumber energi yang dapat digunakan kembali.</p><p>Dengan memanfaatkan limbah secara efisien, peternak dapat berkontribusi pada kelestarian lingkungan dan mendapatkan keuntungan tambahan. Pelatihan dan edukasi tentang pengelolaan limbah yang efektif sangat penting untuk memastikan praktik ini diterapkan dengan benar. Pengelolaan limbah yang baik akan memberikan manfaat jangka panjang bagi peternak dan lingkungan sekitar.</p>', 1);

