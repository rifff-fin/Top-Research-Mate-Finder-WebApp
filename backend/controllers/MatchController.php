<?php
require_once __DIR__ . '/../models/Match.php';
require_once __DIR__ . '/../models/Recommendation.php';

class MatchController {
    private $matchModel;
    private $recModel;

    public function __construct() {
        $this->matchModel = new Match();
        $this->recModel = new Recommendation();
    }

    public function getRecommendations($userId) {
        $recs = $this->recModel->getByUser($userId);
        echo json_encode($recs);
    }

    // Logic to generate matches based on tags, fields...
    public function generateRecommendations($userId) {
        // Use SQL to find similar based on tags
        // For example, query researchers with shared tags
        // Then create recommends
    }
    public function getRecommendations() {
    $userId = $this->getUserIdFromToken(); // Implement token decoding
    $query = "SELECT * FROM recommends WHERE recommender_id = :id AND status = 'pending' LIMIT 5";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

    private function getUserIdFromToken() {
        // Decode JWT and return user ID
        return 1; // Placeholder
    }
}