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

<div class="container">
    <div class="card auth-card">
        <div class="card-body p-4">
            <h2 class="text-center mb-4 auth-title">
                🔍 LostTrack
            </h2>
            <p class="text-center text-muted">
                Sistem Aduan Kehilangan Barang
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
                        required
                    >
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >
                </div>
                <button class="btn btn-primary w-100">
                    Login
                </button>

            </form>
            <hr>

            <div class="text-center">

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