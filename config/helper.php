<?php

function redirect($url)
{
    header("Location: $url");
    exit;
}

function currentUser()
{
    return $_SESSION['user'] ?? null;
}