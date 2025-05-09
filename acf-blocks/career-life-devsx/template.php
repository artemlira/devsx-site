<?php
$subtitle_value = get_field('block_career_life_devsx_subtitle_value');
$subtitle = get_field('block_career_life_devsx_subtitle');
$title_value = get_field('block_career_life_devsx_title_value');
$title = get_field('block_career_life_devsx_title');
$heading_text = get_field('block_career_life_devsx_heading_text');
$content_heading_value = get_field('block_career_life_devsx_content_heading_value');
$content_heading = get_field('block_career_life_devsx_content_heading');
$content_repeater = get_field('block_career_life_devsx_content_repeater');
?>
<section class="career-life-devsx-section">
  <div class="container">
    <<?php echo $subtitle_value; ?> class="subtitle wow fadeInUp">
    <?php echo $subtitle; ?>
  </<?php echo $title_value; ?>>
  <div class="heading-wrapper">
    <<?php echo $title_value; ?> class="career-life-devsx-title wow fadeInUp" data-wow-delay="0.2s">
    <?php echo $title; ?>
  </<?php echo $title_value; ?>>
  <div class="heading-text hide-mobile">
    <?php echo $heading_text; ?>
  </div>
  </div>
  <div class="section-content">
    <div class="col-50">
      <<?php echo $content_heading_value; ?>
      class="content-heading"><?php echo $content_heading; ?></<?php echo $content_heading_value; ?>>
    <div class="heading-text hide-desktop">
      <?php echo $heading_text; ?>
    </div>
  </div>
  <div class="col-50">
    <ul class="content-list">
      <?php foreach ($content_repeater as $item): ?>
        <li class="content-item">
        <<?php echo $item['title_value']; ?>
        class="content-item-title"><?php echo $item['title']; ?></<?php echo $item['title_value']; ?>>
        <p class="content-item-text"><?php echo $item['text']; ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  </div>
  </div>
</section>