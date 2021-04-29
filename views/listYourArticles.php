<?php 
   $articles = $_REQUEST['articles'];
   $user = $_REQUEST['user'];
?>
    <div class="container">
            <?php echo "<h1 class='display-4 my-4'><span class='text-info'>" . $user->getUsername() . "'s</span> Articles</h1>" ?> 
   
            <form action="controller.php" method="GET">
            
            <?php if($status == "Logged In") {
                echo "<button class='btn btn-primary' type='submit' name='page' value='add'>Add Article</button>";
                if(!is_null($articles) && count($articles) > 0) {
                    echo "<button class='btn btn-danger float-right' type='submit' name='page' value='delete'>Delete</button>";
                    echo "<button class='btn btn-info float-right' type='submit' name='page' value='edit'>Edit</button>";
                }
            } ?>

            <div class="my-4">
                    <?php
                        if(count($articles) == 0 || $articles == null || !isset($articles)) {
                            echo "<h1>You have no articles</h1>";
                        } else {
                        for($index=0; $index<count($articles); $index++){
                            echo "<div class='card border-primary'><div class='card-header'>";
                                if(($status == "Logged In") && ($_SESSION['user'] == $articles[$index]->getAuthorID())) {
                                    echo "<h2 class='float-right'><input type='radio' name='artID' value='" .$articles[$index]->getArtID(). "'></h2>";
                                } 
                            echo "<h5 class='card-title text-primary float-left'>" . $articles[$index]->getTitle() . "   -   <span class='text-info'>" . $articles[$index]->getLastModified() . " </span><br> Author: " . $articles[$index]->getAuthorName() . " <br> Topic: " . $articles[$index]->getCatName();
                            echo "</h5></div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='font-size:1.2' rem>" . substr($articles[$index]->getContent(), 0,20). "...</p></div>";
                              echo "</div>";                       
                        }
                    }
                    
                    ?>
            </div>
 
            </form>
 
    </div>