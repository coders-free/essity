<?php

function iframe_url($url)
{

    /* $regex = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})$%x'; */
    $regex = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})(?:&\S+)?%x';
    if (preg_match($regex, $url, $matches)) {
        return $matches[1];
    }

    return $url;
}