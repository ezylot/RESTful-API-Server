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
  if($stmt->execute(array($username))){
    $result_assoc = $stmt->fetch(PDO::FETCH_ASSOC);

    if(password_verify($passwort, $result_assoc['password'])){
      $_SESSION['angemeldet'] = true;
    }
  }
  header('Location: index.php');
  exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
  <title>Geschützter Bereich</title>
</head>
<body>
  <form action="login.php" method="post">
    Username: <input type="text" name="username" /><br />
    Passwort: <input type="password" name="passwort" /><br />
    <input type="submit" value="Anmelden" />
  </form>
</body>
</html>
