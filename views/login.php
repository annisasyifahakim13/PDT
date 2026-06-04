<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - LostTrack</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">
    <style>
        body{
            background:#f4f7fc;
        }

        .login-card{
            max-width:450px;
            margin:auto;
            margin-top:100px;
            border:none;
            border-radius:15px;
            box-shadow:0 0 20px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>

<div class="login-container">

    <!-- KIRI -->
    <div class="login-left">

        <div class="branding">

            <h1>🔍 LostTrack</h1>

            <p class="subtitle">
                Sistem Aduan Kehilangan Barang
            </p>

            <p class="description">
                Laporkan kehilangan barang dengan mudah,
                pantau status penemuan, dan temukan kembali
                barangmu dengan cepat.
            </p>

        </div>

    </div>

    <!-- KANAN -->
    <div class="login-right">

        <div class="auth-card">

            <h2>Selamat Datang Kembali!</h2>

            <p class="text-muted mb-4">
                Silakan login untuk melanjutkan
            </p>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan email"
                        required>

                </div>

                <div class="mb-4">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required>

                </div>

                <button
                    type="submit"
                    class="btn btn-login w-100">

                    Login

                </button>

            </form>

            <div class="register-link">

                Belum punya akun?

                <a href="index.php?page=register">
                    Register
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>