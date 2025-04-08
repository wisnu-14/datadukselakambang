<?php
error_reporting(1);
require '../../app/controller/AuthController.php';
require '../../app/middleware/Guest.php';
require '../../app/controller/CountController.php';
logUserVisit();
guestMiddleware();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $result = loginUser($_POST['username'], $_POST['password']);
    if ($result === true) {
        header("Location: ../auth/redirect.php");
        exit();
    } else {
        $_SESSION['error'] = $result;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="../../public/asset/logo/logo-title.png">
    <?php include '../../app/config/cdn/css.php'; ?>
    <style>
        body {
            background-color: #eaf8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    
        .login-container {
            width: 100%;
            padding: 100px;
            padding-block: 150px;
            max-width: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
     @media screen and (max-width: 768px) {
            .login-container {
                width: 100%;
                margin: 50px 50px;
                padding: 50px;
                padding-block: 100px;
                max-width: 500px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

        }
        .btn-primary {
            background-color: #3b6ef8;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2a5adb;
        }

        input:focus {
            outline: none !important;
            box-shadow: none !important;
            border-color: grey !important;
            transition: .2s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h3 class="mb-4">Account Login</h3>
        <?php if (isset($_GET['message']) && $_GET['message'] == 'session_timeout'): ?>
    <div class="alert alert-warning">Sesi Anda telah berakhir karena tidak aktif. Silakan login kembali.</div>
<?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color:red;"><?php echo $_SESSION['error'];
                                    unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <input type="username" name="username" class="form-control rounded-0" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control rounded-0" placeholder="Password" required>
            </div>
            <button type="submit" class="rounded-0 btn btn-primary w-100">SIGN IN</button>
        </form>

    </div>
    <?php include '../../app/config/cdn/js.php'; ?>

</body>

</html>