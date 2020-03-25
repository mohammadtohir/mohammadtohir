<?php

include '../Database.php';
class Member {
    private $connect;
    private $table;
    private $primary;
    private $fields;

    public function __construct()
    {
        $db = new Database();
        $this->connect = $db->connect();
        $this->table = "buku";
        $this->primary= "idbuku";
        $this->fields =['judul','pengarang','penerbit','sinopsis','gambar'];
    }

    public function get(){
        $query = "SELECT * FROM ".$this->table;
        $result = mysqli_query($this->connect, $query);

        $data =[];
        while($row= mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        return $data;
    }

    public function delete($idbuku){
        $query  = "DELETE FROM ".$this->table;
        $query .=" WHERE idbuku ='".$idbuku."'";

        $res = mysqli_query($this->connect,$query);
        return $res;
    }

    public function add($data){
        $request= json_decode(json_encode($data));
        $query = "INSERT INTO buku (`judul`,`pengarang`,`penerbit`,`sinopsis`,`gambar`)";
        $query .= "VALUES ('".$request->judul."','".$request->pengarang."','".$request->penerbit."','".$request->sinopsis."','".$request->gambar."')";
        $res = mysqli_query($this->connect, $query);
        return $res;
    }

    public function update($data){
        $request= json_decode(json_encode($data));
        $query  = "UPDATE buku SET ";
        $filter = " WHERE ";
        foreach($request as $key=>$row){

            if(in_array($key,$this->fields))
                $query .="`".$key."`='".$row."',";
            
            if($key ==$this->primary)
                $filter .="`".$key."`=".$row;
        }
        $query_build = rtrim($query,",").$filter;

        $res = mysqli_query($this->connect, $query_build);
        return $res;
    }

}