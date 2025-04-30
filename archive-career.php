<?php
get_header();
$title_value = get_field('career_setting_title_value', 'option');
$title = get_field('career_setting_title', 'option');
$posts_per_page = 8;
?>
  <div class="container">
    <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
      <?php devsx_breadcrumbs(); ?>
    </div>
    <<?php echo $title_value; ?> class="section-title"><?php echo $title; ?></<?php echo $title_value; ?>>

  </div>

<?php get_template_part('template-parts/block-contacts-bottom'); ?>
<?php get_footer(); ?>