<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('generate_secure_action_token')) {
    function generate_secure_action_token($id, $action)
    {
        $CI =& get_instance();
        $CI->load->library('encryption');   // Load library
        $CI->load->library('session');

        // SESSION ID
        $session_id = $CI->session->userdata('session_id');

        // IP
        $ip = $CI->input->ip_address();

        // NONCE (token sekali pakai)
        $nonce = bin2hex(random_bytes(16));

        // Simpan nonce per id
        $CI->session->set_userdata("nonce_$id", $nonce);

        // Ambil secret HMAC
        $secret = $CI->config->item('secret_hmac_key');
        if (!$secret) {
        show_error("Config 'secret_hmac_key' belum di-set di config.php");
        }
 
        // Buat signature HMAC
        $signature = hash_hmac('sha256', $id . $nonce . $action . $ip . $session_id, $secret);

        // Enkripsi ID
        $encrypted_id = $CI->encryption->encrypt($id);

        // Return array ke controller
        return [
            'nonce'        => $nonce,
            'signature'    => $signature,
            'enc_id'       => $encrypted_id,
            'session_id'   => $session_id,
            'ip'           => $ip,
            'action'       => $action 
        ];
    }
}
