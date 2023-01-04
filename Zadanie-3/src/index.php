<?php

    require_once('resources/DirectoryLister.php');

    $lister = new DirectoryLister();

    ini_set('open_basedir', getcwd());

    if (isset($_GET['hash'])) {

        $hashes = $lister->getFileHash($_GET['hash']);
        $data   = json_encode($hashes);

        die($data);

    }

    if (isset($_GET['zip'])) {

        $dirArray = $lister->zipDirectory($_GET['zip']);

    } else {

        if (isset($_GET['dir'])) {
            $dirArray = $lister->listDirectory($_GET['dir']);
        } else {
            $dirArray = $lister->listDirectory('.');
        }

        if (!defined('THEMEPATH')) {
            define('THEMEPATH', $lister->getThemePath());
        }

        $themeIndex = $lister->getThemePath(true) . '/index.php';

        if (file_exists($themeIndex)) {
            include($themeIndex);
        } else {
            die('Błąd: Coś poszło nie tak');
        }

    }
