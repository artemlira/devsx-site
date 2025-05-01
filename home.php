<?php
get_header();
$title_value = get_field('blog_setting_title_value', 'option');
$title = get_field('blog_setting_title', 'option');
$form_placeholder = get_field('blog_setting_form_placeholder', 'option');
$title_editor_choice_value = get_field('blog_setting_title_editor_choice_value', 'option');
$title_editor_choice = get_field('blog_setting_title_editor_choice', 'option');
$title_latest_posts_value = get_field('blog_setting_title_latest_posts_value', 'option');
$title_latest_posts = get_field('blog_setting_title_latest_posts', 'option');
?>
  <div class="container">
    <div class="blog-hero">
      <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
        <?php devsx_breadcrumbs(); ?>
      </div>
      <<?php echo $title_value; ?> class="section-title wow fadeIn" data-wow-delay="0.2s"><?php echo $title; ?></<?php echo $title_value; ?>>
      <div class="blog-search-container wow fadeIn" data-wow-delay="0.3s">
        <form role="search" method="get" class="blog-search-form" action="<?php echo home_url('/'); ?>">
          <button type="submit" class="blog-search-submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#BFBFC7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M20.9984 21.0004L16.6484 16.6504" stroke="#BFBFC7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
          <input type="search" class="blog-search-field" placeholder="<?php echo $form_placeholder;?>" value="<?php echo get_search_query(); ?>" name="s" />
          <input type="hidden" name="post_type" value="post" />
          <?php if (!empty($_GET['tag'])) : ?>
            <input type="hidden" name="tag" value="<?php echo esc_attr($_GET['tag']); ?>" />
          <?php endif; ?>
        </form>
      </div>
    </div>



<?php
$tags = get_terms(array(
  'taxonomy' => 'post_tag',
  'hide_empty' => false,
));
$current_tag = isset($_GET['tag']) ? sanitize_text_field($_GET['tag']) : '';
$search_query = get_search_query();
?>
  <div class="blog-filter">
    <ul class="blog-filter-list wow fadeIn" data-wow-delay="0.4s">
      <li class="blog-filter-item <?php echo empty($current_tag) ? 'active' : ''; ?>">
        <?php
        $all_link = empty($search_query) ? get_home_url() : add_query_arg('s', $search_query, get_home_url());
        ?>
        <a href="<?php echo $all_link; ?>" class="blog-filter-link">All</a>
      </li>
      <?php foreach ($tags as $tag) :
        $has_posts = get_posts(array(
          'post_type' => 'post',
          'numberposts' => 1,
          'tax_query' => array(
            array(
              'taxonomy' => 'post_tag',
              'field' => 'id',
              'terms' => $tag->term_id,
            )
          )
        ));

        $empty_class = empty($has_posts) ? 'empty-tag' : '';

        $tag_link = add_query_arg('tag', $tag->slug, get_home_url());
        if (!empty($search_query)) {
          $tag_link = add_query_arg('s', $search_query, $tag_link);
        }
        ?>
        <li class="blog-filter-item <?php echo $current_tag === $tag->slug ? 'active' : ''; ?> <?php echo $empty_class; ?>">
          <a href="<?php echo $tag_link; ?>" class="blog-filter-link">
            <?php echo $tag->name; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="editors-choice-section">
  <<?php echo $title_editor_choice_value; ?> class="editors-choice-title"><?php echo $title_editor_choice; ?></<?php echo $title_editor_choice_value; ?>>
    <div class="editors-choice-container">
      <?php
      $editors_choice_args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'orderby' => 'rand',
        'tax_query' => array(
          array(
            'taxonomy' => 'post_tag',
            'field' => 'slug',
            'terms' => 'editors-choice',
          )
        )
      );

      $editors_choice_query = new WP_Query($editors_choice_args);

      $delay_counter = 0.5;
      $delay_increment = 0.1;

      if ($editors_choice_query->have_posts()) :
        while ($editors_choice_query->have_posts()) : $editors_choice_query->the_post();
          $delay = number_format($delay_counter, 1) . 's';
          ?>
          <article class="editors-choice-post wow fadeIn" data-wow-delay="<?php echo $delay; ?>">
            <?php if (has_post_thumbnail()) : ?>
              <div class="editors-choice-thumbnail">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('large'); ?>
                </a>
              </div>
            <?php endif; ?>

            <div class="editors-choice-content-wrapper">
              <div class="editors-choice-meta">
                <span class="editors-choice-date"><?php echo get_the_date(); ?></span>
              </div>

              <h4 class="editors-choice-post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h4>

              <div class="editors-choice-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
              </div>
              <div class="editors-read-more">
                <a href="<?php the_permalink(); ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M7 17L17 7M17 7H8M17 7V16" stroke="#F0F3FA" stroke-width="2" stroke-linecap="square"/>
                  </svg>
                </a>
              </div>
            </div>
          </article>
        <?php
          $delay_counter += $delay_increment;
        endwhile;
        wp_reset_postdata();
      else :
        echo `<p>No "Editor/'s Choice" articles found.</p>`;
      endif;
      ?>
    </div>
  </div>
