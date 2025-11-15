<?php
/**
 * Plugin Name: Site Modes x CoreyHall93
 * Plugin URI: https://github.com/coreyhall93/site-modes
 * Description: Display maintenance, coming soon, white page, or custom modes with WordPress-styled pages
 * Version: 1.0.0
 * Author: CoreyHall93
 * Author URI: https://github.com/coreyhall93
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ch93-site-modes
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CH93_SM_VERSION', '1.0.0');
define('CH93_SM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CH93_SM_PLUGIN_URL', plugin_dir_url(__FILE__));

class CH93_Site_Modes {

    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('template_redirect', array($this, 'display_mode_page'), 1);
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    public function add_admin_menu() {
        add_options_page(
            'Site Modes',
            'Site Modes',
            'manage_options',
            'ch93-site-modes',
            array($this, 'render_settings_page')
        );
    }

    public function register_settings() {
        register_setting('ch93_site_modes', 'ch93_sm_active_mode');
        register_setting('ch93_site_modes', 'ch93_sm_maintenance_message');
        register_setting('ch93_site_modes', 'ch93_sm_coming_soon_message');
        register_setting('ch93_site_modes', 'ch93_sm_white_page_message');
        register_setting('ch93_site_modes', 'ch93_sm_custom_message');
        register_setting('ch93_site_modes', 'ch93_sm_custom_title');
    }

    public function enqueue_admin_scripts($hook) {
        if ('settings_page_ch93-site-modes' !== $hook) {
            return;
        }
        wp_enqueue_editor();
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        $active_mode = get_option('ch93_sm_active_mode', 'none');
        $maintenance_msg = get_option('ch93_sm_maintenance_message', 'This site is currently undergoing scheduled maintenance. Please check back soon.');
        $coming_soon_msg = get_option('ch93_sm_coming_soon_message', 'Something awesome is coming soon. Stay tuned!');
        $white_page_msg = get_option('ch93_sm_white_page_message', 'This website is currently unavailable. If you are the owner of this site, please contact your website host.');
        $custom_msg = get_option('ch93_sm_custom_message', '');
        $custom_title = get_option('ch93_sm_custom_title', 'Site Unavailable');

        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

            <?php if (isset($_GET['settings-updated'])) : ?>
                <div class="notice notice-success is-dismissible">
                    <p>Settings saved successfully!</p>
                </div>
            <?php endif; ?>

            <form method="post" action="options.php">
                <?php settings_fields('ch93_site_modes'); ?>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">Active Mode</th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="radio" name="ch93_sm_active_mode" value="none" <?php checked($active_mode, 'none'); ?>>
                                    <strong>None (Site Active)</strong>
                                </label><br>

                                <label style="margin-top: 10px; display: inline-block;">
                                    <input type="radio" name="ch93_sm_active_mode" value="maintenance" <?php checked($active_mode, 'maintenance'); ?>>
                                    <strong>Maintenance Mode</strong>
                                </label><br>

                                <label style="margin-top: 10px; display: inline-block;">
                                    <input type="radio" name="ch93_sm_active_mode" value="coming-soon" <?php checked($active_mode, 'coming-soon'); ?>>
                                    <strong>Coming Soon Mode</strong>
                                </label><br>

                                <label style="margin-top: 10px; display: inline-block;">
                                    <input type="radio" name="ch93_sm_active_mode" value="white-page" <?php checked($active_mode, 'white-page'); ?>>
                                    <strong>White Page Mode</strong>
                                </label><br>

                                <label style="margin-top: 10px; display: inline-block;">
                                    <input type="radio" name="ch93_sm_active_mode" value="custom" <?php checked($active_mode, 'custom'); ?>>
                                    <strong>Custom Mode</strong>
                                </label>

                                <p class="description">Select which mode to display to site visitors. Administrators will still see the site normally.</p>
                            </fieldset>
                        </td>
                    </tr>
                </table>

                <hr>

                <h2>Maintenance Mode Settings</h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">
                            <label for="ch93_sm_maintenance_message">Maintenance Message</label>
                        </th>
                        <td>
                            <textarea name="ch93_sm_maintenance_message" id="ch93_sm_maintenance_message" rows="3" class="large-text"><?php echo esc_textarea($maintenance_msg); ?></textarea>
                            <p class="description">Message shown when maintenance mode is active.</p>
                        </td>
                    </tr>
                </table>

                <hr>

                <h2>Coming Soon Mode Settings</h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">
                            <label for="ch93_sm_coming_soon_message">Coming Soon Message</label>
                        </th>
                        <td>
                            <textarea name="ch93_sm_coming_soon_message" id="ch93_sm_coming_soon_message" rows="3" class="large-text"><?php echo esc_textarea($coming_soon_msg); ?></textarea>
                            <p class="description">Message shown when coming soon mode is active.</p>
                        </td>
                    </tr>
                </table>

                <hr>

                <h2>White Page Mode Settings</h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">
                            <label for="ch93_sm_white_page_message">White Page Message</label>
                        </th>
                        <td>
                            <textarea name="ch93_sm_white_page_message" id="ch93_sm_white_page_message" rows="3" class="large-text"><?php echo esc_textarea($white_page_msg); ?></textarea>
                            <p class="description">Message shown for unpaid/suspended sites.</p>
                        </td>
                    </tr>
                </table>

                <hr>

                <h2>Custom Mode Settings</h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">
                            <label for="ch93_sm_custom_title">Custom Page Title</label>
                        </th>
                        <td>
                            <input type="text" name="ch93_sm_custom_title" id="ch93_sm_custom_title" value="<?php echo esc_attr($custom_title); ?>" class="regular-text">
                            <p class="description">Title displayed in custom mode.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="ch93_sm_custom_message">Custom Message</label>
                        </th>
                        <td>
                            <?php
                            wp_editor($custom_msg, 'ch93_sm_custom_message', array(
                                'textarea_name' => 'ch93_sm_custom_message',
                                'media_buttons' => false,
                                'textarea_rows' => 10,
                                'teeny' => false,
                                'quicktags' => true,
                            ));
                            ?>
                            <p class="description">Custom HTML message with full editor support.</p>
                        </td>
                    </tr>
                </table>

                <?php submit_button('Save Settings'); ?>
            </form>
        </div>
        <?php
    }

    public function display_mode_page() {
        // Don't show mode pages to administrators
        if (current_user_can('manage_options')) {
            return;
        }

        $active_mode = get_option('ch93_sm_active_mode', 'none');

        if ($active_mode === 'none') {
            return;
        }

        // Determine title and message based on mode
        $title = '';
        $message = '';

        switch ($active_mode) {
            case 'maintenance':
                $title = 'Maintenance Mode';
                $message = get_option('ch93_sm_maintenance_message', 'This site is currently undergoing scheduled maintenance. Please check back soon.');
                break;

            case 'coming-soon':
                $title = 'Coming Soon';
                $message = get_option('ch93_sm_coming_soon_message', 'Something awesome is coming soon. Stay tuned!');
                break;

            case 'white-page':
                $title = 'Site Unavailable';
                $message = get_option('ch93_sm_white_page_message', 'This website is currently unavailable. If you are the owner of this site, please contact your website host.');
                break;

            case 'custom':
                $title = get_option('ch93_sm_custom_title', 'Site Unavailable');
                $message = get_option('ch93_sm_custom_message', '');
                break;
        }

        // Set appropriate HTTP status
        status_header(503);
        nocache_headers();

        // Render the mode page
        $this->render_mode_page($title, $message);
        exit;
    }

    private function render_mode_page($title, $message) {
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="robots" content="noindex, nofollow">
            <title><?php echo esc_html($title); ?></title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }

                html {
                    background: #f0f0f1;
                }

                body {
                    background: #fff;
                    color: #3c434a;
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                    margin: 2em auto;
                    padding: 1em 2em;
                    max-width: 700px;
                    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
                    border: 1px solid #c3c4c7;
                }

                h1 {
                    border-bottom: 1px solid #dcdcde;
                    clear: both;
                    color: #3c434a;
                    font-size: 24px;
                    padding: 0 0 7px;
                    font-weight: 600;
                    margin-bottom: 20px;
                }

                p {
                    font-size: 14px;
                    line-height: 1.6;
                    margin: 1em 0;
                }

                a {
                    color: #2271b1;
                    text-decoration: none;
                }

                a:hover,
                a:active {
                    color: #135e96;
                }

                .message {
                    margin-top: 20px;
                }

                code {
                    font-family: Consolas, Monaco, monospace;
                    background: #f0f0f1;
                    padding: 2px 6px;
                    border-radius: 3px;
                }

                @media screen and (max-width: 782px) {
                    body {
                        margin: 0;
                        padding: 1em;
                    }

                    h1 {
                        font-size: 20px;
                    }
                }
            </style>
        </head>
        <body>
            <h1><?php echo esc_html($title); ?></h1>
            <div class="message">
                <?php
                // Allow HTML in custom mode, plain text for others
                if (get_option('ch93_sm_active_mode') === 'custom') {
                    echo wp_kses_post($message);
                } else {
                    echo '<p>' . esc_html($message) . '</p>';
                }
                ?>
            </div>
        </body>
        </html>
        <?php
    }
}

// Initialize the plugin
CH93_Site_Modes::get_instance();
