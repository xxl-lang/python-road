<html>
<head><title>请假模块</title>
</head>
<body>

<h1 align="left">请假模块</h1>
<table border='0' cellpadding='5' cellspacing='1' align="left">
<tr bgcolor='lightblue'>
    <th width="50%">教师姓名</th><th width="50%">教师邮箱&nbsp;<a href="https://mail.qq.com/cgi-bin/loginpage">从这里进入QQ邮箱</a></th>
</tr>
<tr><td>
<?php
 //打开数据库
    function opendb(){
        $conn=@mysql_connect("127.0.0.1","root","0000")  or die(mysql_error());
        @mysql_select_db('zldb',$conn) or die(mysql_error());   
    }
    opendb();
 
    echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
 
    $sqlstr ="SELECT tname,email FROM teacher";
    $query = mysql_query($sqlstr) or die(mysql_error());
 
    while($thread=mysql_fetch_assoc($query)){
        $result[] = $thread;
    }
 
    if($result){
        foreach($result as $val){
            echo '<tr><td>'.$val['tname'].'</td><td>'.$val['email'].'</td></tr>';
        }
        
    }
 
    ?>
    </td>
</tr>
</table>

</html>