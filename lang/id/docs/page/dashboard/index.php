<?php

return [
    /*
    |--------------------------------------------------------------------------
    | eCommerce Dashboard Language Lines (Indonesian)
    |--------------------------------------------------------------------------
    */
    'title' => 'Dashboard eCommerce',
    'subtitle' => 'Pantau performa penjualan, pesanan masuk, dan pertumbuhan bisnis secara real-time.',
    'breadcrumb' => [
        'home' => 'Beranda',
        'pages' => 'Halaman',
        'dashboard' => 'Dashboard',
    ],
    'actions' => [
        'export' => 'Unduh Laporan',
        'add_product' => 'Tambah Produk',
        'filter_period' => 'Pilih Periode',
        'today' => 'Hari Ini',
        'last_7_days' => '7 Hari Terakhir',
        'last_30_days' => 'Bulan Ini',
        'this_year' => 'Tahun Ini',
        'view_all' => 'Lihat Semua',
        'details' => 'Lihat Detail',
        'invoice' => 'Unduh Faktur',
        'contact' => 'Hubungi Pembeli',
        'restock' => 'Pesan Ulang Stok',
    ],
    'toolbar' => [
        'title' => 'Tata Letak Dashboard Interaktif',
        'desc' => 'Tarik header kartu untuk memindahkan posisi atau gunakan tombol di sudut kartu untuk mengubah ukuran.',
    ],
    'metrics' => [
        'revenue' => [
            'title' => 'Total Pendapatan',
            'desc' => 'Akumulasi penjualan kotor',
            'badge' => '+18.4%',
            'comparison' => 'Meningkat Rp 44.2 jt dibanding bulan lalu',
        ],
        'orders' => [
            'title' => 'Total Pesanan',
            'desc' => 'Volume checkout sukses',
            'badge' => '+11.2%',
            'comparison' => '98.4% pesanan terkirim tepat waktu',
        ],
        'customers' => [
            'title' => 'Pelanggan Baru',
            'desc' => 'Pengguna terdaftar baru',
            'badge' => '+22.8%',
            'comparison' => '142 pelanggan berulang (repeat)',
        ],
        'avg_order' => [
            'title' => 'Rata-rata Nilai Pesanan',
            'desc' => 'Average Order Value (AOV)',
            'badge' => '+5.3%',
            'comparison' => 'Target Rp 150.000 tercapai 103%',
        ],
    ],
    'charts' => [
        'sales_trend' => [
            'title' => 'Tren Penjualan & Pendapatan',
            'desc' => 'Perbandingan pendapatan kotor vs laba bersih bulanan',
            'revenue_legend' => 'Pendapatan',
            'profit_legend' => 'Laba Bersih',
            'total_sales' => 'Total Penjualan',
            'net_profit' => 'Laba Bersih',
            'daily_avg' => 'Rata-rata Harian',
            'tabs' => [
                'weekly' => 'Mingguan',
                'monthly' => 'Bulanan',
                'yearly' => 'Tahunan',
            ],
        ],
        'channels' => [
            'title' => 'Saluran Akuisisi & Konversi',
            'desc' => 'Distribusi sumber traffic dan nilai transaksi',
            'conversion_label' => 'Tingkat Konversi Rata-rata',
            'direct' => 'Langsung (Direct)',
            'organic' => 'Pencarian Organik',
            'social' => 'Media Sosial',
            'referral' => 'Afiliasi & Referral',
        ],
    ],
    'products' => [
        'top_title' => 'Produk Terlaris',
        'top_desc' => 'Berdasarkan jumlah unit terjual bulan ini',
        'badge' => 'Top 5',
        'stock_remaining' => ':count unit tersisa',
        'sales_count' => ':count terjual',
        'view_all_products' => 'Kelola Katalog Produk',
    ],
    'orders' => [
        'title' => 'Pesanan Masuk Terbaru',
        'desc' => 'Daftar transaksi checkout terkini dari pelanggan',
        'columns' => [
            'order_id' => 'ID Pesanan',
            'customer' => 'Pelanggan',
            'items' => 'Produk Dibeli',
            'total' => 'Total Bayar',
            'status' => 'Status',
            'action' => 'Aksi',
        ],
        'status' => [
            'completed' => 'Selesai',
            'processing' => 'Diproses',
            'pending' => 'Menunggu Pembayaran',
            'cancelled' => 'Dibatalkan',
        ],
    ],
    'alerts' => [
        'inventory_title' => 'Peringatan Stok Rendah',
        'inventory_desc' => 'Produk yang membutuhkan pengadaan ulang segera',
        'critical' => 'Kritis',
        'warning' => 'Perhatian',
        'safe' => 'Aman',
    ],
    'activity' => [
        'title' => 'Log Aktivitas Toko',
        'desc' => 'Pembaruan otomatis dari sistem dan pembeli',
        'time_ago' => [
            'just_now' => 'Baru saja',
            'mins_ago' => ':count menit lalu',
            'hours_ago' => ':count jam lalu',
        ],
    ],
];
