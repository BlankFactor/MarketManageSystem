<?php
$con = mysqli_connect('localhost','root','root','MarketManagerSystem');

if(!$con)
    die('could not connect : '.mysqli_error($con));

mysqli_set_charset($con,'utf8');

$id = $_POST['ID'];
$name = $_POST['Name'];

$sql = "INSERT into idendity values($id".",'$name',0,0)";
mysqli_query($con,$sql) or die('数据出错：'.mysqli_error($con));  

$sql2 = "select id from produce";
$result = mysqli_query($con,$sql2);
mysqli_query($con,$sql2) or die('数据出错：'.mysqli_error($con));  
while($row = mysqli_fetch_array($result)){
    for($n=1;$n<=12;$n++){
        $sql3 = "INSERT into marketrecord values(".$row['id'].",".$id.",$n ,0)";
        mysqli_query($con,$sql3) or die('数据出错：'.mysqli_error($con));  
    }
}



echo <<<EOT
<form name='fr' action='admin.php' method='POST'>
    <input type='hidden' name='adminName' value='admin'>
    <input type='hidden' name='password' value='admin'>
    <input type='hidden' name='action' value='EmeInfo'>
</form>
<script type='text/javascript'>
    document.fr.submit();
</script>
EOT;

mysqli_close($con);
?>

