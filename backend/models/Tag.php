// backend/models/Tag.php
<?php
require_once __DIR__ . '/../config/db.php';

class Tag {
    private $conn;
    private $table = 'tag';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($tag_name) {
        $query = "INSERT INTO " . $this->table . " (tag_name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $tag_name);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE tag_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>