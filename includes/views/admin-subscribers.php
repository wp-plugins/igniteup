<?php
global $wpdb;
$subs = $wpdb->get_results("SELECT * FROM " . CSCS_DBTABLE_PREFIX . CSCS_DBTABLE_SUBSCRIPTS);
?>
<div class="wrap">
    <h2><?php _e('Subscribers', CSCS_TEXT_DOMAIN); ?></h2>    
    <p><?php _e('List of subscribers you\'ve got through the Coming Soon page.', CSCS_TEXT_DOMAIN); ?></p>
    <form>
        <div class="tablenav top">
            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
                <select name="action" id="bulk-action-selector-top">
                    <option value="-1" selected="selected"><?php _e('Bulk Actions', CSCS_TEXT_DOMAIN); ?></option>
                    <option value="trash"><?php _e('Move to Trash', CSCS_TEXT_DOMAIN); ?></option>
                </select>
                <input id="doaction" class="button action" value="<?php _e('Apply', CSCS_TEXT_DOMAIN); ?>" type="submit">
            </div>
            <div class="alignright">
                <input type="button" class="button downcsv" <?php echo empty($subs) ? 'disabled' : '' ?> value="<?php _e('EXPORT CSV', CSCS_TEXT_DOMAIN); ?>">
                <input type="button" class="button downbcc" <?php echo empty($subs) ? 'disabled' : '' ?> value="<?php _e('EXPORT BCC', CSCS_TEXT_DOMAIN); ?>">
            </div>
        </div>
        <input type="hidden" name="page" value="cscs_subscribers"/>
        <table class="widefat fixed wp-list-table striped">
            <thead>
                <tr>
                    <th class="manage-column column-cb check-column">
                        <input type="checkbox">
                    </th>
                    <th><?php _e('Name', CSCS_TEXT_DOMAIN); ?></th>
                    <th><?php _e('Email Address', CSCS_TEXT_DOMAIN); ?></th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <?php foreach ($subs as $sub): ?>
                <tr>
                    <th class="check-column">
                        <input type="checkbox" name="subscriber[]" value="<?php echo $sub->id; ?>">
                    </th>
                    <td><?php echo empty($sub->name) ? _e('UNKNOWN', CSCS_TEXT_DOMAIN) : $sub->name; ?></td>
                    <td><?php echo $sub->email; ?></td>
                    <td class="alignright"><a class="button" href="<?php echo admin_url('admin.php?page=cscs_subscribers&action=trash&subscriber%5B%5D=') . $sub->id; ?>"><?php _e('Remove', CSCS_TEXT_DOMAIN); ?></a></td>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <tr>
                    <th class="manage-column column-cb check-column">
                        <input type="checkbox">
                    </th>
                    <th><?php _e('Name', CSCS_TEXT_DOMAIN); ?></th>
                    <th><?php _e('Email Address', CSCS_TEXT_DOMAIN); ?></th>
                    <th>&nbsp;</th>
                </tr>
            </tfoot>
        </table>
    </form>
</div>