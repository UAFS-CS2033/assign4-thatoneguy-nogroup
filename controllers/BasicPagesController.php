
<?php
    include "models/UserDAO.php";

    class Login implements ControllerAction{

        function processGET(){
            return "views/login.php";
        }

        function processPOST(){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $userDAO = new UserDAO();

            $found=$userDAO->authenticate($username,$password);
            if($found==null){
                $nextView="Location: controller.php?page=login";
            }else{
                $userID = -1;
                $users = $userDAO->getUsers();
                
                foreach($users as $u) {
                    if(strToLower($u->getUsername()) == strTolower($username)) {
                        $userID = $u->getUserID();
                    }
                }
                $nextView="Location: controller.php?page=list";
                $_SESSION['loggedin']='TRUE';
                $_SESSION['user'] = $userID;
               
            }
            header($nextView);
            exit;       
        }
        function getAccess(){
            return "PUBLIC";
        }
    }

    class Signup implements ControllerAction{

        function processGET(){
            return "views/signup.php"; 
        }

        function processPOST(){
            $username=$_POST['username'];
            $firstname=$_POST['firstname'];
            $lastname=$_POST['lastname'];
            $email=$_POST['email'];
            $role = 'author';
            $password=$_POST['password'];
            $password2=$_POST['password2'];

            if($password !== $password2) {
                $alert = 'Passwords must match';
                $nextView = "Location: controller.php?page=signup";
                header($nextView);
            } else {
                $user = new User();
                $user->setUsername($username);
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setRole($role);
                $userDAO = new UserDAO();
                $userDAO->addUser($user);

                $found=$userDAO->authenticate($username,$password);
                if($found==null){
                    $nextView="Location: controller.php?page=signup";
                }else{
                    $userID = -1;
                    $users = $userDAO->getUsers();
                
                    foreach($users as $u) {
                        if(strToLower($u->getUsername()) == strTolower($username)) {
                            $userID = $u->getUserID();
                        }
                    }
                }
  
                $nextView="Location: controller.php?page=list";
                $_SESSION['loggedin']='TRUE';
                $_SESSION['user'] = $userID;
               
            }

            header($nextView);
            exit;
        }

        function getAccess(){
            return "PUBLIC";
        }

    }
    class Logout implements ControllerAction{

        function processGET(){
            $nextView="Location: controller.php?page=home";
            session_unset();
            header($nextView);
            exit;       
        }

        function processPOST(){
            return;
        }

        function getAccess(){
            return "PROTECTED";
        }

    }
    

    class Home implements ControllerAction{

        function processGET(){
            if(isset($_SESSION['loggedin']) && isset($_SESSION['user'])) {
                $userID = $_SESSION['user'];
                $userDAO = new UserDAO();
                $users = $userDAO->getUsers();

                foreach($users as $u) {
                    if($u->getUserID() == $userID) {
                        $user = $u;
                    }
                }

                $articlesDAO = new ArticlesDAO();
                $articles= $articlesDAO->getArticles();

                foreach($articles as $a) {
                    if($a->getAuthorID() == $userID) {
                        $filteredArticles[] = $a;
                    }
                }

                $commentsDAO = new CommentDAO();
                $comments= $commentsDAO->getComments();

                foreach($comments as $c) {
                    if($c->getAuthorID() == $userID) {
                        $filteredComments[] = $c;
                      
                    }
                }
                $_REQUEST['articles'] = $filteredArticles;
                $_REQUEST['comments'] = $filteredComments;
                $_REQUEST['user'] = $user;
                return "views/home.php";
            }
            return "views/home.php";
        }

        function processPOST(){
            return;
        }

        function getAccess(){
            return "PUBLIC";
        }

    }

    class About implements ControllerAction{

        function processGET(){
            return "views/about.php";
        }

        function processPOST(){
            return;
        }

        function getAccess(){
            return "PUBLIC";
        }

    }
    ?>