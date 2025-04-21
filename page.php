<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DevsX_Theme
 */

get_header();
?>
<?php
// Breadcrumbs
if ( get_field('show_breadcrumbs') ) : ?>
    <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <?php devsx_breadcrumbs(); ?>
        </div>
    </div>
<?php endif; ?>

<?php the_content(); ?>

<?php
// Testimonials
if ( get_field('show_testimonials') ) :
    get_template_part('template-parts/testimonials-full-width');
endif;
?>

<?php
// How to Start Working With Us
if ( get_field('show_work_with_us') ) :
    get_template_part('template-parts/work-with-us');
endif;
?>

<?php
// Contacts
if ( get_field('show_contacts_block') ) :
    get_template_part('template-parts/block-contacts-bottom');
endif;
?>

<?php

get_footer();
