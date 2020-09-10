<!DOCTYPE html>
    <head>
        <title>销售记录修改</title>
        <meta charset="utf-8">
        <link href="/css/admin.css" rel="stylesheet" type="text/css">
        <script src="/js/dataOpr.js" type="text/javascript"></script>
    </head>

    <body class="body">
        <div id="InsertOprDiv">
        <?php
            $con = mysqli_connect('localhost','root','root','marketmanagersystem');

            if(!$con)
                die('could not connect : '.mysqli_error($con));

            mysqli_set_charset($con,'utf8');
            $id = $_GET['number'];
            $month = $_GET['month'];

            // 遍历当月房产销售记录
            $sql = "select p_id,total from marketrecord where month=$month and e_id=$id";
            $res = mysqli_query($con,$sql);


            echo "<form action='action_ConfirmModifyMkRec.php' method='post' onsubmit='return Confirm()'>
                <p><input type='submit' value='确认修改'></p>
                <p>";
            while($record = mysqli_fetch_array($res)){
                $sql_name = "select name from produce where id=$record[0]";
                $name = mysqli_fetch_row(mysqli_query($con,$sql_name))[0];

                echo "<input type='hidden' name='eid' value='$id'></input>";
                echo "<input type='hidden' name='month' value='$month'></input>";

                echo "<label >
                    <font class='text'>$name : </font>
                    <input name='$record[0]' size='10' value=".$record["total"].">
                    </label>";

            }
            echo "</p></form>";
           

            mysqli_close($con);
            ?>
        </div>
    </body>

</html>

