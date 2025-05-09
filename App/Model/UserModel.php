<?php
require_once __DIR__ . '/../../Core/database.php';

class UserModel
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = Database::connect();
        } catch (PDOException $e) {
            error_log("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
            throw new Exception("Không thể kết nối cơ sở dữ liệu.");
        }
    }

    public function getAllUsers()
    {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginatedUsers($limit, $offset)
    {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY id ASC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalUsers()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function createUser($fullname, $username, $phone, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? OR phone = ?");
        $stmt->execute([$username, $phone]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (fullname, username, phone, password) VALUES (?, ?, ?, ?)";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$fullname, $username, $phone, $hashedPassword]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi khi chèn người dùng: " . $e->getMessage());
            throw new Exception("Không thể tạo người dùng: " . $e->getMessage());
        }
    }

    public function getUserByPhone($phone)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByIdentifier($identifier)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? OR phone = ?");
        $stmt->execute([$identifier, $identifier]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        try {
            $stmt->execute([$userId]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Lỗi khi xóa người dùng: " . $e->getMessage());
            throw new Exception("Không thể xóa người dùng: " . $e->getMessage());
        }
    }
}