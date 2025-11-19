<?php
require_once __DIR__ . '/../models/Chat.php';

class ChatController {
    private $chatModel;

    public function __construct() {
        $this->chatModel = new Chat();
    }

    public function sendMessage() {
        $data = json_decode(file_get_contents("php://input"), true);
        // sender_id from JWT, receiver_id, message
        $sender_id = $data['sender_id']; // In real, from JWT
        if ($this->chatModel->create($sender_id, $data['receiver_id'], $data['message'])) {
            echo json_encode(['message' => 'Sent']);
        }
    }

    public function getChats($userId) {
        $chats = $this->chatModel->getByUser($userId);
        echo json_encode($chats);
    }
}