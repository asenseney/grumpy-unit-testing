<?php

$db = new \PDO('mysql:host=localhost;dbname=liesitoldmykids', 'root', '');
$sql = 'SELECT * FROM lies ORDER BY entry_date DESC';
$statement = $db->prepare($sql);
$statement->execute(option_array());
$statement->fetch();
$statement->fetchAll();
$statement->rowCount();
