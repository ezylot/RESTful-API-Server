<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  session_start();

  $username = $_POST['username'];
  $passwort = $_POST['passwort'];

  $hostname = $_SERVER['HTTP_HOST'];
  $path = dirname($_SERVER['PHP_SELF']);


  if(file_exists('../settings.php')){
    require '../settings.php';
  } else {
    echo "Could not find the setting file!";
    exit;
  }
  $settings =  new settings();
  $stmt = $settings->getPDO()->prepare("SELECT * FROM users WHERE username = ?");

  $ret = "";

  if($stmt->execute(array($username))) {
    $result_assoc = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result_assoc != false) {
      if(password_verify($passwort, $result_assoc['password'])) {
        $_SESSION['angemeldet'] = true;
        $ret = "success";
      } else {
        $ret = "wrongCombination";
      }
    } else {
      $ret = "wrongCombination";
    }
  } else {
    $ret = "wrongCombination";
  }
  header('Location: index.php?status='.$ret);
  exit;
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />

  <title>Geschützter Bereich</title>
</head>
<body>
  <div class="container">
    <div class="page-header">
      <h1>Adminbereich <small>Login</small></h1>
    </div>
    <form action="login.php" method="post">
    <div class="table-responsive table-condensed">
      <table class="table table">
        <thead>
        </thead>
        <tbody>
          <tr>
            <td>Username</td>
            <td><input type="text" name="username" /></td>
          </tr>
          <tr>
            <td>Passwort</td>
            <td><input type="password" name="passwort" /></td>
          </tr>
        </tbody>
      </table>
    </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>
