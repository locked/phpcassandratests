<?php
require 'vendor/autoload.php';

# 108.61.208.112	cassandra1
# 108.61.208.213	cassandra2
# 108.61.123.186	cassandra3

$nodes = ['108.61.208.112', '108.61.208.213', '108.61.123.186'];
//$nodes = ['108.61.208.213', '108.61.208.112'];

$database = new evseevnn\Cassandra\Database($nodes, 'boum');
$database->connect();

$maxi = 99999999;
$types = ["type1", "type2", "type3", "type4"];
for( $i = 0; $i < $maxi; $i++ ) {
	$uid = rand(1, 100);
	$ts = intval(microtime(true) * 1000);
	if( $i%5000 == 0 ) {
		$p = round(($i / $maxi) * 100, 2);
		echo $p."%\n";
	}
	//echo $ts."\n";
	$type = $types[rand(1, 3)];
	$value = rand(1, 100);
	$data = $database->query('INSERT INTO data (uid, ts, type, value) VALUES (:uid, :ts, :type, :value)', ['uid' => $uid, 'ts' => $ts, 'type' => $type, 'value' => $value], evseevnn\Cassandra\Enum\ConsistencyEnum::CONSISTENCY_ONE);
}
var_dump($data);

