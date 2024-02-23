<?php
print_r($_POST);
$tableArray = array(1 => 'users', 2 => 'first_name');

$table = $tableArray[$_POST['table']];
echo 'table = ' . $table;
// UPDATE table SET col = ? WHERE id = ?
    // id
 ?>