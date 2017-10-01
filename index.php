<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 27.09.2017
 * Time: 20:43
 */

// Include core file
include('init/core.php');

// Get username from parameter
$username = (isset($_GET['user'])) ? $_GET['user'] : '';

// Get all data from About.me
$data = getAboutMe($username);


if ($data) {
    // If user exists
    $globals = $data['globals'];
    $user = $data['page']['user'];

    $page = new Template(TEMPLATE);
    $page->title = prepareUserFullname($user) . ' - ' . PROJECT_TITLE;
    $page->data = $data;
    $page->user = $user;
    $page->bio = prepareUserBio($user);
    $page->interests = prepareUserInterests($user);
    $page->roles = prepareUserRoles($user);
    $page->website = prepareUserWebsite($user);
    $page->profile_picture = prepareProfilePicture($globals, $user);
    $page->location = prepareUserLocation($user);

} else {
    // If user doesn't exists
    $values = [
        'title' => 'Error',
        'errorCode' => '404',
        'errorMessage' => 'Unknown user, please provide valid username. Set GET parameter `user`.'
    ];
    $page = new Template('errors', $values);
}

// Print prepared template page
echo $page;
