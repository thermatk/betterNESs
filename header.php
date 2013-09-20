<?php
require_once("starter.php");
if(!($user->signed)) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- <link rel="shortcut icon" href="/assets/ico/favicon.png"> -->

    <title>BetterNESs</title>

    <link href="/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/bootstrap/navbar-fixed-top.css" rel="stylesheet">
  </head>

  <body>

    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">BetterNESs</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
<?php
require_once("pagelist.php");
foreach ($pagelist as $onepage) {
  if($onepage[2] and !($user->isAdmin())) {
      continue;
  }
  $active='';
  if($onepage[0]==$page) {
    $active="class='active'";
  }
  echo '<li '.$active.'><a href="/'.$onepage[0].'.php">'.$onepage[1].'</a></li>';
}
?>

          </ul>
          <p class="navbar-text pull-right">
            <a href="/logout.php" class="navbar-link">Выйти из <?php echo $user->username;?></a>
          </p>
        </div><!--/.nav-collapse -->
      </div>
    </div>
        
    <div id="maincontainer" class="container">