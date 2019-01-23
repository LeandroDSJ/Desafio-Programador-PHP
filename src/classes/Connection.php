<?php
class Connection {

  CONST HOST = '127.0.0.1';
  CONST DBNAME = 'sis_vendas';
  CONST USER = 'root';
  CONST PASSWORD = 'vertrigo';

  private $con;

  public static function getConnection() {
    try {
      $con = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DBNAME, self::USER, self::PASSWORD);
      return $con;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
