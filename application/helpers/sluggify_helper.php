<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function sluggify($name)
{
    $slug = $name;
    $slug = preg_replace('/\s+/', '-', $slug);
    var_dump($slug);
    $slug = preg_replace('/[ÁÂÀÄ]/', 'A', $slug);
    $slug = preg_replace('/[áâàä]/', 'a', $slug);
    $slug = preg_replace('/[Ë]/', 'E', $slug);
    $slug = preg_replace('/([a-z])([A-Z])/', '$1-$2', $slug);
    $slug = strtolower($slug);
    //$slug = preg_replace('/[^a-z0-9]/', '-', $slug);
    return utf8_encode($slug);
}
