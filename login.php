<?php
require_once("starter.php");

if($user->signed){
  if($user->isAdmin()) {
    header("Location: grade.php");
  } else {
    header("Location: stats.php");
  }
}

/// login
if(isset($_POST['username']) and isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(isset($_POST['auto'])) {
    $auto = $_POST['auto'];
  } else {
    $auto = false;
  }

  $user->login($username,$password,$auto);

  if($user->signed){
    if($user->isAdmin()) {
      header("Location: grade.php");
    } else {
      header("Location: stats.php");
    }
  }
}
///
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- <link rel="shortcut icon" href="/assets/ico/favicon.png"> -->

    <title>Войти в betterNESs</title>

    <link href="/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/bootstrap/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
<?php
if ($user->has_error() and isset($_POST['username'])) {
  foreach($user->error() as $err){
?>
<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Что-то не так!</strong> Ошибка: <?php echo $err?>.
</div>
<?php
  }
}
?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Войдите</h2>
        <input name="username" type="text" class="form-control" placeholder="Имя пользователя" autofocus>
        <input name="password" type="password" class="form-control" placeholder="Пароль">
        <label class="checkbox">
          <input name="auto" type="checkbox" value="remember-me"> Запомнить меня
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
      </form>

    </div>

    <hr>
    <footer class="container">
      <p>&copy; thermatk 2013</p>
    </footer>

    <script src="vendor/jquery-1.10.2.min.js"></script>
    <script src="vendor/bootstrap/bootstrap.min.js"></script>
  </body>
</html>