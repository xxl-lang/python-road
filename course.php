<?php
session_start();
?>
<html>
<head><title>查看课表</title>
</head>
<body>

<h1 align="left">查看课表</h1>
<table border='0' cellpadding='5' cellspacing='1' align="left">
<tr bgcolor='lightblue'>
    <th width="20%" align="left">课程号</th><th width="20%" align="left">课程名</th><th width="20%" align="left">星期</th><th width="20%" align="left">时间</th><th width="20%" align="left">教室</th>
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
 
    $sqlstr ="SELECT sc.cno, cname,workday,time,classroom FROM sc,course WHERE sc.sno='$_SESSION[uid]' AND sc.cno=course.cno";
    $query = mysql_query($sqlstr) or die(mysql_error());
 
    while($thread=mysql_fetch_assoc($query)){
        $result[] = $thread;
    }
 
    if($result){
        foreach($result as $val){
            echo '<tr><td>'.$val['cno'].'</td><td>'.$val['cname'].'</td><td>'.$val['workday'].'</td><td>'.$val['time'].'</td><td>'.'&nbsp;&nbsp;'.$val['classroom'].'</td></tr>';
        }
        
    }
 
?>
</td></tr>
</table>
</html>
