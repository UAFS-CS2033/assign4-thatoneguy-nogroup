<?php 
   $article = $_REQUEST['article'];
//    $comments = $_REQUEST['comments'];
?>
<main class="container">
    <div class="card my-4">
        <div class="card-body">
        <h1 class="card-title display-4"><?php echo $article->getTitle(); ?></h1>
        <ul class="list-unstyled text-info">
            <li style="font-size: 1.2rem">Author: <?php echo $article->getAuthorName() ?></li>
            <li style="font-size: 1.2rem">Topic: <?php echo $article->getCatName() ?></li>
            <li style="font-size: 1.2rem">Written On: <?php echo $article->getLastModified() ?></li>
        </ul>
        <p class="card-text" style="font-size: 1.3rem"><?php echo $article->getContent(); ?></p>
        </div>
    </div>

    <div><br>
        <h2 class="my-4">Comment Section (<span id="comments-num" class="text-info"></span>):</h2>

       
        <?php if($status == 'Logged In') {
            echo
            '<form id="comment-form">
            <h3>Enter a comment:</h3>
                <input type="hidden" id="artID" name="artID" value="' . $article->getArtID() . '"/>
                <input type="hidden" id="authorID" name="authorID" value="' . $_SESSION['user'] . '"/>
                <input type="textarea" class="form-control" id="content" name="content" placeholder="Enter comment..." required />
                <button class="btn btn-info my-4" type="submit">Reply</button>
            </form>';
        } else {
            echo '<form action="controller.php" method="POST">';
            echo '<input type="hidden" id="artID" name="artID" value="' . $article->getArtID() . '"/>';
            echo "<h5>Don't be a lurker. Share your opinion <span><button class='btn btn-success my-4' type='submit' name='page' value='login'>Login</button></span></h5>";
            echo '</form>';
        }
        ?>
  

        <?php 
            // foreach($comments as $comment) {
            //         echo "<div class='card my-4'>";
            //             echo "<div class='card-body'>";
            //             echo "<h4>" . $comment->getAuthorName(). "   -   <span class='text-info'>" . $comment->getLastModified() ."</span>:</h4><br>";
            //             echo "<p class='card-text' style='font-size: 1.2rem'>" . $comment->getContent() . "</p></div>";
                      
            //         echo "</div>";
            echo '<button id="refresh" class="btn btn-primary">Refresh Comments</button><div id="message"></div><div id="comments-list"></div>';
        ?>
    </div>
</main>
<script src="views/comments.js"></script>