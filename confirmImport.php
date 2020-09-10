<?php
    $con = mysqli_connect('localhost','root','root','marketmanagersystem');
        
    if(!$con)
        die('could not connect : '.mysqli_error($con));

    mysqli_set_charset($con,'utf8');

    $eid = $_POST['eid'];
    $pid = $_POST['pid'];
    $count = $_POST['count'];
    $month = $_POST['month'];

    $sql = "select price from produce where id=$pid";
    $row = mysqli_fetch_row(mysqli_query($con,$sql));
    $price = $row[0];

    $sql = "UPDATE idendity set markingtotal=markingtotal+$count,markingcount=markingcount+$count*$price where id=$eid";
    mysqli_query($con,$sql) or die('数据出错：'.mysqli_error($con)); 

    $sql = "UPDATE marketrecord set total=total+$count where E_ID=$eid and p_id=$pid and month=$month";
    mysqli_query($con,$sql) or die('数据出错：'.mysqli_error($con)); 

    $sql = "UPDATE produce set total=total+$count where id=$pid";
    mysqli_query($con,$sql) or die('数据出错：'.mysqli_error($con)); 

    echo <<<EOT
    <form name='fr' action='importData.php'>
    </form>
    <script type='text/javascript'>
    document.fr.submit();
    </script>
    EOT;

    mysqli_close($con);
?>