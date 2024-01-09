<?php


function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}


function goToPage($page)
{
    $url = CONTROOT . $page;
    header("Location:{$url}");
    die();
}

function isAdmin()
{   
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == 'admin'){
            return true;
        }
    }
    return false;
}   