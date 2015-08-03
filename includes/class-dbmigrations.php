<?php

class CSComingSoonDbMigrations {
    /*
     *  List of migrations
     */

    private $DB_MIGRATE_VERSIONS = array(10);

    /*
     *  Prefix for database tables for the plugin. Wordpress prefix will be merged automatically.
     */
    private $PLUGIN_TABLE_PREFIX = '';

    /*
     *  Plugin basefile path
     */
    private $THE_FILE = '';

    /*
     *  Plugin default prefix for option names.
     */
    private $OPTION_NAME_PREFIX = '';

    /*
     *  Key name for the db version saving option.
     */
    private $VERSION_OPTION_NAME = 'db_version';

    /*
     *  Do nothing to these. Will set automatically.
     */
    private $CHARSET_COLLATE, $DB_TABLE_PREFIX, $OPTION_NAME, $DBVERSION;

    /*
     * 
     * --------------------------------------------------------
     * End of property declaration
     * --------------------------------------------------------
     * 
     */


    /*
     * 
     * Contructor method
     * 
     */

    public function __construct() {
        $this->THE_FILE = CSCS_FILE;
        $this->PLUGIN_TABLE_PREFIX = CSCS_DBTABLE_PREFIX;
        $this->OPTION_NAME_PREFIX = CSCS_GENEROPTION_PREFIX;

        register_activation_hook($this->THE_FILE, array($this, 'runMigrations'));
    }

    /*
     * 
     * Run database migrations
     * 
     */

    public function runMigrations() {
        $this->setAttributes();
        $curr_db_version = $this->DBVERSION;

        if ($curr_db_version < end($this->DB_MIGRATE_VERSIONS)) {
            foreach ($this->DB_MIGRATE_VERSIONS as $version) {
                if ($curr_db_version < $version) {
                    $function_to_call = "runDbMigration_$version";
                    $this->$function_to_call();
                    $curr_db_version = $version;
                }
            }
        }

        update_option($this->OPTION_NAME, $curr_db_version);
    }

    /*
     * 
     * Call dbDelta of Wordpress
     * 
     */

    private function calldbDelta($sql) {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

    /*
     * 
     * Set attributes needed for querying
     * 
     */

    private function setAttributes() {
        global $wpdb;
        $this->DB_TABLE_PREFIX = $this->PLUGIN_TABLE_PREFIX;
        $this->OPTION_NAME = $this->OPTION_NAME_PREFIX . $this->VERSION_OPTION_NAME;
        $this->DBVERSION = (int) get_option($this->OPTION_NAME, 0);



        $charset_collate = '';
        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
        }
        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE {$wpdb->collate}";
        }

        $this->CHARSET_COLLATE = $charset_collate;
    }

    /*
     * ------------------------------------------------------------------------
     * Migrations
     * ------------------------------------------------------------------------
     */

    /*
     * Migration 10 
     */

    private function runDbMigration_10() { // create first tables
        $sql1 = "CREATE TABLE " . $this->DB_TABLE_PREFIX . CSCS_DBTABLE_SUBSCRIPTS . " (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		email text NOT NULL,
		UNIQUE KEY id (id)
	) $this->CHARSET_COLLATE;";

        $this->calldbDelta($sql1);
    }

}
