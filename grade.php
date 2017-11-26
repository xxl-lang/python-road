<?php
// 获取客户端提交的数据
$item       = $_POST['item'];
$content    = $_POST['content'];

// 过滤用户填写的信息
$content = trim($content);
if(!$content) {
    echo '请填写要搜索的内容！专业班级姓名学号都ok';
    exit;
}    
if(! get_magic_quotes_gpc() ) {
    $content    = addslashes($content);
}
if($item == 1)
    $field = 'sname ';
else if($item == 2) 
    $field = 'sno ';
else if($item == 3) 
    $field = 'class ';
else if($item == 4) 
    $field = 'dept ';

else {
    echo '搜索项不被支持！';
    exit;
}
$sql = "SELECT * FROM student WHERE $field LIKE '%$content%'";
// 调用mysqli的构造函数建立连接，同时选择使用数据库'test'
$db = @new mysqli("127.0.0.1", "root", "0000", "zldb");
// 检查数据库连接
if (mysqli_connect_errno()) {
    echo "数据库连接失败!<br>\n";
    echo mysqli_connect_error();
    exit;   // 退出程序，后面的所有语句将不再执行
}

// 创建并执行数据库查询

$sql = "SELECT * FROM grade WHERE $field LIKE '%$content%'";
$rs  = $db->query($sql);
$rsNum = $rs->num_rows;
echo "<p>本次搜索共找到<b> $rsNum </b>条记录。</p>";
for ($i = 0; $i < $rsNum; $i++) {
    $row = $rs->fetch_assoc();
    echo '------------------------------------<br/>';
    echo '<b>学号：</b>' . htmlspecialchars(stripslashes($row['sno'])) . '<br/>';
    echo '<b>姓名：</b>' . htmlspecialchars(stripslashes($row['sname'])) . '<br/>';
    echo '<b>专业：</b>' . htmlspecialchars(stripslashes($row['dept'])) . '<br/>';
    echo '<b>班级：</b>' . htmlspecialchars(stripslashes($row['class'])) . '<br/>';
    echo '<b>第一学期绩点：</b>' . htmlspecialchars(stripslashes($row['1mark'])) . '<br/>';
    echo '<b>第一学期排名：</b>' . htmlspecialchars(stripslashes($row['1rank'])) . '<br/>';
    echo '<b>第二学期绩点：</b>' . htmlspecialchars(stripslashes($row['2mark'])) . '<br/>';
    echo '<b>第二学期排名：</b>' . htmlspecialchars(stripslashes($row['2rank'])) . '<br/>';
    echo '<b>总绩点：</b>' . htmlspecialchars(stripslashes($row['tmark'])) . '<br/>';
    echo '<b>总排名：</b>' . htmlspecialchars(stripslashes($row['trank'])) . '<br/>';
    echo '<b>奖学金：</b>' . htmlspecialchars(stripslashes($row['scholarship'])) . '<br/>';
   
    echo '------------------------------------<br/><br/>';
}

$rs->free();
$db->close();

