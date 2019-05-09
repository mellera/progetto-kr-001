<?php

define('ROOT_PATH', dirname(__DIR__));

define('VAR_PATH', ROOT_PATH . '/var');
define('SRC_PATH', ROOT_PATH . '/src');
define('ETC_PATH', ROOT_PATH . '/etc');
define('BOOT_PATH', ROOT_PATH . '/boot');
define('ASSETS_PATH', ROOT_PATH . '/assets');
define('ROUTES_PATH', ETC_PATH . '/routes');
define('RESOURCES_PATH', ROOT_PATH . '/resources');

define('VIEWS_PATH', RESOURCES_PATH . '/views');

require_once ROOT_PATH . '/vendor/autoload.php';
require_once ETC_PATH . '/constant.php';

spl_autoload_register(function ($className) {
    $filename = SRC_PATH . '/' . implode('/', explode('\\', $className)) . '.php';

    if (file_exists($filename)) {
        require_once $filename;
    }
});

error_reporting(E_ALL);

define('PHP_ERROR_DESCRIPTION', array(
    E_ERROR => 'E_ERROR',
    E_WARNING => 'E_WARNING',
    E_PARSE => 'E_PARSE',
    E_NOTICE => 'E_NOTICE',
    E_CORE_ERROR => 'E_CORE_ERROR',
    E_CORE_WARNING => 'E_CORE_WARNING',
    E_COMPILE_ERROR => 'E_COMPILE_ERROR',
    E_COMPILE_WARNING => 'E_COMPILE_WARNING',
    E_USER_ERROR => 'E_USER_ERROR',
    E_USER_WARNING => 'E_USER_WARNING',
    E_USER_NOTICE => 'E_USER_NOTICE',
    E_STRICT => 'E_STRICT',
    E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
    E_DEPRECATED => 'E_DEPRECATED',
    E_USER_DEPRECATED => 'E_USER_DEPRECATED',
    E_ALL => 'E_ALL'
));

set_error_handler(function ($errNo, $errStr, $errFile, $errLine) {
    try {
        if (array_key_exists($errNo, PHP_ERROR_DESCRIPTION)) {
            $errDescription = PHP_ERROR_DESCRIPTION[$errNo];
        } else {
            $errDescription = $errNo;
        }

        \Sys\Context::logger()->error('[ ' . $errDescription . ' ][ ' . $errFile . '::' . $errLine . ' ] ' . $errStr);

        return true;
    } catch (\Throwable $ex) {
        return false;
    }
});

set_exception_handler(function (\Throwable $ex) {
    try {
        \Sys\Context::logger()->error('[ EXCEPTION ][ ' . $ex->getFile() . '::' . $ex->getLine() . ' ] ' . $ex->getMessage() . PHP_EOL . $ex->getTraceAsString());
        \Sys\Context::handleException($ex);
    } catch (\Throwable $ex1) {
        http_response_code(500);
        echo $ex->getMessage() . PHP_EOL;
        // Gestire eccezione nel gestire l'eccezione (rimandando ad una pagina /500.html o una risposta JSON formattata in caso di API)
    }
});

$dotenv = new \Symfony\Component\Dotenv\Dotenv();

$dotenv->load(ETC_PATH . '/.env');
