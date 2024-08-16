<?php
function frontendFormattedDate($date = null, $hasTime = false)
{
    if (!$date) {
        $date = $hasTime ? date('Y-m-d h:i:s A') : date('Y-m-d');
    }
    if ($hasTime) {
        $date = date('d/M/Y h:i:s A', strtotime($date));
    } else {
        $date = date('d/M/Y', strtotime($date));
    }

    return $date;
}
