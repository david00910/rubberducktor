<?php


class RedirectUser
{
    public function __construct($location)
    {
        header("Location: {$location}");
        exit;
    }
}