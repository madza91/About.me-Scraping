<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 27.09.2017
 * Time: 22:56
 */

// Include config file
include('config.php');

$availableLibraries = ['aboutMe', 'template'];

// Include libraries
foreach ($availableLibraries as $library) {
    include("library/{$library}.php");
}

// Define constants
DEFINE ('TEMPLATE', $config['template']);
DEFINE ('DEBUG', $config['debug']);
DEFINE ('PROJECT_TITLE', $config['project_title']);
DEFINE ('GOOGLE_MAPS_API_KEY', $config['google_maps_api_key']);
