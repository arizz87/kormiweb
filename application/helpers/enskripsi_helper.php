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


if (!function_exists('aes_encrypt_id')) {
    function aes_encrypt_id($id)
    {
        $method = getenv('APP_ENC_METHOD');
        $key    = getenv('APP_ENC_KEY');

        if (!$method || !$key) {
            throw new Exception('Encryption key not configured');
        }

        // IV random (AMAN)
        $iv = random_bytes(openssl_cipher_iv_length($method));

        $cipher = openssl_encrypt(
            (string)$id,
            $method,
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );

        // Gabungkan IV + cipher
        $payload = $iv . $cipher;

        // Base64 URL Safe
        return rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
    }
}
 
if (!function_exists('aes_decrypt_id')) {
    function aes_decrypt_id($hash)
    {
        $method = getenv('APP_ENC_METHOD');
        $key    = getenv('APP_ENC_KEY');

        if (!$method || !$key) {
            throw new Exception('Encryption key not configured');
        }

        // Base64 URL decode
        $data = base64_decode(strtr($hash, '-_', '+/'));

        $ivLength = openssl_cipher_iv_length($method);

        // Ambil IV & cipher
        $iv     = substr($data, 0, $ivLength);
        $cipher = substr($data, $ivLength);

        return openssl_decrypt(
            $cipher,
            $method,
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
    }
}
