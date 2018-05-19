<?php
spl_autoload_register(function ($class) {
    global $config;
    $app_base = $config['base_path'];
    $vendor = $app_base . '\vendor\\';
    $app = $app_base . '\app\\';
    if (file_exists($vendor . '\\' . $class . '.php')) {
        require_once $vendor . '\\' . $class . '.php';
        return;
    }
    if (file_exists($app . '\\' . $class . '.php')) {
        require_once $app . '\\' . $class . '.php';
        return;
    }
    if (file_exists($app . '\common\\' . $class . '.php')) {
        require_once $app . '\common\\' . $class . '.php';
        return;
    }
});
