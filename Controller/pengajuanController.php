<?php
include_once 'model/jumlah_populasi_ayamModel.php';
include_once 'model/pengajuanModel.php';
include_once 'model/validasiModel.php';
include_once 'model/konfirmasiModel.php';
include_once 'model/status_validasiModel.php';
include_once 'model/status_konfirmasiModel.php';
include_once 'model/peternakModel.php';
include_once 'model/tempat_pengambilanModel.php';
include 'assets/fpdf/fpdf.php';



class pengajuanController
{
    public static function showPengajuan()
    {   
        $role = $_SESSION['role'];
        $user = $_SESSION['user'];
        $statusValidasi = status_validasiModel::getRelation(); // Mengambil semua status validasi
        $statusKonfirmasi = status_konfirmasiModel::getRelation();
        $peternak = peternakModel::getRelation(); //
        if($role == 3){
            $limit = 5;
            $total_row = pengajuanModel::getTotalByIdPeternak();
            $total_page = ceil($total_row / $limit);
            $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $pengajuan = pengajuanModel::getByIdPeternak($user['id'], $limit, $current_page);
        } else if($role == 2){
            // $pengajuan = pengajuanModel::getById();
            $tempat_pengambilan = tempat_pengambilanModel::getByIdKepala($user['id']);
            $limit = 5;
            $total_row = validasiModel::getTotalByIdTempat($tempat_pengambilan['id']);
            $total_page = ceil($total_row / $limit);
            $current_page = isset($_GET['page'])? intval($_GET['page']) : 1;
            $validasi = validasiModel::getByIdTempat($tempat_pengambilan['id'],$limit,$current_page);
            // var_dump($validasi);
        } else {
            $limit = 5;
            $total_row = pengajuanModel::getTotal();
            $total_page = ceil($total_row / $limit);
            $current_page = isset($_GET['page'])? intval($_GET['page']) : 1;
            $pengajuan = pengajuanModel::getAll($limit,$current_page);
        }
        if (!($role == 2)) {
            foreach ($pengajuan as &$item) {
                // Menambahkan data status validasi ke dalam array pengajuan berdasarkan ID status validasi
                $item['status_validasi'] = $statusValidasi[$item['id_status_validasi']]['status'];
            }
            foreach ($pengajuan as &$item) {
                // Menambahkan data status validasi ke dalam array pengajuan berdasarkan ID status validasi
                $item['peternak'] = $peternak[$item['id_peternak']]['nama'];
            }
            foreach ($pengajuan as &$item) {
                // Menambahkan data status validasi ke dalam array pengajuan berdasarkan ID status validasi
                $item['status_konfirmasi'] = $statusKonfirmasi[$item['id_status_konfirmasi']]['status'];
                // var_dump($item['status_konfirmasi']);
            }
            view('pengajuan',['user' => $user, 'role' => $role, 'pengajuan' => $pengajuan,'total_pages' => $total_page,'current_page' => $current_page]);
        } else {
            // $pengajuan = pengajuanModel::getByIdValidasi($validasi['id']);
            // var_dump($pengajuan);
            foreach ($validasi as &$item) {
                $pengajuan = pengajuanModel::getByIdValidasi($item['id']);
                $item['pengajuan'] = $pengajuan;
                $item['status_validasi'] = $statusValidasi[$item['pengajuan']['id_status_validasi']]['status'];
                
                $item['status_konfirmasi'] = $statusKonfirmasi[$item['pengajuan']['id_status_konfirmasi']]['status']; 
            }
            view('pengajuan',['user' => $user, 'role' => $role, 'validasi' => $validasi ,'total_pages' => $total_page,'current_page' => $current_page]);

        }
    }
    public static function fetchPengajuan() {
        // Misalnya, ambil data pengajuan sesuai kebutuhan (pagination, status, dsb.)
        $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = 5; // Tentukan limit sesuai kebutuhan
        $pengajuan = pengajuanModel::getAll($limit, $current_page); // Anda harus menyesuaikan fungsi ini
    
        echo json_encode($pengajuan);
    }
    
