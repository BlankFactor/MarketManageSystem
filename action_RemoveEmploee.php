<?php
$con = mysqli_connect('localhost','root','root','marketmanagersystem');

if(!$con)
    die('could not connect : '.mysqli_error($con));

mysqli_set_charset($con,'utf8');

$id = $_GET['number'];

mysqli_query($con,"DELETE FROM idendity WHERE id=$id") or die('删除数据出错：'.mysqli_error($con)); 

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

