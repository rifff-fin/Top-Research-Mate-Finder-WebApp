// backend/models/Publication.php
<?php
require_once __DIR__ . '/../config/db.php';

class Publication {
    private $conn;
    private $table = 'publication';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($title, $journal_conference, $publication_date, $research_id) {
        $query = "INSERT INTO " . $this->table . " (title, journal_conference, publication_date, research_id) VALUES (:title, :journal, :pub_date, :research_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':journal', $journal_conference);
        $stmt->bindParam(':pub_date', $publication_date);
        $stmt->bindParam(':research_id', $research_id);
        return $stmt->execute();
    }

    public function getByResearchId($research_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE research_id = :id ORDER BY publication_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $research_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>