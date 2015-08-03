<?php

class CSAdminOptions {

    public static $gener_options = array('enable', 'cs_page_title', 'skipfor', 'powered_by', 'customcss', 'favicon_url');
    private static $integrat_options = array('mailchimp_api', 'mailchimp_list', 'save_email_to', 'enable_integration', 'mailpoet_list');

    public static function registerGeneralOptions() {
        foreach (self::$gener_options as $val) {
            register_setting('cscs_gener_options', CSCS_GENEROPTION_PREFIX . $val);
        }

        foreach (self::$integrat_options as $ival)
            register_setting('cscs_integrat_options', CSCS_GENEROPTION_PREFIX . $ival);
    }

    public static function registerOptions() {
        global $cscs_templates;
        $template_options = $cscs_templates[CSCS_DEFAULT_TEMPLATE];
        if (!isset($template_options['options']) || count($template_options['options']) < 1)
            return;
        foreach ($template_options['options'] as $key => $val) {
            register_setting('cscs_temp_options', CSCS_TEMPLATEOPTION_PREFIX . CSCS_DEFAULT_TEMPLATE . '_' . $key);
        }
    }

    public static function optionsPage() {
        include 'views/admin-dashboard.php';
    }

    public static function templatePage() {
        include 'views/admin-templates.php';
    }

    public static function subscribersPage() {
        include 'views/admin-subscribers.php';
    }

    private function getNameFromFilePath($file) {
        $ss = split('/', $file);
        $remove_ext = explode('.', end($ss));
        unset($remove_ext[(count($remove_ext) - 1)]);
        return implode('', $remove_ext);
    }

    public static function getDefTemplate() {
        $saved_ = get_option(CSCS_DEFTEMP_OPTION, 'launcher');
        $file = glob(dirname(__FILE__) . '/templates/' . $saved_ . '/' . $saved_ . '.php');
        if (count($file) < 1) {
            update_option(CSCS_DEFTEMP_OPTION, 'launcher');
            return 'launcher';
        }
        return $saved_;
    }

    public static function getTemplates() {
        global $cscs_templates;
        return $cscs_templates;
    }

    public static function setDefaultOptions() {

        // set options for showing welcome message.
        $prev_version = get_option(CSCS_GENEROPTION_PREFIX . 'version', '1.0');
        $plugin_data = get_plugin_data(CSCS_FILE, false);
        $plugin_version = floatval($plugin_data['Version']);
        if ($plugin_version > floatval($prev_version))
            update_option(CSCS_GENEROPTION_PREFIX . 'show_welcome_notice', 'yes');
        update_option(CSCS_GENEROPTION_PREFIX . 'version', '' . $plugin_version);
        //-------------
    }

    public static function selectOptionIsSelected($saved_val, $current_val) {
        if ($saved_val == $current_val)
            return 'selected="selected"';
        return '';
    }

}
