<?php
get_header();
?>


  <main class="main-tag-section">
    <div class="container">
      <header class="page-header">
        <?php
        the_archive_title('<h1 class="page-title">', '</h1>');
        the_archive_description('<div class="archive-description">', '</div>');
        ?>
      </header>

      <div class="tag-page-content">
        <?php
        global $post;

        $query = new WP_Query([
          'posts_per_page' => 5,
          'orderby' => 'comment_count',
        ]);

        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/related-post');
          }
        } else {
          ?>
          <p>No posts found</p>
          <?php
        }

        wp_reset_postdata(); // Сбрасываем $post
        ?>
      </div>
    </div>
  </main>
<?php get_template_part('template-parts/block-contacts-bottom'); ?>
<?php get_footer(); ?>