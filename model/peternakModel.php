<?php

class peternakModel {
    public static function getAll()
    {
        global $conn;
        $query = "SELECT * FROM `peternak`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public static function getById($id) {
        global $conn;
        $query = "SELECT * FROM `peternak` WHERE `id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
    public static function getRelation() {
        global $conn;
        $query = "SELECT * FROM `peternak`";
        $result = $conn->query($query);
        
        $peternak = []; 
        while ($row = $result->fetch_assoc()) {
            $peternak[$row['id']] = $row; // Memetakan status validasi dengan indeks 'id'
        }
        return $peternak;
    }

    public static function getUser($email) {
        global $conn;
        $query = "SELECT * FROM `peternak` WHERE `email` =?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }
    public static function create($data=[]) {
        global $conn;
        $nama = $data['nama'];
        $email = $data['email'];
        $nik = intval($data['nik']);
        $telepon = intval($data['telepon']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO `peternak` (`nama`, `email`, `nik`, `no_telepon`, `password`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $nama, $email, $nik, $telepon, $password);
        $stmt->execute();
        
        return true;
    }

    public static function update($data=[]) {
        global $conn;
        extract($data);
        if (isset($data['nama'])) {
            $query = "UPDATE `peternak` SET `nama` = ? WHERE `id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $data['nama'], $data['id']);
            $stmt->execute();
        }

        if (isset($data['email'])) {
            $query = "UPDATE `peternak` SET `email` = ? WHERE `id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $data['email'], $data['id']);
            $stmt->execute();
        }

        if (isset($data['no_telepon'])) {
            $query = "UPDATE `peternak` SET `no_telepon` = ? WHERE `id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $data['no_telepon'], $data['id']);
            $stmt->execute();
        }
    }
}
?>