<?php
class status_konfirmasiModel {
    public static function getRelation() {
        global $conn;

        $query = "SELECT * FROM `status_konfirmasi`";
        $result = $conn->query($query);

        $statusKonfirmasi = [];
        while ($row = $result->fetch_assoc()) {
            $statusKonfirmasi[$row['id']] = $row;
        }

        return $statusKonfirmasi;
    }
}
?>