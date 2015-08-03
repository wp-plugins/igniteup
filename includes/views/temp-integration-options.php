<form action="options.php" method="post">
    <?php
    settings_fields('cscs_integrat_options');
    do_settings_sections('cscs_integrat_options');
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label><?php _e('Enable / Disable', CSCS_TEXT_DOMAIN); ?></label>
            </th>
            <td>
                <?php
                $cs_name_int_enable = CSCS_GENEROPTION_PREFIX . 'enable_integration';
                $cs_name_int_enable_val = get_option($cs_name_int_enable, '');
                ?>
                <label>
                    <input type="checkbox" value="1" name="<?php echo $cs_name_int_enable; ?>" <?php echo $cs_name_int_enable_val == '1' ? 'checked="checked"' : ''; ?>>
                    <?php _e('Enable External Mailinglist Integration', CSCS_TEXT_DOMAIN); ?>
                </label>
                <p class="description"><?php _e('Tick this if you need to send your subscribers into one of the following Mailing list providers.', CSCS_TEXT_DOMAIN); ?></p>
            </td>
        </tr>

        <tr>
            <th>
                <label><?php _e('Save subscribers to', CSCS_TEXT_DOMAIN); ?></label>
            </th>
            <td>
                <?php
                $cs_name_int_save_to = CSCS_GENEROPTION_PREFIX . 'save_email_to';
                $cs_name_int_save_to_val = get_option($cs_name_int_save_to, '');
                ?>
                <select name="<?php echo $cs_name_int_save_to; ?>" id="cs-selected-provider">
                    <option value="default" <?php echo CSAdminOptions::selectOptionIsSelected($cs_name_int_save_to_val, 'default'); ?>>Only to Local Database</option>
                    <option value="mailchimp" <?php echo CSAdminOptions::selectOptionIsSelected($cs_name_int_save_to_val, 'mailchimp'); ?>>Mailchimp</option>
                    <option value="mailpoet" <?php echo CSAdminOptions::selectOptionIsSelected($cs_name_int_save_to_val, 'mailpoet'); ?>>Mailpoet</option>
                </select>
                <p class="description"><?php _e('Choose the default provider to save your subscribers. IgniteUp will always save to the local database.', CSCS_TEXT_DOMAIN); ?></p>
            </td>
        </tr>
    </table>
    <span id="cs-section-mailchimp" class="cs-hidden-section">
        <h3 class="title">Mailchimp v2.0</h3>
        <p><?php _e('If you need to use Mailchimp integration, provide an API key. So we can get you the mailing lists that you have in your Mailchimp account to select.', CSCS_TEXT_DOMAIN); ?></p>
        <table class="form-table">
            <tr>
                <th>
                    <label><?php _e('Mailchimp API Key', CSCS_TEXT_DOMAIN); ?></label>
                </th>
                <td>
                    <?php
                    $cs_name_mailchimp_api = CSCS_GENEROPTION_PREFIX . 'mailchimp_api';
                    $cs_mailchimp_api_value = get_option($cs_name_mailchimp_api, '');
                    ?>
                    <input type="text" name="<?php echo $cs_name_mailchimp_api; ?>" class="regular-text" placeholder="This is required to use Mailchimp integrations" value="<?php echo $cs_mailchimp_api_value ?>">
                    <p class="description"><?php _e('Need help finding your API key? <a href="http://kb.mailchimp.com/accounts/management/about-api-keys" target="_blank">Read this article</a>.', CSCS_TEXT_DOMAIN); ?></p>
                </td>
            </tr>

            <?php if (!empty($cs_mailchimp_api_value)): ?>
                <tr>
                    <th>
                        <label><?php _e('Select the list', CSCS_TEXT_DOMAIN); ?></label>
                    </th>
                    <td>
                        <?php
                        $cs_name_mailchimp_list = CSCS_GENEROPTION_PREFIX . 'mailchimp_list';
                        $cs_name_mailchimp_list_val = get_option($cs_name_mailchimp_list, '');
                        $MailChimp = new IgniteUpMailChimp($cs_mailchimp_api_value);
                        $mailchimp_lists = $MailChimp->call('lists/list');
                        if (is_array($mailchimp_lists) && $mailchimp_lists['total'] > 0) {
                            echo "<select name='$cs_name_mailchimp_list'>";
                            echo "<option value=''>Select a list..</option>";
                            foreach ($mailchimp_lists['data'] as $list):
                                echo '<option value="' . $list['id'] . '" ' . (($cs_name_mailchimp_list_val == $list['id']) ? 'selected="selected"' : '') . ' >' . $list['name'] . '</option>';
                            endforeach;
                            echo "</select>";
                            echo '<p class="description">' . __('Select the Mailchimp list you want your subscribers to be added.', CSCS_TEXT_DOMAIN) . '</p>';
                        }elseif (is_array($mailchimp_lists) && $mailchimp_lists['total'] == 0) {
                            _e('There are no lists in your Mailchimp account.', CSCS_TEXT_DOMAIN);
                        } else {
                            _e('Your API key seems to invalid!', CSCS_TEXT_DOMAIN);
                        }
                        ?>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </span>

    <span id="cs-section-mailpoet" class="cs-hidden-section">

        <h3 class="title">Mailpoet</h3>
        <p><?php _e('If you need to use Mailpoet integration, make sure you have Mailpoet plugin installed.', CSCS_TEXT_DOMAIN); ?></p>

        <table class="form-table">
            <tr>
                <th><label><?php _e('Select the list', CSCS_TEXT_DOMAIN); ?></label></th>
                <td>
                    <?php
                    if (class_exists('WYSIJA')) {
                        $model_list = WYSIJA::get('list', 'model');
                        $mailpoet_lists = $model_list->get(array('name', 'list_id'), array('is_enabled' => 1));

                        $cs_name_mailpoet_list = CSCS_GENEROPTION_PREFIX . 'mailpoet_list';
                        $cs_mailpet_list_val = get_option($cs_name_mailpoet_list, '');
                        echo "<select name='$cs_name_mailpoet_list'>";
                        echo "<option value=''>Select a list..</option>";
                        foreach ($mailpoet_lists as $list) :
                            echo '<option value="' . $list['list_id'] . '" ' . (($cs_mailpet_list_val == $list['list_id']) ? 'selected="selected"' : '') . ' >' . $list['name'] . '</option>';
                        endforeach;
                        echo "</select>";
                    }else {
                        _e('Install Mailpoet plugin to use the service', CSCS_TEXT_DOMAIN);
                    }
                    ?>
                </td>
            </tr>
        </table>

    </span>

    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
    </p>
</form>