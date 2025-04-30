<?php
get_header();
$title_value = get_field('career_setting_title_value', 'option');
$title = get_field('career_setting_title', 'option');
$posts_per_page = 8;
?>
  <div class="container">
<!--    <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">-->
<!--      --><?php //devsx_breadcrumbs(); ?>
<!--    </div>-->
    <?php the_content();?>

  </div>
<?php get_footer(); ?>