<?php
class BoardList
{ 
    // 成员变量
    public $m_boards;
    
    // 构造函数
    // 不仅设置成员变量，更重要的是递归设置其孩子节点
    public function __construct()
    { 
        $this->m_boards = array();
                
        $conn = db_connect();        
        $sql = "SELECT * FROM t_board";
        $result = $conn->query($sql);
        
        for ($count = 0; $row = @$result->fetch_assoc(); $count++)
        {
            $this->m_boards[$row['f_id']] = $row['f_name'];
        }
    } // end function __construct

    public function getBoard($id)
    {
        return $this->m_boards[$id];
    }

    // 显示函数
    function display()
    {
        if(count($this->m_boards) <= 0)
            return;
            
        foreach($this->m_boards as $id => $name) {
            echo "<tr height='30px'><td style='padding-left:5px'>";        
            echo "<img src='images/item.gif' border='0'/> ";
            echo "<a href='default.php?bid={$id}'>{$name}</a>";
            echo "</td></tr>\n";
        }
    }
}; // end class TreeNode

class Board
{
    public $m_id;
    public $m_name;
    public $m_desc;
    public $m_created_time;
    public $m_enabled;
    
    public static function getAll(&$boards)
    {
        $conn = db_connect();
        
        $sql = "SELECT * FROM t_board";
        $result = $conn->query($sql);
        
        for ($count = 0; $row = @$result->fetch_assoc(); $count++)
        {
            $board = new Board();
            
            $board->m_id             = $row['f_id'];
            $board->m_name           = $row['f_name'];
            $board->m_desc           = $row['f_desc'];
            $board->m_created_time   = $row['f_created_time'];
            $board->m_enabled        = $row['f_enabled'];
            
            $boards[$count] = $board;
        }
        
        $conn->close();
        return true;
    }
    
    public static function deleteAll()
    {
        $conn = db_connect();
        
        $sql = "UPDATE t_board SET f_enabled=0";
        $result = $conn->query($sql);
        
        $conn->close();
    }
    
    public static function restoreAll()
    {
        $conn = db_connect();
        
        $sql = "UPDATE t_board SET f_enabled=1";
        $result = $conn->query($sql);
        
        $conn->close();
    }
   
    function db_connect()
{
   $db = @new mysqli("127.0.0.1", "root", "0000", "zldb");
   if (!$db)
      return false;
   return $db;
}
    public static function deleteOrestore($ids)
    {
        if(empty($ids)) return;
        $sets = '';
        foreach($ids as $value) {
            $sets .= $value . ',';
        }
        $sets{strlen($sets)-1} = ' '; //移除末尾的','号
        
        $conn = db_connect();
        
        $sql = "UPDATE t_board SET f_enabled=NOT f_enabled ";
        $sql.= "WHERE f_id IN ($sets)";
        $result = $conn->query($sql);
        
        $conn->close();
    }
    
    public static function add($name, $desc)
    {
        $conn = db_connect();
        
        $sql = "INSERT INTO t_board (f_name, f_desc, f_created_time) ";
        $sql .= "VALUES ('$name', '$desc', now())";
        $result = $conn->query($sql);
        
        $conn->close();
        return $result;
    }
}
?>


