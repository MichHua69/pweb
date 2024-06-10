<?php 
class status_validasiModel {
    public static function getRelation() {
        global $conn;
        $query = "SELECT * FROM `status_validasi`";
        $result = $conn->query($query);
        
        $statusValidasi = []; 
        while ($row = $result->fetch_assoc()) {
            $statusValidasi[$row['id']] = $row; // Memetakan status validasi dengan indeks 'id'
        }
        return $statusValidasi;
    }
}
?>
