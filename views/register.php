<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register - LostTrack</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    min-height:100vh;
    display:flex;
    font-family:'Segoe UI',sans-serif;
}

.left-side{
    width:55%;
    background:
    linear-gradient(
        rgba(25,45,80,.75),
        rgba(25,45,80,.75)
    ),
    url('assets/img/city-bg.jpg');

    background-size:cover;
    background-position:center;

    display:flex;
    justify-content:center;
    align-items:center;

    color:white;
    padding:60px;
}

.brand-box{
    max-width:600px;
}

.brand-box h1{
    font-size:70px;
    font-weight:700;
}

.brand-box p{
    font-size:18px;
    margin-top:20px;
}

.right-side{
    width:45%;
    background:#06112b;

    display:flex;
    justify-content:center;
    align-items:center;
}

.register-card{
    width:500px;
    background:#071633;

    border-radius:30px;

    padding:50px;

    box-shadow:
    0 20px 50px rgba(0,0,0,.3);
}

.register-card h2{
    color:white;
    font-weight:700;
    margin-bottom:10px;
}

.register-card p{
    color:#9ca3af;
    margin-bottom:30px;
}

.form-label{
    color:white;
}

.form-control{
    background:#102552;
    border:1px solid #1f3d7a;
    color:white;
    height:55px;
}

.form-control:focus{
    background:#102552;
    color:white;
    border-color:#4f46e5;
    box-shadow:none;
}

.btn-register{
    width:100%;
    height:55px;
    border:none;
    border-radius:12px;

    background:
    linear-gradient(
        90deg,
        #2563eb,
        #4f46e5
    );

    color:white;
    font-size:18px;
    font-weight:600;
}

.login-link{
    text-align:center;
    margin-top:20px;
    color:white;
}

.login-link a{
    text-decoration:none;
    color:#3b82f6;
}

.logo{
    font-size:65px;
    margin-bottom:15px;
}

</style>

</head>
<body>

<div class="left-side">

    <div class="brand-box">

        <div class="logo">🔍</div>

        <h1>LostTrack</h1>

        <h3>Sistem Aduan Kehilangan Barang</h3>

        <p>
            Daftarkan akunmu untuk mulai membuat laporan kehilangan,
            memantau status pencarian, dan menemukan kembali barangmu.
        </p>

    </div>

</div>

<div class="right-side">

    <div class="register-card">

        <h2>Buat Akun Baru</h2>

        <p>Silakan isi data berikut untuk mendaftar</p>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Masukkan nama lengkap"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button
                type="submit"
                class="btn-register"
            >
                Register
            </button>

        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="index.php?page=login">
                Login
            </a>
        </div>

    </div>

</div>

</body>
</html>