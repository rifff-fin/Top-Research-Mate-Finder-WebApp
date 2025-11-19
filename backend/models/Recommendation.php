// backend/models/Recommendation.php
<?php
require_once __DIR__ . '/../config/db.php';

class Recommendation {
    private $conn;
    private $table = 'recommends';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($recommender_id, $recommended_id, $match_score, $status) {
        $query = "INSERT INTO " . $this->table . " (recommender_id, recommended_id, match_score, status, generated_date) VALUES (:recommender, :recommended, :score, :status, CURDATE())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':recommender', $recommender_id);
        $stmt->bindParam(':recommended', $recommended_id);
        $stmt->bindParam(':score', $match_score);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function getByUser($userId) {
        $query = "SELECT * FROM " . $this->table . " WHERE recommender_id = :id ORDER BY generated_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>