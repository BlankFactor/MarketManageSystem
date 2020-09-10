<?php
$con = mysqli_connect('localhost','root','root','marketmanagersystem');

if(!$con)
    die('could not connect : '.mysqli_error($con));

mysqli_set_charset($con,'utf8');

$sql = "update produce set total = 0";
mysqli_query($con,$sql);

$sql = "update idendity set markingtotal=0,markingcount=0";
mysqli_query($con,$sql);

$sql = "update marketrecord set total=0";
mysqli_query($con,$sql);

echo <<<EOT
<form name='fr' action='admin.php' method='POST'>
    <input type='hidden' name='adminName' value='admin'>
    <input type='hidden' name='password' value='admin'>
</form>
<script type='text/javascript'>
    document.fr.submit();
</script>
EOT;

mysqli_close($con);
?>

