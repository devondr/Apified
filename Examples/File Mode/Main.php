<?php

include_once './Apified.php';

$api = new Apified\Core([]);

function getApi() {
  global $api;
  return $api;
}
