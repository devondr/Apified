<?php

include_once './Apified.php';
include_once './Main.php';

$api = getApi();
$ac = new Apified\Actions();

function HelloWorld($params) {
  echo 'Hello World!';
}

$ac->get('HelloWorld', 'HelloWorld', []);

$api->init();
