<?php

include_once './Apified.php';

$api = new Apified\Core([
    "url.enabled" => true,
    "url.actionRequired" => true
]);
$ac = new Apified\Actions();

function helloWorld($params)
{
    echo "Hello " . $params['name'] . "!";
}

$ac->get('helloWorld', 'helloWorld', ['name']);

$api->init();
