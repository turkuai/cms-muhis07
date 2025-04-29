<?php
// text.php
header('Content-Type: application/json');

$filePath = __DIR__ . '/../../data/title.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get all texts
    if (file_exists($filePath)) {
        echo file_get_contents($filePath);
    } else {
        echo json_encode([]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new text entry
    $input = json_decode(file_get_contents('php://input'), true);
    $texts = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];
    $texts[] = $input;  // Add the new text entry to the array
    file_put_contents($filePath, json_encode($texts));
    echo json_encode(["message" => "Text added successfully"]);
}
?>