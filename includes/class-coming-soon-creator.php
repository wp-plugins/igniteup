<?php

class CSComingSoonCreator {

    public function __construct($file = NULL) {
        $this->setConstants($file);

        add_action('admin_menu', array($this, 'setMenus'));
        add_action('admin_enqueue_scripts', array($this, 'loadAdminScripts'));
        add_action('wp_enqueue_scripts', array($this, 'dequeScripts'), 599);
        add_action('wp_enqueue_scripts', array($this, 'loadThemeScripts'), 600);
        add_action('admin_init', array('CSAdminOptions', 'registerOptions'));
        add_action('admin_init', array('CSAdminOptions', 'registerGeneralOptions'));
        add_action('admin_init', array($this, 'removeSubscribers'));
        add_action("template_include", array($this, 'myThemeRedirect'));
        add_action('upload_mimes', array($this, 'customMimes'));
        add_action('admin_init', array($this, 'activateTemplate'));
        add_action('admin_init', array($this, 'deleteTemplate'));
        add_action('init', array($this, 'makeTemplateOptionsGlobal'));
        register_activation_hook(CSCS_FILE, array('CSAdminOptions', 'setDefaultOptions'));
        add_action('wp_ajax_nopriv_subscribe_email', array($this, 'subscribeEmail'));
        add_action('wp_ajax_subscribe_email', array($this, 'subscribeEmail'));
        add_action('admin_init', array($this, 'createCsvFile'));
        add_action('admin_init', array($this, 'createBccFile'));
        add_action('after_setup_theme', array($this, 'load_languages'));
        new CSComingSoonDbMigrations();
    }

    /*
     *
     * Define constants required by the plugin
     *
     *
     */

    private function setConstants($file) {
        global $wpdb;
        define('CSCS_TEXT_DOMAIN', '_cscs_igniteup');
        define('CSCS_DEFTEMP_OPTION', 'cscs_default_template');
        define('CSCS_TEMPLATEOPTION_PREFIX', 'cscs_tempoption_');
        define('CSCS_GENEROPTION_PREFIX', 'cscs_generpotion_');
        define('CSCS_CAPABILITY_PREFIX', 'cscs_cap_');
        define('CSCS_DBTABLE_PREFIX', $wpdb->prefix . 'cscs_db_');
        define('CSCS_DBTABLE_SUBSCRIPTS', 'subscriptions');
        define('CSCS_DEFAULT_TEMPLATE', CSAdminOptions::getDefTemplate());
        define('CSCS_DEFAULT_TEMPLATE_LIST', '["launcher", "believe","offline"]');

        if (!empty($file))
            define('CSCS_FILE', $file);
    }

    /*
     *
     * Set menu items
     *
     */

    public function setMenus() {
        add_menu_page(__('CS Coming Soon', CSCS_TEXT_DOMAIN), __('IgniteUp', CSCS_TEXT_DOMAIN), 'manage_options', 'cscs_templates', '', '', 39);
        add_submenu_page('cscs_templates', 'Templates', __('Templates', CSCS_TEXT_DOMAIN), 'manage_options', 'cscs_templates', array('CSAdminOptions', 'templatePage'));
        add_submenu_page('cscs_templates', 'Subscribers', __('Subscribers', CSCS_TEXT_DOMAIN), 'manage_options', 'cscs_subscribers', array('CSAdminOptions', 'subscribersPage'));
        add_submenu_page('cscs_templates', 'Options', __('Options', CSCS_TEXT_DOMAIN), 'manage_options', 'cscs_options', array('CSAdminOptions', 'optionsPage'));
    }

    private function greenToPublishTheme() {
        if (isset($_REQUEST['igniteup']) && $_REQUEST['igniteup'] == 'force')
            return TRUE;
        if (!$this->checkIfEnabled())
            return FALSE;
        if ($this->checkForSkipping())
            return FALSE;
        return TRUE;
    }

