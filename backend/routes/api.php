<?php
// routes/api.php

// Load all controllers in the controllers directory
foreach (glob(__DIR__ . '/../controllers/*.php') as $controllerFile) {
    require_once $controllerFile;
}

$requestMethod = $_SERVER['REQUEST_METHOD'];

// Support both query string (?action=...) and RESTful segments (/auth/login)
$action = $_GET['action'] ?? null;
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = $path === '' ? [] : explode('/', $path);

// Helper to respond JSON and exit
function respondJson($data, int $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}

try {
    // ---------------- AUTH ----------------
    if ($action === 'login' || (isset($segments[0]) && $segments[0] === 'auth' && $segments[1] === 'login')) {
        if ($requestMethod !== 'POST') respondJson(['error' => 'Method not allowed'], 405);
        $controller = new AuthController();
        $controller->login();
        exit;
    }

    if ($action === 'register' || (isset($segments[0]) && $segments[0] === 'auth' && $segments[1] === 'register')) {
        if ($requestMethod !== 'POST') respondJson(['error' => 'Method not allowed'], 405);
        $controller = new AuthController();
        $controller->register();
        exit;
    }

    // ---------------- PROFILE ----------------
    if ($action === 'getProfile' || (isset($segments[0]) && $segments[0] === 'profile')) {
        if ($requestMethod !== 'GET') respondJson(['error' => 'Method not allowed'], 405);

        $id = $segments[1] ?? ($_GET['id'] ?? null);
        if (!$id) respondJson(['error' => 'Profile id required'], 400);

        $controller = new ProfileController();
        $controller->getProfile($id);
        exit;
    }

    // ---------------- RESEARCH ----------------
    if ($action === 'getResearch' || (isset($segments[0]) && $segments[0] === 'research')) {
        if ($requestMethod !== 'GET') respondJson(['error' => 'Method not allowed'], 405);

        $controller = new ResearchController();
        $controller->getAllResearch();
        exit;
    }

    if ($action === 'addResearch' || (isset($segments[0]) && $segments[0] === 'research' && $segments[1] === 'add')) {
        if ($requestMethod !== 'POST') respondJson(['error' => 'Method not allowed'], 405);

        $controller = new ResearchController();
        $controller->addResearch();
        exit;
    }

    // ---------------- CHAT ----------------
    if ($action === 'getChats' || (isset($segments[0]) && $segments[0] === 'chats')) {
        if ($requestMethod !== 'GET') respondJson(['error' => 'Method not allowed'], 405);

        $controller = new ChatController();
        $controller->getChats();
        exit;
    }

    if ($action === 'sendMessage' || (isset($segments[0]) && $segments[0] === 'chats' && $segments[1] === 'send')) {
        if ($requestMethod !== 'POST') respondJson(['error' => 'Method not allowed'], 405);

        $controller = new ChatController();
        $controller->sendMessage();
        exit;
    }

    // ---------------- MATCH ----------------
    if ($action === 'getMatches' || (isset($segments[0]) && $segments[0] === 'matches')) {
        if ($requestMethod !== 'GET') respondJson(['error' => 'Method not allowed'], 405);

        $controller = new MatchController();
        $controller->getMatches();
        exit;
    }

    if ($action === 'addMatch' || (isset($segments[0]) && $segments[0] === 'matches' && $segments[1] === 'add')) {
        if ($requestMethod !== 'POST') respondJson(['error' => 'Method not allowed'], 405);

        $controller = new MatchController();
        $controller->addMatch();
        exit;
    }

    // ---------------- FALLBACK ----------------
    respondJson(['error' => 'Not found'], 404);

} catch (Throwable $e) {
    // In production, don’t expose $e->getMessage()
    respondJson(['error' => 'Server error'], 500);
}
