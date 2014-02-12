<?php

$folders = array('library', 'src');

spl_autoload_register(function ($class) use ($folders) {
    foreach ($folders as $folder)
    {
        $filePath = $folder . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($filePath))
        {
            include $filePath;
        }
    }
    
});