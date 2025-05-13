<?php
$caption = get_field('page_home_services_slider_caption');
$title_value = get_field('page_home_services_slider_title_value');
$title = get_field('page_home_services_slider_title');
$slider = get_field('page_home_services_slider_items');
?>
<section class="home-services-slider">
  <div class="container">
    <div class="section-heading">
      <div class="caption-text color-blue wow fadeInUp">
        <?php echo $caption; ?>
      </div>
      <<?php echo $title_value; ?> class="wow fadeInUp" data-wow-delay="0.1s">
      <?php echo $title; ?>
    </<?php echo $title_value; ?>>
  </div>
  </div>
  <div class="home-services-slider-wrap wow fadeInUp" data-wow-delay="0.1s">
    <div class="home-services-slider-container">
      <?php foreach ($slider as $slide):
        $image = $slide['image'];
        $link = $slide['link'];
        ?>
        <div class="slider-item wow fadeInUp" data-wow-delay="0.2s">
          <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
            <div class="item-heading">
              <span><?php echo $slide['caption_number']; ?></span>
              <span><?php echo $slide['caption_text']; ?></span>
            </div>
            <figure>
              <img src="<?php echo $image['url']; ?>"
                   alt="<?php echo $image['alt']; ?>">
            </figure>
            <h6><?php echo $slide['title']; ?></h6>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>