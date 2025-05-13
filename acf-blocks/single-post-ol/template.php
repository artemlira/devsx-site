<?php
$single_post_list = get_field('single_post_list');
?>

<ol class="single-post-ol-list wow fadeInUp">
  <?php foreach ($single_post_list as $single_post_item) : ?>
    <li class="single-post-ol-li wow fadeInUp">
      <?php if ($single_post_item['title']): ?>
        <h4 class="item-title wow fadeInUp" data-wow-delay="0.1s"><?php echo $single_post_item['title']; ?></h4>
      <?php endif; ?>
      <?php if ($single_post_item['text']): ?>
        <div class="item-content wow fadeInUp" data-wow-delay="0.2s">
          <?php echo $single_post_item['text']; ?>
        </div>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ol>
