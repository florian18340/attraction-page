<?php

function attraction_page_admin_menu() {
    add_menu_page(
        'Attraction Page Options',
        'Attractions',
        'manage_options',
        'attraction-page-options',
        'attraction_page_options_page',
        'dashicons-location-alt',
        20
    );
}
add_action('admin_menu', 'attraction_page_admin_menu');

function attraction_page_options_page() {
    ?>
    <div class="wrap">
        <h1>Options du Plugin Attraction Page</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('attraction_page_options');
            do_settings_sections('attraction-page-options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function attraction_page_settings() {
    register_setting('attraction_page_options', 'attraction_contact_form_recipient');
    register_setting('attraction_page_options', 'attraction_contact_form_subject');

    add_settings_section(
        'attraction_contact_form_section',
        'Paramètres du Formulaire de Contact',
        null,
        'attraction-page-options'
    );

    add_settings_field(
        'attraction_contact_form_recipient',
        'Email de destination',
        'attraction_contact_form_recipient_callback',
        'attraction-page-options',
        'attraction_contact_form_section'
    );

    add_settings_field(
        'attraction_contact_form_subject',
        'Sujet de l\'email par défaut',
        'attraction_contact_form_subject_callback',
        'attraction-page-options',
        'attraction_contact_form_section'
    );
}
add_action('admin_init', 'attraction_page_settings');

function attraction_contact_form_recipient_callback() {
    $recipient = get_option('attraction_contact_form_recipient', get_option('admin_email'));
    echo '<input type="email" name="attraction_contact_form_recipient" value="' . esc_attr($recipient) . '" size="40">';
}

function attraction_contact_form_subject_callback() {
    $subject = get_option('attraction_contact_form_subject', 'Nouveau message concernant une attraction');
    echo '<input type="text" name="attraction_contact_form_subject" value="' . esc_attr($subject) . '" size="40">';
}
