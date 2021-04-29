<?php
    include_once "controllers/ArticlesControllers.php";
    include_once "controllers/BasicPagesController.php";
    include_once "controllers/CommentsControllers.php";


    class FrontController { 
        private $controllers;
        

        public function __construct(){
            $this->showErrors(0);
            $this->controllers = $this->loadControllers();
        }

        public function run(){
            session_start();

            //***** 1. Get Request Method and Page Variable *****/
            $method = $_SERVER['REQUEST_METHOD'];
            $page = $_REQUEST['page'];
            
            //***** 2. Route the Request to the Controller Based on Method and Page *** */

            //***** 3. Deal with individual article reading (in case) *** */
            if(substr( $page, 0, 5 ) === "read-") {
                $controller = new ArticleRead();
            } 
            
                
            else { 
                $controller = $this->controllers[$method.$page];
            }
            // $controller = $this->controllers[$method.$page];
        
            
            //** 3. Check Security Access ***/
            $controller = $this->securityCheck($controller);


           
            //** 4. Execute the Controller */
            if($method=='GET'){
                $content=$controller->processGET();
            }
            if($method=='POST'){
                $controller->processPOST();
            }

            //**** 5. Render Page Template */
         
            include "template/template.php";
        }

        private function loadControllers(){
        /******************************************************
         * Register the Controllers with the Front Controller *
         ******************************************************/
            $controllers["GET"."list"] = new ArticlesList();
            $controllers["GET" . "list-yours"] = new ArticlesListYours();

            // $controllers["GET" . "read"] = new ArticleRead();
            // $controllers["POST" . "read"] = new ArticleRead();

            $controllers["GET"."add"] = new ArticleAdd();
            $controllers["POST"."add"] = new ArticleAdd();

            $controllers["GET"."delete"] = new ArticleDelete();
            $controllers["POST"."delete"] = new ArticleDelete();

            $controllers["GET"."edit"] = new ArticleEdit();
            $controllers["POST"."edit"] = new ArticleEdit();
           
            $controllers["GET"."login"] = new Login();
            $controllers["POST"."login"] = new Login();

            $controllers["GET"."signup"] = new Signup();
            $controllers["POST"."signup"] = new Signup();
            
            $controllers["GET"."home"] = new Home();
            $controllers["GET" . "logout"] = new Logout();
            $controllers["GET"."about"] = new About();

            $controllers["GET"."addComment"] = new CommentAdd();
            $controllers["POST"."addComment"] = new CommentAdd();
            return $controllers;
        }

        private function securityCheck($controller){
        /******************************************************
         * Check Access restrictions for selected controller  *
         ******************************************************/
            if($controller->getAccess()=='PROTECTED'){
                if(!isset($_SESSION['loggedin'])){
                    //*** Not Logged In ****/
                    $controller = $this->controllers["GET"."login"];
                }
            }
            return $controller;
        }


        private function showErrors($debug){
            if($debug==1){
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
            }
        }
    }

    $controller = new FrontController();
    $controller->run();
?>