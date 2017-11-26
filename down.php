<?php
// 包含通用文件，其中有连接数据库的代码
require_once('up_common.php');

// 文件项类
class CFileItem 
{
    public $id;
    public $title;
    public $remark;
    public $file;
    public $upload_time;
    public $download_times;    
}

function getFileList(&$files)
{
    // 构造查询语句
    $sql = "SELECT * FROM t_file ORDER BY f_download_times DESC ";
    
    // 连接数据库并执行查询
    $db = db_connect();    
    $rs = $db->query($sql);
    // 遍历记录集
    for ($count = 0; $row = @$rs->fetch_assoc(); $count++)
    {
        $fi = new CFileItem();
        
        $fi->id             = $row['f_id'];
        $fi->title          = $row['f_title'];            
        $fi->remark         = $row['f_remark'];            
        $fi->file           = $row['f_file'];
        $fi->upload_time    = $row['f_upload_time'];
        $fi->download_times = $row['f_download_times'];
        
        // 以引用参数数组返回各项
        $files[$count]      = $fi;
    }
    $db->close();
    
    return $rs ? $rs->num_rows : 0;
}

$totalNum = getFileList($files);
?>
<html>
<head><title>下载模块</title>
</head>
<body>

<h1 align="left">下载模块</h1>
<form name='frmDownload' method='post' action='down.php' >
<table border='0' cellpadding='5' cellspacing='1' width='80%' align="left">
<tr bgcolor='lightblue'>
    <th width='15%'>标题</th><th width='35%'>说明</th><th width='25%'>上传时间</th><th width='15%'>下载次数</th><th></th>
</tr>
<?php
if ($totalNum > 0) {
// 输出各项
    for ($i = 0; $i < $totalNum; $i++) {
        $row = $files[$i];
        // 奇偶行的背景色不同
        $bgcolor = ($i % 2) == 0 ? 'white' : '#eeeeee';
        echo "<tr bgcolor='$bgcolor'><td>{$row->title}</td><td>{$row->remark}</td>";
        echo "<td>{$row->upload_time}</td><td>{$row->download_times}</td>";
        // 输出下载链接
        echo "<td><a href='download.php?id={$row->id}'>下载</a></td><tr>";
    }
}
?>
</table>
</form>
</html>

