<?php
    // Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Acces-Control-Allow-Methods: POST');
    header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers,Acces-Control-Allow-Origin,Acces-Control-Allow-Methods,Content-Type,Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);

    $data = json_decode(file_get_contents("php://input"));
    
    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    if ($post->create()) {
        echo json_encode(['message' => 'Post Created']);
    } else {
        echo json_encode(['message' => 'Post not Created']);
    }