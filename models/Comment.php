<?php
    class Comment implements JsonSerializable{
        private $comID;
        private $authorID;
        private $artID;
        private $content;
        private $lastModified;
        private $authorName;

        public function load($row){
            $this->setComID($row['comID']);
            $this->setAuthorID($row['authorID']);
            $this->setAuthorName($row['username']);
            $this->setArtID($row['artID']);
            $this->setContent($row['content']);
            $this->setLastModified($row['lastModified']);

           
        }

        public function setComID($comID){
            $this->comID=$comID;
        }

        public function getComID(){
            return $this->comID;
        }

        public function setAuthorID($authorID){
            $this->authorID=$authorID;
        }

        public function getAuthorID(){
            return $this->authorID;
        }


        public function setAuthorName($authorName){
            $this->authorName=$authorName;
        }

        public function getAuthorName(){
            return $this->authorName;
        }

        public function setArtID($artID){
            $this->artID=$artID;
        }

        public function getArtID(){
            return $this->artID;
        }

        public function setContent($content){
            $this->content=$content;
        }

        public function getContent(){
            return $this->content;
        }

        public function setLastModified($lastModified){
            $this->lastModified=$lastModified;
        }

        public function getLastModified(){
            return $this->lastModified;
        }


        public function jsonSerialize(){
            return array(
                'comID' => $this->comID,
                'authorID'=> $this->authorID,
                'authorName' => $this->authorName,
                'artID' => $this->artID,
                'content' => $this->content,
                'lastModified' => $this->lastModified
            );
        }
    }
?>