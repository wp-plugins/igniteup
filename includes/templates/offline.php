<?php

global $cscs_templates;
$cscs_templates['offline'] = array(
    'name' => 'Offline',
    'folder_name' => 'offline',
    'options' => array(
        'logo' => array(
            'type' => 'image',
            'label' => 'Logo (Transparent)',
            'def' => plugins_url("offline/img/rockyton_color.png", __FILE__),
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
        'link_color' => array(
            'type' => 'color-picker',
            'label' => 'Link Color',
            'def' => '#f1c40f',
            'placeholder' => '#f1c40f',
            'description' => 'This will be the hover color',
        ),
        'title_top' => array(
            'type' => 'text',
            'label' => 'Title Top',
            'def' => 'Website is offline',
            'placeholder' => 'Website is offline',
            'description' => 'Text above the main title',
        ),
        'paragraph' => array(
            'type' => 'textarea',
            'label' => 'Paragraph Text',
            'def' => 'sorry for the inconvenience <br> we will come with new experience.',
            'placeholder' => 'Paragraph Text',
            'description' => 'This will be the paragraph text, you can use html tags here.',
        ),
        'contact' => array(
            'type' => 'text',
            'label' => 'Contact text',
            'def' => 'contact site admin:',
            'placeholder' => 'contact site admin:',
            'description' => 'Contact information label',
        ),
        'email' => array(
            'type' => 'email',
            'label' => 'Contact email',
            'def' => 'contact@email.com',
            'placeholder' => 'contact@email.com',
            'description' => 'Your email address',
        ),
    )
);

function cscs_offline_theme_scripts() {
    wp_enqueue_style('bootstrap', plugins_url('includes/css/bootstrap.min.css', CSCS_FILE));
    wp_enqueue_style('font-montserrat', plugins_url('includes/css/font-montserrat.css', CSCS_FILE));
    wp_enqueue_style('font-biryani', plugins_url('includes/css/font-biryani.css', CSCS_FILE));
    wp_enqueue_style('offline', plugins_url('offline/css/main.css', __FILE__));
}

add_action('cscs_theme_scripts_offline', 'cscs_offline_theme_scripts');
