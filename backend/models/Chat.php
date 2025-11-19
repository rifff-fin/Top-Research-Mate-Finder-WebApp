<?php
require_once __DIR__ . '/../config/db.php';

class Chat {
    private $conn;
    private $table = 'chats';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($sender_id, $receiver_id, $message) {
        $query = "INSERT INTO " . $this->table . " (sender_id, receiver_id, message, sent_at) VALUES (:sender, :receiver, :msg, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sender', $sender_id);
        $stmt->bindParam(':receiver', $receiver_id);
        $stmt->bindParam(':msg', $message);
        return $stmt->execute();
    }

    public function getByUser($userId) {
        $query = "SELECT * FROM " . $this->table . " WHERE sender_id = :id OR receiver_id = :id ORDER BY sent_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}