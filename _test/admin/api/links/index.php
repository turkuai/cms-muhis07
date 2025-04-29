<?php
// links.php
header('Content-Type: application/json');

$filePath = __DIR__ . '/../../data/title.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get all links
    if (file_exists($filePath)) {
        echo file_get_contents($filePath);
    } else {
        echo json_encode([]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new link
    $input = json_decode(file_get_contents('php://input'), true);
    $links = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];
    $links[] = $input;  // Add the new link to the array
    file_put_contents($filePath, json_encode($links));
    echo json_encode(["message" => "Link added successfully"]);
}
?>