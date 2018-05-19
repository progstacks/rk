<?php
spl_autoload_register(function ($class) {
    global $config;
    $app_base = $config['base_path'];
    $vendor = $app_base . '\vendor\\';
    $app = $app_base . '\app\\';
    if (file_exists($vendor . '\\' . $class . '.php')) {
        require $vendor . '\\' . $class . '.php';
    }
    if (file_exists($app . '\\' . $class . '.php')) {
        require $app . '\\' . $class . '.php';
    }
});
