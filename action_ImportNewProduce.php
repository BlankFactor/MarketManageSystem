<!DOCTYPE html>
    <head>
        <title>录入新楼房</title>
        <meta charset="utf-8">
        <link href="/css/admin.css" rel="stylesheet" type="text/css">
        <script src="/js/dataOpr.js" type="text/javascript"></script>
    </head>

    <body class="body">
        <div id="InsertOprDiv">
    
            <form action='action_ConfirmImport.php' method='post' onsubmit='return CheckIfNull(id.value,name.value,price.value,rewardrate.value)'>
            <p><input type='submit' class='button' value='确认录入'></p>
                    <p>
                    <form action='search.php' method='post'>
                        <label >
                            <font class='text'>楼房编号 : </font>
                            <input name='id' size='10' value=''>
                        </label>
                        <label ><font class='text'>楼房名称 : 
                        <input name='name' value=''>
                        <label ><font class='text'>价格 : 
                        <input value='' name='price' size='10px' type='text'>
                        </label>
                        <label ><font class='text'>奖金率(%) : 
                        <input value='' name='rewardrate' size='3px' type='text'>
                        </label>
                    </p>
                    </form>
                    </p>
            </form>
            
        </div>
    </body>

</html>

