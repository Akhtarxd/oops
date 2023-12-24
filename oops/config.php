<?php
class database{
    private $host;
    private $dbusername;
    private $dbpassword;
    private $dbname;

    protected function connect(){
        $this->host='localhost';
        $this->dbusername='root';
        $this->dbpassword='';
        $this->dbname='crud';
        $con=new mySQLi($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
        return $con;
    }
}

class query extends database{
    public function getData($table,$field='*',$conditionArr='',$order_by_field='',$order_by_type='desc',$limit=''){
        $sql = "SELECT $field FROM $table";
        if($conditionArr!=''){
            $sql.=" WHERE ";
            $count = count($conditionArr);
            $i = 1;
            foreach($conditionArr as $key=>$value){
                if($i == $count){
                    $sql.="$key='$value'";
                }else{
                    $sql.="$key='$value' AND ";
                }
                $i++;
            }
        }
        if($limit!=''){
            $sql.=" LIMIT $limit ";
        }
        if($order_by_field!=''){
            $sql.=" ORDER BY $order_by_field $order_by_type ";
        }
        
        $result = $this->connect()->query($sql);
        if($result->num_rows>0){
            $arr=array();
            while($row=$result->fetch_assoc()){
                $arr[]=$row;
            }
            return $arr;
        }else{
            return 0;
        }
        //echo $sql;
        //$result = $this->connect()->query($sql);
    }

    public function insertData($table,$conditionArr){
        if($conditionArr!=''){
            foreach($conditionArr as $key=>$value){
                $fieldArr[]=$key;
                $valueArr[]=$value;
            }
            $field = implode(",",$fieldArr);
            $value = implode("','",$valueArr);
            $value = "'".$value."'";
            $sql = "INSERT INTO $table($field) VALUES($value)";
        }
        $result = $this->connect()->query($sql);
    }

    public function deleteData($table,$conditionArr){
        if($conditionArr!=''){
            $sql = "DELETE FROM $table WHERE ";
            $c = count($conditionArr);
            $i = 1;
            foreach($conditionArr as $key=>$value){
                if($i!=$c){
                    $sql.= "$key ='$value' AND ";
                }else{
                    $sql.= "$key = '$value'";
                }
                $i++;
            }
            }
            $result = $this->connect()->query($sql);
        }

    public function updateData($table,$conditionArr,$whereField,$whereValue){
        if($conditionArr!=''){
            $sql="UPDATE $table SET ";
            $c = count($conditionArr);
            $i = 1;
            foreach($conditionArr as $key=>$value){
                if($i!=$c){
                    $sql.="$key ='$value', ";
                }else{
                    $sql.="$key = '$value' ";
                }
                $i++;
            }
            $sql.="WHERE $whereField = '$whereValue'";
            }
            $result=$this->connect()->query($sql);
            
        }
    public function getSafeStr($str){
        if($str!=''){
            return mysqli_real_escape_string($this->connect(),$str);
        }
    }
}

?>