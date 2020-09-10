<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>销售管理系统</title>
    <link href="/css/admin.css" rel="stylesheet" type="text/css">
    <script src="/js/dataOpr.js" type="text/javascript"></script>
</head>

<body class="body">
    <?php
    $usrn = $_POST["adminName"];
    $pwd = $_POST["password"];

    if ($usrn == null || $pwd == null) {
        header("location:index.html");
    }



    $con = mysqli_connect('localhost', 'root', 'root', 'MarketManagerSystem', '3306');

    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    mysqli_set_charset($con, "utf-8");

    $sql = "SELECT * FROM administrator WHERE username = '$usrn' AND password = '$pwd'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result)  > 0) {
    } else {
        header("location:index.html");
    }

    mysqli_close($con);
    ?>

    <div id="OperationBar">
        <p>
            <?php
            echo "<form style='float:left;padding:0px;margin:0px;' action='admin.php' method='post'>
                <input hidden name='adminName' value=$usrn></input>
                <input hidden name='password' value=$pwd></input>
                <input hidden name='action' value='EmeInfo'></input>
                <button class='OperationBar_Button'>销售人员业绩信息</button>
                </form>"
            ?>

            <?php
            echo "<form style='float:left;padding:0px;margin:0px;' action='admin.php' method='post'>
                <input hidden name='adminName' value=$usrn></input>
                <input hidden name='password' value=$pwd></input>
                <input hidden name='action' value='ProduceInfo'></input>
                <button class='OperationBar_Button'>楼房信息</button>
                </form>"
            ?>

            <?php
            echo "<form style='float:left;padding:0px;margin:0px;' action='admin.php' method='post'>
                <input hidden name='adminName' value=$usrn></input>
                <input hidden name='password' value=$pwd></input>
                <input hidden name='action' value='MarketRecord'></input>
                <button class='OperationBar_Button'>楼房销售信息</button>
                </form>"
            ?>

            <button class="OperationBar_Button" onclick="ShowImportDiaglog()">录入新楼房</button>

            <?php
            echo "<form onsubmit='return ComfirmResetData()' name='reset_Form' style='float:left;padding:0px;margin:0px;' action='action_ResetDatabase.php' method='post'>
                <input hidden name='adminName' value=$usrn></input>
                <input hidden name='password' value=$pwd></input>
                <input type='submit' name='log' value='清空销售信息' class='OperationBar_Button'/>
                </form>";
            ?>

            <button class="OperationBar_Button" onclick="InsertMarketData()">录入销售信息</button>

            <button id="Button_Back" onclick="BackToTitle()">退回到主页面</button>
        </p>
    </div>

    <p>
        <div id="LeftBar">
            <?php
            $usrn = $_POST["adminName"];

            echo "<p><font class='text'>登陆日期 " . date('y-m-d') . " </font></p>";

            $con = mysqli_connect('localhost', 'root', 'root', 'MarketManagerSystem', '3306');
            $sql = "select count(*) from idendity";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result)  > 0) {
                $row = mysqli_fetch_row($result);
                echo "<p><font class='text'>当前系统员工记录数 " . $row[0] . " </font></p>";
            }


            ?>

            <form action="action_InsertEmploee.php" method="POST" id="InputRegion" onsubmit="return CheckIfNull(ID.value,Name.value)">
                <p>
                    <label>
                        <font class='text'>新增员工编号 : </font>
                        <input type="text" name="ID" value="">
                    </label>
                </p>
                <p>
                    <label>
                        <font class='text'>新增员工姓名 : </font>
                        <input type="text" name="Name" value="">
                    </label>
                </p>
                <p>
                    <input type="submit" name="log" value="确认" class="button" />
                </p>
            </form>

        </div>

        <div id="MainDiv">
            <?php
            if (!empty($_POST["action"])) {
                // 查询销售员信息
                if ($_POST["action"] == "EmeInfo") {
                    $m = !empty($_POST["month"]) ? $_POST["month"] : "";

                    echo "<form name='setting_Form' action='admin.php' method='POST'>
                    <input type='hidden' name='adminName' value='admin'>
                    <input type='hidden' name='password' value='admin'>
                    <input type='hidden' name='action' value='EmeInfo'>
                    <input type='hidden' name='monthPost' value=''>
                    <input type='hidden' name='sortPost' value=''>

                    <label ><font class='text'>月份 : 
                    <select name='month' onchange='ChangeMonth_EmeInfo(monthPost,month.value,sortPost,sort.value,setting_Form)'>
                        <option value=''></option>
                        <option ";
                    if ($m == 1) echo "selected=selected";
                    echo "'value='1'>1</option>
                        <option ";
                    if ($m == 2) echo "selected=selected";
                    echo "'value='2'>2</option>
                        <option ";
                    if ($m == 3) echo "selected=selected";
                    echo "'value='3'>3</option>
                        <option ";
                    if ($m == 4) echo "selected=selected";
                    echo "'value='4'>4</option>
                        <option ";
                    if ($m == 5) echo "selected=selected";
                    echo "'value='5'>5</option>
                        <option ";
                    if ($m == 6) echo "selected=selected";
                    echo "'value='6'>6</option>
                        <option ";
                    if ($m == 7) echo "selected=selected";
                    echo "'value='7'>7</option>
                        <option ";
                    if ($m == 8) echo "selected=selected";
                    echo "'value='8'>8</option>
                        <option ";
                    if ($m == 9) echo "selected=selected";
                    echo "'value='9'>9</option>
                        <option ";
                    if ($m == 10) echo "selected=selected";
                    echo "'value='10'>10</option>
                        <option ";
                    if ($m == 11) echo "selected=selected";
                    echo "'value='11'>11</option>
                        <option ";
                    if ($m == 12) echo "selected=selected";
                    echo "'value='12'>12</option>";
                    echo "</select>";
                    if (!empty($_POST["month"]) && $_POST["month"] != "all") {
                        $month = $_POST["month"];

                        echo "<a class='text'>      $month 月业绩信息</a>";
                    } else {
                        echo "<a class='text'>      全年业绩信息</a>";
                    }


                    $s = !empty($_POST["sort"]) ? $_POST["sort"] : "";
                    // 排序方式设置
                    echo "<p></p>
                    <label ><font class='text'>排序方式 : 
                    <select name='sort' value='' onchange=' ChangeMethodOfSort(monthPost,month.value,sortPost,sort.value,setting_Form)'>
                        <option value=''></option>
                        <option value='total'";
                    if ($s == "total") echo "selected=selected";
                    echo ">销量</option>
                        <option value='earrning'";

                    if ($s == "earrning") echo "selected=selected";
                    echo "    >销售额</option>
                        <option value='reward'";

                    if ($s == "reward") echo "selected=selected";
                    echo "    >奖金</option>
                        <option value='default'>编号</option>
                    </select>";

                    if (!empty($_POST["sort"])) {
                        $me = $_POST["sort"];

                        switch ($me) {
                            case "total":
                                $me = "销量";
                                break;
                            case "earrning":
                                $me = "销售额";
                                break;
                            case "reward":
                                $me = "奖金";
                                break;
                            case "default":
                                $me = "默认";
                                break;
                        }

                        echo "<a class='text'>      $me - 排序</a>";
                    } else {
                        echo "<a class='text'>      默认 - 排序</a>";
                    }

                    echo "</form>";


                    echo "<table border='1px' cellspacing='0' id='table'>
                        <tr>
                            <th>操作</th>
                            <th>编号</th>
                            <th>销售员姓名</th>
                            <th>销售量</th>
                            <th>销售额</th>
                            <th>奖金</th>
                            <th>备注</th>
                        </tr>";

                    $con = mysqli_connect('localhost', 'root', 'root', 'MarketManagerSystem');

                    if (!$con) {
                        die('could not connect : ' . mysqli_error($con));
                    } else {
                        mysqli_set_charset($con, 'utf-8');

                        // 设置月份下查询 附带月销售执行评定
                        if (!empty($_POST["month"]) && ($_POST["month"] != "all")) {
                            $month = $_POST["month"];


                            // 计算该月总奖金 用于求最大值
                            $rewardArray = array();
                            $index = 0;
                            // 获取个人交易记录
                            $sql = "select id from idendity";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $sql = "select * from marketrecord where e_id=$row[0] and month=$month";
                                $res = (mysqli_query($con, $sql));
                                $reward = 0;
                                // 遍历楼房信息
                                while ($row2 = mysqli_fetch_array($res)) {
                                    if ($row2["Total"] == 0)
                                        continue;
                                    else {
                                        // 获取单个楼房单价以及奖金率
                                        $sql2 = "select price,rewardrate from produce where id=$row2[0]";
                                        $rew =  mysqli_fetch_row(mysqli_query($con, $sql2));
                                        $reward += $row2["Total"] * ($rew[0] * $rew[1] / 100);
                                    }
                                }

                                $rewardArray[$index++] = $reward;
                            }

                            $sql = 'SELECT * from idendity';
                            // // 根据排序依据调整语句
                            // if (!empty($_POST["sort"])) {
                            //     $me = $_POST["sort"];

                            //     switch ($me) {
                            //         case "total":
                            //             $sql = 'SELECT * from idendity order by markingtotal desc';
                            //             break;
                            //         case "earrning":
                            //             $sql = 'SELECT * from idendity order by markingcount desc';
                            //             break;
                            //         case "reward":
                            //             $me = "奖金";
                            //             break;
                            //         case "default":
                            //             break;
                            //     }
                            // }

                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<tr>';

                                echo '<td><a href=detailEmpInfo.php?number=' . $row[0] . '>详细信息  </a>';
                                echo '<a href=action_RemoveEmploee.php?number=' . $row[0] . '>删除  </a></td>';

                                echo '<td>' . $row[0] . '</td>';
                                echo '<td>' . $row[1] . '</td>';

                                $eid = $row[0];
                                $sql = "select sum(total) from marketrecord where e_id=$eid and month=$month";

                                $total = mysqli_fetch_row(mysqli_query($con, $sql))[0];
                                if (!$total)
                                    $total = 0;

                                echo '<td>' . $total . '</td>';

                                $sql = "select P_ID,total from marketrecord where e_id=$eid and month= $month";
                                $recordRes = mysqli_query($con, $sql);
                                $totalEarnning = 0;
                                while ($record = mysqli_fetch_array($recordRes)) {
                                    $sql = "select price from produce where id=$record[0]";
                                    $price = mysqli_fetch_row(mysqli_query($con, $sql))[0];
                                    $totalEarnning += $price * $record[1];
                                }
                                echo '<td>' . $totalEarnning . '</td>';

                                $bestmarking = false;
                                // 计算该月总奖金 用于单元格显示
                                $reward = 0;
                                // 获取个人交易记录
                                $sql = "select * from marketrecord where e_id=$row[0] and month=$month";
                                $res = (mysqli_query($con, $sql));
                                while ($row2 = mysqli_fetch_array($res)) {
                                    if ($row2["Total"] == 0)
                                        continue;
                                    else {
                                        // 获取楼房单价以及奖金率
                                        $sql2 = "select price,rewardrate from produce where id=$row2[0]";
                                        $rew =  mysqli_fetch_row(mysqli_query($con, $sql2));
                                        $reward += $row2["Total"] * ($rew[0] * $rew[1] / 100);
                                    }
                                }
                                echo "<td>$reward</td>";
                                if ($reward == max($rewardArray) && $reward != 0)
                                    echo "<td>月度销售之星</td>";
                                else
                                    echo "<td>无</td>";

                                echo '</tr>';
                            }
                        }
                        // 统计全年销售信息
                        else {
                            // 计算全年总奖金 用于求最大值
                            $rewardArray = array();
                            $index = 0;
                            // 获取个人交易记录
                            $sql = "select id from idendity";
                            $result = mysqli_query($con, $sql);
                            while ($row3 = mysqli_fetch_array($result)) {
                                $sql = " select p_id,sum(total)  from marketrecord where e_id=$row3[0] group by p_id";
                                $res = (mysqli_query($con, $sql));
                                $reward = 0;
                                // 遍历楼房信息
                                while ($row4 = mysqli_fetch_array($res)) {
                                    if ($row4[1] == 0)
                                        continue;
                                    else {
                                        // 获取单个楼房单价以及奖金率
                                        $sql2 = "select price,rewardrate from produce where id=$row4[0]";
                                        $rew =  mysqli_fetch_row(mysqli_query($con, $sql2));
                                        $reward += $row4[1] * ($rew[0] * $rew[1] / 100);
                                    }
                                }

                                $rewardArray[$index++] = $reward;
                            }


                            $sql = 'SELECT * from idendity';

                            // 根据排序依据调整语句
                            if (!empty($_POST["sort"])) {
                                $me = $_POST["sort"];

                                switch ($me) {
                                    case "total":
                                        $sql = 'SELECT * from idendity order by markingtotal desc';
                                        break;
                                    case "earrning":
                                        $sql = 'SELECT * from idendity order by markingcount desc';
                                        break;
                                    case "reward":
                                        $me = "奖金";
                                        break;
                                    case "default":
                                        break;
                                }
                            }

                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                // 计算全年总奖金
                                $reward = 0;
                                // 获取个人交易记录
                                $sql = "select * from marketrecord where e_id=$row[0]";
                                $res = (mysqli_query($con, $sql));
                                while ($row2 = mysqli_fetch_array($res)) {
                                    if ($row2["Total"] == 0)
                                        continue;
                                    else {
                                        // 获取楼房单价以及奖金率
                                        $sql2 = "select price,rewardrate from produce where id=$row2[0]";
                                        $rew =  mysqli_fetch_row(mysqli_query($con, $sql2));
                                        $reward += $row2["Total"] * ($rew[0] * $rew[1] / 100);
                                    }
                                }

                                echo '<tr>';
                                echo '<td><a href=detailEmpInfo.php?number=' . $row[0] . '>详细信息  </a>';
                                echo '<a href=action_RemoveEmploee.php?number=' . $row[0] . '>删除  </a></td>';
                                echo '<td>' . $row[0] . '</td>';
                                echo '<td>' . $row[1] . '</td>';
                                echo '<td>' . $row[2] . '</td>';
                                echo '<td>' . $row[3] . '</td>';
                                echo '<td>' . $reward . '</td>';
                                if ($reward == max($rewardArray) && $reward != 0)
                                    echo "<td>年度销售之星</td>";
                                else echo "<td>无</td>";
                                echo '</tr>';
                            }
                        }

                        mysqli_close($con);
                    }
                } else if ($_POST["action"] == "ProduceInfo") {
                    echo "<table border='1px' cellspacing='0' id='table'>
                    <tr>
                        <th>操作</th>
                        <th>编号</th>
                        <th>楼房类型</th>
                        <th>价格</th>
                        <th>销售量</th>
                        <th>奖金额(%)</th>
                    </tr>";

                    $con = mysqli_connect('localhost', 'root', 'root', 'MarketManagerSystem');

                    if (!$con) {
                        die('could not connect : ' . mysqli_error($con));
                    } else {
                        mysqli_set_charset($con, 'utf-8');

                        $sql = 'SELECT * from produce';
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td><a href=action_EditProduceInfo.php?number=' . $row[0] . '>编辑  </a>';
                            echo '<a href=action_DelProduce.php?number=' . $row[0] . '>删除</a></td>';
                            echo '<td>' . $row[0] . '</td>';
                            echo '<td>' . $row[1] . '</td>';
                            echo '<td>' . $row[2] . '</td>';
                            echo '<td>' . $row[3] . '</td>';
                            echo '<td>' . $row[4] . '</td>';
                            echo '</tr>';
                        }
                        mysqli_close($con);
                    }
                } else if ($_POST["action"] == "MarketRecord") {
                    $con = mysqli_connect('localhost', 'root', 'root', 'MarketManagerSystem');
                    mysqli_set_charset($con, 'utf-8');
                    if (!$con) {
                        die('could not connect : ' . mysqli_error($con));
                    }

                    $sql = "select count(*) from produce";
                    $pcount = mysqli_fetch_array(mysqli_query($con, $sql))[0];

                    echo "<table border='1px' cellspacing='0' id='table'>
                    <tr>
                        <th>月份\房产</th>";
                    $sql = "select name from produce";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<th>" . $row[0] . "</th>";
                    }
                    echo "</tr>";

                    for ($i = 1; $i <= 12; $i++) {
                        echo '<tr>';
                        echo '<td>' . $i . '</td>';
                        $sql = "select total from marketrecord where month=$i";
                        $res = mysqli_query($con, $sql);

                        if (mysqli_num_rows($res)  == 0) {
                            for ($j = 1; $j <= $pcount; $j++)
                                echo '<td>0</td>';
                        } else {
                            $sql = "select id from produce";
                            $res = mysqli_query($con, $sql);
                            while ($produceId = mysqli_fetch_array($res)) {
                                $sql = "select sum(total) from marketrecord where month=$i and p_id=$produceId[0]";
                                $res2 = mysqli_query($con, $sql);
                                $total = mysqli_fetch_array($res2);

                                echo "<td>$total[0]</td>";
                            }
                        }
                        echo '</tr>';
                    }

                    // 总计
                    echo "<tr>";

                    echo "<td>合计</td>";
                    // 遍历产品id
                    $sql = "select id from produce";
                    $res = mysqli_query($con, $sql);
                    while ($pid = mysqli_fetch_array($res)) {
                        $sql_total = "select sum(total) from marketrecord where p_id=$pid[0]";
                        $total = mysqli_fetch_row(mysqli_query($con, $sql_total));

                        echo "<td>" . $total[0] . "</td>";
                    }
                    echo "</tr>";

                    mysqli_close($con);
                }
            }
            ?>
        </div>
    </p>


</body>

</html>