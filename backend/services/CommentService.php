<?php

class CommentService {
    private $connection;
    
    public function __construct($connection) {
        $this->connection = $connection;
    }
    
    public function getRecentComments($limit = RECENT_COMMENTS_LIMIT) {
        $query = "SELECT * FROM tb_komen ORDER BY id_komen DESC LIMIT ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $limit);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }
    
    public function getAllComments() {
        $query = "SELECT * FROM tb_komen ORDER BY id_komen DESC";
        return mysqli_query($this->connection, $query);
    }
    
    public function createComment($authorName, $content) {
        $query = "INSERT INTO tb_komen (nama_penulis, detail_komen, tanggal_komen) VALUES (?, ?, NOW())";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $authorName, $content);
        return mysqli_stmt_execute($stmt);
    }
}
