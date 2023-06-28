<?php
$result = $_POST['result'];
$date = date('Y-m-d H:i:s');

// 获取生成IP
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (isset($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
} else {
    $ip = 'unknown';
}

$data = array(
    'result' => $result,
    'date' => $date,
    'ip' => $ip,

);

// 保存结果到文件
$file = 'data.log';
$fp = fopen($file, 'a');
if ($fp) {
    fwrite($fp, json_encode($data) . "\n");
    fclose($fp);
}

header('Content-Type: application/json');
echo json_encode(array('message' => 'Save succeeded'));

?>
