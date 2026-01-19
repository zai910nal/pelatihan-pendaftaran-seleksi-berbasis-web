<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelatihan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #001D39, #0A4174);
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* Background bubble */
        .bg-animation {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(189, 216, 233, 0.15);
            animation: float 12s infinite ease-in-out;
        }

        .bubble:nth-child(1) {
            width: 90px;
            height: 90px;
            top: 15%;
            left: 10%;
        }

        .bubble:nth-child(2) {
            width: 140px;
            height: 140px;
            top: 40%;
            right: 15%;
            animation-delay: 3s;
        }

        .bubble:nth-child(3) {
            width: 70px;
            height: 70px;
            bottom: 20%;
            left: 30%;
            animation-delay: 6s;
        }

        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(10, 65, 116, 0.9);
            padding: 2rem;
            color: #BDD8E9;
            z-index: 10;
        }

        .sidebar h2 {
            font-size: 1.4rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 1rem;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            text-decoration: none;
            color: #BDD8E9;
            border-radius: 10px;
            transition: 0.3s;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background: rgba(110, 162, 179, 0.4);
            color: #fff;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            padding: 2rem;
        }

        .login-box {
            background: rgba(189, 216, 233, 0.15);
            backdrop-filter: blur(25px);
            padding: 3rem;
            border-radius: 20px;
            width: 420px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            color: white;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .login-box p {
            text-align: center;
            margin-bottom: 2rem;
            color: #BDD8E9;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
            display: block;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #7BBDE8;
        }

        .input-group input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border-radius: 10px;
            border: none;
            background: rgba(255,255,255,0.15);
            color: white;
            font-size: 0.95rem;
        }

        .input-group input::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .input-group input:focus {
            outline: none;
            background: rgba(255,255,255,0.25);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #49769F, #4E8EA2);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 1rem;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #4E8EA2, #6EA2B3);
            transform: translateY(-2px);
        }

        .error-message {
            background: rgba(255, 99, 71, 0.3);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            display: flex;
            gap: 8px;
            align-items: center;
        }

        @media(max-width: 900px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="bg-animation">
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
</div>



<div class="main-content">
    <div class="login-box">
        <h2>Login Pelatihan</h2>
        <p>Masuk ke sistem pelatihan</p>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('pelatihan/auth/proses_login'); ?>">
            <div class="form-group">
                <label>Username</label>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Masukkan username" required>
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            <div style="margin-top:12px;text-align:center;color:#BDD8E9;">
             Belum punya akun? <a href="<?= site_url('pelatihan/auth/register') ?>" style="color:#7BBDE8;text-decoration:none;">Daftar</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
