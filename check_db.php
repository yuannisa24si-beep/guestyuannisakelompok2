<?php
$con = new PDO('mysql:host=localhost;dbname=project_kel2', 'root', '');
$tables = $con->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
foreach($tables as $t) {
    $count = $con->query('SELECT COUNT(*) FROM ' . $t)->fetchColumn();
    echo $t . ': ' . $count . " records\n";
}
