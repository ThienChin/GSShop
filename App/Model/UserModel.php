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
}