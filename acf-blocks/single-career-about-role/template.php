<?php
$title_value = get_field('single_career_about_title_value');
$title = get_field('single_career_about_title');
$text = get_field('single_career_about_text');
?>

<section class="single-career-about-section">
  <div class="container">
    <<?php echo $title_value; ?> class="section-title"><?php echo $title; ?></<?php echo $title_value; ?>>
    <p class="section-text">
      <?php echo $text; ?>
    </p>
  </div>
</section>