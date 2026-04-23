<?php
/*
Plugin Name: Attraction Page
Description: Un plugin pour créer et gérer des pages d'attractions.
Version: 1.0
Author: Votre Nom
*/

// Sécurité
if (!defined('ABSPATH')) {
    exit;
}

// Inclure le type de contenu personnalisé
require_once plugin_dir_path(__FILE__) . 'post-types/attraction.php';

// Inclure la taxonomie personnalisée
require_once plugin_dir_path(__FILE__) . 'taxonomies/attraction-category.php';

// Inclure le gestionnaire du formulaire de contact
require_once plugin_dir_path(__FILE__) . 'includes/contact-form-handler.php';

// Inclure le menu d'administration
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
}

// Charger le template pour les attractions
function load_attraction_template($template) {
    if (is_singular('attraction')) {
        $plugin_template = plugin_dir_path(__FILE__) . 'templates/single-attraction.php';
        if (file_exists($plugin_template)) {
            return $plugin_template;
        }
    }
    return $template;
}
add_filter('single_template', 'load_attraction_template');

// Charger les scripts
function attraction_page_scripts() {
    if (is_singular('attraction')) {
        wp_enqueue_script('attraction-contact-form', plugin_dir_url(__FILE__) . 'js/contact-form.js', array('jquery'), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'attraction_page_scripts');
