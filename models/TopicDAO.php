<?php
    include_once 'Topic.php';

    class TopicDAO {


        public function getConnection(){
            $mysqli = new mysqli("127.0.0.1", "bloguser", "blogAssign3", "blogdb");
            if ($mysqli->connect_errno) {
                $mysqli=null;
            }
            return $mysqli;
        }

        public function addTopic($topic){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("INSERT INTO topics (name, desc, lastModified) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $topic->getName(), $topic->getDesc(), $topic->getLastModified());
            $stmt->execute();
            $stmt->close();
            $connection->close();
        }

        public function getTopics(){
            $connection=$this->getConnection();
            $stmt = $connection->prepare("SELECT * FROM topics;"); 
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                $topic = new Topic();
                $topic->load($row);
                $topics[]=$topic;
            }    
            $stmt->close();
            $connection->close();
            return $topics;
        }
    }
?>
