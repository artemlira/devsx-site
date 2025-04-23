<?php
$title = get_field('block_our_clients_heading');
$title_value = get_field('block_our_clients_heading_value');
$items = get_field('block_our_clients_items');
?>

<section class="devsx-our-clients  wow fadeIn" data-wow-delay="0.0s">
  <div class="container">
    <?php if ($title): ?>
    <<?php echo $title_value ?> class="wow fadeIn section-title"
    data-wow-delay="0.1s"><?php echo $title; ?></<?php echo $title_value ?>>
    <?php endif; ?>

    <?php if (!empty($items)): ?>
    <ul class="section-content wow fadeIn" data-wow-delay="0.3s">
      <?php foreach ($items as $item): ?>
        <li class="section-content-item">
          <img class="section-content-img"
              src="<?php echo $item['image']['url']; ?>"
              alt="<?php echo $item['image']['alt']; ?>"
              loading="lazy"
          >
        </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>