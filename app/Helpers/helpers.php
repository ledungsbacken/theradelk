<?php

function dateToHumanDiff($date) {
    $carbon = new Carbon\Carbon();
    $carbon->setLocale('en');
    return $carbon->parse($date)->diffForhumans();
}
