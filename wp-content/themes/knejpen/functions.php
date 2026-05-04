<?php
// Save ACF field groups as JSON in /wp-content/acf-json/
add_filter('acf/settings/save_json', function($path) {
    return get_stylesheet_directory() . '/../../../acf-json';
});

// Load ACF field groups from the same folder
add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_stylesheet_directory() . '/../../../acf-json';
    return $paths;
});

function custom_theme_styles() {
    wp_enqueue_style('global-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'custom_theme_styles');
