<?php

if (!function_exists('hero_image')) {
    function hero_image()
    {
        return "https://source.unsplash.com/1600x900/?online-learning,education,coding";
    }
}

if (!function_exists('course_image')) {
    function course_image($title, $w = 400, $h = 250)
    {
        $query = urlencode($title . ' programming course');
        return "https://source.unsplash.com/{$w}x{$h}/?{$query}";
    }
}

if (!function_exists('course_detail_image')) {
    function course_detail_image($title)
    {
        $query = urlencode($title . ' coding learning');
        return "https://source.unsplash.com/1200x400/?{$query}";
    }
}

if (!function_exists('category_image')) {
    function category_image($name, $w = 400, $h = 200)
    {
        $query = urlencode($name . ' education learning');
        return "https://source.unsplash.com/{$w}x{$h}/?{$query}";
    }
}

if (!function_exists('teacher_image')) {
    function teacher_image($name, $w = 300, $h = 300)
    {
        $query = urlencode($name . ' teacher portrait');
        return "https://source.unsplash.com/{$w}x{$h}/?{$query}";
    }
}
