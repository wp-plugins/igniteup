<form action="options.php" method="post">
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
                $saved_value = get_option($option_key, isset($field['def']) ? $field['def'] : '');
                ?>
                <tr>
                    <th>
                        <label for="<?php echo $option_id; ?>"><?php echo isset($field['label']) ? $field['label'] : 'Undefined'; ?></label>
                    </th>
                    <td>
                        <?php
                        switch ($field['type']) {
                            case 'text':
                                echo "<input type='text' class='regular-text' id='$option_id' value='$saved_value' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "'>";
                                break;
                            case 'email':
                                echo "<input type='email' class='regular-text' id='$option_id' value='$saved_value' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "'>";
                                break;
                            case 'color-picker':
                                echo "<input type='text' class='cs-color-picker' id='$option_id' value='$saved_value' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "'>";
                                break;
                            case 'date':
                                echo "<input type='text' class='cs-date-picker regular-text' id='$option_id' value='$saved_value' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "'>";
                                break;
                            case 'textarea':
                                echo "<textarea  rows='5' cols='46'  class='regular-text' id='$option_id' name='$option_key' placeholder='" . (isset($field['placeholder']) ? $field['placeholder'] : '' ) . "'>$saved_value</textarea>";
                                break;
                            case 'image':
                                ?>
                                <div class="uploader">
                                    <input id="<?php echo $option_id; ?>" class="regular-text" name="<?php echo $option_key; ?>" type="text" value="<?php echo $saved_value; ?>" />
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
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
    </p>
</form>