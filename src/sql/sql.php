<?php 

require './config.php';

$host = $config['sql_host'];
$db = $config['sql_db'];
$username = $config['sql_user'];
$password = $config['sql_pass'];

try {
  $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

function query($sql, $array=array()) {
  global $conn;
  $q = $conn->prepare($sql);
  $q->execute($array);

  return $q;
}

function fetch($sql, $array=array()) {
  global $conn;
  $q = $conn->prepare($sql);
  $q->execute($array);
  $f = $q->fetchAll(PDO::FETCH_ASSOC);

  return $f;
}

function fetchs($sql, $array=array()) {
  global $conn;
  $q = $conn->prepare($sql);
  $q->execute($array);
  $fs = $q->fetch(PDO::FETCH_ASSOC);

  return $fs;

}

?>