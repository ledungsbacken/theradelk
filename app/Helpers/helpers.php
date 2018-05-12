<?php

function dateToHumanDiff($date) {
    $carbon = new Carbon\Carbon();
    $carbon->setLocale('en');
    return $carbon->parse($date)->diffForhumans();
}

function getSlug($string) {
    return str_replace([' ', 'å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['-', 'a', 'a', 'o', 'A', 'A', 'O'], strtolower($string));
}
