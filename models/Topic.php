<?php
    class Topic {
        private $topID;
        private $name;
        private $dsecription;
        private $lastModified;

        public function load($row){
            $this->setTopID($row['topID']);
            $this->setName($row['name']);
            $this->setDescription($row['description']);
            $this->setLastModified($row['lastModified']);
        }

        public function setTopID($topID){
            $this->topID=$topID;
        }

        public function getTopID(){
            return $this->topID;
        }

        public function setName($name){
            $this->name=$name;
        }

        public function getName(){
            return $this->name;
        }
        
        public function getDescription(){
            return $this->dsecription;
        }

        public function setDescription($description){
            $this->description=$description;
        }

        public function setLastModified($lastModified){
            $this->lastModified=$lastModified;
        }

        public function getLastModified(){
            return $this->lastModified;
        }
    }
?>