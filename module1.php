<?php
function secToArray($secs)
{
    $res = array();

    $res['days'] = floor($secs / 86400);
    $secs = $secs % 86400;

    $res['hours'] = floor($secs / 3600);
    $secs = $secs % 3600;

    $res['minutes'] = floor($secs / 60);
    $res['secs'] = $secs % 60;

    return $res;
}
