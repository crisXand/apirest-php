<?php
class ProductRepository{

    private $conn = null;

    function __construct() {
        $this->conn = Db::getConn();
    }

    public function getAll(){
        $stm = $this->conn->query("SELECT * from products");

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id){
        $stm = $this->conn->prepare("SELECT * FROM products where id = :id");
        $stm->bindParam(":id",$id);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function update($id,$product){
        $stm = $this->conn->prepare("UPDATE products set name = ? where id = ? ");
        return $stm->execute([$product['name'], $id]);
    }
}