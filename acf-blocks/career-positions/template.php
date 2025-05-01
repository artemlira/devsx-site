<?php
$title_value = get_field('block_career_positions_title_value');
$title = get_field('block_career_positions_title');
$subtitle = get_field('block_career_positions_subtitle');
?>
<section class="career-positions">

  <div class="container">
    <p class="career-positions-subtitle wow fadeInUp" data-wow-delay="0.1s">
      <?php echo $subtitle; ?>
    </p>
    <div class="career-header-wrapper">
      <<?php echo $title_value; ?> class="career-positions-title wow fadeInUp"
      data-wow-delay="0.2s"><?php echo $title; ?></<?php echo $title_value; ?>>
    <?php
    $locations = get_terms([
      'taxonomy' => 'career_location',
      'hide_empty' => false,
    ]);

    $levels = get_terms([
      'taxonomy' => 'career_level',
      'hide_empty' => false,
    ]);
    $current_location = isset($_GET['career_location']) ? sanitize_text_field($_GET['career_location']) : '';
    $current_level = isset($_GET['career_level']) ? sanitize_text_field($_GET['career_level']) : '';
    $block_id = $block['id'];
    ?>
    <div class="career-filters">
      <form action="<?php echo esc_url(get_permalink()); ?>" method="get"
            id="career-filter-form-<?php echo esc_attr($block_id); ?>" class="career-filter-form">
        <div class="filter-row">
          <div class="filter-item">
            <label for="career_level_<?php echo esc_attr($block_id); ?>">Level:</label>
            <select name="career_level" id="career_level_<?php echo esc_attr($block_id); ?>" class="auto-submit">
              <option value="">All</option>
              <?php foreach ($levels as $level) : ?>
                <option value="<?php echo esc_attr($level->slug); ?>" <?php selected($current_level, $level->slug); ?>>
                  <?php echo esc_html($level->name); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="filter-item">
            <label for="career_location_<?php echo esc_attr($block_id); ?>">Locations:</label>
            <select name="career_location" id="career_location_<?php echo esc_attr($block_id); ?>" class="auto-submit">
              <option value="">All</option>
              <?php foreach ($locations as $location) : ?>
                <option
                    value="<?php echo esc_attr($location->slug); ?>" <?php selected($current_location, $location->slug); ?>>
                  <?php echo esc_html($location->name); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>


  <?php
  $args = [
    'post_type' => 'career',
    'posts_per_page' => -1,
    'tax_query' => []
  ];

  if (!empty($current_location)) {
    $args['tax_query'][] = [
      'taxonomy' => 'career_location',
      'field' => 'slug',
      'terms' => $current_location
    ];
  }

  if (!empty($current_level)) {
    $args['tax_query'][] = [
      'taxonomy' => 'career_level',
      'field' => 'slug',
      'terms' => $current_level
    ];
  }

  if (count($args['tax_query']) > 1) {
    $args['tax_query']['relation'] = 'AND';
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) :
    ?>
    <div class="career-posts">
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <div class="career-item">
          <div class="container">
            <h2 class="career-item-title"><?php the_title(); ?></h2>

            <div class="career-meta">
              <?php
              $post_locations = get_the_terms(get_the_ID(), 'career_location');
              $post_levels = get_the_terms(get_the_ID(), 'career_level');

              if (!empty($post_levels) && !is_wp_error($post_levels)) {
                $level_names = array();
                foreach ($post_levels as $lvl) {
                  $level_names[] = $lvl->name;
                }
                echo '<span class="level-value">' . implode(', ', $level_names) . '</span>';
              }

              if (!empty($post_locations) && !is_wp_error($post_locations)) {
                $location_names = array();
                foreach ($post_locations as $loc) {
                  $location_names[] = $loc->name;
                }
                echo '<span class="location-value">' . implode(', ', $location_names) . '</span>';
              }

              ?>
            </div>

            <a href="<?php the_permalink(); ?>" class="read-more">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                <path d="M9.33073 22.668L22.6641 9.33464M22.6641 9.33464H10.6641M22.6641 9.33464V21.3346" stroke="none" stroke-width="2" stroke-linecap="square"/>
              </svg>
            </a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
  else :
    ?>
    <div class="no-results">
      <p>Unfortunately, no vacancies were found that match the selected criteria.</p>
    </div>
  <?php
  endif;
  ?>


</section>