// backend/models/Tagged.php
<?php
require_once __DIR__ . '/../config/db.php';

class Tagged {
    private $conn;
    private $table = 'tagged';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addTagToResearcher($researcher_id, $tag_id) {
        $query = "INSERT INTO " . $this->table . " (researcher_id, tag_id) VALUES (:researcher, :tag)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':researcher', $researcher_id);
        $stmt->bindParam(':tag', $tag_id);
        return $stmt->execute();
    }

    public function getTagsByResearcherId($researcher_id) {
        $query = "SELECT t.* FROM " . $this->table . " tg JOIN tag t ON tg.tag_id = t.tag_id WHERE tg.researcher_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $researcher_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeTagFromResearcher($researcher_id, $tag_id) {
        $query = "DELETE FROM " . $this->table . " WHERE researcher_id = :researcher AND tag_id = :tag";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':researcher', $researcher_id);
        $stmt->bindParam(':tag', $tag_id);
        return $stmt->execute();
    }
}
?>
