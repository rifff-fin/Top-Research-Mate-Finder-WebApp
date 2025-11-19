<?php
require_once __DIR__ . '/../utils/Auth.php';
require_once __DIR__ . '/../models/Researcher.php';

class AuthController {
    private $researcherModel;

    public function __construct() {
        $this->researcherModel = new Researcher();
    }

    public function register() {
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $name = $data['name'];
        // Add other fields...

        if ($this->researcherModel->create($name, $email, $password /* add others */)) {
            echo json_encode(['message' => 'Registered successfully']);
        } else {
            echo json_encode(['message' => 'Registration failed']);
        }
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'];
        $password = $data['password'];

        $user = $this->researcherModel->getByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $token = generateJWT($user['researcher_id']);
            echo json_encode(['token' => $token]);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid credentials']);
        }
    }
}