<?php
class User {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to get total user count
    public function getUserCount() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        
        return 0; // In case of failure
    }

    // Method to fetch all users
    public function getAllUsers() {
        $query = "SELECT id, name, email, role FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $users = $result->fetch_all(MYSQLI_ASSOC);  // Fetch all users as an associative array
            return $users;
        }

        return [];
    }
}
?>
