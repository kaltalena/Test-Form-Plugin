<?php
/**
 * Plugin Name: Test Form
 * Descriptopn: Submitting the Form and sending an email
 */


 // Security check
if( !defined('ABSPATH') )
{
      die('You should not be here');
}


 //Form template html code
 function form_include(){

    $content = '';
     
    $content .= '<form method="post" action="process.php"';

    $content .= '<input type="text" name="first_name" placeholder="Your first name"/> <br />' ;

    $content .= '<input type="text" name="last_name" placeholder="Your last name"/> <br />' ;

    $content .= '<input type="text" name="subject" placeholder="Subject of your email"/> <br />' ;

    $content .= '<input type="textarea" name="message" placeholder="Your message"/> <br />' ;

    $content .= '<input type="email" name="email" placeholder="Your email address"/> <br />' ;

    $content .= '<input type="submit" name="form_submit" value="SUBMIT FORM"/> <br />' ;

    $content .= '</form>';
    
    return $content;
 }

 // Shortcode to include the form on a WP front page
 add_shortcode('test_form', 'form_include');

