<?php

class pengajuanModel {
    public static function getAll($limit,$current_page) {
        global $conn;
        $offset = ($current_page - 1) * $limit;
        $query = "SELECT * FROM `pengajuan` ORDER BY `id_status_validasi` ASC, `id` DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public static function getTotal() {
        global $conn;
        $query = "SELECT COUNT(*) as total FROM `pengajuan`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
    public static function getById($id) {
        global $conn;
        $query = "SELECT * FROM `pengajuan` WHERE id =?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
    public static function getByIdPeternak($id, $limit, $current_page) {
        global $conn;
        
        $offset = ($current_page - 1) * $limit;
        $query = "SELECT * FROM `pengajuan` WHERE id_peternak = ? ORDER BY id DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $id, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    public static function getByIdValidasi($id) {
        global $conn;
        $query = "SELECT * FROM `pengajuan` WHERE id_validasi = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public static function getByIdKonfirmasi($id) {
        global $conn;
        $query = "SELECT * FROM `pengajuan` WHERE id_konfirmasi = ? ORDER BY id DESC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public static function create($data=[]) {
        global $conn;
        extract($data);
        $query = "INSERT INTO `pengajuan` (`alamat`, `jumlah_pakan`, `id_jumlah_populasi_ayam`, `foto_peternakan`, `foto_surat_usaha`, `id_peternak`, `id_status_validasi`, `id_status_konfirmasi`, `id_validasi`, `id_konfirmasi`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssss", $alamat, $jumlah_pakan, $id_jumlah_populasi_ayam, $foto_peternakan, $foto_usaha, $id_peternak, $id_status_validasi, $id_status_konfirmasi, $id_validasi, $id_konfirmasi);
        $stmt->execute();
        
        return $conn->insert_id;
    }

    public static function secondCreate($data=[]) {
        global $conn;
        extract($data);
        $query = "UPDATE `pengajuan` SET `foto_peternakan`=?, `foto_surat_usaha`=?, `id_validasi`=?, `id_konfirmasi`=? WHERE `id`=?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $foto_peternakan, $foto_usaha, $id_validasi, $id_konfirmasi, $id);
        $stmt->execute();
        
    }

    public static function update($data = []) {
    global $conn;

    extract($data);

    if (isset($data['alamat'])) {
        $query = "UPDATE `pengajuan` SET `alamat`=? WHERE `id`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $alamat, $id);
        $stmt->execute();
    } 
    if (isset($data['jumlah_pakan'])) {
        $query = "UPDATE `pengajuan` SET `jumlah_pakan`=? WHERE `id`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $jumlah_pakan, $id);
        $stmt->execute();
    } 
    if (isset($data['id_jumlah_populasi_ayam'])) {
        $query = "UPDATE `pengajuan` SET `id_jumlah_populasi_ayam`=? WHERE `id`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $id_jumlah_populasi_ayam, $id);
        $stmt->execute();
    }

    if (isset($data['foto_surat_usaha'])) {
        $query = "UPDATE `pengajuan` SET `foto_surat_usaha`=? WHERE `id`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $foto_surat_usaha, $id);
        $stmt->execute();
    }

    if (isset($data['id_status_validasi'])) {
        $query = "UPDATE `pengajuan` SET `id_status_validasi`=? WHERE `id`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $id_status_validasi, $id);
        $stmt->execute();
    }
    if (isset($data['id_status_konfirmasi'])) {
        $query = "UPDATE `pengajuan` SET `id_status_konfirmasi`=? WHERE `id`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $id_status_konfirmasi, $id);
        $stmt->execute();
    }

    return true;
    }

    public static function getTotalByIdPeternak() {
        global $conn;
        $query = "SELECT COUNT(*) as total FROM `pengajuan`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
}
?>