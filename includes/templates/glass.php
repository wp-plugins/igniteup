<?php

global $cscs_templates;
$cscs_templates['glass'] = array(
    'name' => 'Glass',
    'folder_name' => 'glass',
    'options' => array(
        'logo' => array(
            'type' => 'image',
            'label' => 'Logo (Transparent)',
            'def' => plugins_url("glass/img/logo.png", __FILE__),
            'description' => 'Recommended size: 250px x 90px',
        ),
        'bg_color' => array(
            'type' => 'color-picker',
            'label' => 'Background Color',
            'def' => '#303030',
            'placeholder' => '#28BB9B',
            'description' => 'This will be the background color.',
        ),
        'bg_image' => array(
            'type' => 'image',
            'label' => 'Background Image',
            'def' => plugins_url("glass/img/bg_default.jpg", __FILE__),
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
        'link_color' => array(
            'type' => 'color-picker',
            'label' => 'Link Color',
            'def' => '#cbcbcb',
            'placeholder' => '#cbcbcb',
            'description' => 'This will be the hover color',
        ),
        'title_top' => array(
            'type' => 'text',
            'label' => 'Title Top',
            'def' => 'Under Maintenance',
            'placeholder' => 'Header Text',
            'description' => 'This will be the main title',
        ),
        'paragraph' => array(
            'type' => 'textarea',
            'label' => 'Paragraph Text',
            'def' => 'sorry for the inconvenience <br> we will come with a new experience.',
            'placeholder' => 'Paragraph Text',
            'description' => 'This will be the paragraph text, you can use html tags here.',
        ),
        'subscribe' => array(
            'type' => 'checkbox',
            'label' => 'Show Subscribe Form',
            'def' => '1',
            'description' => 'Show/Hide Email Subscribe Form',
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
        'social-instagram' => array(
            'type' => 'text',
            'label' => 'Instagram',
            'def' => '',
            'placeholder' => 'http://instagram.com/ceylonsystems',
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

function cscs_glass_theme_scripts() {
    wp_enqueue_style('bootstrap', plugins_url('includes/css/bootstrap.min.css', CSCS_FILE), array(), CSCS_CURRENT_VERSION);
    wp_enqueue_style('animate', plugins_url('includes/css/animate.css', CSCS_FILE), array(), CSCS_CURRENT_VERSION);
    wp_enqueue_style('font-montserrat', plugins_url('includes/css/font-montserrat.css', CSCS_FILE), array(), CSCS_CURRENT_VERSION);
    wp_enqueue_style('igniteup-fontawesome', plugins_url('includes/css/font-awesome.min.css', CSCS_FILE), array(), CSCS_CURRENT_VERSION);
    wp_enqueue_style('font-opensans', plugins_url('includes/css/font-opensans.css', CSCS_FILE), array(), CSCS_CURRENT_VERSION);
    wp_enqueue_style('igniteup-glass', plugins_url('glass/css/main.css', __FILE__), array(), CSCS_CURRENT_VERSION);
}

add_action('cscs_theme_scripts_glass', 'cscs_glass_theme_scripts');
