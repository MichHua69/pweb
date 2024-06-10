<?php 

class validasiModel {
    public static function getAll() {
        global $conn;
        $query = "SELECT * FROM `validasi`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public static function getById($id) {
        global $conn;
        $query = "SELECT * FROM `validasi` WHERE `id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    public static function getTotalByIdTempat($id) {
        global $conn;
        $query = "SELECT COUNT(*) AS jumlah FROM `validasi` WHERE `id_tempat_pengambilan` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['jumlah'];
    }
    public static function getByIdTempat($id, $limit, $currentPage) {
        global $conn;

        $offset = ($currentPage - 1) * $limit;
        $query = "SELECT * FROM `validasi` WHERE `id_tempat_pengambilan` = ? LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isi", $id, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public static function create() {
        global $conn;
        $query = "INSERT INTO `validasi` (`tanggal_pengambilan`, `jumlah_pakan`, `id_dinas_peternakan`,`id_tempat_pengambilan`) VALUES (NULL, NULL, NULL, NULL)";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        
        return $conn->insert_id;
    }

    public static function update($data=[]) {
        global $conn;
        extract($data);
        $id_dinas_peternakan = 1;
        $query = "UPDATE `validasi` SET `id_dinas_peternakan`=? WHERE `id`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $id_dinas_peternakan, $id);
        $stmt->execute();


        if (isset($data['tanggal_pengambilan'])) {
            $query = "UPDATE `validasi` SET `tanggal_pengambilan`=? WHERE `id`=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $tanggal_pengambilan, $id);
            $stmt->execute();
        }
        if (isset($data['jumlah_pakan'])) {
            $query = "UPDATE `validasi` SET `jumlah_pakan`=? WHERE `id`=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $jumlah_pakan, $id);
            $stmt->execute();
        }
        if (isset($data['id_tempat_pengambilan'])) {
            $query = "UPDATE `validasi` SET `id_tempat_pengambilan`=? WHERE `id`=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $id_tempat_pengambilan, $id);
            $stmt->execute();
        }
        if (isset($data['surat_validasi'])) {
            
            $query = "UPDATE `validasi` SET `surat_validasi`=? WHERE `id`=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $surat_validasi, $id);
            $stmt->execute();
        }
        return true;
    }
}

?>
