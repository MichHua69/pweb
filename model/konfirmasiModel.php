<?php 
class konfirmasiModel {
    public static function getById($id){
        global $conn;
        $query = "SELECT * FROM `konfirmasi` WHERE `id` = $id";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result;
        
    }
    public static function create() {
        global $conn;
        $query = "INSERT INTO `konfirmasi` (`tanggal_pengambilan`, `foto_bukti`, `id_kepala_kelompok_ternak`) VALUES (NULL, NULL, NULL)";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        // $conn->query($query);
        return $conn->insert_id;
    }

    public static function update($data=[]) {
        global $conn;
        extract($data);
        
        if(isset($data['tanggal_pengambilan'])) {
            $query = "UPDATE `konfirmasi` SET `tanggal_pengambilan` = '$tanggal_pengambilan' WHERE `konfirmasi`.`id` = $id";
            $stmt = $conn->prepare($query);
            $stmt->execute();
        }
        if(isset($data['foto_bukti'])) {
            $query = "UPDATE `konfirmasi` SET `foto_bukti` = '$foto_bukti' WHERE `konfirmasi`.`id` = $id";
            $stmt = $conn->prepare($query);
            $stmt->execute();
        }
    }
}
?>