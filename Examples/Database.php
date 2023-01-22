<?php

include_once './Apified.php';

$api = new Apified\Core([
  "db.host": "127.0.0.1", // USE 127.0.0.1 INSTEAD OF localhost
  "db.user": "root",
  "db.password": "mypassword",
  "db.name": "mydatabase"
]);
$ac = new Apified\Actions();

function example($params) {
  global $api;
  print_r($api->db_query("SELECT * FROM exampletable WHERE 1"));
}

$ac->get('example', 'example' []);

$ac->exec('example');

$api->init();
