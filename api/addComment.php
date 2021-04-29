<?php
   
    include_once "../models/CommentDAO.php";

    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"),true);

    $comment = new Comment();
    $comment->setAuthorID($data['authorID']);
    $comment->setArtID($data['artID']);
    $comment->setContent($data['content']);

    $commentDAO = new commentDAO();
    $id=$commentDAO->addComment($comment);
    $result=$commentDAO->getComment($id);
  
    echo json_encode($result);

?>