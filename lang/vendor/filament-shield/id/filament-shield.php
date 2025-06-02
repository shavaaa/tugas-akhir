<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Kolom Tabel
    |--------------------------------------------------------------------------
    */

    'column.name' => 'Nama',
    'column.guard_name' => 'Tipe Akses',
    'column.roles' => 'Peran',
    'column.permissions' => 'Hak Akses',
    'column.updated_at' => 'Terakhir Diubah',

    /*
    |--------------------------------------------------------------------------
    | Formulir Input
    |--------------------------------------------------------------------------
    */

    'field.name' => 'Nama',
    'field.guard_name' => 'Tipe Akses',
    'field.permissions' => 'Hak Akses',
    'field.select_all.name' => 'Pilih Semua',
    'field.select_all.message' => 'Aktifkan semua hak akses yang <span class="text-primary font-medium">tersedia</span> buat peran ini.',

    /*
    |--------------------------------------------------------------------------
    | Navigasi & Resource
    |--------------------------------------------------------------------------
    */

    'nav.group' => 'Manajemen Akses',
    'nav.role.label' => 'Peran',
    'nav.role.icon' => 'heroicon-o-shield-check',
    'resource.label.role' => 'Peran',
    'resource.label.roles' => 'Daftar Peran',

    /*
    |--------------------------------------------------------------------------
    | Bagian & Tab
    |--------------------------------------------------------------------------
    */

    'section' => 'Data Utama',
    'resources' => 'Data Sistem',
    'widgets' => 'Widget',
    'pages' => 'Halaman',
    'custom' => 'Hak Akses Tambahan',

    /*
    |--------------------------------------------------------------------------
    | Pesan
    |--------------------------------------------------------------------------
    */

    'forbidden' => 'Maaf, kamu nggak punya akses ke halaman ini.',

    /*
    |--------------------------------------------------------------------------
    | Label Hak Akses Resource
    |--------------------------------------------------------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Lihat',
        'view_any' => 'Lihat Semua',
        'create' => 'Tambah',
        'update' => 'Edit',
        'delete' => 'Hapus',
        'delete_any' => 'Hapus Semua',
        'force_delete' => 'Hapus Permanen',
        'force_delete_any' => 'Hapus Permanen Semua',
        'restore' => 'Pulihkan',
        'replicate' => 'Duplikat',
        'reorder' => 'Atur Ulang',
        'restore_any' => 'Pulihkan Semua',
    ],
];
