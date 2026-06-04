<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Register - LostTrack</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">
    <style>
        body{
            background:#f4f7fc;
        }

        .register-card{
            max-width:500px;
            margin:auto;
            margin-top:60px;
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

           <h2 class="text-center auth-title">
                📝 Register LostTrack
            </h2>

            <form method="POST">

                <div class="mb-3">

                    <label>Nama</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        required
                    >

                </div>

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

                <button class="btn btn-success w-100">
                    Register
                </button>

            </form>

            <hr>

            <div class="text-center">

                Sudah punya akun?

                <a href="index.php?page=login">
                    Login
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>