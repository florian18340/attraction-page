<?php

function register_attraction_taxonomy() {
    $labels = array(
        'name' => 'Catégories d\'attractions',
        'singular_name' => 'Catégorie d\'attraction',
        'search_items' => 'Rechercher des catégories',
        'all_items' => 'Toutes les catégories',
        'parent_item' => 'Catégorie parente',
        'parent_item_colon' => 'Catégorie parente:',
        'edit_item' => 'Modifier la catégorie',
        'update_item' => 'Mettre à jour la catégorie',
        'add_new_item' => 'Ajouter une nouvelle catégorie',
        'new_item_name' => 'Nom de la nouvelle catégorie',
        'menu_name' => 'Catégories',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'attraction-category'),
    );

    register_taxonomy('attraction_category', array('attraction'), $args);
}

add_action('init', 'register_attraction_taxonomy');
