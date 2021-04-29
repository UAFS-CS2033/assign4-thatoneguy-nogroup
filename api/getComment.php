<?php 
   include_once "../models/CommentDAO.php";

   $commentID = intval($_GET['id']);
   $commentDAO = new CommentDAO();
   $comment = $commentDAO->getComment($commentID);

   echo json_encode($comment);
?>