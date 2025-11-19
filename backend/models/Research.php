// backend/models/Research.php
<?php
require_once __DIR__ . '/../config/db.php';

class Research {
    private $conn;
    private $table = 'research';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($title, $description, $start_date, $end_date, $approved = 0) {
        $query = "INSERT INTO " . $this->table . " (title, description, start_date, end_date, approved) VALUES (:title, :description, :start_date, :end_date, :approved)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':approved', $approved);
        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE research_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $description, $start_date, $end_date, $approved) {
        $query = "UPDATE " . $this->table . " SET title = :title, description = :description, start_date = :start_date, end_date = :end_date, approved = :approved WHERE research_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':approved', $approved);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getPending() {
        $query = "SELECT * FROM " . $this->table . " WHERE approved = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approve($id) {
        $query = "UPDATE " . $this->table . " SET approved = 1 WHERE research_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " WHERE approved = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop() {
        // Assuming 'top' means some ordering, e.g., by start_date DESC; adjust logic as needed
        $query = "SELECT * FROM " . $this->table . " WHERE approved = 1 ORDER BY start_date DESC LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>