    public static function showTambahPengajuan()
    {   
        $role = $_SESSION['role'];
        $user = $_SESSION['user'];
        $jumlah_populasi = jumlah_populasi_ayamModel::getAll();
        view('tambahpengajuan',['jumlah_populasi'=>$jumlah_populasi, 'user' => $user, 'role' => $role]);
    }
    public static function storeTambahPengajuan()
    {
        $user = $_SESSION['user'];
        $alamat = $_POST['alamat'];
        $jumlah_pakan = $_POST['jumlah_pakan'];
        $jumlah_populasi = $_POST['jumlah_populasi'];
        $jumlah_populasi_ayam = jumlah_populasi_ayamModel::getById(intval($jumlah_populasi));
        $foto_peternakan = $_FILES['foto_peternakan'] ?? null;
        $foto_usaha = $_FILES['foto_usaha'] ?? null;
        

        $_SESSION['alamat'] = $alamat;
        $_SESSION['id_jumlah_populasi_ayam'] = $jumlah_populasi;
        $_SESSION['jumlah_populasi_ayam'] = $jumlah_populasi_ayam['jumlah'];
        $_SESSION['jumlah_pakan'] = $jumlah_pakan;


        if(empty($alamat)) {
            $_SESSION['error']['alamat'] = 'Alamat harus diisi';
        }
        if(empty($jumlah_pakan)) {
            $_SESSION['error']['jumlah_pakan'] = 'Jumlah pakan harus diisi';
        }
        if(empty($jumlah_populasi)) {
            $_SESSION['error']['jumlah_populasi'] = 'Jumlah populasi harus diisi';
        } 
    
        if (!$foto_peternakan || $foto_peternakan['error'] !== UPLOAD_ERR_OK) {
            
        }
        if (!$foto_usaha || $foto_usaha['error'] !== UPLOAD_ERR_OK) {
            
        }
        
        if(isset($_SESSION['error']['alamat']) || isset($_SESSION['error']['jumlah_pakan']) || isset($_SESSION['error']['jumlah_populasi'])) {
            header('Location: ' . urlpath('tambahpengajuan'));
        }
        // // Prepare initial data for insertion
        // $data = [
        //     'alamat' => $alamat,
        //     'jumlah_pakan' => $jumlah_pakan,
        //     'id_jumlah_populasi_ayam' => intval($jumlah_populasi),
        //     'foto_peternakan' => null,
        //     'foto_usaha' => null,
        //     'id_peternak' => $user['id'],
        //     'id_status_validasi' => 1, // Assuming default status
        //     'id_status_konfirmasi' => 1, // Assuming default status
        //     'id_validasi' => null, // Assuming default ID
        //     'id_konfirmasi' => null // Assuming default ID
        // ];

        // $pengajuan_id = pengajuanModel::create($data);
        // $foto_peternakanName = $user['nama'] . '-' . $pengajuan_id . '-foto_peternakan.' . pathinfo($foto_peternakan['name'], PATHINFO_EXTENSION);
        // $foto_usahaName = $user['nama'] . '-' . $pengajuan_id . '-foto_usaha.' . pathinfo($foto_usaha['name'], PATHINFO_EXTENSION);
    
        // // Upload files
        // $foto_peternakanPath = 'assets/pengajuan/foto_peternakan/' . $foto_peternakanName;
        // $foto_usahaPath = 'assets/pengajuan/foto_usaha/' . $foto_usahaName;
        
        // $validasi_id = validasiModel::create();
        // $konfirmasi_id = konfirmasiModel::create();
        // // Update the record with the file paths
        // $updateData = [
        //     'id' => $pengajuan_id,
        //     'foto_peternakan' => $foto_peternakanName,
        //     'foto_usaha' => $foto_usahaName,
        //     'id_validasi' => $validasi_id,
        //     'id_konfirmasi' => $konfirmasi_id
        // ];
        // // var_dump($updateData);
        // $create = pengajuanModel::secondCreate($updateData);
        
        // if (!file_exists('assets/pengajuan/foto_peternakan/')) {
        //     mkdir('assets/pengajuan/foto_peternakan/', 0777, true);
        // }
        // if (!file_exists('assets/pengajuan/foto_usaha/')) {
        //     mkdir('assets/pengajuan/foto_usaha/', 0777, true);
        // }
        // move_uploaded_file($foto_peternakan['tmp_name'], $foto_peternakanPath);
        // move_uploaded_file($foto_usaha['tmp_name'], $foto_usahaPath);
        // header('Location: '.urlpath('pengajuan'));
    }

