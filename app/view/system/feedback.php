<style>  
    /* 
    File responsible for showing feedback boxes,  
    when one of the four sessions is set. 
    */ 
    /*  
        Created on : 20-04-2015, 17:54:25 
        Author     : thom855j 
    */ 

    /* feedback boxes */ 
    .feedback { 
        padding: 25px; 
        margin: 25px 0px 25px 0px; 
        font-weight: bold; 
        font-size: 18px; 
    } 
    .feedback.success { 
        color: #558f2d; 
        background-color: #ddf2c0; 
    } 
    .feedback.error { 
        color: #ff7272; 
        background-color: #ffe5e5; 
    } 
    .feedback.warning { 
        color: #ffcc00; 
        background-color: #fcf8e3; 
    } 
    .feedback.info { 
        color: #00529B; 
        background-color: #BDE5F8; 
    } 
</style> 
<?php 
use thom855j\PHPSecurity\Session;

// echo out positive messages 
if ( Session::exists( 'SUCCESS' ) ) 
{ 
    foreach ( ( array ) Session::flash( 'SUCCESS' ) as $feedback ) 
    { 
        echo '<div  class="feedback success">' . $feedback . '</div>' ; 
    } 
} 

// echo out negative messages 
if ( Session::exists( 'ERRORS' ) ) 
{ 
    foreach ( ( array ) Session::flash( 'ERRORS' ) as $feedback ) 
    { 
        echo '<div class="feedback error">' . $feedback . '</div>' ; 
    } 
} 

// echo out warning messages 
if ( Session::exists( 'WARNINGS' ) ) 
{ 
    foreach ( ( array ) Session::flash( 'WARNINGS' ) as $feedback ) 
    { 
        echo '<div class="feedback warning">' . $feedback . '</div>' ; 
    } 
} 

// echo out info messages 
if ( Session::exists( 'INFO' ) ) 
{ 
    foreach ( ( array ) Session::flash( 'INFO' ) as $feedback ) 
    { 
        echo '<div class="feedback info">' . $feedback . '</div>' ; 
    } 
}