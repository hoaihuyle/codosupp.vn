<?php  
$db = new Database();
    session_start();

    
    /**
    * 
    */
    class Database
    {
        /**
         * Khai báo biến kết nối
         * @var [type]
         */
        public $link;

        public function __construct()
        {

            // $this->link =  mysqli_connect("localhost","root","","codosupp") or die ("Kết nối thất bại thử lại sau - Connect Fail, please try agian late !");
            // $this->link = mysqli_connect("cit.cit","root","","cit_db") or die ();
            $this->link =  mysqli_connect("localhost","root","","codosupp") or die ("Kết nối thất bại thử lại sau - Connect Fail, please try agian late !");
            mysqli_set_charset($this->link,"utf8");
        }
 
        /**
         * [insert description] hàm insert 
         * @param  $table
         * @param  array  $data  
         * @return integer
         */
        public function insert($table, array $data)
        {
            
            //code
            $sql = "INSERT INTO {$table} ";
            $columns = implode(',', array_keys($data));
            $values  = "";
            $sql .= '(' . $columns . ')';
            foreach($data as $field => $value) {
                if(is_string($value)) {
                    $values .= "'". mysqli_real_escape_string($this->link,$value) ."',";
                } else {
                    $values .= mysqli_real_escape_string($this->link,$value) . ',';
                }
            }
            $values = substr($values, 0, -1);
            $sql .= " VALUES (" . $values . ')';
            
            // _debug($sql);die;

            // _debug($sql);die;

            mysqli_query($this->link, $sql) or die("Lỗi  query  insert ----" .mysqli_error($this->link));
            return mysqli_insert_id($this->link);
        }

        public function update($table, array $data, array $conditions)
        {
            $sql = "UPDATE {$table}";

            $set = " SET ";

            $where = " WHERE ";

            foreach($data as $field => $value) {
               
                if(is_string($value)) {
                    
                    $set .= $field .'='.'\''. mysqli_real_escape_string($this->link, ($value)) .'\',';
                } else {
                    $set .= $field .'='. mysqli_real_escape_string($this->link, ($value)) . ',';
                }

                // if(is_string($value)) {
                    
                //     $set .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\',';
                // } else {
                //     $set .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ',';
                // }
            }
            $set = substr($set, 0, -1);
            foreach($conditions as $field => $value) {

                if(is_string($value)) {
                    $where .= $field .'='.'\''. mysqli_real_escape_string($this->link, ($value)) .'\' AND ';
                } else {
                    $where .= $field .'='. mysqli_real_escape_string($this->link, ($value)) . ' AND ';
                }

                // if(is_string($value)) {
                //     $where .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\' AND ';
                // } else {
                //     $where .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ' AND ';
                // }
            }

            $where = substr($where, 0, -5);

            $sql .= $set . $where;
            // var_dump($sql);
            // die();

            mysqli_query($this->link, $sql) or die( "Lỗi truy vấn Update -- " .mysqli_error($this->link));

            return mysqli_affected_rows($this->link);
        }

        public function updateview($sql)
        {
            $result = mysqli_query($this->link,$sql)  or die ("Lỗi update view " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);

        }
        public function countTable($table)
        {
            $sql = "SELECT * FROM  {$table}";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }


        /**
         * [delete description] hàm delete
         * @param  $table      [description]
         * @param  array  $conditions [description]
         * @return integer             [description]
         */
        public function delete ($table ,  $id, $col = null )
        {
            if(!isset($col)) $sql = "DELETE FROM {$table} WHERE id = $id ";
            else             $sql = "DELETE FROM {$table} WHERE $col = $id ";
            
            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }
        public function WhereOneTable($table, array $data1,array $conditions){
            $sql="SELECT * FROM {$table} WHERE ";
            for($x=0;$x<count($data1);$x++){
                 $sql.=$data1[$x].'=';
                for($y=$x;$y<=$x;$y++){
                    if(count($conditions)-$y!=1){
                      $sql.=$conditions[$y]."AND";
                    }
                    else{
                         $sql.=$conditions[$y];
                    }
                }
            }
                echo $sql ;
                
                $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
                    $data = [];
                    if( $result)
                    {
                        while ($num = mysqli_fetch_assoc($result))
                        {
                            $data[] = $num;
                        }
                    }
                    return $data;
            }
                

        /**
         * delete array 
         */
        public function deletewhere($table,$data = array())
        {
            foreach ($data as $id)
            {
                $id = intval($id);
                $sql = "DELETE FROM {$table} WHERE id = $id ";
                mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            }
            return true;
        }
        //
    // ==========================FETCH ===========================
        // truy vấn dữ liệu trong bảng - tùy chọn
        public function fetchsql($sql)
        {
        //     var_dump($sql);
        // die();
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        } 

        /**
         * FetchSql just return result
         */
        public function fetchsqlConn($sql)
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return $result;
        }
        
        
         //lấy toàn bộ dữ liệu của id có trong bảng
         public function fetchByCol($table , $col, $colval )
         {
            $sql = "SELECT * FROM {$table} as tb WHERE $col = $colval";
           
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
         }

        //lấy toàn bộ dữ liệu với điều kiện có trong bảng
        //$id = array 'name' => 'val'
        //return a record
        public function fetchWhere($table , $val)
        {
            $sql = "SELECT * FROM {$table} WHERE $val ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        //$id = array 'name' => 'val'
        //return array
        public function fetchArr($table , $val)
        {
            $sql = "SELECT * FROM {$table} WHERE $val";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        //$id = array 'name' => 'val'
        public function fetchMax($table, $column , $limit)
        {
            $sql = "SELECT * FROM {$table} ORDER BY {$column} LIMIT $limit ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }
        //select count max
        public function fetchMaxId($table,$column)
        {
            $sql = "SELECT Max({$column}) FROM {$table}";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }
        
        //lấy toàn bộ dữ liệu của id có trong bảng
        public function fetchID($table , $id)
        {
            $sql = "SELECT * FROM {$table} WHERE id = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }


        
        /**
         * String query active join between two table
         * read all col in table 1
         * read few col in table 2 throw array parameter
         * return string
         */
        public function queryJoin($tableAll, $tableJoin, $fore, $cols, $cuscol=null)
        {
            $cols = implode(",tb2.", $cols);
            if($cuscol==null) $cuscol="";
            else $cuscol=','.$cuscol;
            $sql = "SELECT tb1.*,tb2.".$cols.$cuscol." 
            FROM {$tableAll} as tb1 
            JOIN {$tableJoin} as tb2 
            ON tb1.id = tb2.{$fore} ";
            // var_dump($sql);
            // die();
            return $sql;
        }

         /**
         * String query active join between two table
         * read all col in table 1
         * read few col in table 2 throw array parameter
         * return string
         */
        public function queryJoin2($tableAll, $tableJoin, $col1, $col2)
        {


            $sql = "SELECT * FROM {$tableAll} as tb1 
            JOIN {$tableJoin} as tb2 
            ON tb1.{$col1} = tb2.{$col2} ";
            return $sql;
        }

        /**
         * Parameter $sql: the query to excute
         * return array
         */
        public function returnArrData($sql){
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchAllTb1JoinWhere " .mysqli_error($this->link).$sql);
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        /**
         * Extend queryJoin
         * return array 
         * ORDER BY COL
         */
        public function fetchAlltb1Coltb2JoinOrder($tableAll, $tableJoin, $fore, $cols, $order, $cuscol=null){
           
            $sql = $this -> queryJoin($tableAll, $tableJoin, $fore, $cols, $cuscol);
            $sql.="ORDER BY {$order} DESC";
            //$this->link =  mysqli_connect("localhost","codoeedp_root","codosupp.website","codoeedp_db") or die ("Kết nối thất bại thử lại sau - Connect Fail, please try agian late !");
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchAllTb1JoinWhere " .mysqli_error($this->link).$sql);
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        //lấy toàn bộ dữ liệu ở 1 bảng có 1 trường ở trong bảng với điều kiện
        public function fetchAllTb1JoinWhere($tableAll, $tableJoin, $col1, $col2, $clause)
        {
            $sql = $this -> queryJoin2($tableAll, $tableJoin, $col1, $col2);
            $sql .= "WHERE {$clause} ";
            // var_dump($sql);
            // die();
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchAllTb1JoinWhere " .mysqli_error($this->link).$sql);
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
            
        }
        /* kiểm tra dữ liệu tồn tại trong bảng hay chưa??
        *  $table = 'name table'
        *  $query = "email ='".$data['email']."' "
        */
        //kiểm tra dữ liệu tồn tại trong bảng hay chưa??
        public function fetchOne($table , $query)
        {
            $sql  = "SELECT * FROM {$table} WHERE ";
            $sql .= $query;
            $sql .= "LIMIT 1";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchOne " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        public function deletesql ($table ,  $sql )
        {
            $sql = "DELETE FROM {$table} WHERE " .$sql;
            // _debug($sql);die;
            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        
        //lấy dữ liệu từ csdl
         public function fetchAll($table)
        {
            $sql = "SELECT * FROM {$table} WHERE 1" ;
            $result = mysqli_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        //Total là tổng số bản ghi, row số bảng ghi trong 1 trang
        /*
         * total: tổng số trang
         * page: trang hiện tại
         * row: số bảng ghi cần lấy ra
         *
         * */
        public  function fetchJones($table,$sql,$total = 1,$page,$row ,$pagi = true )
        {
            
            $data = [];

            if ($pagi == true )
            {
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row ";
                $data = [ "page" => $sotrang];
              
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            else
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            
            return $data;
        }

        public  function fetchJone($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
            // _debug($sql);die;
            if ($pagi == true )
            {
                $total = $this->countTable($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            else
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            // _debug($data);
            return $data;
        }


        public  function fetchJoneDetail($sql ,$page = 0,$total ,$pagi )
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            $sotrang = ceil($total / $pagi);
            $start = ($page - 1 ) * $pagi ;
            $sql .= " LIMIT $start,$pagi";       
            $result = mysqli_query($this->link , $sql);
            $data = [];
            // $data = [ "page" => $sotrang];
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function total($sql)
        {
            $result = mysqli_query($this->link  , $sql);
            $tien = mysqli_fetch_assoc($result);
            return $tien;
        }
    //===========End FETCH
    }
    
   
?>