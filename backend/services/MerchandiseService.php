<?php

class MerchandiseService {
    private $connection;
    
    public function __construct($connection) {
        $this->connection = $connection;
    }
    
    public function getAllMerchandise() {
        $query = "SELECT * FROM tb_merch ORDER BY id_merch DESC";
        return mysqli_query($this->connection, $query);
    }
    
    public function getMerchandiseById($id) {
        $query = "SELECT * FROM tb_merch WHERE id_merch = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }
    
    public function hasPhoto($merchandise) {
        return !empty($merchandise['foto_merch']);
    }
    
    public function hasDescription($merchandise) {
        return !empty($merchandise['detail_merch']);
    }
}
