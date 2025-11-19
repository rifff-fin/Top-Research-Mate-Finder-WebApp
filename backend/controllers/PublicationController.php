<?php
require_once __DIR__ . '/../models/Publication.php';

class PublicationController {
    private $pubModel;

    public function __construct() {
        $this->pubModel = new Publication();
    }

    public function createPublication() {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->pubModel->create($data['title'], $data['journal'], $data['date'], $data['research_id'])) {
            echo json_encode(['message' => 'Created']);
        }
    }

    public function getPublications($researchId) {
        $pubs = $this->pubModel->getByResearch($researchId);
        echo json_encode($pubs);
    }
}