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

## Simulasi Deadlock
Fitur ini digunakan saat administrator melakukan perubahan status laporan kehilangan. Ketika satu administrator sedang memproses perubahan status suatu laporan, data laporan tersebut akan dikunci (locked) sehingga administrator lain tidak dapat mengubah data yang sama secara bersamaan.

Kode :
SELECT *
FROM reports
WHERE id = ?
FOR UPDATE;

Simulasi Konflik Akses Data
Untuk keperluan pengujian, sistem mensimulasikan kondisi konflik akses data (deadlock scenario) dengan memberikan jeda proses menggunakan:

sleep(15);
Apabila dua administrator mencoba memperbarui status laporan yang sama secara bersamaan, maka:
- Admin pertama akan memperoleh lock pada data laporan.
- Admin kedua harus menunggu hingga transaksi pertama selesai.
- Jika waktu tunggu melebihi batas yang ditentukan oleh database (innodb_lock_wait_timeout), maka transaksi salah satu akan gagal dan menghasilkan pesan timeout.

Contoh skenario:
- Admin A → Mengubah status laporan 1 menjadi "Ditemuka"
- Admin B → Secara bersamaan mengubah status laporan 1 menjadi "Ditemukan"
Hasil:
- Admin A berhasil menyimpan perubahan.
- Admin B menunggu hingga lock dilepas.
Jika waktu tunggu melebihi batas, sistem akan menampilkan pesan timeout.

## TRANSACTION
diterapkan pada fitur Update Status Aduan yang digunakan oleh Admin. 
Saat Admin mengubah status laporan, sistem menjalankan beberapa operasi database dalam satu transaksi yang saling berkaitan.
- Mengunci data laporan menggunakan FOR UPDATE.
- Memperbarui status pada tabel reports.
- Menyimpan riwayat perubahan status ke tabel status_logs.
- Menyelesaikan transaksi menggunakan COMMIT.

Apabila seluruh proses berhasil dijalankan, maka perubahan data akan disimpan secara permanen ke database. Namun jika terjadi kesalahan pada salah satu proses (misal lagi mau kirim tiba" mati lampu dan belum sempat ke commit) maka sistem akan menjalankan ROLLBACK sehingga seluruh perubahan dibatalkan dan database tetap berada dalam kondisi konsisten.

## JOIN
Pada sistem LostTrack, Join diterapkan pada halaman kelola aduan yang digunakan oleh admin. Melalui Join, Admin dapat melihat informasi laporan kehilangan beserta identitas pelapor tanpa harus melakukan pencarian data secara terpisah.
```sql
SELECT
    reports.id,
    reports.nama_barang,
    reports.kategori,
    reports.status,
    users.nama AS nama_pelapor
FROM reports
INNER JOIN users
    ON reports.user_id = users.id;
```
nah dari query ini nanti akan menampilkan ID Laporan
nama barang, kategori, status laporan, nama pelapor

join ini mempermudah administrator dalam memantau seluruh laporan kehilangan secara lebih terstruktur dan efisien.

## 🏗️ Stored Procedure
Kami mengimplementasikan Stored Procedure sebagai enkapsulasi logika bisnis di sisi database. Hal ini bertujuan untuk meningkatkan performa dan keamanan aplikasi.

sp_insert_report: Menangani prosedur penyimpanan data laporan baru secara atomik, memastikan bahwa semua kolom terisi sesuai validasi sebelum data masuk ke tabel reports.
```
DELIMITER //
CREATE PROCEDURE sp_insert_report(IN p_user_id INT, IN p_nama_barang VARCHAR(255), ...)
BEGIN
    INSERT INTO reports (user_id, nama_barang, ...) VALUES (p_user_id, p_nama_barang, ...);
END //
DELIMITER ;
```
sp_delete_report: Mengelola penghapusan data secara terstruktur. Prosedur ini memastikan bahwa ketika sebuah laporan dihapus, ketergantungan data pada tabel lain dikelola dengan benar tanpa menyebabkan orphan record.

## 🧩 Fragmentasi & Partisi Logis
Sistem menggunakan pendekatan fragmentasi logis dalam pengelolaan data. Kami memisahkan akses data antara laporan aktif dan data historis melalui View yang teroptimasi. Fragmentasi ini dilakukan agar query pada tabel utama reports tidak terbebani oleh data yang sudah selesai (arsip), sehingga waktu respons sistem tetap cepat meskipun jumlah data terus berkembang.
```sql
CREATE VIEW v_semua_aduan AS 
SELECT id, nama_barang, status FROM reports WHERE status != 'Ditutup'
UNION
SELECT id, nama_barang, status FROM reports WHERE status = 'Ditutup';
```
## 📂 Database Function
Kami menggunakan User-Defined Functions untuk meminimalisir redundansi kode di sisi aplikasi:

total_aduan_user(p_user_id): Menghitung secara dinamis jumlah total aduan yang pernah dibuat oleh seorang user berdasarkan ID.
```
CREATE FUNCTION total_aduan_user(p_user_id INT) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE total INT;
    SELECT COUNT(*) INTO total FROM reports WHERE user_id = p_user_id;
    RETURN total;
END;
```
total_menunggu(): Fungsi agregasi untuk mendapatkan jumlah laporan dengan status 'Menunggu Verifikasi'. Fungsi ini sangat krusial bagi dashboard Admin untuk memantau beban kerja secara real-time.

## ⚙️ Set Operation (UNION)
Untuk fitur pelaporan yang komprehensif, kami memanfaatkan Set Operation (UNION). Operasi ini menggabungkan hasil dari dua atau lebih query yang berbeda ke dalam satu result set.

Implementasi: Digunakan pada fitur riwayat (History) untuk menyatukan data laporan yang masih berjalan dan data laporan yang sudah ditutup/arsip.

Tujuan: Memberikan output data yang seragam kepada Admin, memudahkan proses audit data, dan menyederhanakan logika pemanggilan data di sisi Controller karena sistem cukup memanggil satu View yang telah menerapkan operasi UNION.

```sql
SELECT id, nama_barang, status, 'Aktif' as kategori_data FROM reports WHERE status != 'Ditutup'
UNION
SELECT id, nama_barang, status, 'Arsip' as kategori_data FROM reports WHERE status = 'Ditutup'
ORDER BY id DESC;
```