    public function loadThemeScripts() {
        if (!$this->greenToPublishTheme())
            return;

        do_action('cscs_theme_scripts_' . CSCS_DEFAULT_TEMPLATE);
        wp_enqueue_style('igniteup-front', plugin_dir_url(CSCS_FILE) . 'includes/css/front.css');
    }

    public function dequeScripts() {
        if (!$this->greenToPublishTheme())
            return;

        $skip_scr = array('colors', 'wp-admin', 'login', 'install', 'wp-color-picker', 'customize-controls', 'customize-widgets', 'press-this', 'ie', 'admin-bar');
        global $wp_styles;
        if (!is_a($wp_styles, 'WP_Styles'))
            return;
        $registered_array = $wp_styles->registered;
        if (!is_array($registered_array))
            $registered_array = array();

        foreach ($registered_array as $script) {
            if (isset($script->handle) && !in_array($script->handle, $skip_scr)) {
                wp_dequeue_style($script->handle);
            }
        }
    }

    public function myThemeRedirect($original_template) {
        if (!$this->greenToPublishTheme())
            return $original_template;

        global $wp;
        $file = dirname(__FILE__) . '/templates/' . CSCS_DEFAULT_TEMPLATE . '/' . CSCS_DEFAULT_TEMPLATE . '.php';
        if (file_exists($file))
            include $file;
        die();
    }

    public function loadAdminScripts() {
        wp_enqueue_style('igniteup', plugin_dir_url(CSCS_FILE) . 'includes/css/main.css');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('jquery');
        wp_register_script('igniteup', plugin_dir_url(CSCS_FILE) . 'includes/js/main.js', array('jquery', 'wp-color-picker'), false, true);
        wp_enqueue_script('igniteup');
        wp_enqueue_style('rockyton-icon', plugin_dir_url(CSCS_FILE) . 'includes/css/icons/styles.css');

        if (isset($_GET['page']) && $_GET['page'] == 'cscs_options') {
            wp_enqueue_script('jquery-form', false, array('jquery'));
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_style('jquery-style', plugin_dir_url(CSCS_FILE) . 'includes/css/jquery-ui.css');
        }
    }

    public static function getDefaultTemplateList() {
        return json_decode(CSCS_DEFAULT_TEMPLATE_LIST, TRUE);
    }

    public function customMimes($existing_mimes = array()) {
        $existing_mimes['zip'] = 'application/zip';
        $existing_mimes['gz'] = 'application/x-gzip';
        return $existing_mimes;
    }

    public static function unzip($source_path) {
        WP_Filesystem();
        $destination_path = dirname(CSCS_FILE) . '/includes/templates/';
        return unzip_file($source_path, $destination_path);
    }

    public function activateTemplate() {
        if (!isset($_POST['activate_template']) || empty($_POST['activate_template']))
            return;
        update_option(CSCS_DEFTEMP_OPTION, $_POST['activate_template']);
        header('Location: ' . $_SERVER['REQUEST_URI'] . '&activated=yes');
    }

    public function deleteTemplate() {
        if (!isset($_POST['delete_template']) || empty($_POST['delete_template']))
            return;
        $folder_name = $_POST['delete_template'];
        $path = dirname(CSCS_FILE) . '/includes/templates/';
        array_map('unlink', glob($path . $folder_name . '/*.*'));
        rmdir($path . $folder_name);
        unlink($path . '/' . $folder_name . '.php');
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }

    public function makeTemplateOptionsGlobal() {
        $templates = CSAdminOptions::getTemplates();
        $temp = $templates[CSCS_DEFAULT_TEMPLATE];
        $arr = array();
        if (isset($temp['options'])) {
            foreach ($temp['options'] as $key => $field) {
                $option_key = CSCS_TEMPLATEOPTION_PREFIX . CSCS_DEFAULT_TEMPLATE . '_' . $key;
                $saved_value = get_option($option_key, isset($field['def']) ? $field['def'] : '');
                $arr[$key] = $saved_value;
            }
        }

        $general_options = CSAdminOptions::$gener_options;
        foreach ($general_options as $opt) {
            $arr['general_' . $opt] = get_option(CSCS_GENEROPTION_PREFIX . $opt, '');
        }
        global $the_cs_template_options;
        $the_cs_template_options = $arr;
    }

