<?php
class DB {
      private static $_instance = null;
      private $_pdo,
              $_query,
              $_error = false,
              $_results,
              $_count = 0,
              $_lastid;
      private $filde1="", $value1=""; // for joinget() funnction

      private function __construct()  {
        try {
          $username = Config::get('mysql/username');
          $pasword = Config::get('mysql/password');

          $this->_pdo =  new PDO ('mysql:host='.Config::get('mysql/host').'; dbname=' . Config::get('mysql/db') , $username, $pasword);
          // echo "concted";
        } catch (PDOExceptio $e) {
          die($e->getMessage());
        }
      }

      public static function getInstance() {
        if(!isset( self::$_instance )) {
          self::$_instance = new DB();
        }
        return self::$_instance;
      }

      public function query($sql, $params = array()) {
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){

          $x = 1;
          if (count($params)) {
            foreach ($params as $param) {
              $this->_query->bindValue($x , $param);
              $x++;
            //print_r($this->_query);
            }
          }

          if($this->_query->execute()) {

            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
            $this->_count = $this->_query->rowCount();
            $this->_lastid = $this->_pdo->lastInsertId();

          }else {
            $this->_error = true;
            // echo "not string";
          }

        }
        return $this;
      }

  public function action($action, $table, $where = array() ){
      if (count($where) === 3) {
         $operators = array('=', '>', '<', '>=', '<=');

         $filed    = $where[0];
         $operator = $where[1];
         $value    = $where[2];

        if (in_array($operator, $operators)) {

           $sql = "{$action} FROM {$table} WHERE {$filed} {$operator} ?";

          if (!$this->query($sql, array($value))->error()) {
            return $this;

          }
        }

      }

      return false;

  }

  public function get($table, $where ){   //by WHERE  condtion

      $this->action('SELECT *',  $table, $where );
      //print_r($where);
  }

  public function getAll($filde,$table){  // with out WHERE case
       $sql="SELECT {$filde} FROM {$table}";
       if($this->query($sql)){
           return true;
       }
       return false;
   }

   public function joinget($filde1, $value1){   // INNER JOIN
       //$sql="SELECT {$filde} FROM {$table}";
  $sql="SELECT `Enterprises`.`*`, `Ent_address`.`*`,`Ent_asset`.`*`,
               `Ent_organized_type`.`*`,`Ent_type_meaning`.`*`,
               `Ent_zerif`.`*`

        FROM `Enterprises`
        INNER JOIN `Ent_address` ON
        `Enterprises`.`id` = `Ent_address`.`ent_id`

        INNER JOIN `Ent_asset` ON
        `Enterprises`.`id`= `Ent_asset`.`ent_id`

        INNER JOIN `Ent_organized_type` ON
        `Enterprises`.`id` = `Ent_organized_type`.`ent_id`

        INNER JOIN `Ent_type_meaning` ON
        `Enterprises`.`id` = `Ent_type_meaning`.`ent_id`

        INNER JOIN `Ent_zerif` ON
        `Enterprises`.`id` = `Ent_zerif`.`ent_id`

                                             ";

        if ($filde1 && $value1 != "") {
           $sql .= " WHERE `Enterprises`.`$filde1` = '$value1' ";
        }else {
          $sql .=" WHERE 1 ";
        }

       if($this->query($sql)){
           return true;
       }
       return false;
   }



  public function insert($table, $fileds=array()){

    $keys = array_keys($fileds);
    //$values = array_values($fileds);
    $values = ' ';
    $x = 1;

    foreach($fileds as $filed ){
      $values .= '?';
      if ($x < count($fileds)) {

        $values .= ', ';
      }
      $x++;
    }

    // $sql = " INSERT INTO {$table} (`" .implode('`,`', $keys). "`) VALUES('" .implode("','" ,$values). "')";
    $sql = " INSERT INTO {$table} (`" .implode('`,`', $keys). "`) VALUES({$values})";
    //echo $sql;
    if (!$this->query($sql, $fileds)->error()) {

          return true;

      }

    return false;
  }

  public function update($table, $rowname, $id, $fileds){
    $set = '';
    $x = 1;
      foreach ($fileds as $filed => $value) {
        $set .= " {$filed} = ? ";
        if($x < count($fileds)) {
          $set .= ', ';
        }
        $x++;

      }
        //die($set);
        $sql =" UPDATE {$table} SET {$set} WHERE {$rowname} = {$id}";
      //  echo $sql; results like this UPDATE users SET name = ? , email = ? WHERE id = 3
     if (!$this->query($sql, $fileds)->error()) {

        return true;
     }
     return false;
  }

  public function delete($table, $where ){

      $this->action('DELETE', $table, $where );
  }

  public function error() {

    return $this->_error;
  }


   public function first(){
     return $this->results()[0];
   }

  public function results(){

    return $this->_results;
  }

  public function lastID(){

     return $this->_lastid;
  }

  public function count() {
    return $this->_count;
  }

}
?>
