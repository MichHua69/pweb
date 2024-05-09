<?php

include_once 'config/conn.php';

class user_model {
    
    
    static function index() {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->get_result();

        // Pagination
        $rowsPerPage = 10;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $rowsPerPage;
    
        $totalQuery = "SELECT COUNT(user_id) AS total FROM users";
        $totalResult = $conn->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalPages = ceil($totalRow['total'] / $rowsPerPage);

        $stmt = $conn->prepare("SELECT * FROM `users` LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $rowsPerPage);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Mengembalikan array yang berisi semua nilai yang ingin Anda kembalikan
        return array(
            'result' => $result,
            'rowsPerPage' => $rowsPerPage,
            'page' => $page,
            // 'offset' => $offset,
            'totalResult' => $totalResult,
            'totalRow' => $totalRow,
            'totalPages' => $totalPages,
        );
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

        // Start transaction to ensure data integrity
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
            header("Location: /login");
            exit();
        }
    }
    
    static function totalQuery(){
        $totalQuery = "SELECT COUNT(contact_id) AS total FROM contacts";
        return $totalQuery;
    }
}
