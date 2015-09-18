<?php

use thom855j\PHPSecurity\Session;
use thom855j\PHPScrud\DB;

$users_total = DB::load()->query('SELECT count(*) AS Total FROM Users')->results();
$brokers = DB::load()->query('SELECT count(*) AS Total FROM Users WHERE Role_ID = ?',array(2))->results();
$users =DB::load()->query('SELECT count(*) AS Total FROM Users WHERE Role_ID = ?',array(3))->results();
$posts_total = DB::load()->query('SELECT count(*) AS Total FROM Posts')->results();
$posts_house = DB::load()->query('SELECT count(*) AS Total FROM Posts WHERE Type = ?',array('Hus'))->results();
$posts_flat = DB::load()->query('SELECT count(*) AS Total FROM Posts WHERE Type = ?',array('Lejlighed'))->results();
?>
<h1 class="page-header">Kontrolpanel</h1>

<p class="sub-header">Velkommen <?php echo Session::getKey('User', 'Username'); ?></p>

<h2>Brugere</h2>
<p class="text-info">Total: <?php echo $users_total[0]->Total ?></p>
<p class="text-info">Mæglere: <?php echo $brokers[0]->Total ?></p>
<p class="text-info">Alm. brugere: <?php echo $brokers[0]->Total ?></p>

<h2>Ejendomme</h2>
<p class="text-info">Total: <?php echo $posts_total[0]->Total ?></p>
<p class="text-info">Huse: <?php echo $posts_house[0]->Total ?></p>
<p class="text-info">Lejligheder: <?php echo $posts_flat[0]->Total ?></p>