// Test DB connection
require_once __DIR__ . '/dp.php';
$db = new Database();
$conn = $db->getConnection();

if ($conn) {
    echo "✅ DB Connected!";
} else {
    echo "❌ DB Connection failed!";
}
