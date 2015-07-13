<?php

global $cscs_templates;
$options = array(
    'name' => 'Believe',
    'folder_name' => 'believe',
    'options' => array(
        'logo' => array(
            'type' => 'image',
            'label' => 'Logo (Transparent)',
            'def' => plugins_url("believe/images/logo.png", __FILE__),
            'description' => 'Recommended size: 250px x 90px',
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
            'label' => 'Title Top',
            'def' => 'Our Website is',
            'placeholder' => 'Our Website is',
            'description' => 'Text above the main title',
        ),
        'main_title' => array(
            'type' => 'text',
            'label' => 'Main title',
            'def' => 'Coming Soon',
            'placeholder' => 'Coming Soon',
            'description' => 'The bold title',
        ),
        'paragraph' => array(
            'type' => 'textarea',
            'label' => 'Paragraph Text',
            'def' => 'Meanwhile feel free to interact with our social networks',
            'placeholder' => 'Paragraph Text',
            'description' => 'This will be the paragraph text',
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
    )
);

$cscs_templates['believe'] = $options;

function cscs_belive_theme_scripts(){
    wp_enqueue_style('bootstrap', plugins_url('includes/css/bootstrap.min.css', CSCS_FILE));
    wp_enqueue_style('believe', plugins_url('believe/css/main.css', __FILE__));
}

add_action('cscs_theme_scripts_believe', 'cscs_belive_theme_scripts');
