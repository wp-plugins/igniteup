<form action="options.php" method="post" id="igniteup-template-options">
    <?php settings_fields('cscs_temp_options'); ?>
    <?php
    do_settings_sections('cscs_temp_options');
    wp_enqueue_media();
    ?>

    <table class="form-table">

        <?php
        global $cscs_templates;
        $template_options = $cscs_templates[CSCS_DEFAULT_TEMPLATE];
        if (!isset($template_options)) {
            _e('Something is wrong with your template', CSCS_TEXT_DOMAIN);
            exit();
        }



        if (isset($template_options['options']) && count($template_options['options'])) {
            $temp_options = $template_options['options'];
            foreach ($temp_options as $key => $field) {
                $option_key = CSCS_TEMPLATEOPTION_PREFIX . CSCS_DEFAULT_TEMPLATE . '_' . $key;
                $option_id = CSCS_DEFAULT_TEMPLATE . '_' . $key;
                $def_val = isset($field['def']) ? $field['def'] : '';
                $saved_value = get_option($option_key, $def_val);
                ?>
                <tr>
                    <th>
                        <label for="<?php echo $option_id; ?>"><?php echo isset($field['label']) ? $field['label'] : 'Undefined'; ?></label>
                    </th>
                    <td>
                        <?php
                        switch ($field['type']) {
                            case 'text':
                                echo "<input type='text' class='regular-text reset-supported' id='$option_id' value='$saved_value' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "' data-defval='" . $def_val . "'>";
                                break;
                            case 'email':
                                echo "<input type='email' class='regular-text reset-supported' id='$option_id' value='$saved_value' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "' data-defval='" . $def_val . "'>";
                                break;
                            case 'color-picker':
                                echo "<input type='text' class='cs-color-picker reset-supported' id='$option_id' value='$saved_value' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "' data-defval='" . $def_val . "'>";
                                break;
                            case 'date':
                                echo "<input type='text' class='cs-date-picker regular-text reset-supported' id='$option_id' value='$saved_value' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "' data-defval='" . $def_val . "'>";
                                break;
                            case 'textarea':
                                echo "<textarea  rows='5' cols='46'  class='regular-text reset-supported' id='$option_id' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "' data-defval='" . $def_val . "'>$saved_value</textarea>";
                                break;
                            case 'image':
                                ?>
                                <div class="uploader">
                                    <input id="<?php echo $option_id; ?>" class="regular-text reset-supported" name="<?php echo $option_key; ?>" type="text" value="<?php echo $saved_value; ?>" data-defval='<?php echo $def_val; ?>' />
                                    <input id="<?php echo $option_id; ?>_button" class="button cscs_uploadbutton" data-input="<?php echo $option_id; ?>" type="submit" value="Upload" />
                                </div>
                                <?php
                                break;
                            default:
                        }
                        if (isset($field['description'])) {
                            echo "<p class='description'>" . $field['description'] . "</p>";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<div class="updated"><p>';
            _e('No options defined for the active template!', CSCS_TEXT_DOMAIN);
            echo '</p></div>';
        }
        ?>

    </table>
    <p>
        <a class="reset-igniteup add-new-h2" href="#">Reset to Defaults</a>        
    </p>
    <p class="submit">
        <input type="submit" name="save" class="button button-primary submit" value="Save Changes">
        <input type="submit" name="preview" class="button preview-igniteup" value="Preview" data-forward="<?php echo esc_url(home_url('/?igniteup=force')); ?>">        
        <span id="saveResult" data-text="<?php echo htmlentities(__('Settings Saved Successfully', 'wp'), ENT_QUOTES); ?>"></span>       
    </p>    
</form>