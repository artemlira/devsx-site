<?php
$title = get_field('block_our_approach_heading');
$title_value = get_field('block_our_approach_heading_value');
$subtitle = get_field('block_our_approach_subheading');
$subtitle_value = get_field('block_our_approach_subheading_value');
$items = get_field('block_our_approach_items');
?>

<section class="devsx-our-approach  wow fadeIn" data-wow-delay="0.0s">
  <div class="container">
    <?php if ($title): ?>
    <<?php echo $title_value ?> class="wow fadeIn section-title"
    data-wow-delay="0.1s"><?php echo $title; ?></<?php echo $title_value ?>>
  <?php endif; ?>

  <div class="section-content">
    <div class="section-subtitle">
      <<?php echo $subtitle_value; ?>><?php echo $subtitle; ?></<?php echo $subtitle_value; ?>>
    </div>
    <?php if (!empty($items)): ?>
      <ul class="section-list wow fadeIn" data-wow-delay="0.3s">
        <?php foreach ($items as $item): ?>
          <li class="section-content-item">
            <<?php echo $item['item_title_value'] ?> class="item-title"><?php echo $item['title']?></<?php echo $item['item_title_value'] ?>>
            <p class="item-text"><?php echo $item['text']?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
  </div>
</section>