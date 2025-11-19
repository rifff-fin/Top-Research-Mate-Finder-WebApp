<?php
require_once __DIR__ . '/../models/Researcher.php';

class ProfileController {
    private $researcherModel;

    public function __construct() {
        $this->researcherModel = new Researcher();
    }

    public function getProfile($id) {
        $profile = $this->researcherModel->getById($id);
        echo json_encode($profile);
    }

    public function updateProfile($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->researcherModel->update($id, $data)) {
            echo json_encode(['message' => 'Updated']);
        }
    }
}