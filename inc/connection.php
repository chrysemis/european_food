<?php 
try {
	$db = new PDO("mysql:host=localhost;dbname=european_food; port=3306", "root", "");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	echo "Unable to connect.";
	echo $e->getMessage();
	exit;
}

