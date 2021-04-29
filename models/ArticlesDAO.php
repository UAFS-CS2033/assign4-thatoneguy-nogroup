<?php
    include_once 'Article.php';

    class ArticlesDAO {
        public function getConnection(){
            $mysqli = new mysqli("127.0.0.1", "bloguser", "blogAssign3", "blogdb");
            if ($mysqli->connect_errno) {
                $mysqli=null;
            }
            return $mysqli;
        }

        public function addArticle($article){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("INSERT INTO articles (authorID, catID, title, image, content) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iisss", $article->getAuthorID(), $article->getCatID(), $article->getTitle(), $article->getImage(), $article->getContent());
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function editArticle($article){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("UPDATE articles SET authorID = ?, catID = ?, title = ?, image = ?, content = ? WHERE artID = ?");
            $stmt->bind_param("iisssi", $article->getAuthorID(), $article->getCatID(), $article->getTitle(), $article->getImage(), $article->getContent(), $article->getArtID());
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function deleteArticle($artID){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("DELETE FROM articles WHERE artID = ?");
            $stmt->bind_param("i", $artID);
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function getArticles(){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("select artID, authorID, catID, title, image, content, DATE_FORMAT(articles.lastModified,'%m/%d/%Y') AS lastModified, username, topics.name from users JOIN articles ON users.userID = articles.authorID JOIN topics on topics.topID = articles.catID
            "); 
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $article = new Article();
                $article->load($row);
                $articles[]=$article;
            }    
            $stmt->close();
            $connection->close();
            return $articles;
        }


        public function getUserArticles($userID){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("select artID, authorID, catID, title, image, content, articles.lastModified, username, topics.name from users JOIN articles ON users.userID = articles.authorID JOIN topics on topics.topID = articles.catID
             WHERE userID = ?"); 
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $article = new Article();
                $article->load($row);
            }    
            $stmt->close();
            $connection->close();
            return $article;
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
