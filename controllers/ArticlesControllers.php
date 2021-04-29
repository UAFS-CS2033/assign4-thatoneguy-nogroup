<?php
    include "ControllerAction.php";
    include "models/ArticlesDAO.php";
    include "models/TopicDAO.php";
    include "models/CommentDAO.php";

    class ArticlesList implements ControllerAction{

        function processGET(){
            $articleDAO = new ArticlesDAO();
            $articles = $articleDAO->getArticles();
            $_REQUEST['articles']=$articles;
            return "views/listArticles.php";
        }

        function processPOST(){
            return;
        }

        function getAccess(){
            return "PUBLIC";
        }

    }


    class ArticlesListYours implements ControllerAction{

        function processGET(){
            $userID = $_SESSION['user'];
            $userDAO = new UserDAO();
            $users = $userDAO->getUsers();
            $user = null;

            foreach($users as $u) {
                if($u->getUserID() == $userID) {
                    $user = $u;
                }
            }

            $articleDAO = new ArticlesDAO();
            $all = $articleDAO->getArticles($userID);

            foreach($all as $a) {
                if($a->getAuthorID() == $userID) {
                    $articles[] = $a;
                }
            }
            $_REQUEST['user'] = $user;
            $_REQUEST['articles']=$articles;
            return "views/listYourArticles.php";
        }

        function processPOST(){
            return;
        }

        function getAccess(){
            return "PROTECTED";
        }
    }

    class ArticleRead implements ControllerAction{

        function processGET(){
            $artID = substr($_REQUEST['page'], 5);
            $articleDAO = new ArticlesDAO();
            $articles = $articleDAO->getArticles();
            $article = null;

            foreach($articles as $a) {
                if($a->getArtID() == $artID) {
                    $article = $a;
                }
            }
            $_REQUEST['article']=$article;

            $commentDAO = new CommentDAO();
            $comments = $commentDAO->getComments();
            

            foreach($comments as $c) {
                if($c->getArtID() == $artID) {
                    $filteredComments[] = $c;
                }
            }

            $_REQUEST['comments'] = $filteredComments;

            return "views/article.php";
        }

        function processPOST(){
            return;
        }

        function getAccess(){
            return "PUBLIC";
        }

    }

    class ArticleAdd implements ControllerAction{

        function processGET(){
            $topicDAO = new TopicDAO();
            $topics = $topicDAO->getTopics();
            $_REQUEST['topics']=$topics;

            return "views/addArticle.php";
        }
        

        function processPOST(){
            $authorID=$_POST['authorID'];
            $catID=$_POST['catID'];
            $title=$_POST['title'];
            $content=$_POST['content'];
            
            $article = new Article();
            $article->setAuthorID($authorID);
            $article->setCatID($catID);
            $article->setTitle($title);
            $article->setContent($content);

            $articleDAO = new ArticlesDAO();
            $articleDAO->addArticle($article);
            header("Location: controller.php?page=list");
            exit;
        }

        function getAccess(){
            return "PROTECTED";
        }      

    }

    class ArticleDelete implements ControllerAction{

        function processGET(){
            $artID = $_GET['artID'];
            $articlesDAO = new ArticlesDAO();
            $articles = $articlesDAO->getArticles();
         
            $article = null;

            foreach($articles as $a) {
                if($a->getArtID() == $artID) {
                    $article = $a;
                }
            }

            $_REQUEST['article']=$article;
            return 'views/delArticle.php';

        }

        function processPOST(){
            $artID=$_POST['artID'];
            $submit=$_POST['submit'];
            if($submit=='CONFIRM'){
                $articlesDAO = new ArticlesDAO();
                $articlesDAO->deleteArticle($artID);
            }
            header("Location: controller.php?page=list");
            exit;
        }

        function getAccess(){
            return "PROTECTED";
        }
    }

    class ArticleEdit implements ControllerAction{

        function processGET(){
            $artID = $_GET['artID'];
            $articlesDAO = new ArticlesDAO();
            $articles = $articlesDAO->getArticles();
            $article = null;

            foreach($articles as $a) {
                if($a->getArtID() == $artID) {
                    $article = $a;
                }
            }
            $_REQUEST['article']=$article;

            $topicDAO = new TopicDAO();
            $topics = $topicDAO->getTopics();
            $_REQUEST['topics']=$topics;

            return 'views/addArticle.php';

        }

        function processPOST(){
            $artID = $_POST['artID'];
            $authorID=$_POST['authorID'];
            $catID=$_POST['catID'];
            $title=$_POST['title'];
            $content=$_POST['content'];
            
            $article = new Article();
            $article->setArtID($artID);
            $article->setAuthorID($authorID);
            $article->setCatID($catID);
            $article->setTitle($title);
            $article->setContent($content);

            $articlesDAO = new ArticlesDAO();
            $articlesDAO->editArticle($article);

            $url = "Location: controller.php?page=read-" . $artID;
            header($url);
            exit;
        }

        function getAccess(){
            return "PROTECTED";
        }
    }

