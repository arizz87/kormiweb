<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Enkripsi dan Dekripsi AES-256-CBC yang benar.
 * - Menggunakan OPENSSL_RAW_DATA agar output ciphertext dalam bentuk binary.
 * - Menggabungkan IV (16 bytes) + ciphertext, lalu base64_encode untuk penyimpanan/transmisi.
 * - Key di-derive ke 32 byte via SHA-256 (binary).
 *
 * Ganti KUNCI_RAHASIA dengan nilai rahasiamu yang panjang.
 */

if (!function_exists('encrypt_data')) {
    function encrypt_data($plaintext, $key = 'sLd82Kdl92mDD992kdklA882kkw91KKsslqQq223LLz994hf92hf2h92hf92hf928hf9') {
        if (!function_exists('openssl_encrypt')) {
            throw new Exception('OpenSSL extension not available');
        }

        // derive key ke 32 bytes
        $key = hash('sha256', $key, true); // raw binary 32 bytes

        // IV harus 16 bytes untuk AES-256-CBC
        $iv = openssl_random_pseudo_bytes(16);

        // gunakan OPENSSL_RAW_DATA supaya hasilnya raw binary (bukan base64)
        $ciphertext_raw = openssl_encrypt($plaintext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        // gabungkan IV + ciphertext, lalu base64 supaya aman dikirim dalam URL/JSON
        $combined = $iv . $ciphertext_raw;
        return base64_encode($combined);
    }
}

if (!function_exists('decrypt_data')) {
    function decrypt_data($encoded, $key = 'sLd82Kdl92mDD992kdklA882kkw91KKsslqQq223LLz994hf92hf2h92hf92hf928hf9') {
        if (!function_exists('openssl_decrypt')) {
            throw new Exception('OpenSSL extension not available');
        }

        // derive key ke 32 bytes
        $key = hash('sha256', $key, true);

        // decode base64
        $decoded = base64_decode($encoded, true);
        if ($decoded === false) return false;

        // ambil IV (16 bytes) dan ciphertext
        $iv = substr($decoded, 0, 16);
        $ciphertext_raw = substr($decoded, 16);

        if (strlen($iv) !== 16) {
            return false; // IV invalid
        }

        // dekripsi - gunakan OPENSSL_RAW_DATA
        $original_plaintext = openssl_decrypt($ciphertext_raw, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        return $original_plaintext;
    }
}


if (!function_exists('encode_id')) {
    function encode_id($id)
    {
        // Convert to base64 normal
        $base64 = base64_encode($id);

        // Base64URL (menghapus karakter tidak aman untuk URL)
        $base64url = strtr($base64, '+/', '-_');

        // Buang tanda "=" di akhir
        return rtrim($base64url, '=');
    }
}
 
if (!function_exists('decode_id')) {
    function decode_id($hash)
    {
        // Kembalikan -_ menjadi +/
        $base64 = strtr($hash, '-_', '+/');

        // Karena = dihilangkan, perlu kita tambahkan kembali
        $pad = strlen($base64) % 4;
        if ($pad > 0) {
            $base64 .= str_repeat('=', 4 - $pad);
        }

        return base64_decode($base64);
    }
}

/* CONFIGURASI AES ENKRIPSI*/
const ENC_METHOD = 'AES-256-CBC';
const ENC_KEY    = 'sLd82Kdl92mDD992kdklA882kkw91KKsslqQq223LLz994hf92hf2h92hf92hf928hf9';    // min 32 char
const ENC_IV     = '1234567890ABCDEF';                   // 16 byte FIXED IV
 
if (!function_exists('aes_encrypt_id')) {
    function aes_encrypt_id($id)
    {
        $encrypted = openssl_encrypt(
            $id,
            ENC_METHOD,
            ENC_KEY,
            OPENSSL_RAW_DATA,
            ENC_IV
        );

        // Base64URL encode
        $base64 = base64_encode($encrypted);
        return rtrim(strtr($base64, '+/', '-_'), '=');
    }
}
 
if (!function_exists('aes_decrypt_id')) {
    function aes_decrypt_id($hash)
    {
        // Base64URL decode
        $base64 = strtr($hash, '-_', '+/');
        $pad = strlen($base64) % 4;
        if ($pad > 0) {
            $base64 .= str_repeat('=', 4 - $pad);
        }

        $decoded = base64_decode($base64);

        return openssl_decrypt(
            $decoded,
            ENC_METHOD,
            ENC_KEY,
            OPENSSL_RAW_DATA,
            ENC_IV
        );
    }
}
