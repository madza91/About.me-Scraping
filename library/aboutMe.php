<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 27.09.2017
 * Time: 22:43
 */

/**
 * Get all about selected user
 * @param $username
 * @param string $type
 * @return bool|mixed
 */
function getAboutMe($username, $type = 'array')
{

    if (empty($username))
        return false;


    // About.me homepage
    $base = 'https://about.me/';
    $userProfileUrl = $base . $username;

    $content = getURLContent($userProfileUrl);

    if ($content) {
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($content);
        $selector = new DOMXPath($doc);

        $result = $selector->query('//script[@type="text/json"]');

        foreach ($result as $node) {

            $array = json_decode($node->nodeValue, true);

            if (!isset($array['page']['id']) || $array['page']['id'] != 'profile')
                return false;

            if ($type == 'array') {
                if ($array) {
                    return $array;
                }
            } elseif ($type == 'json') {
                return $node->nodeValue;
            }

        }
    }

    return false;
}

/**
 * Parse profile picture
 * @param $user
 * @return string
 */
function prepareProfilePicture($globals, $user) {

    $defaultImage = 'http://s3.amazonaws.com/37assets/svn/765-default-avatar.png';

    if (count($user['images'])) {

        foreach ($user['images'] as $image) {
            if ($image['active'] == '1') {
                $maxPix = ($image['width'] > $image['height']) ? $image['height']: $image['width'];
                $additional = "?q=40&dpr=2&auto=format&fit=max&w=120&h=120&rect=0,0,{$maxPix},{$maxPix}";
                $image = str_replace($globals['AWS_IMAGES'], 'https://' . $globals['IMGIX_URL'], $image['url']);

                return $image . $additional;
            }
        }

    }

    return $defaultImage;
}

function prepareUserFullname($user) {
    return $user['first_name'] . ' ' . $user['last_name'];
}

function prepareUserBio($user) {
    if (!empty($user['bio']))
        return html_entity_decode($user['bio']);

    return false;
}

function prepareUserRoles($user) {
    $roles = array();

    if (count($user['roles'])) {
        foreach ($user['roles'] as $role) {
            $roles[] = $role['role'];
        }
        $imploded = implode(', ', $roles);
        return [
            'string' => $imploded,
            'array' => $roles
        ];
    }

    return false;
}

function prepareUserInterests($user) {

    $interests = array();
    if (count($user['interests'])) {
        foreach ($user['interests'] as $interest) {
            $interests[] = str_replace(' ', '', strtolower($interest['interest']));
        }
        $imploded = implode(' #', $interests);
        return [
            'string' => '#' . $imploded,
            'array' => $interests
        ];
    }

    return false;
}

function prepareUserLocation($user) {

    if (count($user['locations'])) {
        foreach ($user['locations'] as $location) {
            return $location;
        }
    }

    return false;
}

function prepareUserWebsite($user) {

    if (isset($user['spotlight'])) {
        $website['url'] = $user['spotlight']['url'];
        $website['text'] = $user['spotlight']['text'];
        return $website;
    }

    return false;
}

/**
 * Get body content from URL
 * @param $url
 * @return bool|mixed
 */
function getURLContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $body = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode >= 200 && $httpCode <= 299) {
        return $body;
    }

    return false;
}

/**
 * Get favicon from any domain
 * @param $url
 * @return string
 */
function getWebsiteFavicon($url) {

  $base = 'https://www.google.com/s2/favicons?domain=';

  $parsedUrl = parse_url($url);

  if (!isset($parsedUrl['host'])) {
    $domain = $url;
  } else {
    $domain = $parsedUrl['host'];
  }

  return $base . $domain;
}

/**
 * Dump and Die
 * @param $variable
 */
function dd($variable) {
    var_dump($variable);
    die;
}