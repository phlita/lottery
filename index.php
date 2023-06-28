<?php 
require 'lottery.php';
if (isset($_POST['submit'])) {
    $num = $_POST['num'];
    $type = $_POST['type'];
 if ($type == 'ssq') {
        $result = ssq($num);
    } elseif ($type == 'dlt') {
        $result = dlt($num);
    } else {
        $type = 'powerball';
        $result = powerball($num);
    }
//print_r ($result);
$output = '';
/*foreach ($result as $value) {
        foreach ($value as $key => $ball) {
           if ($key!= $ballCount) {
                $output.= sprintf("%02d", $ball) . ' ';
            } else {
                $output.= '- <span id="back">' . sprintf("%02d", $ball) . '</span> ';
            }	
        }
        $output.=  "<br>";
    }    
	echo '<div>' . $output . '</div>';
*/
foreach ($result as $value) {
    foreach ($value as $key => $ball) {
		 if ($type == 'powerball' && $key == 5) {
                $output .= sprintf('<span style="color: blue;">%02d</span> ', $ball);
            }elseif ($type == 'ssq' && $key == 6) {
            $output .= sprintf('<span style="color: blue;">%02d</span> ', $ball);
 } elseif ($type == 'dlt' && $key >= 5) {
            $output .= sprintf('<span style="color: blue;">%02d</span> ', $ball);
 } else {  $output .= sprintf('<span style="color: red;">%02d</span> ', $ball); 
 }    }    $output .=  "<br>"; }

$output_orig = $output;   

$output = str_replace('<span style="color: red;">', '', $output);  
$output = str_replace('</span>', '', $output);
$output = str_replace('<span style="color: blue;">', '', $output);
$output = str_replace('<br>', "\n", $output);  

$output_content = $output;   
$output = $output_orig;      

$filecontent = "Lottery:$type\nTime:" . date('Y-m-d H:i:s') . "\nLocation:" . $_SERVER['REMOTE_ADDR'] . "\nNumbers:\n$output_content";
 

$file = fopen("ok.log", "w") or die("failed open!");  
fwrite($file, $filecontent);  
fclose($file);  
$msg = "Temporary saved";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Numbers</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<center>
    <h1>Lucky Numbers</h1>
    <form method="post" action="">
<label>Lottery Type : </label>
<select name="type">
<option value="powerball">Powerball</option>
    <option value="ssq">双色球</option>
    <option value="dlt">大乐透</option>
</select>

        <label>Quantity : </label>
        <input type="number" name="num" value="1" min="1" max="99">
        <input type="submit" name="submit" value="Generate">
    </form>
<?php if (isset($output)) echo '<div>' . $output . '</div>'; ?>
<?php if (isset($msg)) echo '<div>' . $msg . '</div>'; ?>
<label><input type="radio" name="downloadOption" value="download" checked>Download</label>
<label><input type="radio" name="downloadOption" value="save">Share</label>
<button onclick="downloadOrSave()">Confirm</button>
<script>
function downloadOrSave() {
  var downloadOption = document.querySelector('input[name="downloadOption"]:checked').value;
  if (downloadOption === 'save') {
    saveResult();
  } else {
    downloadResult();
  }
}

function saveResult() {
document.getElementById('message').innerHTML = "Sharing...";
 var result = {
  type: '<?php if (isset($type)) echo $type; ?>',
  numbers: document.querySelector('div').innerText,
};
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "save.php");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
   xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('message').innerHTML = '<a href="data.php">Check sharing</a>';
        }
    };
xhr.send("result=" + JSON.stringify(result));

}

function downloadResult() {
  var downloadLink = document.createElement('a');
  downloadLink.href = 'down.php';
  downloadLink.click();
}
</script>
<div id="message"></div>
</center>
</body>
</html>