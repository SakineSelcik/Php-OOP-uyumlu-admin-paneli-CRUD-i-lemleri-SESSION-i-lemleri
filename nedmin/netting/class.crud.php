<?php
require_once 'dbconfig.php';
class curd{

    private $db;
    private $dbhost = DBHOST;
    private $dbuser = DBUSER;
    private $dbpass = DBPASS;
    private $dbname = DBNAME;
    function __construct()
    {
        try {

            $this->db=new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.'; charset = utf8; '
                ,$this->dbuser,$this->dbpass);
        }
        catch (Exception $e){
            die('BAĞLANTI BAŞARISIZ :'.$e->getMessage());
        }
    }
    public function adminsLogin($admins_username,$admins_pass,$remember_me){

        try {
            $stmt = $this->db->prepare('SELECT * FROM admins WHERE admins_username=? AND admins_pass=?');

            if (isset($_COOKIE['adminsLogin'])){
                $stmt->execute([$admins_username, md5( openssl_decrypt($admins_pass,"AES-128-ECB","admins_coz"))]);
            }
            else   $stmt->execute([$admins_username, md5($admins_pass)]);

            if ($stmt->rowCount() )
            {
                $row= $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row['admins_status']==0){
                    return ['status' => FAlSE];
                    exit();
                }
                
                $_SESSION["admins"]=[
                    "admins_username"=>$admins_username,
                    "admins_pass"=>$admins_pass,
                    "admins_namesurname"=> $row['admins_namesurname'],
                    "admins_file"=>$row['admins_file'],
                    "admins_id"=>$row['admins_id'],
                ];
                $admins= [
                    "admins_username"=>$admins_username,
                    "admins_pass"=> openssl_encrypt($admins_pass,"AES-128-ECB","admins_coz")
                ];
                if (!empty($remember_me) && empty($_COOKIE['adminsLogin'])){

                    setcookie("adminsLogin", json_encode($admins), strtotime("+30 day"),"/");
                }
                else if(empty($remember_me)) {
                    setcookie("adminsLogin", json_encode($admins), strtotime("-30 day"),"/");
                }
                return ['status' => TRUE];
            }
            else {
                return ['status' => FAlSE];
            }

        }
        catch (Exception $e){

        }


    }
    public function addValue($argse){
     $values= implode(',',array_map(function ($item){
           return $item.'=?';
       }, array_keys($argse)));
     return $values;
    }
    public function insert($table,$values,$options=[]){
        try {
            if(!empty($_FILES[$options['file_name']]['name'])){

             $name_y=$this->imageUpdate(
                  $_FILES[$options['file_name']]['name'],
                  $_FILES[$options['file_name']]['size'],
                  $_FILES[$options['file_name']]['tmp_name'],
                  $options['dir']
             );

                $values+=[$options['file_name']=>$name_y];
            }
            unset($values[$options["buton_key"]]);
            if (isset($options["pass"])){
                $values[$options["pass"]]= md5( $values[$options["pass"]]);
            }

            $stmt= $this->db->prepare("INSERT INTO $table SET {$this->addValue($values)}");
            $stmt->execute(array_values($values));
            return ['status' => TRUE];
        }
        catch (Exception $e){
            return['status'=> FALSE , 'eror'=> $e->getMessage()];
        }
    }
    public function update($table,$values,$options=[]){
        try {
            if(!empty($_FILES[$options['file_name']]['name'])){

                $name_y=$this->imageUpdate(
                    $_FILES[$options['file_name']]['name'],
                    $_FILES[$options['file_name']]['size'],
                    $_FILES[$options['file_name']]['tmp_name'],
                    $options['dir'],
                    $values[$options['file_delete']]
                );
               // print_r($name_y);
               // exit();
                $values+=[$options['file_name']=>$name_y];

            }
            unset( $values[$options['file_delete']]);

            if (isset($options["pass"])){
                $values[$options["pass"]]= md5( $values[$options["pass"]]);
            }
            $columns_id = $values[$options["columns"]];
            unset($values[$options["buton_key"]]);
            unset($values[$options["columns"]]);
            $valuesExecute=$values;
            $valuesExecute+=[$options['columns']=>$columns_id];
           // echo "<pre>";
            //print_r($values);
            //print_r($valuesExecute);
            $stmt= $this->db->prepare("UPDATE $table SET {$this->addValue($values)} WHERE {$options['columns']}=?");
            $stmt->execute(array_values($valuesExecute));
            return ['status' => TRUE];
        }
        catch (Exception $e){
            return['status'=> FALSE , 'eror'=> $e->getMessage()];
        }
    }
    public function delete($table,$columns,$values,$fileName=null){

        try {

            if(!empty($fileName)){
                unlink("dimg/$table/".$fileName);
            }

            $stmt=$this->db->prepare("DELETE FROM $table WHERE $columns=?");
            $stmt->execute([htmlspecialchars($values)]);
            return ['status' => TRUE];

        }catch (Exception $e){
            return['status'=> FALSE , 'eror'=> $e->getMessage()];
        }
    }
    public function imageUpdate($name,$size,$tmp_name,$dir,$file_delete=Null){
        try {
            $izinli_uzantilar=[
                'jpg',
                'jpeg',
                'jpge',
                'png',
                'ico',
            ];
            $ext= strtolower(substr($name,strpos($name, '.')+1));
            if(in_array($ext,$izinli_uzantilar)===FALSE){
                throw new Exception('Bu dosya türü kabul edilemez..');
            }
            if ($size>1048576){
                throw new Exception('Bu dosya boyutu kabul edilemez..');}


            $name_y=uniqid().".".$ext;

            if (!@move_uploaded_file($tmp_name,"dimg/$dir/$name_y")){
                throw new Exception('Dosya yükleme hatası..');
            }

            if(!empty($file_delete)&& $dir==="admins"){
               // unlink("dimg/$dir/$file_delete");
                if(strstr($dir,"admin")){
                    $_SESSION["admins"]["admins_file" ]=$name_y;
                }


            }

            return $name_y;
        }
        catch (Exception $e){
            return['status'=> FALSE , 'eror'=> $e->getMessage()];
        }
    }
    public function adminInsert($admins_namesurname,$admins_username,$admins_pass,$admins_status){
        try {
            $stmt= $this->db->prepare("INSERT INTO admins SET admins_namesurname=?,admins_username=?,admins_pass=?,admins_status=?");
            $stmt->execute([$admins_namesurname,$admins_username,md5($admins_pass),$admins_status]);
            return ['status' => TRUE];
        }
        catch (Exception $e){
            return['status'=> FALSE , 'eror'=> $e->getMessage()];
        }
    }
    public function read($table,$options=[]){

        try {

            if(isset($options['columns_name']) && empty($options['limit'])){
                $stmt = $this->db->prepare("SELECT * FROM $table order by {$options['columns_name']} {$options['columns_sort']}");
            }
            else if(isset($options['columns_name']) && isset($options['limit'])){
                $stmt = $this->db->prepare("SELECT * FROM $table order by {$options['columns_name']} {$options['columns_sort']} limit {$options['limit']}");
            }
            else{
                $stmt = $this->db->prepare("SELECT * FROM $table");
            }

            $stmt->execute();
            return $stmt ;
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }

    }
    public function wread($table,$columns,$values,$options=[]){
        try {
            $stmt = $this->db->prepare("SELECT* FROM $table WHERE $columns=?");
            $stmt->execute([htmlspecialchars($values)]);
            return $stmt ;
        }
        catch (Exception $e){
            return['status'=> FALSE , 'eror'=> $e->getMessage()];
        }

    }
    public function orderUpdate($table,$values,$columns,$orderId) {

        try {

            foreach ($values as $key => $value) {

                $stmt = $this->db->prepare("UPDATE $table SET $columns=? WHERE $orderId=?");
                $stmt->execute([$key,$value]);

            }

            return ['status' => TRUE];

        } catch(PDOException $e) {
            echo $e->getMessage();
            return ['status' => FALSE,'error'=> $e->getMessage()];

        }
    }

}


?>
