<?php
// title.php
header('Content-Type: application/json');

$filePath = __DIR__ . '/../data/title.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Read the title from the file
    if (file_exists($filePath)) {
        $title = json_decode(file_get_contents($filePath), true);
        echo json_encode($title);
    } else {
        echo json_encode(["title" => "Default Title"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the title in the file
    $input = json_decode(file_get_contents('php://input'), true);
    file_put_contents($filePath, json_encode(["title" => $input['title']]));
    echo json_encode(["message" => "Title updated successfully"]);
}
?>