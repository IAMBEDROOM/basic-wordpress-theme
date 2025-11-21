<?php
/**
 * The template for displaying all single posts
 *
 * @package Basic_WordPress_Theme
 */

get_header();
?>

<div class="container site-content">
    <main id="primary" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', 'single' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();