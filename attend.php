<html>
<head><title>查看考勤</title>
</head>
<body>

<h1 align="left">查看考勤</h1>
<table border='0' cellpadding='5' cellspacing='1' align="left">
<tr bgcolor='lightblue'>
    <th width="20%" align="left">课程号</th><th width="20%" align="left">课程名</th><th width="20%" align="left">学号</th><th width="20%" align="left">姓名</th><th width="20%" align="left">出勤</th>
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
 
    $sqlstr ="SELECT attendence.cno, cname,attendence.sno,sname,attend FROM course,attendence,student WHERE attendence.cno=course.cno AND attendence.sno=student.sno";
    $query = mysql_query($sqlstr) or die(mysql_error());
 
    while($thread=mysql_fetch_assoc($query)){
        $result[] = $thread;
    }
 
    if($result){
        foreach($result as $val){
            echo '<tr><td>'.$val['cno'].'</td><td>'.$val['cname'].'</td><td>'.$val['sno'].'</td><td>'.$val['sname'].'</td><td>'.'&nbsp;&nbsp;'.$val['attend'].'</td></tr>';
        }
        
    }
 
?>
</td></tr>
</table>
</html>



