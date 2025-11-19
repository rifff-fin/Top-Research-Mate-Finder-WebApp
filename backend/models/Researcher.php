// backend/models/Researcher.php
<?php
require_once __DIR__ . '/../config/db.php';

class Researcher {
    private $conn;
    private $table = 'researcher';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($name, $email, $password, $institution = null, $field = null, $one_line_pitch = null, $profile_pic = null, $role = 'user') {
        $query = "INSERT INTO " . $this->table . " (name, email, password, institution, field, one_line_pitch, profile_pic, role) VALUES (:name, :email, :password, :institution, :field, :pitch, :profile_pic, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Assume hashed
        $stmt->bindParam(':institution', $institution);
        $stmt->bindParam(':field', $field);
        $stmt->bindParam(':pitch', $one_line_pitch);
        $stmt->bindParam(':profile_pic', $profile_pic);
        $stmt->bindParam(':role', $role);
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE researcher_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEmail($email) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $institution, $field, $one_line_pitch, $profile_pic = null, $role = null) {
        $query = "UPDATE " . $this->table . " SET name = :name, email = :email, institution = :institution, field = :field, one_line_pitch = :pitch, profile_pic = :profile_pic, role = :role WHERE researcher_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':institution', $institution);
        $stmt->bindParam(':field', $field);
        $stmt->bindParam(':pitch', $one_line_pitch);
        $stmt->bindParam(':profile_pic', $profile_pic);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function updatePassword($id, $password) {
        $query = "UPDATE " . $this->table . " SET password = :password WHERE researcher_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':password', $password); // Assume hashed
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>