<?php 
   $article = $_REQUEST['article'];
?>
    <div class="container">
        <div class="row my-5 p-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-info">Delete Article</h1>
                        <h3 class="card-text">Confirm Deletion of Article:<?php echo $article->getTitle() ?></h3>
                        <form action="controller.php" method="POST">
                            <input type="hidden" name="page" value="delete">
                            <input type="hidden" id="artID" name="artID" value="<?php echo $article->getArtID() ?>">
                            <button class="btn btn-danger" type="submit" name="submit" value="CONFIRM" >Confirm</button> 
                            <button class="btn btn-primary" type="submit" name="submit" value="CANCEL" >Cancel</button>   
                        </form>
                    </div>
                </div>      
            </div>
        </div>
    </div>

