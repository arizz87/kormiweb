<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function db_check()
{
    include(APPPATH.'config/database.php');
    $cfg = $db['default'];

    // Native mysqli (BUKAN CI)
    $conn = @mysqli_connect(
        $cfg['hostname'],
        $cfg['username'],
        $cfg['password'],
        $cfg['database'],
        $cfg['port'] ?? 3306
    );

    if (!$conn) {
        http_response_code(503);
        require(APPPATH.'views/errors/db_error.php');
        exit;
    }

     // =============================
    // 2️⃣ CEK USER TERHAPUS
    // =============================
    $CI =& get_instance();

    // jangan cek di halaman auth
    $controller = $CI->router->fetch_class();
    if ($controller === 'auth') {
        mysqli_close($conn);
        return;
    }

    $user_id = $CI->session->userdata('kode_user');

    if ($user_id) {
        $stmt = mysqli_prepare(
            $conn,
            "SELECT id_user FROM tbl_user WHERE id_user = ? LIMIT 1"
        );
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // 🔥 USER SUDAH DIHAPUS
        if (mysqli_stmt_num_rows($stmt) === 0) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            $CI->session->sess_destroy();
            redirect('login');
            exit;
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
