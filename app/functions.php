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

function hashPassword($value)
{
    return password_hash($value, PASSWORD_DEFAULT);
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
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            return true;
        }
    }
    return false;
}

function isAuthor()
{
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'author') {
            return true;
        }
    }
    return false;
}
