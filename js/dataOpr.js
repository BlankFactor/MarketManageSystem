function Delete(number){
    if (confirm("确定删除?")){
        window.location = "action_Del.php?id="+number;
    }
}

function Insert(){
    var elems = document.getElementsByTagName("input");
    for(i = 0;i<elems.length;i++){
        if(elems[i].value == ""){
            alert("所有信息不能为空");
            return false;
        }
    }

    elems = document.getElementsByTagName("select");
    for(i = 0;i<elems.length;i++){
        if(elems[i].value == ""){
            alert("地点不能为空");
            return false;
        }
    }
    return true;
}

function Confirm(){
    return confirm("确认修改?");
}

function CheckIfNull(_id,_name,_price,_rewardrate){
    if(_id==""||_name==""||_price==""||_rewardrate==""){
        alert("信息不能为空");
        return false;
    }
    return true;
}

function CheckIfNull(_id,_name){
    if(_id==""||_name==""){
        alert("ID或姓名不能为空");
        return false;
    }
    return true;
}

function ShowImportDiaglog(){
    window.location.href="action_ImportNewProduce.php";
}

function BackToTitle(){
    window.location.href="index.html";
}

function ChangeMonth_EmeInfo(_ele,_month,_ele_Sort,_method,_form){
    _ele.value=_month;
    _ele_Sort.value = _method;
    _form.submit();
}

function ChangeMethodOfSort(_ele,_month,_ele_Sort,_method,_form){
    _ele.value=_month;
    _ele_Sort.value = _method;
    _form.submit();
}

function ComfirmResetData(){
    if(confirm("是否确认重设销售数据?"))
        if(confirm("再次确认是否重设销售数据?"))
            return true;
    return false;
}

function InsertMarketData(){
    window.location.href="importData.php";
}