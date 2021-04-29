<?php


    class CommentAdd implements ControllerAction {

        function processGET() {
            return;
        }

        function processPOST(){
            $userID = $_SESSION['user'];
            $artID=$_POST['artID'];
            $content=$_POST['commentText'];
            
            $comment = new Comment();
            $comment->setAuthorID($userID);
            $comment->setArtID($artID);
            $comment->setContent($content);
            $commentDAO = new CommentDAO();
            $commentDAO->addComment($comment);
            $url = 'Location: controller.php?page=read-' . $artID;
            header($url);
            exit;
        }

        function getAccess(){
            return "PROTECTED";
        }      

    }

