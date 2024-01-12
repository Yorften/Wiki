<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function processForm($value)
{
    if (!isset($value) || $value !== $_SESSION['csrf_token']) {
        return false;
    } else return true;
}

function processContent($value)
{
    return str_replace("\n", '&#10;', $value);
}

function processBack($value)
{
    return str_replace('&#10;', "<br>", $value);
}

function hashPassword($value)
{
    return password_hash($value, PASSWORD_DEFAULT);
}

function verifyPassword($value, $hash)
{
    return password_verify($value, $hash);
}

function goToPage($page)
{
    $url = CONTROOT . $page;
    header("Location:{$url}");
    die();
}

function isLogged()
{
    if (isset($_SESSION['userId'])) {
        return true;
    }
    return false;
}

function isAdmin()
{
    if (isset($_SESSION['userRole'])) {
        if ($_SESSION['userRole'] == 'admin') {
            return true;
        }
    }
    return false;
}

function isAuthor()
{
    if (isset($_SESSION['userRole'])) {
        if ($_SESSION['userRole'] == 'author') {
            return true;
        }
    }
    return false;
}


function uploadWikiImage($name, $tmp_name, $size, $error)
{
    if ($error === 0) {
        if ($size > 10200000) {
            return 1;
        } else {
            $img_ext = pathinfo($name, PATHINFO_EXTENSION);
            $img_ext_lc = strtolower($img_ext);

            $allowed_ext = array("jpg", "jpeg", "png", "webp", "avif", "jfif");

            if (in_array($img_ext_lc, $allowed_ext)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ext_lc;
                $img_upload_path ='../public/assets/images/wikis/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                return $new_img_name;
            } else {
                return 2;
            }
        }
    } else {
        return 3;
    }
}
