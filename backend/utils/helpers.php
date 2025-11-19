<?php
// Any helper functions, e.g., response helpers
function sendResponse($code, $data) {
    http_response_code($code);
    echo json_encode($data);
}