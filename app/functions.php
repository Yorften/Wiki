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
