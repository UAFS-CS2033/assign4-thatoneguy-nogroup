<?php 
   include_once "../models/CommentDAO.php";

   $commentDAO = new CommentDAO();
   $comments = $commentDAO->getComments();

   echo json_encode($comments);
?>