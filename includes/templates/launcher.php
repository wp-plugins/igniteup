<?php

global $cscs_templates;
$cscs_templates['launcher'] = array(
    'name' => 'Launcher',
    'folder_name' => 'launcher',
    'options' => array(
        'launch_date' => array(
            'type' => 'date',
            'label' => 'Launch Date',
            'placeholder' => 'mm/dd/yyyy',
            'def' => date('m/d/Y', strtotime('Next Monday')),
            'description' => 'Add the date when you are going to launch the site',
        ),
        'launch_time' => array(
            'type' => 'text',
            'label' => 'Launch Time',
            'placeholder' => 'hh:mm:ss',
            'def' => '12:12:12',
            'description' => 'Note: Enter time in hh:mm:ss format.',
        ),
        'bg_color' => array(
            'type' => 'color-picker',
            'label' => 'Background Color',
            'def' => '#28BB9B',
            'placeholder' => '#28BB9B',
            'description' => 'This will be the background color.',
        ),
        'bg_image' => array(
            'type' => 'image',
            'label' => 'Background Image',
            'def' => '',
            'placeholder' => '',
            'description' => 'Page background image. (Recommended size: 1920px x 1080px)',
        ),
        'font_color' => array(
            'type' => 'color-picker',
            'label' => 'Font Color',
            'def' => '#fff',
            'placeholder' => '#FFFFFF',
            'description' => 'This will be the font color',
        ),
        'title_top' => array(
            'type' => 'text',
            'label' => 'Title Top Text',
            'def' => 'Almost Ready',
            'placeholder' => 'Bold Title',
            'description' => 'This will be the bold title',
        ),
        'title' => array(
            'type' => 'text',
            'label' => 'Subtitle Text',
            'def' => 'Website will launch in',
            'placeholder' => 'Subtitle',
            'description' => 'Text below the title',
        ),
        'paragraph' => array(
            'type' => 'textarea',
            'label' => 'Paragraph Text',
            'def' => 'This website is currently unavailable due to maintenance. Please visit again later. If you have any inquiries forward to the site admin. Please subscribe with our Newsletter.',
            'placeholder' => 'Paragraph Text',
            'description' => 'This will be the paragraph text',
        ),
        'subscribe_text' => array(
            'type' => 'text',
            'label' => 'Button Text',
            'def' => 'Subscribe',
            'placeholder' => 'Subscribe',
            'description' => 'Max: 15 Characters',
        ),
        'subscribe_text_color' => array(
            'type' => 'color-picker',
            'label' => 'Button Font Color',
            'def' => '#fff',
            'placeholder' => '#FFFFFF',
            'description' => 'This will be the font color the button',
        ),
        'subscribe_bg_color' => array(
            'type' => 'color-picker',
            'label' => 'Button Background Color',
            'def' => '#DB4F4B',
            'placeholder' => '#FFFFFF',
            'description' => 'This will be the background color the button',
        ),
        'social-twitter' => array(
            'type' => 'text',
            'label' => 'Twitter',
            'def' => '',
            'placeholder' => 'http://twitter.com/ceylonsystems',
            'description' => 'Enter the Twitter URL here',
        ),
        'social-facebook' => array(
            'type' => 'text',
            'label' => 'Facebook',
            'def' => '',
            'placeholder' => 'http://facebook.com/ceylonsystems',
            'description' => 'Enter the Facebook URL here',
        ),
        'social-pinterest' => array(
            'type' => 'text',
            'label' => 'Pinterest',
            'def' => '',
            'placeholder' => 'http://pinterest.com/ceylonsystems',
            'description' => 'Enter the Pinterest URL here',
        ),
        'social-gplus' => array(
            'type' => 'text',
            'label' => 'Google+',
            'def' => '',
            'placeholder' => 'http://plus.google.com/+ceylonsystems',
            'description' => 'Enter the Google+ URL here',
        ),
        'social-youtube' => array(
            'type' => 'text',
            'label' => 'Youtube',
            'def' => '',
            'placeholder' => 'http://youtube.com/ceylonsystems',
            'description' => 'Enter the Youtube URL here',
        ),
        'social-evernote' => array(
            'type' => 'text',
            'label' => 'Evernote',
            'def' => '',
            'placeholder' => 'http://evernote.com/ceylonsystems',
            'description' => 'Enter the Evernote URL here',
        ),
        'social-tumblr' => array(
            'type' => 'text',
            'label' => 'Tumblr',
            'def' => '',
            'placeholder' => 'http://tumblr.com/ceylonsystems',
            'description' => 'Enter the Tumblr URL here',
        ),
        'social-behance' => array(
            'type' => 'text',
            'label' => 'Behance',
            'def' => '',
            'placeholder' => 'http://behance.net/ceylonsystems',
            'description' => 'Enter the Behance URL here',
        ),
        'social-linkedin' => array(
            'type' => 'text',
            'label' => 'Linkedin',
            'def' => '',
            'placeholder' => 'http://linkedin.com/ceylonsystems',
            'description' => 'Enter the Linkedin URL here',
        ),
    )
);

function cscs_launcher_theme_scripts(){
  wp_enqueue_style('bootstrap', plugins_url('includes/css/bootstrap.min.css', CSCS_FILE));  
  wp_enqueue_style('animate', plugins_url('includes/css/animate.css', CSCS_FILE));
  wp_enqueue_style('font-montserrat', plugins_url('includes/css/font-montserrat.css', CSCS_FILE));
  wp_enqueue_style('launcher', plugins_url('launcher/css/main.css', __FILE__), array(), CSCS_CURRENT_VERSION);
  wp_enqueue_style('launcher-icons', plugins_url('includes/css/icons/styles.css', CSCS_FILE));
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-countdown', plugins_url('launcher/js/jquery.countdown.js', __FILE__),  array('jquery'));
}

add_action('cscs_theme_scripts_launcher', 'cscs_launcher_theme_scripts');
