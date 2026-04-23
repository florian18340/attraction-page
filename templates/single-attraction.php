<?php
/**
 * The template for displaying single attractions.
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/TouristAttraction">
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
                </header>

                <div class="entry-content">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail" itemprop="image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( has_excerpt() ) : ?>
                        <div class="entry-gallery">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>

                    <div itemprop="description">
                        <?php the_content(); ?>
                    </div>

                    <div class="attraction-contact-form">
                        <h2>Contactez-nous à propos de cette attraction</h2>
                        <form action="" method="post" id="attraction-contact-form">
                            <p>
                                <label for="contact_name">Votre Nom:</label><br>
                                <input type="text" name="contact_name" id="contact_name" required>
                            </p>
                            <p>
                                <label for="contact_email">Votre Email:</label><br>
                                <input type="email" name="contact_email" id="contact_email" required>
                            </p>
                            <p>
                                <label for="contact_subject">Sujet:</label><br>
                                <input type="text" name="contact_subject" id="contact_subject" required>
                            </p>
                            <p>
                                <label for="contact_message">Votre Message:</label><br>
                                <textarea name="contact_message" id="contact_message" rows="5" required></textarea>
                            </p>
                            <p>
                                <input type="hidden" name="attraction_id" value="<?php the_ID(); ?>">
                                <input type="hidden" name="attraction_title" value="<?php the_title_attribute(); ?>">
                                <input type="hidden" name="action" value="submit_attraction_contact_form">
                                <?php wp_nonce_field('attraction_contact_form_nonce', 'attraction_contact_form_nonce_field'); ?>
                                <input type="submit" value="Envoyer">
                            </p>
                            <div id="form-messages"></div>
                        </form>
                    </div>
                </div>

            </article><!-- #post-## -->
        <?php
        // End the loop.
        endwhile;
        ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
