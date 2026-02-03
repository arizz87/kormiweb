<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['maintenance_mode'] = FALSE; // TRUE = ON | FALSE = OFF

// // IP yang boleh bypass maintenance
// $config['maintenance_whitelist_ip'] = array(
//     '127.0.0.1', // localhost
// );

// role admin (jika pakai session)
$config['maintenance_admin_role'] = 'admin';
