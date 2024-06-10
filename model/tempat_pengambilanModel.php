<?php 
class tempat_pengambilanModel {
    public static function getAll() {
        global $conn;
        $query = "SELECT * FROM `tempat_pengambilan`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public static function getByIdKepala($id) { 
        global $conn;
        $query = "SELECT * FROM `tempat_pengambilan` WHERE `id_kepala_kelompok_ternak` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
}
?>