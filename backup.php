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