    public static function showEditPengajuan() 
    {   
        $role = $_SESSION['role'];
        $user = $_SESSION['user'];
        $jumlah_populasi = jumlah_populasi_ayamModel::getAll();
        $jumlah_populasiRelation = jumlah_populasi_ayamModel::getRelation();
        $pengajuan = pengajuanModel::getById(intval($_GET['id']));
        
        $pengajuan['id_jumlah_populasi_ayam'] = $jumlah_populasiRelation[$pengajuan['id_jumlah_populasi_ayam']];
        
        view('editpengajuan',['user'=> $user, 'pengajuan' => $pengajuan, 'role' => $role, 'jumlah_populasi'=>$jumlah_populasi]);
    }
    public static function storeEditPengajuan() 
    {
        
        $user = $_SESSION['user'];
        $pengajuan_id = intval($_GET['id']);
        $alamat = $_POST['alamat'];
        $jumlah_pakan = $_POST['jumlah_pakan'];
        $jumlah_populasi = $_POST['jumlah_populasi'];
        
        // Validate file uploads
        $foto_peternakan = $_FILES['foto_peternakan'] ?? null;
        $foto_usaha = $_FILES['foto_usaha'] ?? null;
    
        $pengajuan = pengajuanModel::getById($pengajuan_id);
        
        $data = [
            'alamat' => $alamat,
            'jumlah_pakan' => $jumlah_pakan,
            'id_jumlah_populasi_ayam' => intval($jumlah_populasi),
            'id' => $pengajuan_id
        ];
        
        // Process foto_peternakan if uploaded
        if ($foto_peternakan && $foto_peternakan['error'] == UPLOAD_ERR_OK) {
            // Define file name
            $foto_peternakanName = $user['nama'] . '-' . $pengajuan_id . '-foto_peternakan.' . pathinfo($foto_peternakan['name'], PATHINFO_EXTENSION);
    
            // Define file path
            $foto_peternakanPath = 'assets/pengajuan/foto_peternakan/' . $foto_peternakanName;
    
            // Delete old file if exists
            if (!empty($pengajuan['foto_peternakan']) && file_exists('assets/pengajuan/foto_peternakan/' .$pengajuan['foto_peternakan'])) {
                unlink('assets/pengajuan/foto_peternakan/' .$pengajuan['foto_peternakan']);
            }
    
            // Move uploaded file to destination
            move_uploaded_file($foto_peternakan['tmp_name'], $foto_peternakanPath);
    
            // Update data array with new file path
            $data['foto_peternakan'] = $foto_peternakanName;
        }
    
        // Process foto_usaha if uploaded
        if ($foto_usaha && $foto_usaha['error'] == UPLOAD_ERR_OK) {
            // Define file name
            
            $foto_usahaName = $user['nama'] . '-' . $pengajuan_id . '-foto_usaha.' . pathinfo($foto_usaha['name'], PATHINFO_EXTENSION);
            
            // Define file path
            $foto_usahaPath = 'assets/pengajuan/foto_usaha/' . $foto_usahaName;
            // Delete old file if exists
            
            if (!empty($pengajuan['foto_surat_usaha']) && file_exists('assets/pengajuan/foto_usaha/'.$pengajuan['foto_surat_usaha'])) {
                unlink('assets/pengajuan/foto_usaha/'.$pengajuan['foto_surat_usaha']);
            }
            // Move uploaded file to destination
            move_uploaded_file($foto_usaha['tmp_name'], $foto_usahaPath);
    
            // Update data array with new file path
            $data['foto_surat_usaha'] = $foto_usahaName;
        }
    
        // Save the updated data to the database
        // var_dump($data);
        pengajuanModel::update($data);
    
        // Redirect to a relevant page, e.g., the pengajuan overview
        header('Location: ' . urlpath('pengajuan'));
        exit();
    }
    
    public static function showDetailPengajuan()
    {
        $role = $_SESSION['role'];
        $user = $_SESSION['user'];
        $jumlah_populasi = jumlah_populasi_ayamModel::getRelation();
        $pengajuan = pengajuanModel::getById(intval($_GET['id']));
        $pengajuan['id_jumlah_populasi_ayam'] = $jumlah_populasi[$pengajuan['id_jumlah_populasi_ayam']]['jumlah'];

        $tempat_pengambilan = tempat_pengambilanModel::getAll();
        view('detailpengajuan',['role' => $role, 'user' => $user, 'pengajuan' => $pengajuan, 'tempat_pengambilan' => $tempat_pengambilan]);
    }

