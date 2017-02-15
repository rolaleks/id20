<?php

$tests = [
    "function_exists('random_bytes')",
    "defined('OPENSSL_VERSION_TEXT') ? OPENSSL_VERSION_TEXT : null",
    "PHP_VERSION_ID",
    "function_exists('mcrypt_create_iv') ? bin2hex(mcrypt_create_iv(8, MCRYPT_DEV_URANDOM)) : null",
    "DIRECTORY_SEPARATOR",
    "sprintf('%o', lstat('/dev/urandom')['mode'])",
    "sprintf('%o', lstat('/dev/urandom')['mode'] & 0170000)",
    "bin2hex(file_get_contents('/dev/urandom', false, null, 0, 8))",
    "ini_get('open_basedir')",
];
foreach ($tests as $i => $test) {
    $result = eval('return ' . $test . ';');
    printf("%2d  %s\n    %s\n\n", $i + 1, $test, var_export($result, true));
}