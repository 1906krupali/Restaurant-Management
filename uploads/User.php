<?php
include_once 'config.php';

class User {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($name, $email, $password, $address, $dob, $phone, $marital_status, $gender, $hobbies, $profile_pic) {
        if ($this->emailExists($email)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " (name, email, password, address, dob, phone, marital_status, gender, hobbies, profile_pic) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            printf("Error: %s.\n", $this->conn->error);
            return false;
        }

        $name = htmlspecialchars(strip_tags($name));
        $email = htmlspecialchars(strip_tags($email));
        $password = password_hash($password, PASSWORD_BCRYPT);
        $address = htmlspecialchars(strip_tags($address));
        $dob = htmlspecialchars(strip_tags($dob));
        $phone = htmlspecialchars(strip_tags($phone));
        $marital_status = htmlspecialchars(strip_tags($marital_status));
        $gender = htmlspecialchars(strip_tags($gender));
        $hobbies = htmlspecialchars(strip_tags($hobbies));
        $profile_pic = htmlspecialchars(strip_tags($profile_pic));

        $stmt->bind_param("ssssssssss", $name, $email, $password, $address, $dob, $phone, $marital_status, $gender, $hobbies, $profile_pic);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    private function emailExists($email) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            printf("Error: %s.\n", $this->conn->error);
            return true;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $query = "SELECT id, name, password FROM " . $this->table_name . " WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $password_hash = $row['password'];
            
            if (password_verify($password, $password_hash)) {
                return $row;
            }
        }

        return false;
    }

    public function read() {
        $query = "SELECT id, name, email, address, phone, dob, marital_status, gender, hobbies, profile_pic FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            printf("Error: %s.\n", $this->conn->error);
            return false;
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function updateUserDetails($user_id, $name, $email, $address, $dob, $phone, $marital_status, $gender, $hobbies, $profile_pic = null) {
     
        $query = "UPDATE users 
                  SET name = ?, email = ?, address = ?, dob = ?, phone = ?, 
                      marital_status = ?, gender = ?, hobbies = ?";
    
        
        if ($profile_pic !== null) {
            $query .= ", profile_pic = ?";
        }
    
        $query .= " WHERE id = ?";
    
        if ($stmt = $this->conn->prepare($query)) {
            if ($profile_pic !== null) {
             
                $stmt->bind_param("sssssssssi", $name, $email, $address, $dob, $phone, $marital_status, $gender, $hobbies, $profile_pic, $user_id);
            } else {
              
                $stmt->bind_param("ssssssssi", $name, $email, $address, $dob, $phone, $marital_status, $gender, $hobbies, $user_id);
            }
    
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                die("Execute failed: " . $stmt->error);
            }
        } else {
            die("Prepare failed: " . $this->conn->error);
        }
    }
    
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            printf("Error: %s.\n", $this->conn->error);
            return false;
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
     
      public function getUserDetails($user_id) {
        $query = "SELECT * FROM users WHERE id = ?";
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_details = $result->fetch_assoc();
            $stmt->close();
            return $user_details;
        } else {
            die("Query failed: " . $this->conn->error);
        }
    }
    public function getUserById($id) {
        $id = $this->conn->real_escape_string($id);
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '$id'";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    public function getCart() {
        return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    }

    public function clearCart() {
        $_SESSION['cart'] = [];
    }
    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function insert_id() {
        return $this->conn->insert_id;
    }

    public function close() {
        $this->conn->close();
    }
}
?>
