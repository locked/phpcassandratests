<?php
require 'vendor/autoload.php';

# 108.61.208.112	cassandra1
# 108.61.208.213	cassandra2
# 108.61.123.186	cassandra3

$nodes = ['108.61.208.112', '108.61.208.213', '108.61.123.186'];

$database = new evseevnn\Cassandra\Database($nodes, 'boum');
$database->connect();
$data = $database->query('SELECT * FROM data WHERE ts > :mints AND ts < :maxts', ['mints' => 1310702176, 'maxts' => 1410702176]);
var_dump($data);

