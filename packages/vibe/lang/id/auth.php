<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Laravel Authentication Lines
    |--------------------------------------------------------------------------
    */
    'failed' => 'Kredensial tersebut tidak cocok dengan data kami.',
    'password' => 'Kata sandi yang diberikan salah.',
    'throttle' => 'Terlalu banyak upaya masuk. Silakan coba lagi dalam :seconds detik.',

    /*
    |--------------------------------------------------------------------------
    | Page Titles & Descriptions
    |--------------------------------------------------------------------------
    */
    'titles' => [
        'login' => 'Masuk ke Akun Anda',
        'login_description' => 'Selamat datang kembali! Silakan masukkan detail kredensial Anda.',
        'register' => 'Buat Akun Baru',
        'register_description' => 'Lengkapi data formulir di bawah ini untuk membuat akun Anda.',
        'forgot_password' => 'Lupa Kata Sandi?',
        'forgot_password_description' => 'Masukkan alamat email Anda dan kami akan mengirimkan tautan reset kata sandi.',
        'reset_password' => 'Atur Ulang Kata Sandi',
        'reset_password_description' => 'Silakan masukkan kata sandi baru untuk akun Anda.',
        'confirm_password' => 'Konfirmasi Kata Sandi',
        'confirm_password_description' => 'Ini adalah area aman aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.',
        'verify_email' => 'Verifikasi Alamat Email',
        'verify_email_description' => 'Harap verifikasi email Anda sebelum menggunakan layanan penuh.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Form Fields & Labels
    |--------------------------------------------------------------------------
    */
    'fields' => [
        'name' => 'Nama Lengkap',
        'name_placeholder' => 'Ahmad Fauzi',
        'email' => 'Alamat Email',
        'email_placeholder' => 'nama@domain.com',
        'username' => 'Username',
        'username_placeholder' => 'username_anda',
        'phone' => 'Nomor Handphone',
        'phone_placeholder' => '081234567890',
        'password' => 'Kata Sandi',
        'password_placeholder' => '••••••••',
        'password_confirmation' => 'Konfirmasi Kata Sandi',
        'new_password' => 'Kata Sandi Baru',
        'confirm_new_password' => 'Konfirmasi Kata Sandi Baru',
        'current_password' => 'Kata Sandi Saat Ini',

        // Multi-credential dynamic labels
        'email_or_username' => 'Email atau Username',
        'email_or_phone' => 'Email atau Nomor HP',
        'username_or_phone' => 'Username atau Nomor HP',
        'all_credentials' => 'Email, Username, atau No. HP',
        'credentials' => 'Kredensial Akun',
        'credentials_placeholder' => 'Masukkan kredensial Anda...',
    ],

    /*
    |--------------------------------------------------------------------------
    | Action Buttons & Statuses
    |--------------------------------------------------------------------------
    */
    'actions' => [
        'login' => 'Masuk ke Akun',
        'logging_in' => 'Memverifikasi...',
        'register' => 'Buat Akun Baru',
        'registering' => 'Memproses Pendaftaran...',
        'send_reset_link' => 'Kirim Link Reset Password',
        'sending_link' => 'Mengirim Link...',
        'reset_password' => 'Perbarui Kata Sandi',
        'saving' => 'Menyimpan...',
        'confirm' => 'Konfirmasi Kata Sandi',
        'verifying' => 'Memverifikasi...',
        'resend_verification' => 'Kirim Ulang Email Verifikasi',
        'sending' => 'Mengirim...',
        'logout' => 'Keluar Akun',
    ],

    /*
    |--------------------------------------------------------------------------
    | Passkey (WebAuthn)
    |--------------------------------------------------------------------------
    */
    'passkey' => [
        'login_button' => 'Masuk dengan Passkey',
        'connecting' => 'Menghubungkan Perangkat...',
        'separator' => 'atau dengan kredensial',
        'failed_title' => 'Autentikasi Passkey Gagal',
        'dev_mode_title' => 'Mode Pengembangan (Local Development)',
        'dev_mode_notice' => 'Fitur Passkey (WebAuthn) memerlukan nama domain. Pada masa development, silakan akses melalui localhost alih-alih alamat IP 127.0.0.1.',
        'switch_to_localhost' => 'Beralih ke Localhost',
    ],

    /*
    |--------------------------------------------------------------------------
    | Navigation & Helper Links
    |--------------------------------------------------------------------------
    */
    'links' => [
        'remember_me' => 'Ingat saya di perangkat ini',
        'forgot_password' => 'Lupa kata sandi?',
        'already_registered' => 'Sudah memiliki akun?',
        'dont_have_account' => 'Belum memiliki akun?',
        'sign_in_now' => 'Masuk sekarang',
        'sign_up_now' => 'Daftar sekarang',
        'back_to_login' => 'Kembali ke halaman masuk',
        'remember_password' => 'Ingat kata sandi Anda?',
    ],

    /*
    |--------------------------------------------------------------------------
    | Messages & Notifications
    |--------------------------------------------------------------------------
    */
    'messages' => [
        'verification_sent' => 'Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda daftarkan.',
        'verification_notice' => 'Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, klik tombol di bawah untuk meminta tautan baru.',
    ],

];
