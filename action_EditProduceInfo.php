<!DOCTYPE html>

<head>
    <title>楼房信息修改</title>
    <meta charset="utf-8">
    <link href="/css/admin.css" rel="stylesheet" type="text/css">
    <script src="/js/dataOpr.js" type="text/javascript"></script>
</head>

<body class="body">
    <div id="InsertOprDiv">
        <?php
        $con = mysqli_connect('localhost', 'root', 'root', 'marketmanagersystem');

        if (!$con)
            die('could not connect : ' . mysqli_error($con));

        mysqli_set_charset($con, 'utf8');

        $number = $_GET['number'];

        $sql = "SELECT * from produce where id=" . $number;
        $rl = mysqli_query($con, $sql) or die('数据出错：' . mysqli_error($con));
        $res = mysqli_fetch_array($rl);

        echo "<form action='action_UpdateProduceInfo.php' method='post' onsubmit='return Confirm()'>
            <p><input type='submit' class='button' value='确认修改'></p>
                    <p>
                    <form action='search.php' method='post'>
                        <label >
                            <font class='text'>楼房编号 : </font>
                            <input name='id' size='10' class='readonlyInput' readonly=" . $res[0] . " value=" . $res[0] . ">
                        </label>
                        <label ><font class='text'>楼房名称 : 
                        <input name='name' value='" . $res[1] . "'>
                        <label ><font class='text'>价格 : 
                        <input value='" . $res[2] . "' name='price' size='3px' type='text' oninput='value=value.replace(/[^\d]/g,'')'>
                        </label>
                        <label ><font class='text'>销售量 : 
                        <input class='readonlyInput' value='" . $res[3] . "' readonly name='total' size='3px' type='text' oninput='value=value.replace(/[^\d]/g,'')'>
                        </label>
                        <label ><font class='text'>奖金率(%) : 
                        <input value='" . $res[4] . "' name='rewardrate' size='3px' type='text' oninput='value=value.replace(/[^\d]/g,'')'>
                        </label>
                    </p>
                    </form>
                    </p>
            </form>";

        mysqli_close($con);
        ?>
    </div>
</body>

</html>