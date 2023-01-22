<?php

include_once './Apified.php';

$api = new Apified\Core([]);
$ac = new Apified\Actions();

function helloWorld($params)
{
    echo "Hello " . $params['name'] . "!";
}

$ac->get('helloWorld', 'helloWorld', ['name']);

$ac->exec('helloWorld');

$api->init();
