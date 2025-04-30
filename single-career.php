<?php
get_header();
?>
  <section>
    <div class="container">
      <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
        <?php devsx_breadcrumbs(); ?>
      </div>
      <?php the_content();?>
    </div>
  </section>
<?php get_footer(); ?>