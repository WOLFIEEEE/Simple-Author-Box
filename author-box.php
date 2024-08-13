<?php
/*
Plugin Name: Author Box
Description: Adds a customizable author box to posts and pages.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Add a menu item to the dashboard
add_action('admin_menu', 'ab_add_admin_menu');

function ab_add_admin_menu() {
    add_menu_page(
        'Author Box Settings', // Page title
        'Author Box',          // Menu title
        'manage_options',      // Capability
        'author-box',          // Menu slug
        'ab_settings_page',    // Function to display the page
        'dashicons-admin-users', // Icon URL
        20                     // Position
    );
}

// Register settings
add_action('admin_init', 'ab_settings_init');

function ab_settings_init() {
    if (false === get_option('ab_settings')) {
        add_option('ab_settings', [
            'ab_author_image' => '',
            'ab_author_name' => 'Default Author',
            'ab_author_description' => 'This is the default author description.',
            'ab_social_links' => [
                'linkedin' => '',
                'facebook' => '',
                'gmail' => '',
                'twitter' => '',
                'instagram' => ''
            ],
            'ab_image_width_percent' => '100',
            'ab_left_container_width' => '30',
            'ab_background_color' => '#f9f9f9',
            'ab_box_border_radius' => '0',
            'ab_image_border_radius' => '10',
            'ab_image_border_color' => '#ccc',
            'ab_image_border_size' => '1',
            'ab_border_color' => '#ccc',
            'ab_border_size' => '1',
            'ab_consultation_text' => 'Book a Consultation',
            'ab_consultation_url' => '',
            'ab_show_consultation_link' => '1',
            'ab_consultation_bg_color' => '#0073aa',
            'ab_consultation_font_size' => '16',
            'ab_consultation_button_padding' => '10',
            'ab_consultation_border_color' => '#0073aa',
            'ab_consultation_border_size' => '1',
            'ab_consultation_border_radius' => '5',
            'ab_consultation_button_width' => 'auto'
        ]);
    }

    register_setting('ab_settings_group', 'ab_settings', 'ab_sanitize_settings');
    add_settings_section('ab_section', __('Author Box Settings', 'author-box'), 'ab_section_callback', 'author-box');
    add_settings_field('ab_author_image', __('Author Image', 'author-box'), 'ab_author_image_render', 'author-box', 'ab_section');
    add_settings_field('ab_image_width_percent', __('Image Width (%)', 'author-box'), 'ab_image_width_percent_render', 'author-box', 'ab_section');
    add_settings_field('ab_image_border_radius', __('Image Border Radius (px)', 'author-box'), 'ab_image_border_radius_render', 'author-box', 'ab_section');
    add_settings_field('ab_image_border_color', __('Image Border Color', 'author-box'), 'ab_image_border_color_render', 'author-box', 'ab_section');
    add_settings_field('ab_image_border_size', __('Image Border Size (px)', 'author-box'), 'ab_image_border_size_render', 'author-box', 'ab_section');
    add_settings_field('ab_author_name', __('Author Name', 'author-box'), 'ab_author_name_render', 'author-box', 'ab_section');
    add_settings_field('ab_author_description', __('Author Description', 'author-box'), 'ab_author_description_render', 'author-box', 'ab_section');
    add_settings_field('ab_social_links', __('Social Links', 'author-box'), 'ab_social_links_render', 'author-box', 'ab_section');
    add_settings_field('ab_left_container_width', __('Left Container Width (%)', 'author-box'), 'ab_left_container_width_render', 'author-box', 'ab_section');
    add_settings_field('ab_background_color', __('Background Color', 'author-box'), 'ab_background_color_render', 'author-box', 'ab_section');
    add_settings_field('ab_box_border_radius', __('Box Border Radius (px)', 'author-box'), 'ab_box_border_radius_render', 'author-box', 'ab_section');
    add_settings_field('ab_border_color', __('Box Border Color', 'author-box'), 'ab_border_color_render', 'author-box', 'ab_section');
    add_settings_field('ab_border_size', __('Box Border Size (px)', 'author-box'), 'ab_border_size_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_text', __('Consultation Link Text', 'author-box'), 'ab_consultation_text_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_url', __('Consultation Link URL', 'author-box'), 'ab_consultation_url_render', 'author-box', 'ab_section');
    add_settings_field('ab_show_consultation_link', __('Show Consultation Link', 'author-box'), 'ab_show_consultation_link_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_bg_color', __('Consultation Button Background Color', 'author-box'), 'ab_consultation_bg_color_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_font_size', __('Consultation Button Font Size (px)', 'author-box'), 'ab_consultation_font_size_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_button_padding', __('Consultation Button Padding (px)', 'author-box'), 'ab_consultation_button_padding_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_border_color', __('Consultation Button Border Color', 'author-box'), 'ab_consultation_border_color_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_border_size', __('Consultation Button Border Size (px)', 'author-box'), 'ab_consultation_border_size_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_border_radius', __('Consultation Button Border Radius (px)', 'author-box'), 'ab_consultation_border_radius_render', 'author-box', 'ab_section');
    add_settings_field('ab_consultation_button_width', __('Consultation Button Width (px or auto)', 'author-box'), 'ab_consultation_button_width_render', 'author-box', 'ab_section');
}

function ab_sanitize_settings($input) {
    $input['ab_show_consultation_link'] = isset($input['ab_show_consultation_link']) ? '1' : '0';
    return $input;
}

function ab_section_callback() {
    echo __('Configure the Author Box settings below:', 'author-box');
}

function ab_author_image_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_author_image]' value='<?php echo esc_attr($options['ab_author_image']); ?>' />
    <button type="button" class="button" id="upload_image_button"><?php _e('Upload Image', 'author-box'); ?></button>
    <p class="description"><?php _e('Enter the URL or upload an image for the author.', 'author-box'); ?></p>
    <?php
}

function ab_author_name_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_author_name]' value='<?php echo esc_attr($options['ab_author_name']); ?>' />
    <?php
}

function ab_author_description_render() {
    $options = get_option('ab_settings');
    ?>
    <textarea name='ab_settings[ab_author_description]' rows='10' cols='50'><?php echo esc_textarea($options['ab_author_description']); ?></textarea>
    <p class="description"><?php _e('Enter the author description. HTML tags are allowed.', 'author-box'); ?></p>
    <?php
}

function ab_social_links_render() {
    $options = get_option('ab_settings');
    $social_platforms = ['linkedin', 'facebook', 'gmail', 'twitter', 'instagram'];

    foreach ($social_platforms as $platform) {
        $value = isset($options['ab_social_links'][$platform]) ? esc_attr($options['ab_social_links'][$platform]) : '';
        ?>
        <p>
            <label for="ab_social_links_<?php echo $platform; ?>"><?php echo ucfirst($platform); ?> URL:</label>
            <input type='url' id='ab_social_links_<?php echo $platform; ?>' name='ab_settings[ab_social_links][<?php echo $platform; ?>]' value='<?php echo $value; ?>' />
        </p>
        <?php
    }
}

function ab_image_width_percent_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_image_width_percent]' value='<?php echo esc_attr($options['ab_image_width_percent']); ?>' min="50" max="100" />
    <p class="description"><?php _e('Set the width of the author image as a percentage of the container.', 'author-box'); ?></p>
    <?php
}

function ab_image_border_radius_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_image_border_radius]' value='<?php echo esc_attr($options['ab_image_border_radius']); ?>' min="0" max="100" />
    <p class="description"><?php _e('Set the border radius for the author image in pixels.', 'author-box'); ?></p>
    <?php
}

function ab_image_border_color_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_image_border_color]' value='<?php echo esc_attr($options['ab_image_border_color']); ?>' class="color-field" />
    <p class="description"><?php _e('Choose the border color for the author image.', 'author-box'); ?></p>
    <?php
}

function ab_image_border_size_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_image_border_size]' value='<?php echo esc_attr($options['ab_image_border_size']); ?>' min="0" max="10" />
    <p class="description"><?php _e('Set the border size for the author image in pixels.', 'author-box'); ?></p>
    <?php
}

function ab_left_container_width_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_left_container_width]' value='<?php echo esc_attr($options['ab_left_container_width']); ?>' min="10" max="50" />
    <p class="description"><?php _e('Set the width percentage of the left container.', 'author-box'); ?></p>
    <?php
}

function ab_background_color_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_background_color]' value='<?php echo esc_attr($options['ab_background_color']); ?>' class="color-field" />
    <p class="description"><?php _e('Choose the background color for the author box.', 'author-box'); ?></p>
    <?php
}

function ab_box_border_radius_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_box_border_radius]' value='<?php echo esc_attr($options['ab_box_border_radius']); ?>' min="0" max="50" />
    <p class="description"><?php _e('Set the border radius for the author box in pixels.', 'author-box'); ?></p>
    <?php
}

function ab_border_color_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_border_color]' value='<?php echo esc_attr($options['ab_border_color']); ?>' class="color-field" />
    <p class="description"><?php _e('Choose the border color for the author box.', 'author-box'); ?></p>
    <?php
}

function ab_border_size_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_border_size]' value='<?php echo esc_attr($options['ab_border_size']); ?>' min="0" max="10" />
    <p class="description"><?php _e('Set the border size for the author box in pixels.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_text_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_consultation_text]' value='<?php echo esc_attr($options['ab_consultation_text']); ?>' />
    <p class="description"><?php _e('Set the text for the consultation link.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_url_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='url' name='ab_settings[ab_consultation_url]' value='<?php echo esc_attr($options['ab_consultation_url']); ?>' />
    <p class="description"><?php _e('Set the URL for the consultation link.', 'author-box'); ?></p>
    <?php
}

function ab_show_consultation_link_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='checkbox' name='ab_settings[ab_show_consultation_link]' value='1' <?php checked(isset($options['ab_show_consultation_link']) ? $options['ab_show_consultation_link'] : '0', '1'); ?> />
    <p class="description"><?php _e('Check to show the consultation link in the author box.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_bg_color_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_consultation_bg_color]' value='<?php echo esc_attr($options['ab_consultation_bg_color']); ?>' class="color-field" />
    <p class="description"><?php _e('Choose the background color for the consultation button.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_font_size_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_consultation_font_size]' value='<?php echo esc_attr($options['ab_consultation_font_size']); ?>' min="10" max="30" />
    <p class="description"><?php _e('Set the font size for the consultation button text.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_button_padding_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_consultation_button_padding]' value='<?php echo esc_attr($options['ab_consultation_button_padding']); ?>' min="5" max="20" />
    <p class="description"><?php _e('Set the padding for the consultation button.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_border_color_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_consultation_border_color]' value='<?php echo esc_attr($options['ab_consultation_border_color']); ?>' class="color-field" />
    <p class="description"><?php _e('Choose the border color for the consultation button.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_border_size_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_consultation_border_size]' value='<?php echo esc_attr($options['ab_consultation_border_size']); ?>' min="0" max="5" />
    <p class="description"><?php _e('Set the border size for the consultation button.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_border_radius_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='number' name='ab_settings[ab_consultation_border_radius]' value='<?php echo esc_attr($options['ab_consultation_border_radius']); ?>' min="0" max="20" />
    <p class="description"><?php _e('Set the border radius for the consultation button.', 'author-box'); ?></p>
    <?php
}

function ab_consultation_button_width_render() {
    $options = get_option('ab_settings');
    ?>
    <input type='text' name='ab_settings[ab_consultation_button_width]' value='<?php echo esc_attr($options['ab_consultation_button_width']); ?>' />
    <p class="description"><?php _e('Set the width for the consultation button (e.g., 200px or auto).', 'author-box'); ?></p>
    <?php
}

// Enqueue styles and scripts
add_action('wp_enqueue_scripts', 'ab_enqueue_assets');

function ab_enqueue_assets() {
    wp_enqueue_style('ab_styles', plugin_dir_url(__FILE__) . 'style.css');
    wp_enqueue_script('ab_script', plugin_dir_url(__FILE__) . 'script.js', ['jquery'], null, true);
    // Enqueue Font Awesome for social icons
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
}

// Function to get the Author Box HTML
function ab_get_author_box_html() {
    $options = get_option('ab_settings', [
        'ab_author_image' => '',
        'ab_author_name' => 'Default Author',
        'ab_author_description' => 'This is the default author description.',
        'ab_social_links' => [
            'linkedin' => '',
            'facebook' => '',
            'gmail' => '',
            'twitter' => '',
            'instagram' => ''
        ],
        'ab_image_width_percent' => '100',
        'ab_left_container_width' => '30',
        'ab_background_color' => '#f9f9f9',
        'ab_box_border_radius' => '0',
        'ab_image_border_radius' => '10',
        'ab_image_border_color' => '#ccc',
        'ab_image_border_size' => '1',
        'ab_border_color' => '#ccc',
        'ab_border_size' => '1',
        'ab_consultation_text' => 'Book a Consultation',
        'ab_consultation_url' => '',
        'ab_show_consultation_link' => '1',
        'ab_consultation_bg_color' => '#0073aa',
        'ab_consultation_font_size' => '16',
        'ab_consultation_button_padding' => '10',
        'ab_consultation_border_color' => '#0073aa',
        'ab_consultation_border_size' => '1',
        'ab_consultation_border_radius' => '5',
        'ab_consultation_button_width' => 'auto'
    ]);

    $author_image = isset($options['ab_author_image']) ? esc_url($options['ab_author_image']) : '';
    $author_name = isset($options['ab_author_name']) ? esc_html($options['ab_author_name']) : '';
    $author_description = isset($options['ab_author_description']) ? wpautop(esc_html($options['ab_author_description'])) : '';
    $social_links = isset($options['ab_social_links']) ? $options['ab_social_links'] : [];
    $image_width_percent = isset($options['ab_image_width_percent']) ? intval($options['ab_image_width_percent']) : 100;
    $left_container_width = isset($options['ab_left_container_width']) ? intval($options['ab_left_container_width']) : 30;
    $background_color = isset($options['ab_background_color']) ? esc_attr($options['ab_background_color']) : '#f9f9f9';
    $box_border_radius = isset($options['ab_box_border_radius']) ? intval($options['ab_box_border_radius']) : 0;
    $image_border_radius = isset($options['ab_image_border_radius']) ? intval($options['ab_image_border_radius']) : 10;
    $image_border_color = isset($options['ab_image_border_color']) ? esc_attr($options['ab_image_border_color']) : '#ccc';
    $image_border_size = isset($options['ab_image_border_size']) ? intval($options['ab_image_border_size']) : 1;
    $border_color = isset($options['ab_border_color']) ? esc_attr($options['ab_border_color']) : '#ccc';
    $border_size = isset($options['ab_border_size']) ? intval($options['ab_border_size']) : 1;
    $consultation_text = isset($options['ab_consultation_text']) ? esc_html($options['ab_consultation_text']) : 'Book a Consultation';
    $consultation_url = isset($options['ab_consultation_url']) ? esc_url($options['ab_consultation_url']) : '';
    $show_consultation_link = isset($options['ab_show_consultation_link']) ? boolval($options['ab_show_consultation_link']) : false;
    $consultation_bg_color = isset($options['ab_consultation_bg_color']) ? esc_attr($options['ab_consultation_bg_color']) : '#0073aa';
    $consultation_font_size = isset($options['ab_consultation_font_size']) ? intval($options['ab_consultation_font_size']) : 16;
    $consultation_button_padding = isset($options['ab_consultation_button_padding']) ? intval($options['ab_consultation_button_padding']) : 10;
    $consultation_border_color = isset($options['ab_consultation_border_color']) ? esc_attr($options['ab_consultation_border_color']) : '#0073aa';
    $consultation_border_size = isset($options['ab_consultation_border_size']) ? intval($options['ab_consultation_border_size']) : 1;
    $consultation_border_radius = isset($options['ab_consultation_border_radius']) ? intval($options['ab_consultation_border_radius']) : 5;
    $consultation_button_width = isset($options['ab_consultation_button_width']) ? esc_attr($options['ab_consultation_button_width']) : 'auto';

    $social_links_html = '';
    $social_icons = [
        'linkedin' => 'fab fa-linkedin',
        'facebook' => 'fab fa-facebook',
        'gmail' => 'fas fa-envelope',
        'twitter' => 'fab fa-twitter',
        'instagram' => 'fab fa-instagram'
    ];

    foreach ($social_links as $platform => $url) {
        if (!empty($url)) {
            $icon = isset($social_icons[$platform]) ? $social_icons[$platform] : '';
            $social_links_html .= sprintf(
                '<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s" class="social-icon">
                    <i class="%s" aria-hidden="true"></i>
                </a> ',
                esc_url($url),
                ucfirst($platform),
                $icon
            );
        }
    }

    // Generate the consultation button if enabled
    $consultation_button_html = '';
    if ($show_consultation_link) {
        $consultation_button_html = sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" class="consultation-button" style="width: %s; margin-right: 10px; padding: %dpx; background-color: %s; color: white; text-decoration: none; border-radius: %dpx; font-size: %dpx; border: %dpx solid %s;">%s</a>',
            $consultation_url,
            $consultation_button_width,
            $consultation_button_padding,
            $consultation_bg_color,
            $consultation_border_radius,
            $consultation_font_size,
            $consultation_border_size,
            $consultation_border_color,
            $consultation_text
        );
    }

    return sprintf(
        '<div class="ab-author-box" style="max-width: 1200px; background-color: %s; border-radius: %dpx; border: %dpx solid %s; padding: 15px;">
            <div class="ab-author-left" style="flex: 0 0 %d%%; max-width: %d%%; padding-right: 15px;">
                <img src="%s" alt="%s" class="ab-author-image" style="width: %d%%; height: auto; border-radius: %dpx; border: %dpx solid %s;" />
            </div>
            <div class="ab-author-right" style="flex: 1;">
                <h2 class="ab-author-name">%s</h2>
                <div class="ab-author-description">%s</div>
                <div class="ab-link-social-container" style="display: flex; justify-content: space-between; align-items: center;">
                    %s
                    <div class="ab-social-links">%s</div>
                </div>
            </div>
        </div>',
        $background_color,
        $box_border_radius,
        $border_size,
        $border_color,
        $left_container_width,
        $left_container_width,
        $author_image,
        $author_name,
        $image_width_percent,
        $image_border_radius,
        $image_border_size,
        $image_border_color,
        $author_name,
        $author_description,
        $consultation_button_html,
        $social_links_html
    );
}

// Register the shortcode
function ab_register_shortcodes() {
    add_shortcode('author_box', 'ab_author_box_shortcode');
}

function ab_author_box_shortcode($atts) {
    return ab_get_author_box_html();
}

add_action('init', 'ab_register_shortcodes');

// Enqueue scripts for media uploader
add_action('admin_enqueue_scripts', 'ab_enqueue_admin_assets');

function ab_enqueue_admin_assets() {
    wp_enqueue_media();
    wp_enqueue_script('ab_admin_script', plugin_dir_url(__FILE__) . 'script.js', ['jquery'], null, true);
    wp_enqueue_style('ab_admin_style', plugin_dir_url(__FILE__) . 'admin-style.css');
    wp_enqueue_style('wp-color-picker'); // Enqueue color picker CSS
    wp_enqueue_script('ab_color_picker', plugin_dir_url(__FILE__) . 'color-picker.js', ['wp-color-picker'], null, true);
}

// Create the settings page
function ab_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Author Box Settings', 'author-box'); ?></h1>
        <div class="ab-settings-container">
            <form action='options.php' method='post'>
                <?php
                settings_fields('ab_settings_group');
                do_settings_sections('author-box');
                submit_button();
                ?>
            </form>
        </div>
    </div>
    <?php
}
