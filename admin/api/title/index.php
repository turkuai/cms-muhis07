<?php

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    echo '{ "title": "Mohan otsiko toimi"}';
    
} else {
    
    

    echo '{ "status": "ok"}';
}

?>