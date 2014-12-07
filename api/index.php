<?php
  session_start();

  if(file_exists('../vendor/autoload.php')){
    require '../vendor/autoload.php';
  } else {
    echo "<h1>Please install via composer.json</h1>";
    echo "<p>Install Composer instructions: <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
    echo "<p>Once composer is installed navigate to the working directory in your terminal/command promt and enter 'composer install'</p>";
    exit;
  }

  if(file_exists('../settings.php')){
    require '../settings.php';
  } else {
    echo "Could not find the setting file!";
    exit;
  }

  header("Access-Control-Allow-Orgin: *");
  header("Access-Control-Allow-Methods: *");
  header("Content-Type: application/json");
  
  $settings =  new settings();

  if(!isset($_REQUEST['key']) || !\classes\key::check($_REQUEST['key'], $settings->getPDO()))
    die(json_encode(array("status" => "Failure", "data" => "You must use a valid API Key")));

  $request  = explode('/', rtrim($_REQUEST['request'], '/'));
  $model = array_shift($request);
  try {
    if(!empty($model)) {
      $model = "\\model\\". $model;
      $obj = new $model($request);
      echo $obj->processAPI();
    } else {
      echo json_encode(array("status" => "Failure", "data" => "No model specified."));
    }
  } catch (Exception $ex) {
    echo json_encode(Array('error' => $ex->getMessage()));
  }
?>
