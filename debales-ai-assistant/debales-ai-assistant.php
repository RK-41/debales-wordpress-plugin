<?php
/* Debales AI Assistant is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* any later version.
* 
* Debales AI Assistant is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Debales AI Assistant. If not, see https://www.gnu.org/licenses/gpl-2.0.html
 * Plugin Name:       Debales AI Assistant test
 * Plugin URI:        https://debales.ai/
 * Description:       This plugin will help you to integrate Debales AI Assistant Chatbot into your website.
 * Version:           1.9.3-0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Debales
 * License:           GPLv2 or later
 * Update URI:        https://debales.ai/
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define('debales_chatbot_api_url', 'https://saas.brainlox.com');
$debales_chatbot_api_key = get_option('debales_chatbot_bot_id');

define('debales_chatbot_api_key', $debales_chatbot_api_key);


function debales_chatbot_settings_page()
{
    add_options_page(
        'Debales Chatbot Settings',
        'Debales Chatbot',
        'manage_options',
        'debales-chatbot-settings',
        'debales_chatbot_settings_form'
    );
}
add_action('admin_menu', 'debales_chatbot_settings_page');

function debales_chatbot_settings_form()
{
?>
    <div class="wrap">
        <h2>Custom Chatbot Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('debales-chatbot-settings-group'); ?>
            <?php do_settings_sections('debales-chatbot-settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">BOT ID</th>
                    <td>
                        <input type="text" name="debales_chatbot_bot_id" value="<?php echo esc_attr(get_option('debales_chatbot_bot_id')); ?>" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function debales_chatbot_register_settings()
{
    register_setting(
        'debales-chatbot-settings-group',
        'debales_chatbot_bot_id'
    );
}
add_action('admin_init', 'debales_chatbot_register_settings');


function debales_chatbot_add_to_footer()
{

    if (debales_chatbot_api_key != '') {
    wp_enqueue_script('debales-ai-assistant', plugin_dir_url(__DIR__) . 'debales-ai-assistant/debales-ai-assistant.min.js', array(), '1.9.3-0', true);
    ?>
        <div id="debales-ai-assistant" data-bot-id="<?php echo esc_attr(debales_chatbot_api_key); ?>"></div>
<?php
    }
}


add_action('wp_footer', 'debales_chatbot_add_to_footer');


?>