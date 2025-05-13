<?php
// Генерируем уникальный ID для каждого слайдера
$slider_id = 'devsx-slider-' . uniqid();

// Получаем изображения из ACF
$images = get_field('slides');
//$slider_settings = get_field('slider_settings');
//$pagination = $slider_settings['pagination'];
//$navigation = $slider_settings['navigation'];
?>


<div class="swiper devsx-slider" id="<?php echo $slider_id; ?>" data-slider-id="<?php echo $slider_id; ?>">
  <div class="swiper-wrapper">
    <?php foreach ($images as $slide):
      $image = $slide['image'];
      $title = $slide['title'];
      $text = $slide['text'];
      ?>
      <div class="swiper-slide">
        <?php if ($title): ?>
          <h3><?php echo $title; ?></h3>
        <?php endif; ?>
        <?php if (!empty($image)): ?>
          <img
              src="<?php echo $image['url']; ?>"
              alt="<?php echo $image['alt']; ?>"
              loading="lazy"
          >
        <?php endif; ?>
        <?php if ($text): ?>
          <p><?php echo $text; ?></p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>


  <div class="swiper-pagination devsx-slider-pagination-<?php echo $slider_id; ?>"></div>

</div>

<script>


</script>