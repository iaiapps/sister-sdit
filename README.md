<p align="center">
  <h1 align="center">SISTER — Sistem Informasi Terpadu</h1>
  <p align="center">
    <strong>Sistem informasi terpadu untuk pengelolaan sekolah dasar Islam terpadu</strong>
  </p>
  <p align="center">
    <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel">
    <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php" alt="PHP">
    <img src="https://img.shields.io/badge/Vue-3.x-42b883?style=flat-square&logo=vue.js" alt="Vue.js">
    <img src="https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=flat-square&logo=bootstrap" alt="Bootstrap">
    <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat-square&logo=mysql" alt="MySQL">
    <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License">
  </p>
</p>

---

## Preview

<p align="center">
  <img src="public/github/1.png" alt="SISTER Preview 1" width="100%">
</p>
<p align="center">
  <img src="public/github/2.png" alt="SISTER Preview 2" width="100%">
</p>
<p align="center">
  <img src="public/github/3.png" alt="SISTER APP (Android)" width="100%">
</p>

---

## Tentang

**SISTER** (Sistem Informasi Terpadu) adalah aplikasi web dan mobile yang dirancang untuk mendukung operasional harian sekolah dasar Islam terpadu. Sistem ini mencakup manajemen presensi, Pembiasaan harian (mutabaah), pengelolaan data guru, serta berbagai fitur pendukung lainnya.

---

## Fitur Utama

### Web Application

| Modul                 | Deskripsi                                                        |
| --------------------- | ---------------------------------------------------------------- |
| **Presensi Guru**     | Pencatatan kehadiran guru harian, bulk input, export, dan filter |
| **Presensi Karyawan** | Pencatatan kehadiran guru dan tenaga kependidikan                |
| **Mutabaah**          | Pembiasaan harian berbasis kategori & pertanyaan                 |
| **BPI**               | Bina Pribadi Islami guru                                         |
| **Guru Pengganti**    | Manajemen penggantian guru dan penugasan                         |
| **Data Guru**         | Profil, pendidikan, pelatihan, dan data keluarga guru            |
| **Dokumen**           | Manajemen dokumen sekolah                                        |
| **Pengaturan**        | Konfigurasi sekolah, backup/restore database                     |
| **Manajemen User**    | User management berbasis role (Spatie Permission)                |

### Mobile Application

| Fitur                   | Deskripsi                                   |
| ----------------------- | ------------------------------------------- |
| **Login & Autentikasi** | Autentikasi via Sanctum token               |
| **Presensi QR Scan**    | Scan QR code untuk presensi                 |
| **Presensi Manual**     | Input presensi manual dengan verifikasi GPS |
| **Mutabaah**            | Input dan lihat data mutabaah               |
| **BPI**                 | Input dan lihat data BPI                    |
| **Guru Pengganti**      | Input dan lihat jadwal guru pengganti       |

---

## Tech Stack

### Backend

- **Framework**: Laravel 11
- **PHP**: 8.2+
- **Database**: MySQL 8.x
- **Authentication**: Laravel Sanctum (token-based API)
- **Authorization**: Spatie Laravel Permission
- **Export**: Maatwebsite Excel

### Frontend (Web)

- **Templating**: Blade
- **CSS Framework**: Bootstrap 5
- **JavaScript**: Vite

### Mobile App

- **Framework**: Vue 3 + Vue Router
- **CSS Framework**: Bootstrap 5 + Bootstrap Icons
- **Build Tool**: Vite
- **Platform**: Cordova (Android/iOS)

---

## Role & Akses

| Role         | Akses                                                                 |
| ------------ | --------------------------------------------------------------------- |
| **Admin**    | Full access: user management, guru, siswa, setting, backup            |
| **Operator** | Presensi, mutabaah, BPI, guru pengganti                               |
| **Guru**     | Profil, data pribadi, presensi, mutabaah jawaban, BPI, guru pengganti |
| **Tendik**   | Profil, data pribadi, presensi, BPI                                   |
| **Karyawan** | Profil, data pribadi, presensi                                        |


