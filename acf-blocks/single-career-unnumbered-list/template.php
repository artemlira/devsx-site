<?php
$title_value = get_field('single_career_ul_title_value');
$title = get_field('single_career_ul_title');
$list = get_field('single_career_ul_list');
?>

<section class="single-career-ul-section">
  <div class="container">
    <div class="heading-wrapper">
      <h2 class="section-title"><?php echo $title; ?></h2>
    </div>
    <ul class="section-list">
      <?php foreach ($list as $item): ?>
        <li class="section-item"><?php echo $item['text']; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>