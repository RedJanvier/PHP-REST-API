<?php
    // Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);
    
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    $post->read_single();

    $response = array(
        'id' => $post->id,
        'body' => $post->body,
        'title' => $post->title,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );

    print_r(json_encode($response));

