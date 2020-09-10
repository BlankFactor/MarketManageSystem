<?php
    $con = mysqli_connect('localhost','root','root','marketmanagersystem');
        
    if(!$con)
        die('could not connect : '.mysqli_error($con));

    mysqli_set_charset($con,'utf8');

    $sql = "select id from produce";
    $res_pid = mysqli_query($con,$sql);

    $eid = $_POST["eid"];
    $month = $_POST["month"];

    while($pid = mysqli_fetch_array($res_pid)){
        $total = $_POST["$pid[0]"];
        $sql = "UPDATE marketrecord set total = $total where month=$month and e_id=$eid and p_id=$pid[0]";
        mysqli_query($con,$sql);
    }

    // 根据销售记录表 统计更新个人销售记录
    $total = 0;
    $totalEarnning = 0;

    // 遍历产品
    $sql = "select id from produce";
    $res_pid = mysqli_query($con,$sql);

    while($pid = mysqli_fetch_array($res_pid)){
        $sql = "select sum(total) from marketrecord where e_id=$eid and p_id=$pid[0]";
        $ptotal = mysqli_fetch_row(mysqli_query($con,$sql))[0];

        $sql = "select price from produce where id=$pid[0]";
        $price = mysqli_fetch_row(mysqli_query($con,$sql))[0];

        $total += $ptotal;
        $totalEarnning += $ptotal * $price;
        
    }

    // 更新销售员信息
    $sql = "update idendity set markingtotal=$total,markingcount=$totalEarnning where id=$eid";
    mysqli_query($con,$sql);

    // 更新产品记录
    // 遍历产品
    $sql = "select id from produce";
    $res_pid = mysqli_query($con,$sql);

    while($pid = mysqli_fetch_array($res_pid)){
        $sql = "select sum(total) from marketrecord where p_id=$pid[0]";
        $ptotal = mysqli_fetch_row(mysqli_query($con,$sql))[0];

        $sql = "update produce set total =$ptotal where id=$pid[0]";
        mysqli_query($con,$sql);
    }

    echo <<<EOT
    <form name='fr' action='detailEmpInfo.php?number=$eid' method='POST'>
    </form>
    <script type='text/javascript'>
    document.fr.submit();
    </script>
    EOT;

    mysqli_close($con);
?>