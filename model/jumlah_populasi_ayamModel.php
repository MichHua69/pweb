<?php 
class jumlah_populasi_ayamModel {

    public static function getAll() { 
        global $conn;
        $query = "SELECT * FROM `jumlah_populasi_ayam`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    
    public static function getRelation() { 
        global $conn;
        $query = "SELECT * FROM `jumlah_populasi_ayam`";
        $result = $conn->query($query);
        
        $jumlahPopulasiAyamRelation = []; 
        while ($row = $result->fetch_assoc()) {
            $jumlahPopulasiAyamRelation[$row['id']] = $row; // Memetakan jumlah populasi ayam dengan indeks 'jumlah_populasi_ayam_id'
        }
        return $jumlahPopulasiAyamRelation;
    }

    public static function getById($id) {
        global $conn;
        $query = "SELECT * FROM `jumlah_populasi_ayam` WHERE `id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>