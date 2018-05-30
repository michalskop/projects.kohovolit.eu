<?php
$arr = [
    date("Y-m-d H:i:s"),
    json_encode($_GET)
];
$file = fopen('log.csv','a');
fputcsv($file,$arr);
fclose($file);
?>
