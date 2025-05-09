<?php
get_header();
?>
<section>
  <div class="container">
  <h1>My custom page case</h1>
    <?php the_content();?>
  </div>
</section>
<?php get_template_part('template-parts/block-contacts-bottom'); ?>
<?php get_footer(); ?>