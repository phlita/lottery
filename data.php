<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Numbers</title>
  <style>
  body {
    font-family: Arial, sans-serif;
}

.container {
    width: 100%;
    max-width: 960px;
    margin: 0 auto;
}

.log-entry {
    margin: 20px 0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.result {
    background-color: #f2f2f2;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.numbers {
    font-weight: bold;
}</style>
</head>

<body>
    <div class="container">
        <?php
        // 从log文件读取内容
        $log_file = 'data.log';
        $log_contents = file_get_contents($log_file);

        // 将log内容转换为数组
        $log_data = explode("\n", trim($log_contents));
        //$log_data = array_map('json_decode', $log_data);
$log_data = array_reverse(array_map('json_decode', explode("\n", trim($log_contents))));
        // 遍历log数据
        foreach ($log_data as $entry) {
            $result = json_decode($entry->result);
            $type = $result->type;
			if ($type == 'ssq') {
    $type = '双色球'; 
} else if ($type == 'dlt') {
    $type = '大乐透';
}


            $numbers = explode("\n", trim($result->numbers));
			$ip = $entry->ip;
$ip_parts = explode('.', $ip);
$ip_parts[1] = '*';  // 用*号替换第二段
$ip_parts[2] = '*';  // 用*号替换第三段
$ip = implode('.', $ip_parts);
            ?>
            <div class="log-entry">
                <div class="result">
                    <p>Lottery : <?php echo htmlspecialchars($type); ?></p>
                    <?php foreach ($numbers as $number) { ?>
                        <p class="numbers"><?php echo htmlspecialchars($number); ?></p>
                    <?php } ?>
                </div>

                <p>Time : <?php echo htmlspecialchars($entry->date); ?></p>
                <p>Location : <?php echo htmlspecialchars($ip); ?></p>
            </div>
        <?php } ?>
    </div>
</body>

</html>