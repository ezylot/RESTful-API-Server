<?php
  require_once("auth.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <style>
      ul {
        margin: 0;
        padding: 0;
      }
      div, #developers>li{
        display: block;
        float: left;
        border: 1px solid black;
        width: 300px;
        min-height: 200px;
        margin-right: 8px;
        padding: 10px;
      }
    </style>
    <meta charset="utf-8" />
  </head>
  <body>
    <ul id="developers">
      <?php
        if(file_exists('../settings.php')){
          require '../settings.php';
        } else {
          echo "Could not find the setting file!";
          exit;
        }
        $settings =  new settings();
        $stmt = $settings->getPDO()->prepare("SELECT * FROM developer;");
        if($stmt->execute()){
          while($result_assoc = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <li>
                <h2><?php echo $result_assoc['developerID'] . " " . $result_assoc['name']; ?></h2>
                <table>
                  <tr>
                    <td style="width: 100px;">Status</td>
                    <td><?php echo $result_assoc['status']; ?></td>
                  </tr>
                  <tr>
                    <td>Rechte</td>
                    <td><?php echo $result_assoc['rights']; ?></td>
                  </tr>
                  <tr>
                    <td>Premium</td>
                    <td><?php echo $result_assoc['premium']; ?></td>
                  </tr>
                </table>
                <b style="margin: 5px; display: block;"> API Keys </b>
                <ul style="margin-left: 30px; ">
                  <?php
                    $stmt2 = $settings->getPDO()->prepare("SELECT * FROM api_key WHERE developerId = ?");
                    $stmt2->execute(array($result_assoc['developerID']));
                    while($result_assoc2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                      echo "<li style='list-style-type: disc;'>".$result_assoc2['key']."</li>";
                    }
                  ?>
                </ul>
              </li>
            <?php
          }
        } else {
          var_dump($stmt->errorInfo());
        }
      ?>
    </ul>
  <body>
</html>
