<!DOCTYPE html>
    <head>
        <title>销售员详细信息</title>
        <meta charset="utf-8">
        <link href="/css/admin.css" rel="stylesheet" type="text/css">
        <script src="/js/dataOpr.js" type="text/javascript"></script>
    </head>

    <body class="body">
        <div id="InsertOprDiv_Major">
        <?php
            $con = mysqli_connect('localhost','root','root','marketmanagersystem');

            if(!$con)
                die('could not connect : '.mysqli_error($con));

            mysqli_set_charset($con,'utf8');
            
            $number = $_GET['number'];

            $sql = "SELECT name from idendity where id=".$number;
            $rl = mysqli_query($con,$sql) or die('数据出错：'.mysqli_error($con));  
            $name = mysqli_fetch_row($rl)[0];

            echo "<a class='text'>销售员:$name 近一年销售记录</a><p></p>";

            echo "<table border='1px' cellspacing='0' id='table_Detail'>
                        <tr>
                            <th>操作</th>
                            <th>月份\楼房</th>";

            $sql = "select name from produce";
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result)){
                 echo "<th>".$row[0]."</th>";
            }

            echo "<td>应得奖金</td>";
            $totalreward = 0;
            echo "</tr>";

            // 按月份查找
            for($n=1;$n<=12;$n++){
                echo '<tr>';

                echo "<td><a href=action_EditMarketRecord.php?number=$number&month=$n>修改  </a>";

                echo '<td>'.$n.'</td>';
                $sql = "select * from marketrecord where month=$n and e_id=$number";
                $res = mysqli_query($con,$sql);
                
                if(mysqli_num_rows($res)  == 0){
                    for($j=1;$j<=$pcount;$j++)
                        echo '<td>0</td>';
                }   
                else{
                    while($total = mysqli_fetch_array($res)){
                        echo "<td>".$total['Total']."</td>";
                    }
                }

                // 计算该月总奖金
                $reward = 0;
                // 获取个人交易记录
                $sql = "select * from marketrecord where e_id=$number and month=$n";
                $res = (mysqli_query($con,$sql));
                while($row2 = mysqli_fetch_array($res)){
                    if($row2["Total"]==0)
                        continue;
                    else{
                        // 获取楼房单价以及奖金率
                        $sql2="select price,rewardrate from produce where id=$row2[0]";
                        $rew =  mysqli_fetch_row(mysqli_query($con,$sql2));
                        $reward += $row2["Total"] * ($rew[0] * $rew[1] / 100);
                    }   
                }
                echo "<td>$reward</td>";
                $totalreward += $reward;
                echo '</tr>';
            }

            // 总计
            echo "<tr><td></td>";
            
            echo "<td>合计</td>";
            // 遍历产品id
            $sql = "select id from produce";
            $res = mysqli_query($con,$sql);
            while($pid = mysqli_fetch_array($res)){
                $sql_total = "select sum(total) from marketrecord where e_id=$number and p_id=$pid[0]";
                $total = mysqli_fetch_row(mysqli_query($con,$sql_total));

                echo "<td>".$total[0]."</td>";

            }
            echo "<td>$totalreward</td>";
            echo "</tr>";


            echo "</table>";

            $month = date("n");
            $lastMonth = $month-1;

            $sql = "select sum(total) from marketrecord where e_id=$number and month=$month";
            $tm = mysqli_fetch_row(mysqli_query($con,$sql))[0];

            $sql = "select sum(total) from marketrecord where e_id=$number and month=$lastMonth";
            $tl = mysqli_fetch_row(mysqli_query($con,$sql))[0];

            $sub = $tm - $tl;
            echo "<p><p>";
            echo "<hr color='black'></hr>";
            echo "<a class='text'>$month 月 较 $lastMonth 月 相比销量相差 $sub</a>";
                    

            mysqli_close($con);
            ?>
        </div>
    </body>

</html>