    public static function storeDetailPengajuan() {
        $jumlah_pakan = $_POST['jumlah_pakan'];
        $tempat_pengambilan = $_POST['tempat_pengambilan'];
        $tanggal_pengambilan = $_POST['tanggal_pengambilan'];

        $validasi = validasiModel::getById(intval($_GET['id']));
        if ($_POST['action'] == 'validasi') {
            $data = [
                'jumlah_pakan' => $jumlah_pakan,
                'id_tempat_pengambilan' => intval($tempat_pengambilan),
                'tanggal_pengambilan' => $tanggal_pengambilan,
                'id' => $validasi['id'],
            ];
            
            validasiModel::update($data);
            $data = [
                'id' => intval($_GET['id']),
                'id_status_validasi' => 2,
            ];
        } else {
            $data = [
                'id' => intval($_GET['id']),
                'id_status_validasi' => 3,
            ];
        }
        pengajuanModel::update($data);
        $validasi = validasiModel::getById(intval($_GET['id']));
        $pengajuan = pengajuanModel::getByIdvalidasi($validasi['id']);
        $peternak = peternakModel::getById($pengajuan['id_peternak']);

        $pdf = new FPDF();
        $pdf->AddPage("", "A4");
        $pdf->image('assets/images/validasi.jpg', 0, 0, 210);

        // Tambahkan teks di posisi tertentu
        $pdf->SetFont('Arial', '', 12);

        $x = 70;
        $y = 127;
        $pdf->SetXY($x, $y);
        $pdf->Text($x, $y, $peternak['nama']);

        $x = 52;
        $y = 133.5;
        $pdf->SetXY($x, $y);
        $pdf->Text($x, $y, $validasi['jumlah_pakan'].' kg');

        $x = 63;
        $y = 140;
        $pdf->SetXY($x, $y);
        $pdf->Text($x, $y, $validasi['tanggal_pengambilan']);

        $x = 63;
        $y = 146.2;
        $pdf->SetXY($x, $y);
        $pdf->Text($x, $y, $validasi['tempat_pengambilan']);

        // Tentukan direktori dan nama file
        $directory = 'assets/validasi/surat_validasi/';  // Ganti dengan path direktori yang diinginkan
        $filename = $peternak['nama'].'-'.$validasi['id'].'.pdf';

        // Pastikan direktori sudah ada atau buat jika belum ada
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Simpan PDF ke direktori yang ditentukan
        $pdf->Output($directory . $filename, 'F');
        $data = [
            'id' => intval($_GET['id']),
            'surat_validasi' => $filename
        ];

        validasiModel::update($data);
        header('Location: '.urlpath('pengajuan'));
        exit();

    }

    public static function showKonfirmasi()
    {
        $role = $_SESSION['role'];
        $user = $_SESSION['user'];
            
        $validasi = validasiModel::getById(intval($_GET['id']));
        // var_dump($validasi);

        view('konfirmasi',['role' => $role, 'user' => $user, 'validasi' => $validasi]);
    }

    public static function storeKonfirmasi() {
        $user = $_SESSION['user'];
        $tanggal_pengambilan = $_POST['tanggal_pengambilan'];
        $foto_bukti = $_FILES['foto_bukti'];
        
        $konfirmasi = konfirmasiModel::getById(intval($_GET['id']));
        // var_dump($foto_bukti['name']);

        $foto_buktiName = $user['nama'] . '-' . $konfirmasi['id'] . '-foto_bukti.' . pathinfo($foto_bukti['name'], PATHINFO_EXTENSION);
        $foto_buktiPath = 'assets/konfirmasi/foto_bukti/' . $foto_buktiName;

        move_uploaded_file($foto_bukti['tmp_name'], $foto_buktiPath);

        $data = [
            'id' => $konfirmasi['id'],
            'foto_bukti' => $foto_buktiName,
            'tanggal_pengambilan' => $tanggal_pengambilan,
        ];

        konfirmasiModel::update($data);
        $pengajuan = pengajuanModel::getByIdKonfirmasi($konfirmasi['id']);
        // var_dump($pengajuan);
        $data = [
            'id' => $pengajuan['id'],
            'id_status_konfirmasi' => 2
        ];

        pengajuanModel::update($data);
        header('Location: '.urlpath('pengajuan'));
        exit();
    }

    public static function unduhValidasi() {

        // Dapatkan ID dari parameter query
        // $id = isset($_GET['id']) ? $_GET['id'] : null;
        $validasi = validasiModel::getById(intval($_GET['id']));
        $pengajuan = pengajuanModel::getByIdvalidasi($validasi['id']);
        $peternak = peternakModel::getById($pengajuan['id_peternak']);
        // Tentukan direktori dan nama file berdasarkan ID atau logika lainnya
        $directory = 'assets/validasi/surat_validasi/';  // Ganti dengan path direktori yang diinginkan
        $filename = $peternak['nama'].'-'.$validasi['id'].'.pdf';
        // Path lengkap ke file
        $filePath = $directory . $filename;
        $downloadFilename = 'Surat Validasi.pdf';
        // Periksa apakah file ada
        if (file_exists($filePath)) {
            // Set header untuk mengunduh file
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $downloadFilename . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            flush(); // Flush sistem output buffer
            readfile($filePath);
            exit;
        } else {
            // Tampilkan pesan kesalahan jika file tidak ditemukan
            echo 'File tidak ditemukan.';
        }
        // header('Location: ' .urlpath('pengajuan'));
        // exit();
    }
}
?>