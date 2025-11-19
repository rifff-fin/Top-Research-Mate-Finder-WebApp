<?php
require_once __DIR__ . '/../models/Research.php';

class AdminController {
    private $researchModel;

    public function __construct() {
        $this->researchModel = new Research();
    }

    public function approveResearch($id) {
        if ($this->researchModel->approve($id)) {
            echo json_encode(['message' => 'Approved']);
        } else {
            echo json_encode(['message' => 'Failed']);
        }
    }

    // Other admin functions...
}