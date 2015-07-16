<?php
  namespace classes;

  class key {
    static function check($key, $pdo) {
      $stmt = $pdo->prepare("SELECT * FROM `api_key` WHERE `key` = ?");
      $stmt->execute(array($key));
      if($stmt->rowCount() == 1) {
        return true;
      }
      return false;
    }
  }