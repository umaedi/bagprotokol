<?php
return [
    'main' => [
        [
            'name' => 'Home',
            'url' => 'dashboard',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-smart-home" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105"></path>
   <path d="M16 15c-2.21 1.333 -5.792 1.333 -8 0"></path>
</svg>',
            'sub' => []
        ],
        [
            'name' => 'Galeri',
            'role' => 'superadmin|admin|dokumentasi',
            'url' => 'galeri',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
  <circle cx="12" cy="13" r="3" />
</svg>',
            'sub' => []
        ],

        [
            'name' => 'Kategori Galeri',
            'role' => 'superadmin|admin|dokumentasi',
            'url' => 'galeri/kategori',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <rect x="4" y="4" width="6" height="6" rx="1" />
                          <rect x="4" y="14" width="6" height="6" rx="1" />
                          <rect x="14" y="14" width="6" height="6" rx="1" />
                          <line x1="14" y1="7" x2="20" y2="7" />
                          <line x1="17" y1="4" x2="17" y2="10" />
                        </svg>',
            'sub' => []
        ],
        [
            'name' => 'Agenda',
            'role' => 'superadmin|admin|protokol',
            'url' => 'agenda',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <rect x="4" y="5" width="16" height="16" rx="2" />
  <line x1="16" y1="3" x2="16" y2="7" />
  <line x1="8" y1="3" x2="8" y2="7" />
  <line x1="4" y1="11" x2="20" y2="11" />
  <rect x="8" y="15" width="2" height="2" />
</svg>',
            'sub' => []
        ],
        [
            'name' => 'Surat Menyurat',
            'role' =>'superadmin|admin|surat|user',
            'url' => 'surat',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <rect x="4" y="4" width="16" height="16" rx="2" />
                          <path d="M4 13h3l3 3h4l3 -3h3" />
                        </svg>',
            'sub' => [

                [
                    'role' => 'superadmin|admin|surat',
                    'name' => 'Surat Keluar',
                    'url' => 'surat/keluar',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <line x1="12" y1="4" x2="12" y2="14" />
  <line x1="12" y1="4" x2="16" y2="8" />
  <line x1="12" y1="4" x2="8" y2="8" />
  <line x1="4" y1="20" x2="20" y2="20" />
</svg>',
                    'sub' => []
                ],
                [
                    'role' => 'user',
                    'name' => 'Surat Masuk',
                    'url' => 'surat/masuk',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-down" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <line x1="12" y1="20" x2="12" y2="10" />
  <line x1="12" y1="20" x2="16" y2="16" />
  <line x1="12" y1="20" x2="8" y2="16" />
  <line x1="4" y1="4" x2="20" y2="4" />
</svg>',
                    'sub' => []
                ],
                [
                    'role' => 'hidden',
                    'name' => 'Surat Disposisi',
                    'url' => 'surat/disposisi',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-left-right" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <line x1="21" y1="17" x2="3" y2="17" />
  <path d="M6 10l-3 -3l3 -3" />
  <line x1="3" y1="7" x2="21" y2="7" />
  <path d="M18 20l3 -3l-3 -3" />
</svg>',
                    'sub' => []
                ],
                [
                    'role' => 'superadmin|surat|admin',
                    'name' => 'Surat Eksternal',
                    'url' => 'surat/eksternal',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link me-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" />
  <line x1="10" y1="14" x2="20" y2="4" />
  <polyline points="15 4 20 4 20 9" />
</svg>',
                    'sub' => []
                ],
                [
                    'role' => 'superadmin|admin|surat',
                    'name' => 'Tanda Tangan',
                    'url' => 'surat/tanda-tangan',
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle me-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z" />
  <path d="M16 5l3 3" />
  <path d="M9 7.07a7.002 7.002 0 0 0 1 13.93a7.002 7.002 0 0 0 6.929 -5.999" />
</svg>
</svg>',
                    'sub' => []
                ],

            ]
        ],
        [
            'name' => 'Organisasi Perangkat Daerah',
            'url' => 'opd',
            'role' => 'superadmin|admin',
//            'role' => 'asda',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-arch" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <line x1="3" y1="21" x2="21" y2="21"></line>
   <path d="M4 21v-15a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v15"></path>
   <path d="M9 21v-8a3 3 0 0 1 6 0v8"></path>
</svg>',
            'sub' => []
        ],
        [
            'name' => 'Youtube',
            'url' => 'youtube',
            'role' => 'superadmin|admin|dokumentasi',
//            'role' => 'asda',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-youtube" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <rect x="3" y="5" width="18" height="14" rx="4" />
  <path d="M10 9l5 3l-5 3z" />
</svg>',
            'sub' => []
        ],
        [
            'name' => 'Pengguna',
            'url' => 'users',
            'role' => 'superadmin|admin',
//            'role' => 'asda',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <circle cx="9" cy="7" r="4"></circle>
   <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
   <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
   <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
</svg>',
            'sub' => []
        ],

    ]
];
