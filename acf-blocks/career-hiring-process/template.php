<?php
$title_value = get_field('block_career_hiring-process_value');
$title = get_field('block_career_hiring-process_title');
$slider = get_field('block_career_hiring-process_slider');

?>

<section class="devsx-career-hiring-process  wow fadeIn" data-wow-delay="0.0s">
  <div class="container">
  <?php if (!empty($slider)): ?>
    <div class="swiper career-hiring-process-slider-wrap">
      <div class="swiper-hero-container">
        <?php if ($title): ?>
        <<?php echo $title_value ?> class="wow fadeIn section-title"
        data-wow-delay="0.1s"><?php echo $title; ?></<?php echo $title_value ?>>
      <?php endif; ?>
      <div class="swiper-buttons">
        <div class="career-hiring-process-swiper-button-prev swiper-button-prev">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M25.4281 16.0016L6.57191 16.0016M6.57191 16.0016L15.0572 7.51632M6.57191 16.0016L15.0572 24.4869" stroke="#F0F3FA"  stroke-width="2" stroke-linecap="square"/>
          </svg>
        </div>
        <div class="career-hiring-process-swiper-button-next swiper-button-next">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path d="M6.57191 16.0016L25.4281 16.0016M25.4281 16.0016L16.9428 7.51632M25.4281 16.0016L16.9428 24.4869" stroke="#F0F3FA" stroke-width="2" stroke-linecap="square"/>
          </svg>
        </div>
      </div>
    </div>
      <ol class="swiper-wrapper career-hiring-process-slider-container">
        <?php foreach ($slider as $item):?>
          <li class="swiper-slide slider-item">
            <div class="slider-item-card">
              <p class="item-heading"><?php echo $item['title']; ?></p>
              <p class="item-text"><?php echo $item['text']; ?></p>
            </div>
          </li>
        <?php endforeach; ?>
      </ol>

    </div>
  <?php endif; ?>
  </div>
</section>

