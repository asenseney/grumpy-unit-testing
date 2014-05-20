<?php 

$db = new \PDO('mysql:host=localhost;dbname=liesitoldmykids', 'root', '');
$sql = 'SELECT * FROM lies ORDER BY entry_date DESC';
$result = $db->prepare($sql);
$result->execute(option_array());
$result->fetch();
$result->fetchAll();
$result->rowCount();
