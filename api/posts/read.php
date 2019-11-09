<?php
    // Headers
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);
    $result = $post->read();
    $row_num = $result->rowCount();

    if ($row_num > 0) {
        $response = array();
        $response['data'] = array();

        while ($row = $result->fetch()) {
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );

            array_push($response['data'], $post_item);
        }
      
        echo json_encode($response);    
    } else {
        echo json_encode(['message' => 'No Posts Found']);
    }

