<?php
use \Firebase\JWT\JWT;

$secretKey = 'your-secret-key';

function generateJWT($userId) {
    global $secretKey;
    $payload = ['user_id' => $userId, 'exp' => time() + 3600];
    return JWT::encode($payload, $secretKey, 'HS256');
}

function verifyJWT($token) {
    global $secretKey;
    try {
        return JWT::decode($token, new \Firebase\JWT\Key($secretKey, 'HS256'));
    } catch (Exception $e) {
        return null;
    }
}
?>