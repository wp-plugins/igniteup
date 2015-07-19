<?php global $the_cs_template_options; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php wp_head(); ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?php echo (!empty($the_cs_template_options["general_cs_page_title"]) ? $the_cs_template_options["general_cs_page_title"] : 'Almost Ready we are ready to launch.'); ?></title>

        <style>
            a{
                color:<?php echo $the_cs_template_options['font_color']; ?> !important;
                transition: all ease 400ms;
            }
            a:hover, a:focus{
                color:<?php echo $the_cs_template_options['link_color']; ?> !important;
            }
            <?php if (!empty($the_cs_template_options['bg_image'])): ?>
                body::after{
                    content: '';
                    background-image: url('<?php echo $the_cs_template_options['bg_image']; ?>');
                    top: 0px;
                    left: 0px;
                    bottom: 0px;
                    right: 0px;
                    position: fixed;
                    z-index: -1;                    
                    background-size:cover;
                }
                body{
                    background: #000 !important;
                }
            <?php endif; ?>
        </style>
    </head>
    <body style=" color:<?php echo $the_cs_template_options['font_color']; ?>;">
        <div class="container-fluid main-container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                    <div class="glass-wrapper">
                        <img class="img-responsive logo" src="<?php echo $the_cs_template_options['logo']; ?>">
                        <h2 class="text-center"> <?php echo $the_cs_template_options['title_top']; ?></h2>
                        <p class="text-center"><?php echo $the_cs_template_options['paragraph']; ?></p>
                        <ul class="social-icon">
                            <?php
                            $twitter = $the_cs_template_options['social-twitter'];
                            $facebook = $the_cs_template_options['social-facebook'];
                            $pinterest = $the_cs_template_options['social-pinterest'];
                            $gplus = $the_cs_template_options['social-gplus'];
                            $youtube = $the_cs_template_options['social-youtube'];
                            $instagram = $the_cs_template_options['social-instagram'];
                            $tumblr = $the_cs_template_options['social-tumblr'];
                            $behance = $the_cs_template_options['social-behance'];
                            $linkedin = $the_cs_template_options['social-linkedin'];
                            ?>
                            <li class = "<?php echo empty($twitter) ? 'hidden' : ''; ?>"><a href = "<?php echo $twitter; ?>" target = "_blank"><span class = "fa fa-twitter-square"></span></a></li>
                            <li class = "<?php echo empty($facebook) ? 'hidden' : ''; ?>"><a href = "<?php echo $facebook; ?>" target = "_blank"><span class = "fa fa-facebook-square"></span></a></li>
                            <li class = "<?php echo empty($gplus) ? 'hidden' : ''; ?>"><a href = "<?php echo $gplus; ?>" target = "_blank"><span class = "fa fa-google-plus-square"></span></a></li>
                            <li class = "<?php echo empty($pinterest) ? 'hidden' : ''; ?>"><a href = "<?php echo $pinterest; ?>" target = "_blank"><span class = "fa fa-pinterest-square"></span></a></li>
                            <li class = "<?php echo empty($youtube) ? 'hidden' : ''; ?>"><a href = "<?php echo $youtube; ?>" target = "_blank"><span class = "fa fa-youtube-square"></span></a></li>
                            <li class = "<?php echo empty($instagram) ? 'hidden' : ''; ?>"><a href = "<?php echo $instagram; ?>" target = "_blank"><span class = "fa fa-instagram"></span></a></li>
                            <li class = "<?php echo empty($tumblr) ? 'hidden' : ''; ?>"><a href = "<?php echo $tumblr; ?>" target = "_blank"><span class = "fa fa-tumblr-square"></span></a></li>
                            <li class = "<?php echo empty($behance) ? 'hidden' : ''; ?>"><a href = "<?php echo $behance; ?>" target = "_blank"><span class = "fa fa-behance-square"></span></a></li>
                            <li class = "<?php echo empty($linkedin) ? 'hidden' : ''; ?>"><a href = "<?php echo $linkedin; ?>" target = "_blank"><span class = "fa fa-linkedin-square"></span></a></li>
                        </ul>
                        <?php
                        $powered_by = $the_cs_template_options['general_powered_by'];
                        ($powered_by == 1) ? $class = "visible" : $class = "hidden";
                        ?>
                        <div class="<?php echo $class; ?> text-center" id="powered-by">                        
                            Powered by <a href="https://wordpress.org/plugins/igniteup/" target="_blank">IgniteUp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>
