<?php
include_once 'config/conn.php';

class contact_model {
    
    static function index() {
        global $conn;
        $rowsPerPage = 5;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $rowsPerPage;
    
        $stmt = $conn->prepare("SELECT * FROM `contacts` LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $rowsPerPage);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = [
            'rowPerPage'=>$rowsPerPage,
            'page'=>$page,
            'offset'=>$offset,
            'result'=>$result,
        ];
        return $data;
    }

    static function show() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM `contacts`");
        $stmt->execute();
        $result = $stmt->get_result();
    }

    static function create($userId, $name, $email, $address, $phone_number) {
        global $conn;
        $conn->begin_transaction(); // Mulai transaksi

        try {
            // Lakukan query INSERT untuk tabel contacts
            $stmt = $conn->prepare("INSERT INTO contacts (user_id, name, email, address, phone_number) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $userId, $name, $email, $address, $phone_number);
            $stmt->execute();
            $stmt->close();

            // Commit transaksi jika sukses
            $conn->commit();
            
            // Kembalikan true untuk menandakan sukses
            return true;
        } catch (Exception $e) {
            // Rollback transaksi jika ada kesalahan
            $conn->rollback();
            error_log('Error: ' . $e->getMessage()); // Log pesan kesalahan
            
            // Kembalikan false untuk menandakan kegagalan
            return false;
        }
    }



    static function update($contact_id, $name, $email, $address, $phone_number) {
        global $conn;
        $stmt = $conn->prepare("UPDATE contacts SET name = ?, email = ?, address = ?, phone_number = ? WHERE contact_id = ?");
        $stmt->bind_param("ssssi", $name, $email, $address, $phone_number, $contact_id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    static function delete($contact_id) {
        global $conn;

        // Start transaction to ensure data integrity
        $conn->begin_transaction();

        try {
            // Delete the contact entry
            $deleteStmt = $conn->prepare("DELETE FROM contacts WHERE contact_id = ?");
            $deleteStmt->bind_param("i", $contact_id);
            $deleteStmt->execute();
            $deleteStmt->close();

            // Commit the transaction
            $conn->commit();
            return true;
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $conn->rollback();
            error_log('Error: ' . $e->getMessage());  // Log error
            return false;
        }
    }

    static function getRoles() {
        global $conn;
        $rolesQuery = "SELECT role_id, role_name FROM roles";
        $rolesResult = $conn->query($rolesQuery);
        $roles = array();
        while ($role = $rolesResult->fetch_assoc()) {
            $roles[] = $role;
        }
        return $roles;
    }

    static function totalQuery(){
        $totalQuery = "SELECT COUNT(contact_id) AS total FROM contacts";
        return $totalQuery;
    }
}
?>
