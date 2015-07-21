<?php

function createTemplateThumb($key, $template, $active = FALSE) {
    ?>
    <div class="template-box">
        <div class="template-title"><?php echo $template['name'], $active ? ' (Active)' : ''; ?></div>
        <img src="<?php echo plugin_dir_url(CSCS_FILE) . 'includes/templates/' . $template['folder_name'] . '/screenshot.jpg'; ?>">
        <div class="template-footer">

            <?php if (CSCS_DEFAULT_TEMPLATE == $key): ?>
                <a href="<?php echo admin_url('admin.php?page=cscs_options&section=appearance'); ?>">
                    <button class="button button-primary button-customize"><?php _e('Customize', CSCS_TEXT_DOMAIN); ?></button>
                </a>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" name="activate_template" value="<?php echo $key; ?>">
                    <button class="button button-activate"><?php _e('Activate', CSCS_TEXT_DOMAIN); ?></button>
                </form>
            <?php endif; ?>

            <?php if (CSCS_DEFAULT_TEMPLATE != $key && !in_array($key, CSComingSoonCreator::getDefaultTemplateList())): ?>
                <form method="post">
                    <input type="hidden" name="page" value="cscs_templates"/>
                    <input type="hidden" name="delete_template" value="<?php echo $template['folder_name'] ?>"/>
                    <input type="submit" class="button button-delete" value="<?php _e('Uninstall', CSCS_TEXT_DOMAIN) ?>"/>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
?>

<div class="wrap">
    <h2><?php _e('Templates', CSCS_TEXT_DOMAIN); ?></h2>
    <?php if (isset($_REQUEST['activated']) && $_REQUEST['activated'] == 'yes'): ?>
        <div class="updated notice is-dismissible below-h2"><p><?php _e('A new template activated!', CSCS_TEXT_DOMAIN); ?> <a href="<?php echo admin_url('admin.php?page=cscs_options&section=appearance'); ?>"><?php _e('Customize it', CSCS_TEXT_DOMAIN); ?></a></p></div>
    <?php endif; ?>
    <div id="cscs-templates">
        <?php
        $templates = CSAdminOptions::getTemplates();
        createTemplateThumb(CSCS_DEFAULT_TEMPLATE, $templates[CSCS_DEFAULT_TEMPLATE], TRUE);
        foreach ($templates as $key => $template) {
            if ($key !== CSCS_DEFAULT_TEMPLATE)
                createTemplateThumb($key, $template);
        }
        ?>
        <div class="template-box">
            <div class="get-template-box"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
