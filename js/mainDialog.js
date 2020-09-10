function Login(_usrn,_pwd){
    if(_usrn == "" || _pwd == ""){
        alert("用户或密码不能为空");
        return false;
    }
return true;
}
function Browse(){
    window.location.href="importData.php";
}