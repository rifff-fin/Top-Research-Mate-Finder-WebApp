<?php
// Enable CORS
header('Access-Control-Allow-Origin: *'); // For dev, change to specific in prod
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0); // Handle preflight
}

require_once __DIR__ . '/routes/api.php';