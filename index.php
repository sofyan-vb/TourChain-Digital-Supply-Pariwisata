<?php
session_start();

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Simple Router
switch ($path) {
    // 1. PUBLIC ROUTES
    case '':
    case '/':
        require __DIR__ . '/views/home.php';
        break;
        
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require __DIR__ . '/controllers/AuthController.php';
            $auth = new AuthController();
            $auth->handleLogin();
        } else {
            require __DIR__ . '/views/auth/login.php';
        }
        break;
        
    case '/register':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require __DIR__ . '/controllers/AuthController.php';
            $auth = new AuthController();
            $auth->handleRegister();
        } else {
            require __DIR__ . '/views/auth/register.php';
        }
        break;
        
    case '/logout':
        require __DIR__ . '/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
        break;

    // 2. VENDOR ROUTES
    case '/vendor/dashboard':
        require __DIR__ . '/views/vendor/index.php';
        break;
        
    case '/vendor/produk/tambah':
        require __DIR__ . '/views/vendor/tambah_produk.php';
        break;
        
    case '/vendor/produk/store':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require __DIR__ . '/controllers/ProductController.php';
            $prod = new ProductController();
            $prod->store();
        } else {
            header("Location: /vendor/produk/tambah");
            exit;
        }
        break;

    // 3. PEMBELI (HOTEL/RESTORAN) ROUTES
    case '/pembeli/dashboard':
        require __DIR__ . '/views/pembeli/index.php';
        break;
        
    case '/pembeli/checkout':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require __DIR__ . '/controllers/OrderController.php';
            $order = new OrderController();
            $order->checkout();
        } else {
            require __DIR__ . '/views/pembeli/index.php'; // Sementara fallback ke dashboard pembeli
        }
        break;

    // 4. ADMIN ROUTES
    case '/admin/dashboard':
        require __DIR__ . '/views/admin/index.php';
        break;
        
    case '/admin/order/clear':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require __DIR__ . '/controllers/OrderController.php';
            $order = new OrderController();
            $order->clearFunds();
        }
        break;

    case '/admin/order/reject':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require __DIR__ . '/controllers/OrderController.php';
            $order = new OrderController();
            $order->rejectFunds();
        }
        break;

    // 5. 404 NOT FOUND
    default:
        http_response_code(404);
        echo "<h1 style='text-align:center; margin-top:50px;'>404 - Halaman Tidak Ditemukan</h1>";
        break;
}
?>
