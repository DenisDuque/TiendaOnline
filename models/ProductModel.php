<?php
class ProductModel {
    private $code;
    private $name;
    private $description;
    private $codeCategory;
    private $price;
    private $stock;
    private $size;
    private $outstanding;

    public function setCode($code) {
        $this->code = $code;
    }

    public function getCode() {
        return $this->code;
    }

    public function setName($name) {
        $this->name = $name;
    } 

    public function getName() {
        return $this->name;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    } 

    public function getDescription() {
        return $this->description;
    }

    public function setCodeCategory($codeCategory) {
        $this->codeCategory = $codeCategory;
    } 

    public function getCodeCategory() {
        return $this->codeCategory;
    }

    public function setPrice($price) {
        $this->price = $price;
    } 

    public function getPrice() {
        return $this->price;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    } 

    public function getStock() {
        return $this->stock;
    }

    public function setSize($size) {
        $this->size = $size;
    } 

    public function getSize() {
        return $this->size;
    }

    public function setOutstanding($outstanding) {
        $this->outstanding = $outstanding;
    } 

    public function getOutstanding() {
        return $this->outstanding;
    }
    public function getTopProducts() {
        
    }
}
?>