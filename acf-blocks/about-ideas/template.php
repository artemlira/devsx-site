<?php
$title = get_field('block_about_ideas_heading');
$mobile_title = get_field('block_about_ideas_heading_mobile');
$title_value = get_field('block_about_ideas_heading_value');
$mobile_title_value = get_field('block_about_ideas_heading_value_mobile');
$description = get_field('block_about_ideas_text');
$items = get_field('block_about_ideas_items');
?>

<section class="devsx-about-ideas  wow fadeIn" data-wow-delay="0.0s">
  <div class="container">
    <div class="flex">
      <div class="col-50">
        <?php if ($title):?>
          <<?php echo $title_value?> class="wow fadeIn section-title" data-wow-delay="0.1s"><?php echo $title; ?></<?php echo $title_value?>>
        <?php endif;?>
      <?php if ($mobile_title):?>
      <<?php echo $mobile_title_value; ?> class="wow fadeIn section-title section-title-mobile" data-wow-delay="0.1s"><?php echo $mobile_title; ?></<?php echo $mobile_title_value;?>>
    <?php endif;?>
      </div>

      <div class="col-50">
        <?php if ($description): ?>
          <div class="col-50">
            <p class="h6 wow fadeIn" data-wow-delay="0.2s"><?php echo $description; ?></p>
          </div>
        <?php endif; ?>
        <?php if (!empty($items)):?>
        <ul class="list wow fadeIn" data-wow-delay="0.3s">
          <?php foreach ($items as $item):?>
            <li class="list-item">
              <p class="list-item-number"><?php echo $item['number']; ?></p>
              <p class="list-item-text"><?php echo $item['text']; ?></p>
            </li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
      </div>
    </div>
  </div>
</section>