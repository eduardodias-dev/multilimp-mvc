<?php

function showDateTime($date, $format = 'd M, Y h:i A')
{
    return \Carbon\Carbon::parse($date)->translatedFormat($format);
}
