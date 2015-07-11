<?php global $the_cs_template_options; ?>
<html>
    <head>
        <?php wp_head(); ?>
        <title><?php echo (!empty($the_cs_template_options["general_cs_page_title"]) ? $the_cs_template_options["general_cs_page_title"] : 'Almost Ready we are ready to launch.'); ?></title>

        <style>
            a{
                color:<?php echo $the_cs_template_options['font_color']; ?>;
                transition: all ease 400ms;
            }
            a:hover{
                color:<?php echo $the_cs_template_options['link_color']; ?>;
            }
            <?php if (!empty($the_cs_template_options['bg_image'])): ?>
                body::after{
                    content: '';
                    background: url('<?php echo $the_cs_template_options['bg_image']; ?>');
                    opacity: 0.5;
                    top: 0px;
                    left: 0px;
                    bottom: 0px;
                    right: 0px;
                    position: absolute;
                    z-index: -1;
                }
                body{
                    background: #000 !important;
                }
            <?php endif; ?>
        </style>
    </head>
    <body style="background: <?php echo $the_cs_template_options['bg_color']; ?>; color:<?php echo $the_cs_template_options['font_color']; ?>;">
        <div class="container-fluid main-container">
            <div class="row">
                <div class="col-sm-12 ">
                    <img class="img-responsive logo" src="<?php echo $the_cs_template_options['logo']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="title-top text-center">
                        <?php echo $the_cs_template_options['title_top']; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                    <div class="text-center sub-text trans">
                        <?php echo $the_cs_template_options['paragraph']; ?>
                    </div>
                    <p class="text-center contact trans">
                        <?php echo $the_cs_template_options['contact']; ?>  <a href="mailto:<?php echo $the_cs_template_options['email']; ?>" > <?php echo $the_cs_template_options['email']; ?> </a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <?php
                    $powered_by = $the_cs_template_options['general_powered_by'];
                    if ($powered_by == 1) {
                        $class = "visible";
                    } else {
                        $class = "hidden";
                    }
                    ?>
                    <div class="<?php echo $class; ?> text-center" id="powered-by">                        
                        Powered by IgniteUp
                    </div>
                </div>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>
