<?php

class CommentService {
    private $connection;
    
    public function __construct($connection) {
        $this->connection = $connection;
        $this->ensureNotificationColumns();
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
        $query = "INSERT INTO tb_komen (nama_penulis, detail_komen, tanggal_komen, is_read, is_notified) VALUES (?, ?, NOW(), 0, 0)";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $authorName, $content);
        return mysqli_stmt_execute($stmt);
    }

    public function getUnreadCount() {
        $query = "SELECT COUNT(*) AS total FROM tb_komen WHERE is_read = 0";
        $result = mysqli_query($this->connection, $query);
        $data = mysqli_fetch_assoc($result);
        return (int) ($data['total'] ?? 0);
    }

    public function getLatestUnreadComment() {
        $query = "SELECT * FROM tb_komen WHERE is_read = 0 ORDER BY id_komen DESC LIMIT 1";
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_assoc($result) ?: null;
    }

    public function markAllAsRead() {
        return mysqli_query($this->connection, "UPDATE tb_komen SET is_read = 1 WHERE is_read = 0");
    }

    public function getLatestUnnotifiedComment() {
        $query = "SELECT * FROM tb_komen WHERE is_notified = 0 ORDER BY id_komen DESC LIMIT 1";
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_assoc($result) ?: null;
    }

    public function markAsNotified($commentId) {
        $query = "UPDATE tb_komen SET is_notified = 1 WHERE id_komen = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $commentId);
        return mysqli_stmt_execute($stmt);
    }

    private function ensureNotificationColumns() {
        $requiredColumns = [
            'is_read' => "ALTER TABLE tb_komen ADD COLUMN is_read TINYINT(1) NOT NULL DEFAULT 0",
            'is_notified' => "ALTER TABLE tb_komen ADD COLUMN is_notified TINYINT(1) NOT NULL DEFAULT 0"
        ];

        foreach ($requiredColumns as $column => $alterQuery) {
            $escapedColumn = mysqli_real_escape_string($this->connection, $column);
            $checkQuery = "SHOW COLUMNS FROM tb_komen LIKE '{$escapedColumn}'";
            $checkResult = mysqli_query($this->connection, $checkQuery);

            if ($checkResult && mysqli_num_rows($checkResult) === 0) {
                mysqli_query($this->connection, $alterQuery);
            }
        }
    }
}
