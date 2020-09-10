<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>销售管理系统-销售人员信息</title>
    <link href="/css/admin.css" rel="stylesheet" type="text/css">
    <script src="/js/dataOpr.js" type="text/javascript"></script>
</head>

<body class="body">
<?php
$usrn = $_POST["adminName"];
$pwd = $_POST["password"];

if($usrn==null||$pwd==null){
    header("location:index.html");
}



$con = mysqli_connect('localhost','root','root','MarketManagerSystem','3306');

if (!$con)
{
    die('Could not connect: ' . mysqli_error($con));
}
    mysqli_set_charset($con, "utf-8");

    $sql="SELECT * FROM administrator WHERE username = '$usrn' AND password = '$pwd'";
    $result = mysqli_query($con,$sql);
    
    if(mysqli_num_rows($result)  > 0){

    }else{
        header("location:index.html");
    }

    mysqli_close($con);
?>

<div id="OperationBar">
    <p>
        <button class="OperationBar_Button">销售人员业绩信息</button>
        <button class="OperationBar_Button">楼房信息</button>
        <button class="OperationBar_Button">楼房销售信息</button>
    </p>
</div>

<p>
    <div id="LeftBar">
        <?php
            $usrn = $_POST["adminName"];

            echo "<p><font class='text'>登陆日期 ".date('y-m-d')." </font></p>";

            $con = mysqli_connect('localhost','root','root','MarketManagerSystem','3306');
            $sql = "select count(*) from idendity";
            $result = mysqli_query($con,$sql);

            if(mysqli_num_rows($result)  > 0){
                $row = mysqli_fetch_row($result);
                echo "<p><font class='text'>当前系统员工记录数 ".$row[0]." </font></p>";
            }


        ?>

    </div>

    <div id="MainDiv">

    </div>
</p>

    
</body>
</html>



