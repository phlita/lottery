<?php
$file = 'ok.log'; 
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="500.txt"');
readfile($file);
exit;
?>
