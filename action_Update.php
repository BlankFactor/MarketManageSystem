<?php
    $con = mysqli_connect('localhost','root','root','web');
        
    if(!$con)
        die('could not connect : '.mysqli_error($con));

    mysqli_set_charset($con,'utf8');

    $number = $_POST['number'];
    $src = $_POST['sources'];
    $dest = $_POST['destination'];
    $date = $_POST['date'];
    $st = $_POST['start'];
    $ed = $_POST['end'];
    $pri = $_POST['price'];
    $cot = $_POST['count'];
    $sea = $_POST['seat'];

    $sql = "UPDATE flights set";
    $sql .= " sources='".$src."'";
    $sql .= ",destination='".$dest."'";
    $sql .= ",date='".$date."'";
    $sql .= ",start='".$st."'";
    $sql .= ",end='".$ed."'";
    $sql .= ",price='".$pri."'";
    $sql .= ",count='".$cot."'";
    $sql .= ",seat='".$sea."' where number=".$number;


    mysqli_query($con,$sql) or die('删除数据出错：'.mysqli_error($con)); 

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