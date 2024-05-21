<?php

include_once 'config/conn.php';

class user_model {
    static function index() {
        global $conn;
        $rowsPerPage = 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $rowsPerPage;
    
        $stmt = $conn->prepare("SELECT * FROM `users` LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $rowsPerPage);
        $stmt->execute();
        $result = $stmt->get_result();
        // Mengambil semua baris hasil dan menyimpannya dalam array
        $rows = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        } else {
            echo "Tidak ada data yang ditemukan.";
        }

        // Menyimpan semua data yang diperlukan dalam array dan mengembalikannya
        $data = [
            'rowPerPage' => $rowsPerPage,
            'page' => $page,
            'offset' => $offset,
            'result' => $rows, // Menggunakan array baris yang sudah diambil
        ];
        return $data;
    }
    

    static function show() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM `users`");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    static function create($username, $password, $role) {
        global $conn;
        $conn->begin_transaction(); // Mulai transaksi

        try {
            // Lakukan query INSERT untuk tabel users
            $stmt = $conn->prepare("INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $username, $password, $role);
            $stmt->execute();
            $userId = $stmt->insert_id; // Dapatkan ID pengguna yang baru dibuat
            $stmt->close();

            // Commit transaksi jika sukses
            $conn->commit();
            
            // Kembalikan ID pengguna yang baru dibuat
            return $userId;
        } catch (Exception $e) {
            // Rollback transaksi jika ada kesalahan
            $conn->rollback();
            error_log('Error: ' . $e->getMessage()); // Log pesan kesalahan
            
            // Kembalikan false untuk menandakan kegagalan
            return false;
        }
    }

    static function delete($user_id) {
        global $conn;
        $conn->begin_transaction();

        try {
            // Delete the contact entry
            $deleteStmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
            $deleteStmt->bind_param("i", $user_id);
            $deleteStmt->execute();
            $deleteStmt->close();

            // Commit the transaction
            $conn->commit();
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $conn->rollback();
            error_log('Error: ' . $e->getMessage());  // Log error
        }
    }
    
    public static function requireLogin() {
        session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            // Redirect to login page or display access denied message
            header("Location: login");
            exit();
        }
    }

    static function totalQuery(){
        $totalQuery = "SELECT COUNT(user_id) AS total FROM users";
        return $totalQuery;
    }

    public static function getUserByUsername($username) {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user;
    }

    public static function getUserById($user_id) {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user;
    }
}
