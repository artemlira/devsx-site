<?php
/*
Template Name: Custom Single Post
Template Post Type: post
*/
get_header();
$post_date_text = get_field('post_date_text', 'option');
$reading_time_text = get_field('reading_time_text', 'option');
$reading_time_unit = get_field('reading_time_unit', 'option');
$related_posts_subtitle = get_field('related_posts_subtitle', 'option');
$related_posts_title = get_field('related_posts_title', 'option');
$related_posts_link = get_field('related_posts_link', 'option');
// Hero Section
if (have_posts()) : while (have_posts()) : the_post();
  $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $reading_time = ceil(str_word_count(get_the_content()) / 200);
  ?>
  <section class="hero-section"
           style="background: linear-gradient(0deg, rgba(15, 23, 55, 0.70) 0%, rgba(15, 23, 55, 0.70) 100%), url('<?php echo esc_url($thumbnail_url); ?>') center / cover no-repeat;">
    <div class="container">

      <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
        <?php devsx_breadcrumbs(); ?>
      </div>
      <div class="hero-content">

        <div class="post-meta">
          <div class="author-info">
            <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
            <div>
              <p class="author-name"><?php the_author(); ?></p>
              <p class="author-position"><?php echo get_the_author_meta('position'); ?></p>
            </div>
          </div>
          <p class="post-date"><span><?php echo $post_date_text; ?> </span><?php echo get_the_date('j M Y'); ?></p>
        </div>

        <h1 class="post-title"><?php the_title(); ?></h1>

        <div class="post-tags">
          <?php the_tags('', ' ', ''); ?>
        </div>

        <div class="reading-time">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M10.4993 12.2507H11.0827V13.4173H2.91602V12.2507H3.49795C3.49577 11.7632 3.49113 11.1816 3.48401 10.4955C3.49807 8.8943 3.97392 8.12301 5.16584 7.40786C5.09947 7.44768 5.47153 7.23697 5.87569 7.00065C5.47153 6.76433 5.09947 6.55363 5.16584 6.59345C3.97392 5.87829 3.49807 5.10701 3.48402 3.49451C3.49114 2.81897 3.49577 2.23766 3.49794 1.75065H2.91602V0.583984H11.0827V1.75065H10.4993V3.50065C10.4993 5.10394 10.0266 5.87755 8.83342 6.59345C8.89795 6.55473 8.52663 6.76491 8.12328 7.00065C8.52663 7.23639 8.89795 7.44657 8.83342 7.40786C10.0266 8.12375 10.4993 8.89737 10.4993 10.5007V12.2507ZM6.46433 8.01003C6.37656 8.05995 6.08418 8.22431 6.09252 8.2196C5.95542 8.29698 5.85707 8.35367 5.76609 8.40826C4.91066 8.92152 4.66099 9.3262 4.65062 10.4945C4.65778 11.174 4.66245 11.7595 4.66463 12.2507H9.33268V10.5007C9.33268 9.32279 9.0868 8.92044 8.23318 8.40826C8.14221 8.35368 8.0438 8.29697 7.90675 8.21966C7.91281 8.22308 7.62235 8.05988 7.53477 8.0101C7.33702 7.89769 7.16416 7.79605 6.99937 7.69397C6.83464 7.79605 6.66187 7.89768 6.46433 8.01003ZM7.90675 5.78164C7.91281 5.77823 7.62235 5.94142 7.53477 5.99121C7.33702 6.10361 7.16416 6.20525 6.99937 6.30733C6.83464 6.20525 6.66187 6.10362 6.46433 5.99127C6.37656 5.94136 6.08418 5.77699 6.09252 5.7817C5.95542 5.70433 5.85707 5.64763 5.76609 5.59304C4.91066 5.07978 4.66099 4.6751 4.65063 3.49553C4.65779 2.82663 4.66245 2.24128 4.66461 1.75065L9.33268 1.75064V3.50065C9.33268 4.67851 9.0868 5.08087 8.23318 5.59304C8.14221 5.64762 8.0438 5.70434 7.90675 5.78164Z"
                  fill="#BFBFC7"/>
          </svg>
          <p><?php echo $reading_time_text; ?><?php echo $reading_time; ?><?php echo $reading_time_unit; ?></p>
        </div>
      </div>
  </section>

  <div class="content-wrapper">
    <div class="container">
      <!-- Table of Contents Sidebar -->
      <aside class="toc-sidebar">
        <nav id="post-toc">
          <ul class="toc-list">
            <?php
            // Extract headings from content
            $content = get_the_content();
            preg_match_all('/<h([2-6]).*?>(.*?)<\/h\1>/i', $content, $matches);

            if (!empty($matches[0])) {
              foreach ($matches[2] as $key => $heading) {
                $tag = $matches[1][$key];
                $anchor = sanitize_title($heading);
                echo '<li class="toc-item toc-level-' . $tag . '">';
                echo '<a href="#' . $anchor . '">' . $heading . '</a>';
                echo '</li>';
              }
            }
            ?>
          </ul>
          <div class="progress-bar"></div>
        </nav>
      </aside>

      <!-- Main Content -->
      <main class="main-content">
        <?php the_content(); ?>
        <?php get_template_part('acf-blocks/single-post-share/template'); ?>
      </main>
    </div>
  </div>

  <!-- Related Posts -->

  <section class="related-posts">
    <div class="container">
      <div class="caption-text color-blue wow fadeInUp"><?php echo $related_posts_subtitle; ?></div>
      <h2 class="section-title"><?php echo $related_posts_title; ?></h2>
      <div class="related-grid">
        <?php
        $current_post = get_the_ID();
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 3,
          'post__not_in' => array($current_post),
          'orderby' => 'date'
        );

        $query = new WP_Query($args);
        $found_posts = $query->found_posts;

        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/related-post');
          }
        }

        // If less than 3 posts, fill with first posts
        if ($found_posts < 3) {
          $additional = 3 - $found_posts;
          $args = array(
            'post_type' => 'post',
            'posts_per_page' => $additional,
            'orderby' => 'date'
          );

          $query = new WP_Query($args);
          while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/related-post');
          }
        }
        wp_reset_postdata();
        ?>
      </div>
      <div class="btn-wrap">
        <a class="btn-blue-text" href="<?php echo $related_posts_link['url']; ?>"
           target="<?php echo $related_posts_link['target']; ?>">
          <?php echo $related_posts_link['title']; ?>
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M9.33268 22.668L22.666 9.33464M22.666 9.33464H10.666M22.666 9.33464V21.3346" stroke="none"
                  stroke-width="2" stroke-linecap="square"/>
          </svg>
        </a>
      </div>
    </div>

  </section>

<?php endwhile; endif;
get_template_part('template-parts/block-contacts-bottom');
get_footer();