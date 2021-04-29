<?php 
  if(isset($_REQUEST['user'])) {
    $user = $_REQUEST['user'];
    $articles = $_REQUEST['articles'];
    $comments = $_REQUEST['comments'];
  } else {
    $user = null;
  }
?>
<main class="container">
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4"><span class="text-info">ThatOneGuy's Blog: Platform of the People</span></h1>
    <p class="lead">Built by Mario Garcia</p>

<?php if(is_null($user)) {
  echo 
  ' <form form action="controller.php" method="GET"> <div class="row mb-2">
    <div class="col col-sm-3">
      <div class="card mb-4 shadow-sm">

      <div class="card-body py-5">
        <h3 class="card-title pricing-card-title">No account, but want one? No Problem.</h3>
       
        <ul class="list-unstyled mt-3 mb-4">
          <li>Free to signup</li>
          <li>No hassle, no unnessary forms to fill</li>
          <li>Very active community (well, soon...)</li>

        </ul>
      
        <button type="submit" class="w-100 btn btn-lg btn-info" name="page" value="signup">Sign up for free</button>
        
      </div>
    </div>
    </div>
    <div class="col col-sm-9">
      <div class="card mb-4 shadow-sm">
      <div class="card-body py-5">
        <h1 class="card-title pricing-card-title">Create, Read, Update, Delete</h1>
        <p style="font-size: 1.5rem">The platform created by people like you, for people like you. Take advantage of reading articles of high relevance, 
        write your own for others to read, and leave feedback for the content creators.</p>
        <button type="submit" class="w-100 btn btn-lg btn-success" name="page" value="list">Get Reading</button>
      </div>
    </div>
    </div>
    </div>
  </div></form>';
} else {
  echo
  '<div class="row mb-2">
    <div class="col col-sm-6">
      <div class="card mb-4 shadow-sm">
        <div class="card-body py-5">
          <h1 class="card-title pricing-card-title">Account Info:</h1>
          <ul class="list-unstyled mt-3 mb-4" style="font-size: 1.4rem">
            <li><h2><span class="text-info">First Name :</span> ' . $user->getFirstname() . '</h2></li>
            <li><h2><span class="text-info">Last Name :</span> ' . $user->getLastname() . '</h2></li>
            <li><h2><span class="text-info">Email :</span> ' . $user->getEmail() . '</h2></li>
        </ul>
        </div>
      </div>
    </div>

    <div class="col col-sm-6">
      <div class="card mb-4 shadow-sm">
        <div class="card-body py-5">
          <h1 class="card-title pricing-card-title">Your Activity</h1>
          <ul class="list-unstyled mt-3 mb-4" style="font-size: 1.4rem">
              <li><h2><span class="text-success">Articles Written: </span>' . count($articles) . '</h2></li>
              <li><h2><span class="text-success">Comments Shared: </span>' . count($comments) . '</h2></li>
          </ul>
        </div>
      </div>
  </div>
  </div>';
}
  ?>
</main>
