# LostTrack (PROJEK UAP)
LostTrack adalah sistem informasi berbasis web yang dirancang untuk membantu proses pelaporan dan pengelolaan barang hilang. Sistem ini memungkinkan pengguna untuk membuat laporan kehilangan barang secara online, memantau perkembangan status laporan, serta memperoleh informasi terkait proses pencarian barang yang hilang.
![Deskripsi Gambar](https://github.com/user-attachments/assets/4c2dcefa-054b-4648-b7e9-fecdf2df7221)

# Detail Konsep
Stored Procedure, Function, dan Trigger digunakan untuk meningkatkan konsistensi, efisiensi, dan integritas data pada sistem LostTrack. Logika tertentu ditempatkan langsung pada database sehingga proses pengolahan data dapat dilakukan secara lebih terstruktur dan aman.
## 📂 Function 
total_aduan_user(p_user_id)
Function ini digunakan untuk menghitung jumlah aduan yang pernah dibuat oleh pengguna tertentu.

Contoh Penggunaan:

`SELECT total_aduan_user();`

total_menunggu()
Function ini digunakan untuk menghitung jumlah aduan yang masih berstatus Menunggu Verifikasi. Function ini membantu administrator dalam memantau jumlah laporan yang belum diproses.

Contoh Penggunaan:

`SELECT total_menunggu();`

## 🔄 Trigger Database
trg_insert_report
Trigger ini dijalankan secara otomatis setelah data laporan baru ditambahkan ke tabel reports.
Tujuan trigger ini adalah mencatat status awal laporan ke tabel status_logs, sehingga setiap laporan yang dibuat memiliki riwayat status yang dapat dilacak.

trg_update_status
Trigger ini dijalankan secara otomatis setelah terjadi perubahan data pada tabel reports.
Trigger akan memeriksa apakah status laporan berubah. Jika terjadi perubahan status, maka sistem akan menambahkan catatan baru ke tabel status_logs sebagai riwayat perubahan status laporan.
<img width="1516" height="493" alt="Screenshot 2026-06-05 160201" src="https://github.com/user-attachments/assets/04c7e385-1672-442f-a9e6-670989711b15" />


# 💾 Backup Database
Untuk menjaga keamanan dan ketersediaan data, sistem LostTrack menyediakan fitur backup database manual dan otomatis. Backup dilakukan menggunakan utilitas mysqldump sehingga seluruh isi database dapat disimpan ke dalam file berekstensi.

Hasil backup disimpan pada direktori:

`storage/backups/`

Setiap file backup diberi nama berdasarkan waktu pembuatan (timestamp) sehingga memudahkan proses identifikasi dan pemulihan data.

`losttrack_backup_2026-06-05_10-16-00.sql`

## 📄 backup.php
File backup.php bertugas menjalankan proses backup database secara otomatis maupun manual. Proses yang dilakukan meliputi:

1. Membuat folder backup jika belum tersedia.

2. Membuat nama file backup berdasarkan tanggal dan waktu.

3. Menjalankan perintah mysqldump.

4. Menyimpan hasil backup ke folder storage/backups.

Kode 📄 backup.php

```php
<?php

date_default_timezone_set('Asia/Jakarta');

$date = date('Y-m-d_H-i-s');

$backup_dir = __DIR__ . '/storage/backups/';

if (!is_dir($backup_dir)) {
    mkdir($backup_dir, 0755, true);
}

$backupFile = $backup_dir . "losttrack_backup_$date.sql";

$mysqldump_path = "C:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump.exe";

$db_user = "root";
$db_pass = "";
$db_name = "losttrack";

$command = "\"$mysqldump_path\" -u $db_user $db_name --result-file=\"$backupFile\" 2>&1";

exec($command, $output, $return_var);

if ($return_var === 0 && file_exists($backupFile)) {
    echo "Backup berhasil!<br>";
    echo $backupFile;
} else {
    echo "Backup gagal!<br>";
    print_r($output);
}
```

## ⏰ Backup Otomatis
Sistem mendukung backup otomatis menggunakan Windows Task Scheduler. Backup dijalankan secara berkala sesuai jadwal yang telah ditentukan administrator.

Alur proses backup otomatis:

Task Scheduler → backup_auto.bat → backup.php
        
storage/backups

Dengan adanya fitur ini, proses pencadangan data dapat dilakukan tanpa campur tangan pengguna sehingga risiko kehilangan data dapat diminimalkan.
