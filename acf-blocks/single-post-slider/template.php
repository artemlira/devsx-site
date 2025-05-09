<?php
// Проверка наличия слайдов
if (!have_rows('slides')) {
  echo '<p>Добавьте слайды в настройках блока.</p>';
  return;
}

// Генерация уникальных идентификаторов
$swiper_id = 'swiper-' . uniqid();
$pagination_id = 'swiper-pagination-' . uniqid();
$next_id = 'swiper-button-next-' . uniqid();
$prev_id = 'swiper-button-prev-' . uniqid();
?>

<section class="single-post-slider">

  <div class="swiper-container swiper-block" id="<?php echo $swiper_id; ?>">
    <div class="swiper-wrapper">
      <?php while (have_rows('slides')) : the_row(); ?>
        <div class="swiper-slide">
          <?php
          // Ваши ACF-поля для слайда
          $image = get_sub_field('image');
          $title = get_sub_field('title');
          ?>

          <?php if ($image) : ?>
            <img src="<?php echo esc_url($image['url']); ?>"
                 alt="<?php echo esc_attr($image['alt']); ?>">
          <?php endif; ?>

          <?php if ($title) : ?>
            <h3><?php echo esc_html($title); ?></h3>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>

    <!-- Элементы управления -->
    <div class="swiper-pagination" id="<?php echo $pagination_id; ?>"></div>
    <div class="swiper-button-next" id="<?php echo $next_id; ?>"></div>
    <div class="swiper-button-prev" id="<?php echo $prev_id; ?>"></div>
  </div>
</section>