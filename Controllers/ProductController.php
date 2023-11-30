<?php
class ProductController{

    private $prod = null;

    function __construct(){
        $this->prod = new ProductRepository();
    }

    public function get($id){
        echo $id;
        if(isset($id)){
            $products = $this->prod->findById($id);
        }else{
            $products = $this->prod->getAll();
        }

        echo json_encode($products);
    }

    public function update($id, $body){
        $result = $this->prod->update($id, $body);
        if($result){
            echo json_encode(["msg" => "Update succesfully"]);
        }else{
             echo json_encode(["msg" => "Somethins was wrong"]);

        }
    }
}