<?php
require_once __DIR__ . '/../models/Research.php';

class ResearchController {
    private $researchModel;

    public function __construct() {
        $this->researchModel = new Research();
    }

    public function createResearch() {
        $data = json_decode(file_get_contents("php://input"), true);
        // Add approved = 0 for admin approval
        if ($this->researchModel->create($data['title'], $data['description'], $data['start_date'], $data['end_date'], 0)) {
            echo json_encode(['message' => 'Created, pending approval']);
        }
    }

    public function getTopResearch() {
        $top = $this->researchModel->getApproved(); // Add logic for top
        echo json_encode($top);
    }
    public function getTopResearch() {
    $query = "SELECT * FROM research WHERE approved = 1 ORDER BY research_id DESC LIMIT 5"; // Top 5
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

    public function getResearchById($id) {
        $research = $this->researchModel->getById($id);
        echo json_encode($research);
    }
}