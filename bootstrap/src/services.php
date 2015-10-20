<?php
/*
 * Set custom services
 */

// Caoture screen pdf
use PDF\Capture;
$app->set('Capture', new Capture);