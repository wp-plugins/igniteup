<form action="options.php" method="post">
    <?php
    settings_fields('cscs_gener_options');
    do_settings_sections('cscs_gener_options');
    wp_enqueue_media();

    function check_checkboxes($isTrue) {
        echo $isTrue ? 'checked="checked"' : '';
    }
    ?>

    <table class="form-table">
        <tr>
            <th>
                <label><?php _e('Enable / Disable', CSCS_TEXT_DOMAIN); ?></label>
            </th>
            <td>
                <label><input type="checkbox" name="<?php echo $cs_enable_name = CSCS_GENEROPTION_PREFIX . 'enable'; ?>" value="1" <?php check_checkboxes(get_option($cs_enable_name) == '1'); ?>><?php _e('Enable Coming Soon or Site Offline', CSCS_TEXT_DOMAIN); ?></label>
            </td>
        </tr>
        <tr>
            <th><label><?php _e('Skip Page For', CSCS_TEXT_DOMAIN); ?></label></th>
            <td>
                <?php
                $skipfor = get_option(CSCS_GENEROPTION_PREFIX . 'skipfor');
                $skip_for_array = empty($skipfor) ? array() : json_decode($skipfor, TRUE);
                ?>
                <label><input type="checkbox" class="skip_checkbox" value="administrator" <?php check_checkboxes(in_array('administrator', $skip_for_array)); ?>><?php _e('Administrators', CSCS_TEXT_DOMAIN); ?></label>
                <div class="clearfix"></div>
                <label><input type="checkbox" class="skip_checkbox" value="editor" <?php check_checkboxes(in_array('editor', $skip_for_array)); ?>><?php _e('Editors', CSCS_TEXT_DOMAIN); ?></label>
                <div class="clearfix"></div>
                <label><input type="checkbox" class="skip_checkbox" value="subscriber" <?php check_checkboxes(in_array('subscriber', $skip_for_array)); ?>><?php _e('Subscribers', CSCS_TEXT_DOMAIN); ?></label>
                <input type="hidden"  name="<?php echo CSCS_GENEROPTION_PREFIX . 'skipfor'; ?>" id="skip_for_value" value='<?php echo $skipfor; ?>'>
            </td>
        </tr>
        <tr>
            <th><label><?php _e('Page Title', CSCS_TEXT_DOMAIN); ?></label></th>
            <td>
                <input type="text" class="regular-text" placeholder="Page Title" name='<?php echo $pg_title_name = CSCS_GENEROPTION_PREFIX . 'cs_page_title'; ?>' value='<?php echo get_option($pg_title_name); ?>'>
                <p><?php _e('This will be the title of the coming soon page.', CSCS_TEXT_DOMAIN); ?></p>
            </td>
        </tr>
        <tr>
            <th><label><?php _e('Powered by IgniteUp', CSCS_TEXT_DOMAIN); ?></label></th>
            <td>
                <?php $cs_powered_by = CSCS_GENEROPTION_PREFIX . 'powered_by'; ?>
                <label><input type="checkbox" name="<?php echo $cs_powered_by; ?>" value="1" <?php check_checkboxes(get_option($cs_powered_by) == '1'); ?>><?php _e('Show "Powered by IgniteUp" in the page', CSCS_TEXT_DOMAIN); ?></label>
            </td>
        </tr>


        <tr>
            <th><label><?php _e('Custom CSS', CSCS_TEXT_DOMAIN); ?></label></th>
            <td>
                <textarea name="<?php echo CSCS_GENEROPTION_PREFIX . 'customcss'; ?>" cols="50" rows="7"><?php echo get_option(CSCS_GENEROPTION_PREFIX . 'customcss', ''); ?></textarea>
            </td>
        </tr>

    </table>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
    </p>
</form>

<script>
    jQuery(document).on('change', '.skip_checkbox', function () {
        skip_arr = new Array();
        jQuery('.skip_checkbox').each(function () {
            if (jQuery(this).is(':checked')) {
                skip_arr.push(jQuery(this).val());
            }
        });
        jQuery('#skip_for_value').val(JSON.stringify(skip_arr));
    });
</script>