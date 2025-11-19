<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../../vendor/autoload.php'; // Assume composer installed firebase/php-jwt

const JWT_SECRET = "your_secret_key_here";  
const JWT_ALGO = "HS256";

function generateJWT($userId) {
    $payload = [
        "iss" => "researchmate.local",
        "aud" => "researchmate.local",
        "iat" => time(),
        "exp" => time() + (60 * 60 * 24),
        "sub" => $userId
    ];
    return JWT::encode($payload, JWT_SECRET, JWT_ALGO);
}

function verifyJWT($token) {
    try {
        $decoded = JWT::decode($token, new Key(JWT_SECRET, JWT_ALGO));
        return (array) $decoded;
    } catch (Exception $e) {
        return null;
    }
}

// In routes, for protected: $token = $_SERVER['HTTP_AUTHORIZATION'] ? str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']) : null;
// if (!verifyJWT($token)) { http_response_code(401); exit; }