<?php
$title_value = get_field('block_our_team_heading_value');
$title = get_field('block_our_team_heading');
$slider = get_field('block_our_team_slider');

?>

<section class="devsx-our-team  wow fadeIn" data-wow-delay="0.0s">
  <div class="container">
    <?php if ($title): ?>
      <<?php echo $title_value ?> class="wow fadeIn section-title"
      data-wow-delay="0.1s"><?php echo $title; ?></<?php echo $title_value ?>>
    <?php endif; ?>
<?php if (!empty($slider)): ?>
    <div class="swiper our-team-slider-wrap wow fadeInUp" data-wow-delay="0.1s">
      <div class="swiper-wrapper our-team-slider-container">
        <?php foreach ($slider as $item):
          $image = $item['image'];
          $name = $item['name'];
          $post = $item['post'];
          ?>
        <div class="swiper-slide slider-item wow fadeInUp" data-wow-delay="0.2s">
          <div class="item-image-wrapper">
            <img class="item-image" src="<?php echo $image['url']?>" alt="<?php echo $image['alt']; ?>" loading="lazy">
          </div>
          <div class="item-info-wrapper">
            <p class="item-name"><?php echo $name; ?></p>
            <p class="item-post"><?php echo $post; ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  <?php endif; ?>
  </div>
</section>