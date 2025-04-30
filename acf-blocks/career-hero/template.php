<?php
$title_value = get_field('block_career_hero_title_value');
$title = get_field('block_career_hero_title');
$text = get_field('block_career_hero_text');
?>
<section class="career-hero">
  <div class="container">
        <<?php echo $title_value; ?> class="career-hero-title wow fadeInUp" data-wow-delay="0.2s"><?php echo $title; ?></<?php echo $title_value; ?>>
        <p class="career-hero-descripton wow fadeInUp" data-wow-delay="0.3s">
          <?php echo $text; ?>
        </p>
  </div>
</section>