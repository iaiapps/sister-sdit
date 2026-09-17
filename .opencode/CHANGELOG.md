# Changelog

## 2026-08-12

### Fixed
- Cronjob `schedule:run` tidak berjalan: crontab user `serversdit` menunjuk ke path lama `/home/serversdit/ZServer/sister-sdit` (tidak ada), sehingga `cd` gagal dan artisan tidak pernah dieksekusi.
- Diperbaiki ke path yang benar: `/opt/lampp/htdocs/sister/sister`.
- Verifikasi: baris cron sementara menulis bukti eksekusi pada menit berikutnya (berhasil), kemudian dihapus.
- Backup crontab lama: `/tmp/opencode/crontab_backup_20260812.txt`
