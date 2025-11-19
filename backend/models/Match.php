// backend/models/Match.php
<?php
require_once __DIR__ . '/../config/db.php';

class MatchModel {
    private $conn;
    private $table = 'matches';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($matcher_id, $matched_id) {
        $query = "INSERT INTO " . $this->table . " (matcher_id, matched_id, match_date) VALUES (:matcher, :matched, CURDATE())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':matcher', $matcher_id);
        $stmt->bindParam(':matched', $matched_id);
        return $stmt->execute();
    }

    public function getByUser($userId) {
        $query = "SELECT * FROM " . $this->table . " WHERE matcher_id = :id OR matched_id = :id ORDER BY match_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>