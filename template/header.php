<?php
  if(isset($_SESSION['loggedin'])){
    $status="Logged In";
    $class="disabled";
    $logoutVis = "";
  }else{
    $status="Login";
    $class="";
    $logoutVis = "disabled";
  }
?>
 
  <header>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">ThatOneGuy's Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="controller.php?page=home">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="controller.php?page=about">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="controller.php?page=list">Read All</a>
        </li>

        <?php 
          if($status == "Logged In") {
            echo 
            '<li class="nav-item">
            <a class="nav-link" href="controller.php?page=list-yours">Read Yours</a>
          </li>';
          }
        ?>
      
        <!-- <li class="nav-item">
          <a class="nav-link <?php echo $class; ?>" href="controller.php?page=login"><?php echo $status; ?></a>
        </li> -->


        <?php 
          if($status != "Logged In") {
            echo 
            '<li class="nav-item">
              <a class="nav-link" href="controller.php?page=login">Login</a>
            </li>';
          }
        ?>
        

        <?php 
          if($status == "Logged In") {
            echo 
            '<li class="nav-item">
              <a class="nav-link" href="controller.php?page=logout">Logout</a>
            </li>';
          } else {
            echo 
            '<li class="nav-item">
              <a class="nav-link" href="controller.php?page=signup">Sign Up</a>
            </li>';
          }
        ?>

      </ul>

    </div>
    </div>
  </nav>
  
</header>