    private function checkIfEnabled() {
        $get = get_option(CSCS_GENEROPTION_PREFIX . 'enable', '');
        if ($get == '1')
            return TRUE;
        return FALSE;
    }

    private function checkForSkipping() {
        if (!is_user_logged_in())
            return FALSE;
        $skipfor = get_option(CSCS_GENEROPTION_PREFIX . 'skipfor');
        $skip_for_array = empty($skipfor) ? array() : json_decode($skipfor, TRUE);
        global $current_user;
        $user_roles = $current_user->roles;
        if (in_array($user_roles[0], $skip_for_array))
            return TRUE;
        return FALSE;
    }

    public function subscribeEmail() {
        if (!filter_var(($_REQUEST['cs_email']), FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array('status' => FALSE, 'error' => TRUE, 'message' => 'Invalied email'));
            wp_die();
        }
        $name = '';
        if (!empty($_REQUEST['cs_name']))
            $name = $_REQUEST['cs_name'];

        global $wpdb;
        $wpdb->insert(CSCS_DBTABLE_PREFIX . CSCS_DBTABLE_SUBSCRIPTS, array('name' => $name, 'email' => $_REQUEST['cs_email']));
        echo json_encode(array('status' => TRUE, 'error' => FALSE));
        wp_die();
    }

    private function convertToCsv($input_array, $output_file_name, $delimiter) {
        $temp_memory = fopen('php://memory', 'w');
        foreach ($input_array as $line) {
            fputcsv($temp_memory, $line, $delimiter);
        }
        fseek($temp_memory, 0);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
        fpassthru($temp_memory);
    }

    public function createCsvFile() {
        if (!isset($_GET['rockython_createcsv']) || !isset($_GET['sub']))
            return;
        global $wpdb;
        $subs = $wpdb->get_results("SELECT * FROM " . CSCS_DBTABLE_PREFIX . CSCS_DBTABLE_SUBSCRIPTS);
        $csv_array = array();
        $csv_array[] = array('Name', 'Email');

        foreach ($subs as $sub):
            $csv_array[] = array(!empty($sub->name) ? $sub->email : '', !empty($sub->email) ? $sub->email : '');
        endforeach;
        $this->convertToCsv($csv_array, 'igniteup_subscribers_' . time() . '.csv', ',');
        exit();
    }

    public function createBccFile() {
        if (!isset($_GET['rockython_createbcc']) || !isset($_GET['sub']))
            return;

        $textTitle = 'igniteup_subscribers_' . time() . '.txt';
        global $wpdb;
        $subs = $wpdb->get_results("SELECT * FROM " . CSCS_DBTABLE_PREFIX . CSCS_DBTABLE_SUBSCRIPTS);

        $bccArray = array();
        foreach ($subs as $reg):
            $bccArray[] = $reg->name . ' <' . $reg->email . '>';
        endforeach;
        header('Content-type: text/plain; charset=utf-8');
        header('Content-Disposition: attachement; filename="' . $textTitle . '";');
        echo implode(", ", $bccArray);
        exit();
    }

    public function removeSubscribers() {

        if (!isset($_REQUEST['action']) || $_REQUEST['action'] !== 'trash')
            return;

        global $wpdb;
        $subs = $wpdb->get_results("SELECT * FROM " . CSCS_DBTABLE_PREFIX . CSCS_DBTABLE_SUBSCRIPTS . ' ORDER BY id DESC');
        for ($i = 1; $i <= $subs[0]->id; $i++) {
            if (isset($_REQUEST['subscriber']) && in_array($i . '', $_REQUEST['subscriber']))
                $wpdb->delete(CSCS_DBTABLE_PREFIX . CSCS_DBTABLE_SUBSCRIPTS, array('id' => $i));
        }
    }

    public function load_languages() {
        load_plugin_textdomain(CSCS_TEXT_DOMAIN, false, dirname(plugin_basename(CSCS_FILE)) . '/localization/');
    }

}
