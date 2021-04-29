<?php 
    if(isset($_REQUEST['article'])) {
        $article = $_REQUEST['article'];
    }

    $userID = $_SESSION['user'];
    $topics = $_REQUEST['topics'];

?>
    <div class="container my-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <?php if(isset($article)) {
                            echo "<h5 class='card-title'>Edit Article</h5>";
                        } else {
                            echo "<h5 class='card-title'>Add Article</h5>";   
                        }
                        ?>
                        <form action="controller.php" method="POST">
                            <?php if(isset($article)) {
                                echo '<input type="hidden" name="artID" value="' . $article->getArtID() . '">';
                                echo '<input type="hidden" name="page" value="edit">';
                            } else {
                                echo '<input type="hidden" name="page" value="add">';
                            };
                            ?>

                            <input type="hidden" class="form-control mb-3" id="authorID" name="authorID" value="<?php echo $userID ?>" required>
                        
                            <label for="title" class="form-label">Title:</label>
                            <?php echo 
                                "<input 
                                    type='text'
                                    class='form-control mb-3' 
                                    id='title' 
                                    placeholder='Enter title'
                                    name='title'
                                    required "
                            ?>
                            <?php 
                                if(isset($article)) { 
                                    echo "value='" . $article->getTitle() . "'"; 
                                } else {
                                    "value=''";
                                }
                            ?>

                            <label for="content" class="form-label">Content:</label>
                            <?php echo 
                                "<input 
                                    type='textarea'
                                    class='form-control mb-3' 
                                    id='content' 
                                    placeholder='Type content'
                                    name='content'
                                    required "
                            ?>
                            <?php 
                                if(isset($article)) { 
                                    echo "value='" . $article->getContent() . "'"; 
                                } else {
                                    "value=''";
                                }
                            ?>

                            <label for="content" class="form-label">Topic:</label><br><br>
                            <?php 


                                foreach($topics as $topic) {
                                    echo "<div class='row'>";
                                    echo "<div class='col'><input ";
                                    if(isset($article)) {
                                        if($article->getCatID() == $topic->getTopID()) {
                                            echo "checked ";
                                        }
                                    }
                                    echo "type='radio' name='catID' value='".$topic->getTopID()."' class='col'>";
                                    echo "<p>" . $topic->getName() . "</p></div>";
                                    echo "</div>";
                                }  
                                
                                echo "<button type='submit' class='btn btn-primary'>Submit</button>";
                            ?>
                                    
                
                        </form>
                                                
<!-- 
                        <label for='image' class='form-label'>Image</label>
                                <input type='text' class='form-control mb-3' id='image'  name='image' placeholder='Enter image' required>

                                <label for='content' class='form-label'>Content</label>
                                <input type='textarea' class='form-control mb-3' id='content'  name='content' placeholder='Enter content' required>

                                <button type='submit' class='btn btn-primary'>Submit</button> -->
                    </div>
                </div>      
            </div>
        </div>
    </div>
