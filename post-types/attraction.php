<?php

function register_attraction_post_type() {
    $labels = array(
        'name' => 'Attractions',
        'singular_name' => 'Attraction',
        'add_new' => 'Ajouter une attraction',
        'add_new_item' => 'Ajouter une nouvelle attraction',
        'edit_item' => 'Modifier l\'attraction',
        'new_item' => 'Nouvelle attraction',
        'view_item' => 'Voir l\'attraction',
        'search_items' => 'Rechercher des attractions',
        'not_found' => 'Aucune attraction trouvée',
        'not_found_in_trash' => 'Aucune attraction trouvée dans la corbeille',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'attractions'),
    );

    register_post_type('attraction', $args);
}

add_action('init', 'register_attraction_post_type');
