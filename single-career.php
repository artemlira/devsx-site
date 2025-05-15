<?php
get_header();
?>
  <main class="single-career-page">
    <section class="single-career-hero">
      <div class="container">
        <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
          <?php devsx_breadcrumbs(); ?>
        </div>
        <div class="career-hero-content">
          <?php while (have_posts()) : the_post(); ?>

            <h1 class="career-hero-title"><?php the_title(); ?></h1>

            <div class="career-hero-taxonomies">
              <?php
              $locations = get_the_terms(get_the_ID(), 'career_location');
              if ($locations && !is_wp_error($locations)) {
                echo '<div class="career-hero-locations">';
                echo '<p>Location:</p>';
                $location_names = array();
                foreach ($locations as $location) {
                  $location_names[] = esc_html($location->name);
                }
                echo implode(', ', $location_names);
                echo '</div>';
              }

              $levels = get_the_terms(get_the_ID(), 'career_level');
              if ($levels && !is_wp_error($levels)) {
                echo '<div class="career-hero-levels">';
                echo '<p class="career-hero-level">Level:</p>';
                $level_names = array();
                foreach ($levels as $level) {
                  $level_names[] = esc_html($level->name);
                }
                echo implode(', ', $level_names);
                echo '</div>';
              }
              ?>
            </div>

          <?php endwhile; ?>
        </div>
      </div>

    </section>

    <?php the_content(); ?>
  </main>
<?php get_template_part('template-parts/block-contacts-bottom'); ?>
<?php get_footer(); ?>