<?php

function handle_attraction_contact_form() {
    if (isset($_POST['action']) && $_POST['action'] === 'submit_attraction_contact_form') {
        // Vérifier le nonce
        if (!isset($_POST['attraction_contact_form_nonce_field']) || !wp_verify_nonce($_POST['attraction_contact_form_nonce_field'], 'attraction_contact_form_nonce')) {
            wp_send_json_error('Nonce invalide.');
        }

        // Récupérer les données du formulaire
        $name = sanitize_text_field($_POST['contact_name']);
        $email = sanitize_email($_POST['contact_email']);
        $subject = sanitize_text_field($_POST['contact_subject']);
        $message = sanitize_textarea_field($_POST['contact_message']);
        $attraction_title = sanitize_text_field($_POST['attraction_title']);

        // Valider les données
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            wp_send_json_error('Veuillez remplir tous les champs.');
        }

        // Envoyer l'email
        $to = get_option('attraction_contact_form_recipient', get_option('admin_email'));
        $default_subject = get_option('attraction_contact_form_subject', 'Nouveau message concernant une attraction');
        $email_subject = $default_subject . ' : ' . $attraction_title;
        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>');
        $email_body = "
            <p><strong>Nom:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Sujet:</strong> {$subject}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        if (wp_mail($to, $email_subject, $email_body, $headers)) {
            wp_send_json_success('Votre message a bien été envoyé.');
        } else {
            wp_send_json_error('Une erreur s\'est produite lors de l\'envoi de l\'email.');
        }
    }
}
add_action('init', 'handle_attraction_contact_form');
