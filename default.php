<?php
require_once('bbs_common.php');
require_once('Board.php');
require_once('TreeNode.php');
session_start();

// 检查是否已经创建了SESSION变量
if(!isset($_SESSION['expands']))
{
    $_SESSION['expands'] = array();
}

// 检查是点击了全部展开按钮还是某个贴子的+号按钮
if(isset($_GET['expand']))
{
    if($_GET['expand'] == 'all')
        expand_all($_SESSION['expands']);
    else
        $_SESSION['expands'][$_GET['expand']] = true;
}

// 检查是点击了全部折叠按钮还是某个贴子的-号按钮
if(isset($_GET['collapse']))
{
    if($_GET['collapse'] == 'all')
        $_SESSION['expands'] = array();
    else
        unset($_SESSION['expands'][$_GET['collapse']]);
} 

// 构造版面列表
$board = new BoardList();
// 取当前版面
$bid = isset($_GET['bid']) ? $_GET['bid'] : 1;
$cur_board = $board->getBoard($bid);

// 构造树节点
$tree = new TreeNode($bid, 0, true, '', '', '', '', '', -1, $_SESSION['expands']);
?>

<?php
$page_title = '青鸟讨论区';   // 设置窗口标题
$page_caption = '讨论区主页'; // 设置页面标题
require_once('header.inc.php');
?>
<table border='0' cellpadding='0' cellspacing='0' width='768' align="left">
<tr>
<td width='25%'>
<div style='width:100%;height:360px;border:2px groove lightgray;'>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr height='32px'>
        <td bgcolor='lightblue' align='center'>
            <font color='orange'>版面列表</font>
        </td>
    </tr>
    <?php
        // 让版面类的对象显示自己
        $board->display();
    ?>
    </table>
</div>
</td>
<td valign='top'>
    <div style='color:orange;height:32px; width:100%; 
        background-color:lightblue; padding:3px;border:2px groove lightgray;'>
    <span style='color:orange;height:22px;'>当前版面：</span>
    <span style='color:white;;height:22px;width:20%;'><?echo $cur_board;?></span>
    <a class='link_btn' href='default.php?bid=<?echo $bid;?>&expand=all'>全部展开</a>&nbsp;
    <a class='link_btn' href='default.php?bid=<?echo $bid;?>&collapse=all'>全部折叠</a>&nbsp;
    <a class='link_btn' href='post.php?bid=<?echo $bid;?>'>发表文章</a>&nbsp;
    </div>
    <table border='0' cellpadding='5' cellspacing='0' width='100%' style='margin-left:5px'>
    <?php
        // 让树显示自己
        $tree->display(0);
    ?>
    </table>
</td>
</tr>
</table>

<?php
require_once('footer.inc.php');
?>


