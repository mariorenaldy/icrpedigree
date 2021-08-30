<?php
class Navigation extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    public function get_navigation(){
        $data = array(
          'superadmin' => array(
              array(
                'url' => 'backend',
                'displayName' => 'Dashboard',
                'child' => false,
                'heading' => false,
                'icon' => 'si-speedometer'
              ),

              array(
                'url' => '#',
                'displayName' => 'MASTER',
                'child' => false,
                'heading' => true,
                'icon' => ''
              ),
         array(
                'url' => 'backend/trah',
                'displayName' => 'Trah',
                'child' => false,
                'heading' => false,
                'icon' => 'si-plus'
              ),
              array(
                'url' => 'backend/canines',
                'displayName' => 'Canines',
                'child' => false,
                'heading' => false,
                'icon' => 'si-doc'
              ),
              array(
                'url' => 'backend/users',
                'displayName' => 'Pengguna',
                'child' => false,
                'heading' => false,
                'icon' => 'si-users'
              ),

              array(
                'url' => 'backend/setting',
                'displayName' => 'Pengaturan',
                'child' => false,
                'heading' => false,
                'icon' => 'si-settings '
              ),

              // ARTechnology
              array(
                'url' => '#',
                'displayName' => 'Membership',
                'child' => false,
                'heading' => true,
                'icon' => ''
              ),

              array(
                'url' => 'backend/members',
                'displayName' => 'Members',
                'child' => false,
                'heading' => false,
                'icon' => 'si-user-follow'
              ),

              array(
                'url' => 'backend/kennels',
                'displayName' => 'Kennels',
                'child' => false,
                'heading' => false,
                'icon' => 'si-home'
              ),

              array(
                'url' => 'backend/members/logs_request',
                'displayName' => 'Request Pengubahan Data Member',
                'child' => false,
                'heading' => false,
                'icon' => 'fa fa-list-ul'
              ),

              array(
                'url' => 'backend/members/request',
                'displayName' => 'Approve Request Pengubahan Data Member',
                'child' => false,
                'heading' => false,
                'icon' => 'fa fa-check-circle'
              ),

              array(
                'url' => 'backend/canines/logs_request',
                'displayName' => 'Request Pengubahan Data Canine',
                'child' => false,
                'heading' => false,
                'icon' => 'si-list'
              ),

              array(
                'url' => 'backend/canines/request',
                'displayName' => 'Approve Request Pengubahan Data Canine',
                'child' => false,
                'heading' => false,
                'icon' => 'si-check'
              ),

              array(
                'url' => 'backend/studs/view',
                'displayName' => 'Pacak',
                'child' => false,
                'heading' => false,
                'icon' => 'fa fa-list-alt'
              ),

              array(
                'url' => 'backend/studs',
                'displayName' => 'Approve Data Pacak',
                'child' => false,
                'heading' => false,
                'icon' => 'fa fa-check'
              ),

              array(
                'url' => 'backend/births/view',
                'displayName' => 'Lahir',
                'child' => false,
                'heading' => false,
                'icon' => 'fa fa-list-ol'
              ),

              array(
                'url' => 'backend/births',
                'displayName' => 'Approve Data Lahir',
                'child' => false,
                'heading' => false,
                'icon' => 'fa fa-check-square-o'
              ),
              // ARTechnology

              array(
                'url' => '#',
                'displayName' => 'Kelola Website',
                'child' => false,
                'heading' => true,
                'icon' => ''
              ),

              array(
                'url' => '#',
                'displayName' => 'Profil',
                'child' => array(
                      array(
                        'url' => 'backend/profile',
                        'displayName' => 'Tentang Perusahaan',
                      ),
                      array(
                        'url' => 'backend/contacts',
                        'displayName' => 'Kontak dan Pengalamatan',
                      ),
                    ),
                'heading' => false,
                'icon' => 'si-user'
              ),

              array(
                'url' => 'backend/managements',
                'displayName' => 'Manajemen',
                'child' => false,
                'heading' => false,
                'icon' => 'si-users'
              ),

              array(
                'url' => 'backend/products',
                'displayName' => 'Produk',
                'child' => false,
                'heading' => false,
                'icon' => 'si-handbag'
              ),

              array(
                'url' => 'backend/services',
                'displayName' => 'Layanan',
                'child' => false,
                'heading' => false,
                'icon' => 'si-info'
              ),

              array(
                'url' => 'backend/rules',
                'displayName' => 'Aturan/Rule',
                'child' => false,
                'heading' => false,
                'icon' => 'si-info'
              ),

              array(
                'url' => 'backend/events',
                'displayName' => 'Event',
                'child' => false,
                'heading' => false,
                'icon' => 'si-calendar'
              ),

              // array(
              //   'url' => 'backend/contacts',
              //   'displayName' => 'Kontak',
              //   'child' => false,
              //   'heading' => false,
              //   'icon' => 'si-call-end'
              // ),

              // array(
              //   'url' => '#',
              //   'displayName' => 'Sponsor',
              //   'child' => array(
              //         array(
              //           'url' => 'backend/sponsor/primary',
              //           'displayName' => 'Sponsor Utama',
              //         ),
              //         array(
              //           'url' => 'backend/sponsor',
              //           'displayName' => 'Sponsor Umum',
              //         ),
              //       ),
              //   'heading' => false,
              //   'icon' => 'si-emoticon-smile'
              // ),

              array(
                'url' => 'backend/quotes',
                'displayName' => 'Quote',
                'child' => false,
                'heading' => false,
                'icon' => 'si-bubble'
              ),

              array(
                'url' => 'backend/faqs',
                'displayName' => 'Kritik & Saran',
                'child' => false,
                'heading' => false,
                'icon' => 'si-bubbles'
              ),

              array(
                'url' => 'backend/notificationtype',
                'displayName' => 'Notifikasi',
                'child' => false,
                'heading' => false,
                'icon' => 'si-feed'
              ),
            ),
            'admin' => array(
                array(
                  'url' => 'backend',
                  'displayName' => 'Dashboard',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-speedometer'
                ),

                array(
                  'url' => '#',
                  'displayName' => 'MASTER',
                  'child' => false,
                  'heading' => true,
                  'icon' => ''
                ),

                array(
                  'url' => 'backend/canines',
                  'displayName' => 'Canines',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-doc'
                ),
                // array(
                //   'url' => 'backend/users',
                //   'displayName' => 'Pengguna',
                //   'child' => false,
                //   'heading' => false,
                //   'icon' => 'si-users'
                // ),

                array(
                  'url' => 'backend/setting',
                  'displayName' => 'Pengaturan',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-settings '
                ),

                array(
                  'url' => '#',
                  'displayName' => 'Kelola Website',
                  'child' => false,
                  'heading' => true,
                  'icon' => ''
                ),

                array(
                  'url' => '#',
                  'displayName' => 'Profil',
                  'child' => array(
                        array(
                          'url' => 'backend/profile',
                          'displayName' => 'Tentang Perusahaan',
                        ),
                        array(
                          'url' => 'backend/contacts',
                          'displayName' => 'Kontak dan Pengalamatan',
                        ),
                      ),
                  'heading' => false,
                  'icon' => 'si-user'
                ),

                array(
                  'url' => 'backend/managements',
                  'displayName' => 'Manajemen',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-users'
                ),

                array(
                  'url' => 'backend/products',
                  'displayName' => 'Produk',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-handbag'
                ),

                array(
                  'url' => 'backend/services',
                  'displayName' => 'Layanan',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-info'
                ),

                array(
                  'url' => 'backend/events',
                  'displayName' => 'Event',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-calendar'
                ),

                // array(
                //   'url' => 'backend/contacts',
                //   'displayName' => 'Kontak',
                //   'child' => false,
                //   'heading' => false,
                //   'icon' => 'si-call-end'
                // ),

                array(
                  'url' => '#',
                  'displayName' => 'Sponsor',
                  'child' => array(
                        array(
                          'url' => 'backend/sponsor/primary',
                          'displayName' => 'Sponsor Utama',
                        ),
                        array(
                          'url' => 'backend/sponsor',
                          'displayName' => 'Sponsor Umum',
                        ),
                      ),
                  'heading' => false,
                  'icon' => 'si-emoticon-smile'
                ),

                array(
                  'url' => 'backend/quotes',
                  'displayName' => 'Quote',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-bubble'
                ),

                array(
                  'url' => 'backend/faqs',
                  'displayName' => 'Keritik & Saran',
                  'child' => false,
                  'heading' => false,
                  'icon' => 'si-bubbles'
                ),
              ),
              'pegawai' => array(
                  array(
                    'url' => 'backend',
                    'displayName' => 'Dashboard',
                    'child' => false,
                    'heading' => false,
                    'icon' => 'si-speedometer'
                  ),

                  array(
                    'url' => '#',
                    'displayName' => 'Kelola Website',
                    'child' => false,
                    'heading' => true,
                    'icon' => ''
                  ),

                  array(
                    'url' => 'backend/events',
                    'displayName' => 'Event',
                    'child' => false,
                    'heading' => false,
                    'icon' => 'si-calendar'
                  ),

                  array(
                    'url' => 'backend/products',
                    'displayName' => 'Produk',
                    'child' => false,
                    'heading' => false,
                    'icon' => 'si-handbag'
                  ),


                )
        );
        return $data;
    }

}
