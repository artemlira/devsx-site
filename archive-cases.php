<?php
get_header();
$title_value = get_field('cases_setting_title_value', 'option');
$title = get_field('cases_setting_title', 'option');
$posts_per_page = 8;
?>
  <div class="container">
  <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
    <?php devsx_breadcrumbs(); ?>
  </div>
  <<?php echo $title_value; ?> class="section-title"><?php echo $title; ?></<?php echo $title_value; ?>>

<?php
$categories = get_terms(array(
  'taxonomy' => 'cases_rank',
  'hide_empty' => false,
));

$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
?>

  <div class="cases-filter">
    <ul class="cases-filter-list">
      <li class="cases-filter-item <?php echo empty($current_category) ? 'active' : ''; ?>">
        <a href="<?php echo get_post_type_archive_link('cases'); ?>" class="cases-filter-link">All</a>
      </li>
      <?php foreach ($categories as $category) :
        $has_posts = get_posts(array(
          'post_type' => 'cases',
          'numberposts' => 1,
          'tax_query' => array(
            array(
              'taxonomy' => 'cases_rank',
              'field' => 'id',
              'terms' => $category->term_id,
            )
          )
        ));

        $empty_class = empty($has_posts) ? 'empty-category' : '';
        ?>
        <li class="cases-filter-item <?php echo $current_category === $category->slug ? 'active' : ''; ?> <?php echo $empty_class; ?>">
          <a href="<?php echo add_query_arg('category', $category->slug, get_post_type_archive_link('cases')); ?>" class="cases-filter-link">
            <?php echo $category->name; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="section-cases-content">
    <ul class="section-cases-list" id="cases-list">
      <?php
      $args = array(
        'post_type' => 'cases',
        'posts_per_page' => $posts_per_page,
        'paged' => 1,
      );

      if (!empty($current_category)) {
        $args['tax_query'] = array(
          array(
            'taxonomy' => 'cases_rank',
            'field' => 'slug',
            'terms' => $current_category,
          ),
        );
      }

      $query = new WP_Query($args);

      $total_posts = $query->found_posts;

      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post(); ?>
          <li class="section-cases-item">
            <?php if (has_post_thumbnail()) : ?>
              <a class="section-cases-item-image-wrapper" href="<?php the_permalink(); ?>"
                 title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail(); ?>
              </a>
            <?php else: ?>
              <a class="section-cases-item-image-wrapper" href="<?php the_permalink(); ?>">
                <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/images/content/No-Image-Placeholder.png"
                    alt="No image available"
                    loading="lazy"
                >devsx
              </a>
            <?php endif; ?>
            <div class="section-cases-item-info-wrapper">
              <h3 class="section-cases-item-title"><?php the_title(); ?></h3>
              <?php
              $terms = get_terms_in_order(get_the_ID(), 'cases_tags');

              if ($terms && !is_wp_error($terms)): ?>
                <div class="section-cases-item-tags">
                  <?php foreach($terms as $term): ?>
                    <span class="section-cases-item-tag"><?= $term->name; ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </li>
          <?php
        }
      } else {
        echo '<p class="no-cases-found">There are no cases in the selected category.</p>';
      }
      wp_reset_postdata();
      ?>
    </ul>

    <?php
    if ($total_posts > $posts_per_page): ?>
      <div class="load-more-container">
        <button id="cases-load-more" class="load-more-button"
                data-page="1"
                data-category="<?php echo $current_category; ?>"
                data-total="<?php echo $total_posts; ?>">
          Show <?php echo min(8, $total_posts - $posts_per_page); ?> More Articles
        </button>
      </div>
    <?php endif; ?>
  </div>
  </div>

<?php get_template_part('template-parts/block-contacts-bottom'); ?>
<?php get_footer(); ?>