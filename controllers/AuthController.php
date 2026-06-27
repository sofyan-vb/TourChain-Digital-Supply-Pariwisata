<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->getByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['peran'] = $user['peran'];

                if ($user['peran'] == 'Admin') {
                    header("Location: /admin/dashboard");
                } elseif ($user['peran'] == 'Vendor') {
                    header("Location: /vendor/dashboard");
                } else {
                    header("Location: /pembeli/dashboard");
                }
                exit;
            } else {
                header("Location: /login?error=1");
                exit;
            }
        }
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $peran = $_POST['peran'];

            if ($this->userModel->create($nama, $email, $password, $peran)) {
                header("Location: /login?success=1");
                exit;
            } else {
                header("Location: /register?error=1");
                exit;
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /login?msg=logout");
        exit;
    }
}
?>
