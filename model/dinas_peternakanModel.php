<?php

class dinas_peternakanModel {
    public static function getAll()
    {
        global $conn;
        $query = "SELECT * FROM `dinas_peternakan`";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public static function getUser($email)
    {
        global $conn;
        $query = "SELECT * FROM `dinas_peternakan` WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    public static function update($data=[]) {
        global $conn;
        extract($data);
        if (isset($data['nama'])) {
            $query = "UPDATE `dinas_peternakan` SET `nama` = ? WHERE `id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $data['nama'], $data['id']);
            $stmt->execute();

        }

        if (isset($data['email'])) {
            $query = "UPDATE `dinas_peternakan` SET `email` = ? WHERE `id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $data['email'], $data['id']);
            $stmt->execute();
        }

        if (isset($data['no_telepon'])) {  
            $query = "UPDATE `dinas_peternakan` SET `no_telepon` = ? WHERE `id` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $data['no_telepon'], $data['id']);
            $stmt->execute();
        }
    }
}
?>