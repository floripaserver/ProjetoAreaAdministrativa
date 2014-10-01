<?php
/**
 * diretorio do autoload
 */
define('DEFAULT_LOADER', 'vendor/autoload.php');
define('COMPOSER_LOADER', __DIR__ . '/vendor/autoload.php');


/**
 * carregando classes
 */
if (file_exists(COMPOSER_LOADER)) {
    $loader = require COMPOSER_LOADER;
} else {
    if (!file_exists(DEFAULT_LOADER)) {
        
        echo 'Autoload não encontrado';
    } else {
        
        $loader = require_once DEFAULT_LOADER;
    }
}
