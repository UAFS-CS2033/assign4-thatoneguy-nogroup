<?php
    class Article {
        private $artID;
        private $authorID;
        private $catID;
        private $title;
        private $image;
        private $content;
        private $lastModified;
        
        private $authorName;
        private $catName;

    
        public function load($row){

            $this->setArtID($row['artID']);
            $this->setAuthorID($row['authorID']);
            $this->setCatID($row['catID']);
            $this->setTitle($row['title']);
            $this->setImage($row['image']);
            $this->setContent($row['content']);
            $this->setLastModified($row['lastModified']);
            $this->setAuthorName($row['username']);
            $this->setCatName($row['name']);
        }

        public function setArtID($artID){
            $this->artID=$artID;
        }

        public function getArtID(){
            return $this->artID;
        }

        public function setAuthorID($authorID){
            $this->authorID=$authorID;
        }

        public function getAuthorID(){
            return $this->authorID;
        }

        public function setCatID($catID){
            $this->catID=$catID;
        }

        public function getCatID(){
            return $this->catID;
        }

        public function setTitle($title){
            $this->title=$title;
        }

        public function getTitle(){
            return $this->title;
        }

        public function setImage($image){
            $this->image=$image;
        }

        public function getImage(){
            return $this->image;
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


        public function setAuthorName($authorName){
            $this->authorName=$authorName;
        }

        public function getAuthorName(){
            return $this->authorName;
        }

        public function setCatName($catName){
            $this->catName=$catName;
        }

        public function getCatName(){
            return $this->catName;
        }
    }
?>