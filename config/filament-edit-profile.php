<?php

return [
    'show_in_navigation' => false,
    'show_custom_fields' => true,
    'custom_fields' => [
        'nama_lengkap' => [
            'type' => 'text',
            'label' => 'Nama Lengkap',
            'placeholder' => 'Masukkan nama lengkap Anda',
            'required' => true,
            'column_span' => 'full',
        ],
        'no_hp' => [
            'type' => 'text',
            'label' => 'Nomor HP',
            'placeholder' => 'Contoh: 08123456789',
            'required' => true,
            'rules' => ['regex:/^08[0-9]{8,11}$/'],
            'column_span' => 'full',
        ],
        'alamat' => [
            'type' => 'textarea',
            'label' => 'Alamat Lengkap',
            'placeholder' => 'Masukkan alamat rumah lengkap Anda',
            'required' => true,
            'rows' => 3,
            'column_span' => 'full',
        ],
    ],
];

