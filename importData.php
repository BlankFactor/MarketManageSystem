<!DOCTYPE html>

<head>
    <title>录入业绩</title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="css/flightsInfo.css" />
</head>

<body style="background-color:rgb(141, 169, 243);">
    <h3 id="headline">
        <font class="text">销售员业绩信息</font>
    </h3>

    <div id="mainDiv">
        <table border="1px" cellspacing="0" id="table">
            <tr>
                <th>编号</th>
                <th>销售员姓名</th>
                <th>销售量</th>
                <th>销售额</th>
            </tr>

            <?php
            $con = mysqli_connect('localhost', 'root', 'root', 'MarketManagerSystem');

            if (!$con) {
                die('could not connect : ' . mysqli_error($con));
            } else {
                mysqli_set_charset($con, 'utf-8');

                $sql = 'SELECT * from idendity';
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row[0] . '</td>';
                    echo '<td>' . $row[1] . '</td>';
                    echo '<td>' . $row[2] . '</td>';
                    echo '<td>' . $row[3] . '</td>';
                    echo '</tr>';
                }
                mysqli_close($con);
            }
            ?>

        </table>

        <p></p>
        <p></p>
        <table border="1px" cellspacing="0" id="table">
            <tr>

                <th>房产</th>

                <?php
                $con = mysqli_connect('localhost', 'root', 'root', 'MarketManagerSystem');
                $sql = "select name from produce";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<th>" . $row[0] . "</th>";
                }
                echo "</tr>";
                ?>

                <?php
                $con = mysqli_connect('localhost', 'root', 'root', 'MarketManagerSystem');

                if (!$con) {
                    die('could not connect : ' . mysqli_error($con));
                } else {
                    mysqli_set_charset($con, 'utf-8');

                    echo '<tr>';
                    echo "<td>编号</td>";
                    $sql = 'SELECT id from produce';
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<td>' . $row[0] . '</td>';
                    }
                    echo '</tr>';

                    echo '<tr>';
                    echo "<td>价格</td>";
                    $sql = 'SELECT price from produce';
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<td>' . $row[0] . '</td>';
                    }
                    echo '</tr>';

                    echo '<tr>';
                    echo "<td>奖金率</td>";
                    $sql = 'SELECT rewardrate from produce';
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<td>' . $row[0] . '</td>';
                    }
                    echo '</tr>';

                    echo '<tr>';
                    echo "<td>销量</td>";
                    $sql = 'SELECT total from produce';
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<td>' . $row[0] . '</td>';
                    }
                    echo '</tr>';

                    mysqli_close($con);
                }
                ?>

        </table>
    </div>

    <div id="settingDiv">
        <p>
            <font class="text" size="5px">信息录入</font>
        </p>
        <p>
            <form action="confirmImport.php" method="post" onsubmit="return CheckIfNull(eid.value,pid.value,count.value,month.value)">
                <label>
                    <font class="text">销售员编号 : </font>
                </label>
                <input name="eid" size="10" type="text" value="">

                <label>
                    <font class="text">楼房编号 :
                        <input name="pid" size="10" type="text" value="">

                        <label>
                            <font class="text">销售数量 :
                                <input name="count" size="10" type="text" value="">

                                <label>
                                    <font class="text">销售月份 :
                                        <input name="month" size="10" type="text" value="">
                                </label>
            </form>
        </p>
        <p>
            <input type="submit" name="query" value="确定" id="query">
        </p>
    </div>

    <script>
        function CheckIfNull(_a, _b, _c, _d) {
            if (_a == "" || _b == "" || _c == "" || _d == "") {
                alert("信息不能为空");
                return false;
            }
            return confirm("确认录入?");
        }
    </script>
</body>

</html>