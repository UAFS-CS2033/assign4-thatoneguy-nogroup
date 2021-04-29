<?php 
   $articles = $_REQUEST['articles'];

?>
    <div class="container">
        <h1 class="display-4 my-4"><span class="text-info">All</span> Articles</h1>
            <form action="controller.php" method="GET">
            <div class="my-4">
            <?php 
                if($status == "Logged In") {
                    echo
                    "<button class='btn btn-info mb-4' type='submit' name='page' value='list-yours'>Edit Your Articles</button>
                    <button class='btn btn-success mb-4' type='submit' name='page' value='add'>Add Article</button>";
                }
            ?>
                    <?php

                        for($index=0; $index<count($articles); $index++){
                          
                            echo "<div class='card border-primary'><div class='card-header'>";
                            echo "<button class='btn btn-primary float-right' type='submit' name='page' value='read-" . $articles[$index]->getArtID() . "'>Read More</button>";
                            echo "<div class='float-left'><h3 class='card-title text-primary'>" . $articles[$index]->getTitle() . "   -   <span class='text-info'>" . $articles[$index]->getLastModified() ."</span></h3><h5>Author: " . $articles[$index]->getAuthorName() . "</h5><h5>Topic: " . $articles[$index]->getCatName();
                            echo "</h5></div></div>";
                            echo "<div class='card-body'>";
                            echo "<p class='card-text' style='font-size: 1.2rem'>" . substr($articles[$index]->getContent(), 0,20). "...</p></div>";
                            echo "</div>";                        
                        }
                    ?>
            </div>
 
            </form>
 
    </div>