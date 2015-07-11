<?php
$section = isset($_REQUEST['section']) ? $_REQUEST['section'] : 'general';

function show_saved_notice() {
    if (!isset($_REQUEST['settings-updated']))
        return;
    ?>
    <div class="updated settings-error notice is-dismissible">
        <p><?php _e('Settings saved.', CSCS_TEXT_DOMAIN); ?></p>
    </div>
    <?php
}
?>
<div class="wrap">
    <h3 class="cscs-nav">
        <a class="cscs-nav-tabs <?php echo $section == 'general' ? 'active' : ''; ?>" href="<?php echo admin_url('admin.php?page=cscs_options&section=general'); ?>" ><?php _e('General', CSCS_TEXT_DOMAIN); ?></a>
        <a class="cscs-nav-tabs <?php echo $section == 'appearance' ? 'active' : ''; ?>" href="<?php echo admin_url('admin.php?page=cscs_options&section=appearance'); ?>"><?php _e('Template Options', CSCS_TEXT_DOMAIN); ?></a>
    </h3>
    
    <?php show_saved_notice(); ?>

    <?php if (!isset($_REQUEST['section']) || $_REQUEST['section'] == 'general'): ?>
        <h3><?php _e('General Options', CSCS_TEXT_DOMAIN); ?></h3>        
        <?php include 'temp-general-options.php'; ?>
    <?php else: ?>
        <h3><?php _e('Template Options', CSCS_TEXT_DOMAIN); ?></h3>
        <?php include 'temp-template-options.php'; ?>
    <?php endif; ?>
</div>
<?php
