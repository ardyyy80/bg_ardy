<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: admin/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Backend Gameardy</title>
    <style>
        :root {
            --light-bg: #f5f7fa;
            --light-purple: #e8e4f3;
            --light-accent: #d4c5f9;
            --light-hover: #c5b3f0;
            --accent-purple: #000000;
            --dark-text: #2d3748;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8e4f3 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(124, 94, 201, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(124, 94, 201, 0.15);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: var(--accent-purple);
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark-text);
            font-weight: 500;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(124, 94, 201, 0.3);
            border-radius: 5px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.9);
            color: var(--dark-text);
            transition: all 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--accent-purple);
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 0 3px rgba(124, 94, 201, 0.15);
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #7c5ec9 0%, #9b7ed6 100%);
            color: white;
            border: 1px solid #7c5ec9;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            background: linear-gradient(135deg, #9b7ed6 0%, #b399e0 100%);
            border-color: #9b7ed6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(124, 94, 201, 0.3);
        }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: 500;
        }
        .alert-danger {
            background-color: #fee;
            color: #c53030;
            border: 1px solid #feb2b2;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    if ($_GET['error'] == 'invalid') {
                        echo "Username atau password salah!";
                    } elseif ($_GET['error'] == 'empty') {
                        echo "Username dan password harus diisi!";
                    } elseif ($_GET['error'] == 'logout') {
                        echo "Anda telah logout!";
                    }
                ?>
            </div>
        <?php endif; ?>

        <form action="login_proses.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
