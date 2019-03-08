<?php
/*
 * Set View
 */
use Datalaere\PHPMvcFramework\View;
$app->set('View', View::load());
$app->get('View')->setTemplatePath(APP_VIEW);
$app->get('View')->setFeedbackFile(APP_VIEW . 'layouts/feedback');
