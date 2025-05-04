<?php
require_once './App/Model/UserModel.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = $_POST['identifier'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($identifier) || empty($password)) {
                $_SESSION['error'] = 'Vui lòng cung cấp tên đăng nhập/số điện thoại và mật khẩu.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/login');
                exit;
            }

            $user = $this->userModel->getUserByIdentifier($identifier);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['username'] = $user['username']; // Thêm username vào session
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'home/index');
                exit;
            } else {
                $_SESSION['error'] = 'Tên đăng nhập/số điện thoại hoặc mật khẩu không đúng.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/login');
                exit;
            }
        }

        include './App/Views/User/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['name'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm-password'] ?? '';

            if (empty($fullname) || empty($username) || empty($phone) || empty($password)) {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ các thông tin.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/register');
                exit;
            }

            if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                $_SESSION['error'] = 'Tên đăng nhập phải có 3-20 ký tự, chỉ chứa chữ, số hoặc _.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/register');
                exit;
            }

            if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
                $_SESSION['error'] = 'Số điện thoại không hợp lệ (10-11 số).';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/register');
                exit;
            }

            if (strlen($fullname) > 255) {
                $_SESSION['error'] = 'Họ tên không được vượt quá 255 ký tự.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/register');
                exit;
            }

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
                $_SESSION['error'] = 'Mật khẩu phải có ít nhất 8 ký tự, gồm chữ hoa, chữ thường và số.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/register');
                exit;
            }

            if ($password !== $confirmPassword) {
                $_SESSION['error'] = 'Mật khẩu xác nhận không khớp.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/register');
                exit;
            }

            try {
                $userId = $this->userModel->createUser($fullname, $username, $phone, $password);
                if ($userId) {
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['username'] = $username; // Thêm username vào session
                    $_SESSION['success'] = 'Đăng ký thành công!';
                    $config = require 'config.php';
                    $baseURL = $config['baseURL'];
                    header('Location: ' . $baseURL . 'home/index');
                    exit;
                } else {
                    $_SESSION['error'] = 'Tên đăng nhập hoặc số điện thoại đã được sử dụng.';
                    $config = require 'config.php';
                    $baseURL = $config['baseURL'];
                    header('Location: ' . $baseURL . 'user/register');
                    exit;
                }
            } catch (Exception $e) {
                error_log("Lỗi đăng ký: " . $e->getMessage());
                $_SESSION['error'] = 'Lỗi máy chủ: Không thể đăng ký. Vui lòng thử lại sau.';
                $config = require 'config.php';
                $baseURL = $config['baseURL'];
                header('Location: ' . $baseURL . 'user/register');
                exit;
            }
        } else {
            include './App/Views/User/register.php';
        }
    }

    public function logout()
    {
        session_destroy();
        $config = require 'config.php';
        $baseURL = $config['baseURL'];
        header('Location: ' . $baseURL . 'home/index');
        exit;
    }

    public function contact()
    {
        include './App/Views/User/contact.php';
    }
}