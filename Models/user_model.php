<?php

include_once 'config/conn.php';

class user_model {
    
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
    
    // Tambahkan metode lain yang dibutuhkan untuk model pengguna di sini...
    
}
