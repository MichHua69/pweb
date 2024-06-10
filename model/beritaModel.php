<?php
class beritaModel {
    public static function getAll() {
        global $conn;
        $query = "SELECT * FROM `berita`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public static function getById($id) {
        global $conn;
        $query = "SELECT * FROM `berita` WHERE `id` = $id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
    public static function getTotal() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) AS total_rows FROM `berita`");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $total_rows = $row['total_rows'];
        return $total_rows;
    }

    public static function getBerita($page) {
        global $conn;
        $limit = 6;
        $offset = ($page - 1) * $limit;
        $stmt = $conn->prepare("SELECT * FROM `berita` ORDER BY id DESC LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Mengambil setiap baris sebagai objek
        $berita_objects = [];
        while ($row = $result->fetch_assoc()) {
            $berita_objects[] = $row;
        }
        
        return $berita_objects;
        
    }

    public static function create($data=[]) {
        global $conn;
        extract($data);
        $query = "INSERT INTO `berita` (`judul`, `deskripsi`, `tanggal`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $judul, $deskripsi, $tanggal);
        $stmt->execute();
        $stmt->store_result();
        return $conn->insert_id;
    }

    public static function update($data=[]) {
        global $conn;
        extract($data);
        if(isset($data['judul'])) {
            $query = "UPDATE `berita` SET `judul` = ? WHERE `berita`.`id` = ?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $judul, $id);
            $stmt->execute();
        }
        if(isset($data['deskripsi'])) {
            $query = "UPDATE `berita` SET `deskripsi` = ? WHERE `berita`.`id` = ?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $deskripsi, $id);
            $stmt->execute();
        }
        if(isset($data['thumbnail'])) {
            $query = "UPDATE `berita` SET `thumbnail` = ? WHERE `berita`.`id` = ?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $thumbnail, $id);
            $stmt->execute();
        }
    }
}
?>