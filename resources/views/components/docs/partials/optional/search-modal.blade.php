@php
    $catMenu = __('docs/search.categories.menu');
    $catAction = __('docs/search.categories.action');

    $navSections = [
        'start' => __('docs/search.sections.start'),
        'auth' => __('docs/search.sections.auth') ?: __('docs/sidebar.nav.auth.group'),
        'forms' => __('docs/search.sections.forms'),
        'ui' => __('docs/search.sections.ui'),
        'navigation' => __('docs/search.sections.navigation'),
        'layout' => __('docs/search.sections.layout'),
        'data' => __('docs/search.sections.data'),
        'feedback' => __('docs/search.sections.feedback'),
        'extra' => __('docs/search.sections.extra'),
        'display' => __('docs/search.sections.display') ?: __('docs/sidebar.nav.display.group'),
        'dashboard' => __('docs/search.sections.dashboard'),
        'settings' => __('docs/search.sections.settings'),
        'quick_actions' => __('docs/search.sections.quick_actions'),
    ];

    $menuList = [
        // Getting Started
        [
            'id' => 'menu-docs',
            'title' => __('docs/sidebar.nav.docs') ?: __('docs/search.menu_items.docs.title'),
            'subtitle' => __('docs/search.menu_items.docs.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['start'],
            'url' => route('docs.index'),
            'icon' => 'book',
            'keywords' => 'docs start home guide pengantar panduan dokumentasi',
        ],
        [
            'id' => 'menu-instalation',
            'title' => __('docs/sidebar.nav.instalation') ?: __('docs/search.menu_items.instalation.title'),
            'subtitle' => __('docs/search.menu_items.instalation.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['start'],
            'url' => route('docs.instalation.index'),
            'icon' => 'download',
            'keywords' => 'install setup instalasi package composer npm panduan mulai',
        ],
        [
            'id' => 'menu-directories',
            'title' => __('docs/sidebar.nav.directories') ?: __('docs/search.menu_items.directories.title'),
            'subtitle' => __('docs/search.menu_items.directories.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['start'],
            'url' => route('docs.directories.index'),
            'icon' => 'folder',
            'keywords' => 'directories struktur folder file architecture arsitektur direktori',
        ],
        [
            'id' => 'menu-design-system',
            'title' => __('docs/sidebar.nav.design_system') ?: __('docs/search.menu_items.design_system.title'),
            'subtitle' => __('docs/search.menu_items.design_system.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['start'],
            'url' => route('docs.design-system.index'),
            'icon' => 'theme',
            'keywords' => 'design system color semantic warna varian primary secondary danger success warning info rules pedoman palet',
        ],

        // Authentication
        [
            'id' => 'menu-auth-overview',
            'title' => __('docs/sidebar.nav.auth.overview') ?: __('docs/search.menu_items.auth_overview.title'),
            'subtitle' => __('docs/search.menu_items.auth_overview.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['auth'],
            'url' => route('docs.auth.index'),
            'icon' => 'lock',
            'keywords' => 'auth authentication autentikasi login register starter kit scaffolding overview ikhtisar',
        ],
        [
            'id' => 'menu-auth-installation',
            'title' => __('docs/sidebar.nav.auth.installation') ?: __('docs/search.menu_items.auth_installation.title'),
            'subtitle' => __('docs/search.menu_items.auth_installation.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['auth'],
            'url' => route('docs.auth.installation'),
            'icon' => 'download',
            'keywords' => 'auth instalasi installation setup cli artisan vibe:auth webauthn simple card split layout starter kit',
        ],
        [
            'id' => 'menu-auth-confirm',
            'title' => __('docs/sidebar.nav.auth.confirm') ?: __('docs/search.menu_items.auth_confirm.title'),
            'subtitle' => __('docs/search.menu_items.auth_confirm.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['auth'],
            'url' => route('docs.auth.confirm'),
            'icon' => 'shield',
            'keywords' => 'auth confirm password konfirmasi kata sandi sudo mode verifikasi password security keamanan sensitif',
        ],
        [
            'id' => 'menu-auth-idle',
            'title' => __('docs/sidebar.nav.auth.idle') ?: __('docs/search.menu_items.auth_idle.title'),
            'subtitle' => __('docs/search.menu_items.auth_idle.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['auth'],
            'url' => route('docs.auth.idle'),
            'icon' => 'clock',
            'keywords' => 'auth idle timeout inaktivitas lockout sesi modal peringatan inaktivitas countdown otomatis',
        ],
        [
            'id' => 'menu-auth-two-factor',
            'title' => __('docs/sidebar.nav.auth.two_factor') ?: __('docs/search.menu_items.auth_two_factor.title'),
            'subtitle' => __('docs/search.menu_items.auth_two_factor.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['auth'],
            'url' => route('docs.auth.two-factor'),
            'icon' => 'shield',
            'keywords' => 'auth two-factor 2fa totp google authenticator qr code verifikasi dua langkah keamanan authenticator',
        ],
        [
            'id' => 'menu-auth-passkey',
            'title' => __('docs/sidebar.nav.auth.passkey') ?: __('docs/search.menu_items.auth_passkey.title'),
            'subtitle' => __('docs/search.menu_items.auth_passkey.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['auth'],
            'url' => route('docs.auth.passkey'),
            'icon' => 'key',
            'keywords' => 'auth passkey webauthn fido2 biometrik fingerprint sidik jari faceid touchid login tanpa kata sandi security key',
        ],

        // Components - Forms
        [
            'id' => 'menu-form',
            'title' => __('docs/sidebar.nav.form') ?: __('docs/search.menu_items.form.title'),
            'subtitle' => __('docs/search.menu_items.form.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.form.index'),
            'icon' => 'form',
            'keywords' => 'form validation validasi submit input grouping formulir container',
        ],
        [
            'id' => 'menu-input',
            'title' => __('docs/sidebar.nav.input_group.standard') ?: __('docs/search.menu_items.input_standard.title'),
            'subtitle' => __('docs/search.menu_items.input_standard.subtitle') ?: __('docs/search.menu_items.input.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.input.index'),
            'icon' => 'input',
            'keywords' => 'input text password email field form control standar input textfield',
        ],
        [
            'id' => 'menu-input-otp',
            'title' => __('docs/sidebar.nav.input_group.otp') ?: __('docs/search.menu_items.input_otp.title'),
            'subtitle' => __('docs/search.menu_items.input_otp.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.input.otp'),
            'icon' => 'hash',
            'keywords' => 'input otp one time password pin kode verifikasi kotak auth token 2fa',
        ],
        [
            'id' => 'menu-input-currency',
            'title' => __('docs/sidebar.nav.input_group.currency') ?: __('docs/search.menu_items.input_currency.title'),
            'subtitle' => __('docs/search.menu_items.input_currency.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.input.currency'),
            'icon' => 'currency',
            'keywords' => 'input currency rupiah uang format nominal rupiah separator idr money angka harga',
        ],
        [
            'id' => 'menu-input-phone',
            'title' => __('docs/sidebar.nav.input_group.phone') ?: __('docs/search.menu_items.input_phone.title'),
            'subtitle' => __('docs/search.menu_items.input_phone.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.input.phone'),
            'icon' => 'phone',
            'keywords' => 'input phone nomor telepon hp country code format wa whatsapp contact kontak',
        ],
        [
            'id' => 'menu-textarea',
            'title' => __('docs/sidebar.nav.textarea') ?: __('docs/search.menu_items.textarea.title'),
            'subtitle' => __('docs/search.menu_items.textarea.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.textarea.index'),
            'icon' => 'textarea',
            'keywords' => 'textarea multi line text input note catatan auto resize textarea',
        ],
        [
            'id' => 'menu-select',
            'title' => __('docs/sidebar.nav.select') ?: __('docs/search.menu_items.select.title'),
            'subtitle' => __('docs/search.menu_items.select.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.select.index'),
            'icon' => 'select',
            'keywords' => 'select dropdown option picker choose multi searchable single pilihan opsi',
        ],
        [
            'id' => 'menu-checkbox',
            'title' => __('docs/sidebar.nav.checkbox') ?: __('docs/search.menu_items.checkbox.title'),
            'subtitle' => __('docs/search.menu_items.checkbox.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.checkbox.index'),
            'icon' => 'check',
            'keywords' => 'checkbox check centang toggle multiple boolean pilihan centang kotak',
        ],
        [
            'id' => 'menu-radio',
            'title' => __('docs/sidebar.nav.radio') ?: __('docs/search.menu_items.radio.title'),
            'subtitle' => __('docs/search.menu_items.radio.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.radio.index'),
            'icon' => 'radio',
            'keywords' => 'radio option choice single boolean pilihan tunggal lingkaran opsi',
        ],
        [
            'id' => 'menu-switch',
            'title' => __('docs/sidebar.nav.switch') ?: __('docs/search.menu_items.switch.title'),
            'subtitle' => __('docs/search.menu_items.switch.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.switch.index'),
            'icon' => 'toggle',
            'keywords' => 'switch toggle on off status boolean sakelar saklar beralih aktif',
        ],
        [
            'id' => 'menu-range',
            'title' => __('docs/sidebar.nav.range') ?: __('docs/search.menu_items.range.title'),
            'subtitle' => __('docs/search.menu_items.range.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.range.index'),
            'icon' => 'slider',
            'keywords' => 'range slider number value control geser nilai angka rentang slider',
        ],
        [
            'id' => 'menu-date-time',
            'title' => __('docs/sidebar.nav.date-time') ?: __('docs/search.menu_items.date_time.title'),
            'subtitle' => __('docs/search.menu_items.date_time.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.date-time.index'),
            'icon' => 'calendar',
            'keywords' => 'date time calendar picker tanggal waktu jam kalender rentang range',
        ],
        [
            'id' => 'menu-dynamic-form',
            'title' => __('docs/sidebar.nav.dynamic-form') ?: __('docs/search.menu_items.dynamic_form.title'),
            'subtitle' => __('docs/search.menu_items.dynamic_form.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.dynamic-form.index'),
            'icon' => 'form',
            'keywords' => 'dynamic form repeater input bertambah dinamis add more row array baris formulir tambah',
        ],
        [
            'id' => 'menu-filepond',
            'title' => __('docs/sidebar.nav.filepond') ?: __('docs/search.menu_items.filepond.title'),
            'subtitle' => __('docs/search.menu_items.filepond.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.filepond.index'),
            'icon' => 'upload',
            'keywords' => 'filepond upload unggah file image attachment dokumen berkas drag and drop gambar',
        ],

        // Components - Elements & UI
        [
            'id' => 'menu-button',
            'title' => __('docs/sidebar.nav.button') ?: __('docs/search.menu_items.button.title'),
            'subtitle' => __('docs/search.menu_items.button.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.button.index'),
            'icon' => 'button',
            'keywords' => 'button tombol action click cta trigger aksi primary secondary outline ghost',
        ],
        [
            'id' => 'menu-show',
            'title' => __('docs/sidebar.nav.show') ?: __('docs/search.menu_items.show.title'),
            'subtitle' => __('docs/search.menu_items.show.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.show.index'),
            'icon' => 'eye',
            'keywords' => 'show data binding vibe:show vibe:button.show client populating populasikan tampilan data display render',
        ],
        [
            'id' => 'menu-dropdown',
            'title' => __('docs/sidebar.nav.dropdown') ?: __('docs/search.menu_items.dropdown.title'),
            'subtitle' => __('docs/search.menu_items.dropdown.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.dropdown.index'),
            'icon' => 'dropdown',
            'keywords' => 'dropdown menu popup flyout popover opsi menu pop-up floating list',
        ],
        [
            'id' => 'menu-context',
            'title' => __('docs/sidebar.nav.context') ?: __('docs/search.menu_items.context.title'),
            'subtitle' => __('docs/search.menu_items.context.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.context.index'),
            'icon' => 'context',
            'keywords' => 'context menu contextmenu klik kanan right click popover table row action sheet submenu delete',
        ],
        [
            'id' => 'menu-badge',
            'title' => __('docs/sidebar.nav.badge') ?: __('docs/search.menu_items.badge.title'),
            'subtitle' => __('docs/search.menu_items.badge.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.badge.index'),
            'icon' => 'badge',
            'keywords' => 'badge tag label status pill indicator penanda lencana varian dot',
        ],
        [
            'id' => 'menu-avatar',
            'title' => __('docs/sidebar.nav.avatar') ?: __('docs/search.menu_items.avatar.title'),
            'subtitle' => __('docs/search.menu_items.avatar.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.avatar.index'),
            'icon' => 'user',
            'keywords' => 'avatar profile user image picture initials foto profil pengguna fallback inisial',
        ],
        [
            'id' => 'menu-image',
            'title' => __('docs/sidebar.nav.image') ?: __('docs/search.menu_items.image.title'),
            'subtitle' => __('docs/search.menu_items.image.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.image.index'),
            'icon' => 'image',
            'keywords' => 'image photo picture media lazyload gambar foto rasio aspect ratio',
        ],
        [
            'id' => 'menu-card',
            'title' => __('docs/sidebar.nav.card') ?: __('docs/search.menu_items.card.title'),
            'subtitle' => __('docs/search.menu_items.card.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.card.index'),
            'icon' => 'card',
            'keywords' => 'card container box wrapper panel wadah kartu kotak pembungkus',
        ],
        [
            'id' => 'menu-grid-list',
            'title' => __('docs/sidebar.nav.grid-list') ?: __('docs/search.menu_items.grid_list.title'),
            'subtitle' => __('docs/search.menu_items.grid_list.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.grid-list.index'),
            'icon' => 'grid',
            'keywords' => 'grid list collection items catalog daftar kartu katalog koleksi item',
        ],

        // Components - Navigation
        [
            'id' => 'menu-header',
            'title' => __('docs/sidebar.nav.header') ?: __('docs/search.menu_items.header.title'),
            'subtitle' => __('docs/search.menu_items.header.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['navigation'],
            'url' => route('docs.header.index'),
            'icon' => 'header',
            'keywords' => 'header navbar topbar sticky navigation bilah navigasi atas top header',
        ],
        [
            'id' => 'menu-nav',
            'title' => __('docs/sidebar.nav.nav') ?: __('docs/search.menu_items.nav.title'),
            'subtitle' => __('docs/search.menu_items.nav.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['navigation'],
            'url' => route('docs.nav.index'),
            'icon' => 'nav',
            'keywords' => 'nav sidebar menu tree navigation history pinned navigasi samping pohon riwayat',
        ],
        [
            'id' => 'menu-breadcrumb',
            'title' => __('docs/sidebar.nav.breadcrumb') ?: __('docs/search.menu_items.breadcrumb.title'),
            'subtitle' => __('docs/search.menu_items.breadcrumb.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['navigation'],
            'url' => route('docs.breadcrumb.index'),
            'icon' => 'breadcrumb',
            'keywords' => 'breadcrumb path hierarchy trail remah roti jejak halaman hierarki',
        ],
        [
            'id' => 'menu-tabs',
            'title' => __('docs/sidebar.nav.tabs') ?: __('docs/search.menu_items.tabs.title'),
            'subtitle' => __('docs/search.menu_items.tabs.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['navigation'],
            'url' => route('docs.tabs.index'),
            'icon' => 'tabs',
            'keywords' => 'tabs panel pill navigation segmented switch tab panel peralihan konten tab',
        ],

        // Components - Layout
        [
            'id' => 'menu-grid',
            'title' => __('docs/sidebar.nav.grid') ?: __('docs/search.menu_items.grid.title'),
            'subtitle' => __('docs/search.menu_items.grid.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['layout'],
            'url' => route('docs.grid.index'),
            'icon' => 'grid',
            'keywords' => 'grid layout responsive columns flex tata letak kolom kotak responsif',
        ],
        [
            'id' => 'menu-sheet',
            'title' => __('docs/sidebar.nav.sheet') ?: __('docs/search.menu_items.sheet.title'),
            'subtitle' => __('docs/search.menu_items.sheet.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['layout'],
            'url' => route('docs.sheet.index'),
            'icon' => 'sheet',
            'keywords' => 'sheet drawer laci slideover panel side panel samping panel geser drawer',
        ],
        [
            'id' => 'menu-accordion',
            'title' => __('docs/sidebar.nav.accordion') ?: __('docs/search.menu_items.accordion.title'),
            'subtitle' => __('docs/search.menu_items.accordion.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['layout'],
            'url' => route('docs.accordion.index'),
            'icon' => 'accordion',
            'keywords' => 'accordion collapse disclosure faq expand panel fold panel lipat daftar faq tanya jawab',
        ],

        // Components - Data
        [
            'id' => 'menu-table',
            'title' => __('docs/sidebar.nav.table') ?: __('docs/search.menu_items.table.title'),
            'subtitle' => __('docs/search.menu_items.table.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['data'],
            'url' => route('docs.table.index'),
            'icon' => 'table',
            'keywords' => 'table tabel tabular row column cell data tabel html sederhana baris kolom',
        ],
        [
            'id' => 'menu-datatable',
            'title' => __('docs/sidebar.nav.datatable') ?: __('docs/search.menu_items.datatable.title'),
            'subtitle' => __('docs/search.menu_items.datatable.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['data'],
            'url' => route('docs.datatable.index'),
            'icon' => 'table',
            'keywords' => 'datatable table pagination sorting search livewire user filter tabel canggih pencarian data',
        ],
        [
            'id' => 'menu-chart',
            'title' => __('docs/sidebar.nav.chart') ?: __('docs/search.menu_items.chart.title'),
            'subtitle' => __('docs/search.menu_items.chart.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['data'],
            'url' => route('docs.chart.index'),
            'icon' => 'chart',
            'keywords' => 'chart graph bar line donut analytics metrik grafik visualisasi statistik diagram',
        ],

        // Components - Feedback
        [
            'id' => 'menu-alert',
            'title' => __('docs/sidebar.nav.alert') ?: __('docs/search.menu_items.alert.title'),
            'subtitle' => __('docs/search.menu_items.alert.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['feedback'],
            'url' => route('docs.alert.index'),
            'icon' => 'alert',
            'keywords' => 'alert notice warning info success danger error pemberitahuan peringatan bahaya pesan',
        ],
        [
            'id' => 'menu-toast',
            'title' => __('docs/sidebar.nav.toast') ?: __('docs/search.menu_items.toast.title'),
            'subtitle' => __('docs/search.menu_items.toast.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['feedback'],
            'url' => route('docs.toast.index'),
            'icon' => 'toast',
            'keywords' => 'toast notification snackbar popup notify notifikasi pop up melayang pesan kilat',
        ],
        [
            'id' => 'menu-modal',
            'title' => __('docs/sidebar.nav.modal') ?: __('docs/search.menu_items.modal.title'),
            'subtitle' => __('docs/search.menu_items.modal.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['feedback'],
            'url' => route('docs.modal.index'),
            'icon' => 'modal',
            'keywords' => 'modal dialog popup lightbox overlay window dialog konfirmasi popup spotlight',
        ],

        // Components - Display
        [
            'id' => 'menu-display-qrcode',
            'title' => __('docs/sidebar.nav.display.qrcode') ?: __('docs/search.menu_items.display_qrcode.title'),
            'subtitle' => __('docs/search.menu_items.display_qrcode.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['display'],
            'url' => route('docs.display.qrcode'),
            'icon' => 'qrcode',
            'keywords' => 'display qrcode qr code generator svg barcode matriks scan authenticator pindai 2fa',
        ],

        // Components - Extra
        [
            'id' => 'menu-highlightjs',
            'title' => __('docs/sidebar.nav.highlightjs') ?: __('docs/search.menu_items.highlightjs.title'),
            'subtitle' => __('docs/search.menu_items.highlightjs.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['extra'],
            'url' => route('docs.highlightjs.index'),
            'icon' => 'code',
            'keywords' => 'highlight code syntax prism pre snippet penyorot sintaks tema kode syntax',
        ],

        // Pages & Dashboard
        [
            'id' => 'menu-dashboard-products',
            'title' => __('docs/search.menu_items.dashboard_products.title'),
            'subtitle' => __('docs/search.menu_items.dashboard_products.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['dashboard'],
            'url' => route('docs.dashboard.show', 'index'),
            'icon' => 'dashboard',
            'keywords' => 'dashboard produk sales analytics metric order pesanan ecommerce penjualan analitik',
        ],

        // Pages - Settings
        [
            'id' => 'menu-settings',
            'title' => __('docs/page/settings/index.breadcrumb.settings') ?: __('docs/search.menu_items.settings.title'),
            'subtitle' => __('docs/search.menu_items.settings.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['settings'],
            'url' => route('docs.settings.index'),
            'icon' => 'settings',
            'keywords' => 'settings pengaturan appearance tema custom sidebar header preferensi konfigurasi',
        ],
        [
            'id' => 'menu-settings-appearance',
            'title' => __('docs/search.menu_items.settings_appearance.title') ?: __('docs/page/settings/index.tabs.appearance.label'),
            'subtitle' => __('docs/search.menu_items.settings_appearance.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['settings'],
            'url' => route('docs.settings.appearance'),
            'icon' => 'theme',
            'keywords' => 'settings appearance tampilan tema custom warna palet dark light mode styling studio',
        ],
        [
            'id' => 'menu-settings-account',
            'title' => __('docs/search.menu_items.settings_account.title') ?: __('docs/page/settings/index.tabs.profile.label'),
            'subtitle' => __('docs/search.menu_items.settings_account.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['settings'],
            'url' => route('docs.settings.account'),
            'icon' => 'user',
            'keywords' => 'settings account akun profil nama email username biodata foto profil',
        ],
        [
            'id' => 'menu-settings-security',
            'title' => __('docs/search.menu_items.settings_security.title') ?: __('docs/page/settings/index.tabs.security.label'),
            'subtitle' => __('docs/search.menu_items.settings_security.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['settings'],
            'url' => route('docs.settings.security'),
            'icon' => 'shield',
            'keywords' => 'settings security keamanan ubah password kata sandi sudo mode verifikasi dua langkah',
        ],
        [
            'id' => 'menu-settings-passkey',
            'title' => __('docs/search.menu_items.settings_passkey.title'),
            'subtitle' => __('docs/search.menu_items.settings_passkey.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['settings'],
            'url' => route('docs.settings.passkey'),
            'icon' => 'key',
            'keywords' => 'settings passkey biometrik webauthn fido2 login tanpa kata sandi kunci keamanan security key',
        ],
        [
            'id' => 'menu-settings-login-history',
            'title' => __('docs/search.menu_items.settings_login_history.title'),
            'subtitle' => __('docs/search.menu_items.settings_login_history.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['settings'],
            'url' => route('docs.settings.login-history'),
            'icon' => 'clock',
            'keywords' => 'settings login history riwayat login sesi aktif ip address browser perangkat aktivitas',
        ],
    ];

    $quickActions = [
        [
            'id' => 'action-toggle-theme',
            'title' => __('docs/search.actions.theme_title'),
            'subtitle' => __('docs/search.actions.theme_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'action' => 'toggleTheme',
            'icon' => 'theme',
            'shortcut' => 'Ctrl+D',
            'keywords' => 'theme dark light mode gelap terang malam siang warna',
        ],
        [
            'id' => 'action-switch-language',
            'title' => __('docs/search.actions.switch_lang_target'),
            'subtitle' => __('docs/search.actions.switch_lang_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'url' => route('locale.switch', __('docs/search.actions.target_locale')),
            'icon' => 'globe',
            'shortcut' => 'Locale',
            'keywords' => 'bahasa language english indonesia locale switch translate',
        ],
        [
            'id' => 'action-open-settings',
            'title' => __('docs/search.actions.settings_title'),
            'subtitle' => __('docs/search.actions.settings_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'url' => route('docs.settings.index'),
            'icon' => 'settings',
            'shortcut' => 'Settings',
            'keywords' => 'appearance settings warna custom sidebar header styling',
        ],
        [
            'id' => 'action-toggle-fullscreen',
            'title' => __('docs/search.actions.fullscreen_title'),
            'subtitle' => __('docs/search.actions.fullscreen_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'action' => 'toggleFullscreen',
            'icon' => 'fullscreen',
            'shortcut' => 'F11',
            'keywords' => 'fullscreen layar penuh window monitor maximize',
        ],
        [
            'id' => 'action-clear-history',
            'title' => __('docs/search.actions.clear_history_title'),
            'subtitle' => __('docs/search.actions.clear_history_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'action' => 'clearHistory',
            'icon' => 'trash',
            'shortcut' => 'Clear',
            'keywords' => 'clear hapus reset history riwayat jejak cache',
        ],
    ];
@endphp

<vibe:modal id="global-search-modal" position="top" maxWidth="2xl" :dismissibleButton="false">
    <div x-data="globalSearchModal({
        menuItems: {{ Js::from($menuList) }},
        actionItems: {{ Js::from($quickActions) }},
        searchApiUrl: '{{ route('docs.search.query') }}'
    })" @open-modal.window="if ($event.detail === 'global-search-modal' || (Array.isArray($event.detail) && $event.detail[0] === 'global-search-modal')) { onModalOpen(); }" @open-search-modal.window="onModalOpen();" class="flex flex-col">
        <vibe:modal.header class="p-0 gap-0 border-b border-border font-normal">
            <div class="relative flex items-center px-4 sm:px-5 py-3 sm:py-3.5 bg-card">
                <vibe:input variant="ghost" size="lg" x-ref="searchInput" x-model="query" @input="onQueryInput()" @keydown.down.prevent="nextItem()" @keydown.up.prevent="prevItem()" @keydown.enter.prevent="selectActiveItem()" @keydown.tab.prevent="cycleFilter()" @keydown.escape.prevent="$dispatch('close-modal', 'global-search-modal')" placeholder="{{ __('docs/search.placeholder') }}" autocomplete="off" spellcheck="false">
                    <x-slot:icon>
                        <template x-if="isLoadingDb">
                            <svg class="size-5 animate-spin text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </template>
                        <template x-if="!isLoadingDb">
                            <svg class="size-5 text-muted-foreground/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11.5" cy="11.5" r="9.5" />
                                <path d="M18.5 18.5L22 22" />
                            </svg>
                        </template>
                    </x-slot:icon>
                    <x-slot:trailingIcon>
                        <button x-show="query.length > 0" x-cloak type="button" @click="clearSearch()" class="p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted transition-colors cursor-pointer" title="{{ __('docs/search.clear_search') }}">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 5L5 19M19 19L5 5" />
                            </svg>
                        </button>
                    </x-slot:trailingIcon>
                </vibe:input>
            </div>

            {{-- Filter Category Pills --}}
            <div class="flex items-center gap-1.5 px-4 sm:px-5 py-2 border-t border-border/60 overflow-x-auto vibe-scrollbar bg-muted/40 text-xs select-none">
                <template x-for="filter in filterOptions" :key="filter.id">
                    <button type="button" @click="setFilter(filter.id)" class="px-2.5 py-1 rounded-full text-xs font-medium transition-all duration-150 shrink-0 cursor-pointer flex items-center gap-1.5" :class="activeFilter === filter.id ?
                        'bg-primary text-primary-foreground shadow-2xs font-semibold' :
                        'bg-secondary text-secondary-foreground hover:bg-accent hover:text-accent-foreground border border-border/40'">
                        <span x-text="filter.label"></span>
                        <span x-show="filter.count !== null" x-text="filter.count" class="text-[10px] px-1.5 py-0.2 rounded-full font-mono" :class="activeFilter === filter.id ? 'bg-primary-foreground/20 text-primary-foreground' : 'bg-background/80 text-muted-foreground'"></span>
                    </button>
                </template>
            </div>
        </vibe:modal.header>

        {{-- Modal Content: Results List Container --}}
        <vibe:modal.content x-ref="resultsContainer" class="p-2 sm:p-2.5 max-h-96 sm:max-h-104 space-y-1 vibe-scrollbar">
            {{-- When there are items --}}
            <template x-if="filteredItems.length > 0">
                <div class="flex flex-col gap-1">
                    <template x-for="(item, index) in filteredItems" :key="item.id || index">
                        <div :data-index="index" @click="selectItem(item)" @mouseenter="selectedIndex = index" class="flex items-center gap-3 px-3 py-2.5 rounded-xl cursor-pointer transition-all duration-150 group/search-item" :class="selectedIndex === index ?
                            'bg-accent text-accent-foreground shadow-2xs ring-1 ring-border/80' :
                            'text-foreground/80 hover:bg-accent hover:text-foreground'">
                            {{-- Icon container --}}
                            <div class="shrink-0 size-9 rounded-lg flex items-center justify-center transition-colors border" :class="selectedIndex === index ?
                                'bg-primary text-primary-foreground border-primary shadow-2xs' :
                                'bg-muted text-muted-foreground border-border/60 group-hover/search-item:bg-accent group-hover/search-item:text-foreground'">
                                <span x-html="renderIcon(item.icon, item.category)"></span>
                            </div>

                            {{-- Text Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs sm:text-sm font-semibold truncate tracking-tight" :class="selectedIndex === index ? 'text-accent-foreground font-bold' : 'text-foreground'" x-text="item.title"></span>

                                    {{-- Sub category or section tag --}}
                                    <template x-if="item.subCategory || item.section">
                                        <span class="text-[10px] px-1.5 py-0.2 rounded-md font-medium shrink-0 bg-muted text-muted-foreground border border-border/60" x-text="item.subCategory || item.section"></span>
                                    </template>
                                </div>

                                <p x-show="item.subtitle" class="text-[11px] sm:text-xs text-muted-foreground truncate mt-0.5" x-text="item.subtitle"></p>
                            </div>

                            {{-- Category Badge / Shortcut Badge --}}
                            <div class="shrink-0 flex items-center gap-1.5">
                                <template x-if="item.shortcut">
                                    <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 text-[10px] font-mono text-muted-foreground bg-muted border border-border/80 rounded shadow-2xs" x-text="item.shortcut"></kbd>
                                </template>

                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full uppercase tracking-wider" :class="getCategoryBadgeClass(item.category)" x-text="item.category"></span>

                                {{-- Active Arrow Indicator --}}
                                <svg class="size-4 transition-transform text-primary shrink-0 opacity-0 group-hover/search-item:opacity-100" :class="selectedIndex === index ? 'opacity-100 translate-x-0.5' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            {{-- Empty State --}}
            <template x-if="filteredItems.length === 0">
                <div class="py-12 px-4 text-center flex flex-col items-center justify-center">
                    <div class="size-12 rounded-full bg-muted flex items-center justify-center text-muted-foreground mb-3 shadow-inner border border-border/60">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11.5" cy="11.5" r="9.5" />
                            <path d="M18.5 18.5L22 22" />
                            <path d="M9 11.5h5" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/search.no_results.title') }}</h3>
                    <p class="text-xs text-muted-foreground max-w-xs mt-1">
                        {{ __('docs/search.no_results.desc_prefix') }}<span class="font-medium text-foreground" x-text="query"></span>{{ __('docs/search.no_results.desc_suffix') }}
                    </p>
                </div>
            </template>
        </vibe:modal.content>

        {{-- Modal Footer: Keyboard Controls & Hint --}}
        <vibe:modal.footer class="justify-between px-4 sm:px-5 py-2.5 text-[11px] select-none border-t border-border bg-card">
            <div class="flex items-center gap-3 text-muted-foreground">
                <span class="flex items-center gap-1">
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">↑</kbd>
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">↓</kbd>
                    <span>{{ __('docs/search.footer.navigation') }}</span>
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">↵</kbd>
                    <span>{{ __('docs/search.footer.select') }}</span>
                </span>
                <span class="hidden sm:flex items-center gap-1">
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">Tab</kbd>
                    <span>{{ __('docs/search.footer.category') }}</span>
                </span>
                <span class="hidden sm:flex items-center gap-1">
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">ESC</kbd>
                    <span>{{ __('docs/search.footer.close') }}</span>
                </span>
            </div>

            <div class="flex items-center gap-2">
                <span x-text="filteredItems.length + ' {{ __('docs/search.footer.results') }}'"></span>
                <span class="text-border">•</span>
                <span class="font-medium text-foreground/80">{{ __('docs/search.footer.branding') }}</span>
            </div>
        </vibe:modal.footer>
    </div>
</vibe:modal>

<script>
    function globalSearchModal(config) {
        return {
            query: '',
            activeFilter: 'all',
            selectedIndex: 0,
            isLoadingDb: false,
            allMenuItems: config.menuItems || [],
            allActionItems: config.actionItems || [],
            searchApiUrl: config.searchApiUrl || '/docs/search/query',
            dbResults: [],
            historyItems: [],
            pinnedItems: [],
            debounceTimer: null,

            filterOptions: [
                { id: 'all', label: @js(__('docs/search.filters.all')), count: null },
                { id: 'menu', label: @js(__('docs/search.filters.menu')), count: null },
                { id: 'database', label: @js(__('docs/search.filters.database')), count: null },
                { id: 'history', label: @js(__('docs/search.filters.history')), count: null },
                { id: 'pinned', label: @js(__('docs/search.filters.pinned')), count: null },
                { id: 'action', label: @js(__('docs/search.filters.action')), count: null },
            ],

            init() {
                this.loadLocalData();
                window.addEventListener('vibeHistory:updated', () => {
                    this.loadHistory();
                });
            },

            onModalOpen() {
                this.loadLocalData();
                this.selectedIndex = 0;
                this.$nextTick(() => {
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                        this.$refs.searchInput.select();
                    }
                });
            },

            loadLocalData() {
                this.loadHistory();
                this.loadPinned();
            },

            loadHistory() {
                try {
                    const prefix = window.VIBE_PREFIX || 'vibe';
                    const raw = localStorage.getItem(prefix + '-page-history');
                    if (raw) {
                        const parsed = JSON.parse(raw);
                        if (Array.isArray(parsed)) {
                            // Deduplicate
                            const seen = new Set();
                            this.historyItems = parsed
                                .filter(item => {
                                    if (!item || !item.url || seen.has(item.url)) return false;
                                    seen.add(item.url);
                                    return true;
                                })
                                .slice(0, 10)
                                .map((item, idx) => ({
                                    id: 'history-' + idx,
                                    title: item.title || item.url,
                                    subtitle: @js(__('docs/search.history.subtitle', ['url' => ''])) + (item.url || ''),
                                    category: @js(__('docs/search.categories.history')),
                                    section: @js(__('docs/search.sections.recent_pages')),
                                    url: item.url,
                                    icon: 'history',
                                    keywords: (item.title || '') + ' ' + (item.url || ''),
                                }));
                        }
                    } else {
                        this.historyItems = [];
                    }
                } catch (e) {
                    this.historyItems = [];
                }
            },

            loadPinned() {
                try {
                    const prefix = window.VIBE_PREFIX || 'vibe';
                    const raw = localStorage.getItem(prefix + '-nav');
                    let pinnedIds = [];
                    if (raw) {
                        const parsed = JSON.parse(raw);
                        if (Array.isArray(parsed)) {
                            const navData = parsed.find(n => n.id === 'sidebar-menu');
                            if (navData && Array.isArray(navData.pinned)) {
                                pinnedIds = navData.pinned;
                            }
                        }
                    }

                    // Extract items from DOM or match with allMenuItems
                    const pins = [];
                    pinnedIds.forEach((pinId, idx) => {
                        const el = document.querySelector(`[data-nav-pin-id="${pinId}"]`);
                        if (el) {
                            const title = el.getAttribute('data-pin-title') || el.innerText.trim();
                            const href = el.getAttribute('href') || '#';
                            pins.push({
                                id: 'pinned-' + idx,
                                title: title,
                                subtitle: @js(__('docs/search.pinned.subtitle')),
                                category: @js(__('docs/search.categories.pinned')),
                                section: @js(__('docs/search.sections.favorites')),
                                url: href,
                                icon: 'pin',
                                keywords: title + ' ' + href,
                            });
                        }
                    });

                    // Fallback: If no DOM elements found yet, check allMenuItems matching IDs
                    if (pins.length === 0 && pinnedIds.length > 0) {
                        pinnedIds.forEach((pinId, idx) => {
                            pins.push({
                                id: 'pinned-' + idx,
                                title: @js(__('docs/search.pinned.fallback_title', ['id' => ''])) + pinId,
                                subtitle: @js(__('docs/search.pinned.fallback_subtitle')),
                                category: @js(__('docs/search.categories.pinned')),
                                section: @js(__('docs/search.sections.favorites')),
                                url: '#',
                                icon: 'pin',
                                keywords: pinId,
                            });
                        });
                    }

                    this.pinnedItems = pins;
                } catch (e) {
                    this.pinnedItems = [];
                }
            },

            onQueryInput() {
                this.selectedIndex = 0;
                clearTimeout(this.debounceTimer);

                const q = this.query.trim();
                if (q.length >= 1) {
                    this.debounceTimer = setTimeout(() => {
                        this.fetchDatabaseResults(q);
                    }, 250);
                } else {
                    this.dbResults = [];
                    this.isLoadingDb = false;
                }
            },

            fetchDatabaseResults(q) {
                this.isLoadingDb = true;
                const url = new URL(this.searchApiUrl, window.location.origin);
                url.searchParams.set('q', q);

                fetch(url.toString(), {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            this.dbResults = data.map(item => ({
                                id: item.id,
                                title: item.title,
                                subtitle: item.subtitle,
                                category: item.category || @js(__('docs/search.categories.database')),
                                subCategory: item.subCategory,
                                url: item.url,
                                icon: item.icon || 'database',
                                keywords: item.title + ' ' + (item.subtitle || ''),
                            }));
                        } else {
                            this.dbResults = [];
                        }
                    })
                    .catch(err => {
                        console.error('Search query failed:', err);
                        this.dbResults = [];
                    })
                    .finally(() => {
                        this.isLoadingDb = false;
                    });
            },

            get filteredItems() {
                const q = this.query.toLowerCase().trim();
                let list = [];

                if (q === '') {
                    // Empty query: provide curated default list
                    if (this.activeFilter === 'menu') {
                        list = this.allMenuItems;
                    } else if (this.activeFilter === 'database') {
                        list = this.dbResults;
                    } else if (this.activeFilter === 'history') {
                        list = this.historyItems;
                    } else if (this.activeFilter === 'pinned') {
                        list = this.pinnedItems;
                    } else if (this.activeFilter === 'action') {
                        list = this.allActionItems;
                    } else {
                        // 'all': blend top history, pinned, recommended menus, and quick actions
                        list = [
                            ...this.pinnedItems.slice(0, 3),
                            ...this.historyItems.slice(0, 3),
                            ...this.allActionItems.slice(0, 3),
                            ...this.allMenuItems.slice(0, 6),
                        ];
                    }
                } else {
                    // Search mode across properties
                    const searchMatch = (item) => {
                        const titleMatch = item.title && item.title.toLowerCase().includes(q);
                        const subtitleMatch = item.subtitle && item.subtitle.toLowerCase().includes(q);
                        const keywordsMatch = item.keywords && item.keywords.toLowerCase().includes(q);
                        const categoryMatch = item.category && item.category.toLowerCase().includes(q);
                        const sectionMatch = item.section && item.section.toLowerCase().includes(q);
                        return titleMatch || subtitleMatch || keywordsMatch || categoryMatch || sectionMatch;
                    };

                    let pool = [];
                    if (this.activeFilter === 'menu') {
                        pool = this.allMenuItems.filter(searchMatch);
                    } else if (this.activeFilter === 'database') {
                        pool = this.dbResults;
                    } else if (this.activeFilter === 'history') {
                        pool = this.historyItems.filter(searchMatch);
                    } else if (this.activeFilter === 'pinned') {
                        pool = this.pinnedItems.filter(searchMatch);
                    } else if (this.activeFilter === 'action') {
                        pool = this.allActionItems.filter(searchMatch);
                    } else {
                        // All sources
                        pool = [
                            ...this.allMenuItems.filter(searchMatch),
                            ...this.dbResults,
                            ...this.historyItems.filter(searchMatch),
                            ...this.pinnedItems.filter(searchMatch),
                            ...this.allActionItems.filter(searchMatch),
                        ];
                    }

                    list = pool;
                }

                // Update filter counts dynamically
                this.updateFilterCounts(q);

                return list;
            },

            updateFilterCounts(q) {
                const countMatch = (item) => {
                    if (!q) return true;
                    return (item.title && item.title.toLowerCase().includes(q)) ||
                        (item.subtitle && item.subtitle.toLowerCase().includes(q)) ||
                        (item.keywords && item.keywords.toLowerCase().includes(q));
                };

                const menuCount = this.allMenuItems.filter(countMatch).length;
                const dbCount = this.dbResults.length;
                const histCount = this.historyItems.filter(countMatch).length;
                const pinCount = this.pinnedItems.filter(countMatch).length;
                const actCount = this.allActionItems.filter(countMatch).length;

                this.filterOptions[1].count = menuCount;
                this.filterOptions[2].count = dbCount;
                this.filterOptions[3].count = histCount;
                this.filterOptions[4].count = pinCount;
                this.filterOptions[5].count = actCount;
            },

            setFilter(filterId) {
                this.activeFilter = filterId;
                this.selectedIndex = 0;
                this.scrollToSelected();
            },

            cycleFilter() {
                const filters = ['all', 'menu', 'database', 'history', 'pinned', 'action'];
                const curIdx = filters.indexOf(this.activeFilter);
                const nextIdx = (curIdx + 1) % filters.length;
                this.setFilter(filters[nextIdx]);
            },

            clearSearch() {
                this.query = '';
                this.dbResults = [];
                this.selectedIndex = 0;
                if (this.$refs.searchInput) {
                    this.$refs.searchInput.focus();
                }
            },

            nextItem() {
                if (this.filteredItems.length === 0) return;
                this.selectedIndex = (this.selectedIndex + 1) % this.filteredItems.length;
                this.scrollToSelected();
            },

            prevItem() {
                if (this.filteredItems.length === 0) return;
                this.selectedIndex = (this.selectedIndex - 1 + this.filteredItems.length) % this.filteredItems.length;
                this.scrollToSelected();
            },

            scrollToSelected() {
                this.$nextTick(() => {
                    if (!this.$refs.resultsContainer) return;
                    const activeEl = this.$refs.resultsContainer.querySelector(`[data-index="${this.selectedIndex}"]`);
                    if (activeEl) {
                        activeEl.scrollIntoView({
                            block: 'nearest',
                            behavior: 'smooth'
                        });
                    }
                });
            },

            selectActiveItem() {
                if (this.filteredItems.length > 0 && this.filteredItems[this.selectedIndex]) {
                    this.selectItem(this.filteredItems[this.selectedIndex]);
                }
            },

            selectItem(item) {
                if (!item) return;

                // Close the modal
                this.$dispatch('close-modal', 'global-search-modal');

                // Execute action if action property exists
                if (item.action) {
                    if (item.action === 'toggleTheme') {
                        if (window.VibeTheme) {
                            window.VibeTheme.toggle();
                        } else {
                            document.documentElement.classList.toggle('dark');
                        }
                    } else if (item.action === 'toggleFullscreen') {
                        if (!document.fullscreenElement) {
                            document.documentElement.requestFullscreen().catch(() => {});
                        } else {
                            document.exitFullscreen().catch(() => {});
                        }
                    } else if (item.action === 'clearHistory') {
                        const prefix = window.VIBE_PREFIX || 'vibe';
                        localStorage.removeItem(prefix + '-page-history');
                        this.historyItems = [];
                        window.dispatchEvent(new CustomEvent('vibeHistory:updated'));
                        if (window.vibeToast) {
                            window.vibeToast({
                                type: 'success',
                                message: @js(__('docs/search.actions.clear_history_toast')),
                            });
                        }
                    }
                    return;
                }

                // If item has a URL, navigate
                if (item.url && item.url !== '#') {
                    if (window.Livewire && window.Livewire.navigate) {
                        window.Livewire.navigate(item.url);
                    } else {
                        window.location.href = item.url;
                    }
                }
            },

            getCategoryBadgeClass(category) {
                switch (category) {
                    case 'Menu':
                        return 'bg-secondary text-secondary-foreground border border-border/60';
                    case 'Database':
                        return 'bg-success/15 text-success border border-success/25';
                    case 'Riwayat':
                    case 'History':
                        return 'bg-warning/15 text-warning border border-warning/25';
                    case 'Disematkan':
                    case 'Pinned':
                        return 'bg-info/15 text-info border border-info/25';
                    case 'Aksi':
                    case 'Action':
                    case 'Actions':
                        return 'bg-primary/10 text-primary border border-primary/20';
                    default:
                        return 'bg-muted text-muted-foreground border border-border/60';
                }
            },

            renderIcon(iconName, category) {
                switch (iconName) {
                    case 'book':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10M6 10h10"/></svg>`;
                    case 'download':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12m-4-4 4 4 4-4"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>`;
                    case 'folder':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>`;
                    case 'lock':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>`;
                    case 'shield':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>`;
                    case 'clock':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`;
                    case 'key':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="7.5" cy="15.5" r="5.5"/><path d="m21 2-9.6 9.6M15.5 7.5l3 3M18.5 4.5l3 3"/></svg>`;
                    case 'form':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>`;
                    case 'input':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="6" y1="12" x2="10" y2="12"/></svg>`;
                    case 'hash':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="9" x2="20" y2="9"/><line x1="4" y1="15" x2="20" y2="15"/><line x1="10" y1="3" x2="8" y2="21"/><line x1="16" y1="3" x2="14" y2="21"/></svg>`;
                    case 'currency':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M14.8 9A2 2 0 0 0 13 8h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1-1.8-1M12 6v2m0 8v2"/></svg>`;
                    case 'phone':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>`;
                    case 'textarea':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22C17.523 22 22 17.523 22 12S17.523 2 12 2 2 6.477 2 12c0 1.6.376 3.112 1.043 4.453.178.356.237.763.134 1.148l-.595 2.226c-.259.966.625 1.85 1.591 1.592l2.226-.596c.385-.103.792-.044 1.148.134A9.957 9.957 0 0 0 12 22Z"/><path d="M8 10.5h8M8 14h5.5"/></svg>`;
                    case 'select':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="4"/><path d="M8 12h.01M12 12h.01M16 12h.01"/></svg>`;
                    case 'check':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>`;
                    case 'radio':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/></svg>`;
                    case 'toggle':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="12" x="2" y="6" rx="6"/><circle cx="16" cy="12" r="2.5"/></svg>`;
                    case 'slider':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="12" x2="20" y2="12"/><circle cx="14" cy="12" r="3"/></svg>`;
                    case 'calendar':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>`;
                    case 'upload':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>`;
                    case 'button':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="4"/><line x1="8" y1="12" x2="16" y2="12"/></svg>`;
                    case 'eye':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>`;
                    case 'badge':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4.7 16.1C3.2 14.6 2.4 13.8 2.1 12.8c-.3-1 0-2.1.5-4.2l.3-1.2C3.3 5.6 3.5 4.7 4.1 4.1c.6-.6 1.5-.8 3.3-1.2l1.2-.3c2.1-.5 3.2-.7 4.2-.5 1 .3 1.8 1.1 3.3 2.6l1.8 1.8c2.7 2.7 4 4.1 4 5.7 0 1.7-1.3 3-4 5.7-2.7 2.7-4 4-5.7 4-1.7 0-3-1.3-5.7-4L4.7 16.1Z"/><circle cx="8.6" cy="8.9" r="2"/></svg>`;
                    case 'image':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>`;
                    case 'card':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>`;
                    case 'grid':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>`;
                    case 'header':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/></svg>`;
                    case 'nav':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>`;
                    case 'breadcrumb':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>`;
                    case 'table':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18M9 21V9M15 21V9"/></svg>`;
                    case 'alert':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>`;
                    case 'toast':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>`;
                    case 'modal':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><line x1="3" y1="8" x2="21" y2="8"/><line x1="7" y1="5.5" x2="7.01" y2="5.5"/><line x1="10" y1="5.5" x2="10.01" y2="5.5"/></svg>`;
                    case 'sheet':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><line x1="15" y1="3" x2="15" y2="21"/></svg>`;
                    case 'tabs':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h7"/></svg>`;
                    case 'accordion':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m7 15 5 5 5-5M7 9l5-5 5 5"/></svg>`;
                    case 'code':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>`;
                    case 'qrcode':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>`;
                    case 'dashboard':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>`;
                    case 'context':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7H4M15 12H4M9 17H4"/></svg>`;
                    case 'dropdown':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 9l-7 6-7-6"/></svg>`;
                    case 'user':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="3"/><circle cx="12" cy="12" r="10"/><path d="M17.969 20C17.81 17.109 16.925 15 12 15s-5.81 2.109-5.969 5"/></svg>`;
                    case 'chart':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>`;
                    case 'history':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>`;
                    case 'pin':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22l4.653-4.658M19.072 8.036L15.99 4.95C13.882 2.84 12.829 1.786 11.697 2.036c-1.131.25-1.644 1.65-2.67 4.45L8.332 8.382c-.273.746-.41 1.12-.656 1.408a2.5 2.5 0 0 1-.374.345c-.308.222-.69.327-1.457.538-1.726.476-2.589.714-2.914 1.279a1.5 1.5 0 0 0-.212.803c.004.652.637 1.286 1.903 2.553l4.117 4.12c1.274 1.276 1.911 1.914 2.567 1.915a1.5 1.5 0 0 0 .788-.208c.57-.325.809-1.195 1.288-2.934.21-.764.315-1.147.536-1.455.097-.134.209-.257.334-.366.286-.248.657-.387 1.399-.666l1.917-.72c2.77-1.04 4.154-1.56 4.398-2.69.244-1.128-.802-2.175-2.894-4.269Z"/></svg>`;
                    case 'theme':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22C17.523 22 22 17.523 22 12c0-.463-.693-.539-.933-.143C19.929 13.74 17.862 15 15.5 15 11.91 15 9 12.09 9 8.5c0-2.362 1.26-4.429 3.143-5.567.396-.24.32-.933-.143-.933C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10Z"/></svg>`;
                    case 'globe':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><ellipse cx="12" cy="12" rx="4" ry="10"/><path d="M2 12h20"/></svg>`;
                    case 'settings':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M13.765 2.152C13.398 2 12.932 2 12 2c-.932 0-1.398 0-1.765.152a2.6 2.6 0 0 0-1.083.916 3.6 3.6 0 0 1-.143.864c-.02.557-.306 1.074-.79 1.353-.483.279-1.073.268-1.566.008a3.2 3.2 0 0 0-.82-.308 2.6 2.6 0 0 0-1.478.396 6.3 6.3 0 0 0-1.015 1.453c-.466.807-.7 1.21-.752 1.605a2.6 2.6 0 0 0 .396 1.478c.148.193.355.354.676.556.473.297.777.803.777 1.361s-.304 1.064-.777 1.361c-.321.202-.529.363-.676.556a2.6 2.6 0 0 0-.396 1.478c.052.395.286.798.752 1.605.466.807.7 1.21 1.015 1.453a2.6 2.6 0 0 0 1.478.396 3.2 3.2 0 0 0 .82-.308c.493-.26 1.083-.27 1.566.008.483.279.77.796.79 1.353.014.38.05.64.143.864a2.6 2.6 0 0 0 1.083.916C10.602 22 11.068 22 12 22c.932 0 1.398 0 1.765-.152a2.6 2.6 0 0 0 1.083-.916c.092-.224.129-.484.143-.864.02-.557.306-1.074.79-1.353.483-.279 1.073-.268 1.566-.008.336.177.58.276.82.308a2.6 2.6 0 0 0 1.479-.396c.315-.242.549-.646 1.014-1.453.466-.807.7-1.21.752-1.605a2.6 2.6 0 0 0-.396-1.478c-.148-.193-.355-.354-.676-.556a1.6 1.6 0 0 1-.777-1.361c0-.558.304-1.064.777-1.361.321-.202.528-.363.676-.556a2.6 2.6 0 0 0 .396-1.478c-.052-.395-.286-.798-.752-1.605-.465-.807-.7-1.21-1.014-1.453a2.6 2.6 0 0 0-1.479-.396 3.2 3.2 0 0 0-.82.308c-.493.26-1.083.27-1.566-.008-.483-.279-.77-.796-.79-1.353-.014-.38-.05-.64-.143-.864a2.6 2.6 0 0 0-1.083-.916Z"/></svg>`;
                    case 'fullscreen':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3H5a2 2 0 0 0-2 2v4M15 3h4a2 2 0 0 1 2 2v4M9 21H5a2 2 0 0 1-2-2v-4M15 21h4a2 2 0 0 0 2-2v-4"/></svg>`;
                    case 'trash':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0M20.5 6H3.5m15.333 2.5l-.46 6.899c-.177 2.655-.265 3.983-1.13 4.792C16.378 21 15.047 21 12.387 21h-.774c-2.66 0-3.991 0-4.856-.809-.865-.809-.953-2.137-1.13-4.792L5.167 8.5M9.5 11l.5 5m4.5-5l-.5 5"/></svg>`;
                    case 'database':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>`;
                    default:
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11.5" cy="11.5" r="9.5"/><path d="M18.5 18.5L22 22"/></svg>`;
                }
            }
        };
    }
</script>
