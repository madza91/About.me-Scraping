<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 28.09.2017
 * Time: 00:31
 */

// Include core file
include('init/core.php');

$username = (isset($_GET['user'])) ? $_GET['user'] : '';

$userData = getAboutMe($username, 'json');

echo ($userData) ? $userData: '{}';