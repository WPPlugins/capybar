<?php
/**
 * @package Capybar
 * @version 1.0
 */
/*
Plugin Name: CapyBar
Plugin URI: http://wordpress.org/extend/plugins/capybar/
Description: CapyBar will show how many people online on your website. It also allow to chat with him! after install capybar peoples can chat with any site's visitors!
Author: Anton Kedenko
Version: 1.0
Author URI: http://capybar.com/
*/
// save options
if(isset($_POST['action'], $_POST['widget-id']))
{
    if( $_POST['action']=='save-widget' && $_POST['widget-id']=='capybar_widget')
    {
        if( isset($_POST['capybar_color_title']))
            update_option( 'capybar_color_title', $_POST['capybar_color_title']);
        if( isset($_POST['capybar_color_bottom']))
            update_option( 'capybar_color_bottom', $_POST['capybar_color_bottom']);
        if( isset($_POST['capybar_color_text']))
            update_option( 'capybar_color_text', $_POST['capybar_color_text']);
    }
}


function widget_CapyBar_options() 
{
   $title_and_border_color = get_option('capybar_color_title', '#693F15');
   $bottom_background = get_option('capybar_color_bottom', '#F53867');
   $color_text = get_option('capybar_color_text', '#FFFFFF');
   echo "Title Background & Border Color (HEX) <br><input name=capybar_color_title value=\"$title_and_border_color\">
   <br><br>
   Button install background (HEX) <br>
   <input name=capybar_color_bottom value=\"$bottom_background\">
   <br><br>
   Text-Color:<br>
   <input name=capybar_color_text value=\"$color_text\">
   ";
}
function CapyBar_render()
{
    $host = getenv("HTTP_HOST");
    $title_and_border_color = get_option('capybar_color_title', '#693F15');
    $bottom_background = get_option('capybar_color_bottom', '#F53867');
    $color_text = get_option('capybar_color_text', '#FFFFFF');   
    $colors = urlencode("$title_and_border_color|$bottom_background|$color_text");
    echo "<iframe src=\"http://capybar.com/widgets/?online&host=$host&colors=$colors\" frameborder=\"0\" border=\"0\" width=\"180\" height=\"300\"></iframe>";
    
}
wp_register_sidebar_widget(
    'CapyBar_widget',        // your unique widget id
    'CapyBar',          // widget name
    'CapyBar_render',  // callback function
    array(                  // options
        'description' => 'Install widget to know how many people on your website!'
    )
);

wp_register_widget_control(
        'CapyBar_widget',
        'CapyBar',
        'widget_CapyBar_options'
        );
