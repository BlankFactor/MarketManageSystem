<?php
$con = mysqli_connect('localhost', 'root', 'root', 'marketmanagersystem');

if (!$con)
    die('could not connect : ' . mysqli_error($con));

mysqli_set_charset($con, 'utf8');

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$rewardrate = $_POST['rewardrate'];

$sql = "insert into produce value(";
$sql .= $id . ",'";
$sql .= $name . "',";
$sql .= $price . ",0,";
$sql .= $rewardrate . ");";

mysqli_query($con, $sql) or die('删除数据出错：' . mysqli_error($con));

// 遍历销售员ID
$sql = "select id from idendity";
$res = mysqli_query($con, $sql) or die('数据出错：' . mysqli_error($con));
while ($row = mysqli_fetch_array($res)) {
    for ($n = 1; $n <= 12; $n++) {
        $sql = "insert into marketrecord values($id,$row[0],$n ,0)";
        mysqli_query($con, $sql) or die('数据出错：' . mysqli_error($con));
    }
}

echo <<<EOT
    <form name='fr' action='admin.php' method='POST'>
    <input type='hidden' name='adminName' value='admin'>
    <input type='hidden' name='password' value='admin'>
    <input type='hidden' name='action' value='ProduceInfo'>
    </form>
    <script type='text/javascript'>
    document.fr.submit();
    </script>
    EOT;

mysqli_close($con);
