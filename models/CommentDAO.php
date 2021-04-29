<?php
    include_once 'Comment.php';

    class CommentDAO {
        
        public function getConnection(){
            $mysqli = new mysqli("127.0.0.1", "bloguser", "blogAssign3", "blogdb");
            if ($mysqli->connect_errno) {
                $mysqli=null;
            }
            return $mysqli;
        }

        public function addComment($comment){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("INSERT INTO comments (authorID, artID, content) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $comment->getAuthorID(), $comment->getArtID(), $comment->getContent());
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function deleteComment($comID){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("DELETE FROM comments WHERE comID = ?");
            $stmt->bind_param("i", $comID);
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function getComments(){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("select comID, authorID, users.username, artID, content, DATE_FORMAT(comments.lastModified,'%m/%d/%Y') AS lastModified from users JOIN comments ON users.userID = comments.authorID order by lastModified ASC"); 
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $comment= new Comment();
                $comment->load($row);
                $comments[]=$comment;
            }    
            $stmt->close();
            $connection->close();
            return $comments;
        }

        public function getComment($id){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("select comID, authorID, users.username, artID, content, DATE_FORMAT(comments.lastModified,'%m/%d/%Y') AS lastModified from users JOIN comments ON users.userID = comments.authorID where comID = ?"); 
            $stmt->bind_param("i", $comID);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $comment= new Comment();
                $comment->load($row);
            }    
            $stmt->close();
            $connection->close();
            return $comment;
        }


        
        // public function authenticate($username, $password){
        //     $connection=$this->getConnection();
        //     $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? and password = ?;");
        //     $stmt->bind_param("ss",$username,$password); 
        //     $stmt->execute();
        //     $result = $stmt->get_result();
        //     $found=$result->fetch_assoc();
        //     $stmt->close();
        //     $connection->close();
        //     var_dump($found);
        //     return $found;
        // }
    
    }
?>