<section class="blog-posts-section-wrapper">


  <<?php echo $title_latest_posts_value; ?> class="blog-posts-section-title wow fadeIn" data-wow-delay="0.8s"><?php echo $title_latest_posts; ?></<?php echo $title_latest_posts_value; ?>>

<?php
$posts_per_page = 12;
$paged = 1;

$args = array(
  'post_type' => 'post',
  'posts_per_page' => $posts_per_page,
  'paged' => $paged,
);

if (!empty($search_query)) {
  $args['s'] = $search_query;
}

if (!empty($current_tag)) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'post_tag',
      'field' => 'slug',
      'terms' => $current_tag,
    )
  );
}

$query = new WP_Query($args);
$total_posts = $query->found_posts;
$max_pages = ceil($total_posts / $posts_per_page);
$delay_counter = 0;
$delay_increment = 0.1;

if ($query->have_posts()) :
  echo '<div class="blog-posts" id="blog-posts-container">';
  while ($query->have_posts()) : $query->the_post();
    $delay = number_format($delay_counter, 1) . 's';
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post wow fadeIn'); ?> data-wow-delay="<?php echo $delay; ?>">


      <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium'); ?>
          </a>
        </div>
      <?php endif; ?>

      <div class="entry-content-wrapper">
        <div class="entry-meta">
          <span class="posted-on"><?php echo get_the_date(); ?></span>
        </div>

        <h2 class="entry-title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <div class="entry-content">
          <?php the_excerpt(); ?>
        </div>

        <div class="read-more">
          <a href="<?php the_permalink(); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M7 17L17 7M17 7H8M17 7V16" stroke="#F0F3FA" stroke-width="2" stroke-linecap="square"/>
            </svg>
          </a>
        </div>
      </div>
    </article>
  <?php
  endwhile;
  echo '</div>';

  if ($max_pages > 1) :
    ?>
    <div class="load-more-container">
      <button id="load-more" class="load-more-button"
              data-page="1"
              data-max="<?php echo $max_pages; ?>"
              data-search="<?php echo esc_attr($search_query); ?>"
              data-tag="<?php echo esc_attr($current_tag); ?>">
        Show 12 More Articles
      </button>
      <div id="loading-spinner" class="loading-spinner" style="display: none;">
        <span class="spinner-icon"></span>
      </div>
    </div>
  <?php
  endif;
  wp_reset_postdata();

else :
  echo '<div class="no-results">';
  if (!empty($search_query)) {
    echo '<p>Nothing found for the search query "' . esc_html($search_query) . '".</p>';
    echo '<p>Try changing your search query or resetting your filters.</p>';
  } else {
    echo '<p>No records found.</p>';
  }
  echo '</div>';
endif;
?>
  </div>

<?php

wp_localize_script('blog-load-more', 'blogLoadMore', array(
  'ajaxurl' => admin_url('admin-ajax.php'),
  'nonce' => wp_create_nonce('blog_load_more_nonce'),
));
?>
  </section>
<?php get_template_part('template-parts/block-contacts-bottom'); ?>
<?php get_footer(); ?>