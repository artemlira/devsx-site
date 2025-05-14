<?php
$caption = get_field('page_home_process_steps_caption');
$title_value = get_field('page_home_process_steps_title_value');
$title = get_field('page_home_process_steps_title');
$step_1 = get_field('page_home_process_steps_step_1');
$step_2 = get_field('page_home_process_steps_step_2');
$step_3 = get_field('page_home_process_steps_step_3');
?>

<section class="home-process-steps">
  <div class="container">
    <div class="section-heading">
      <div class="caption-text color-blue wow fadeInUp">
        <?php echo $caption; ?>
      </div>
      <<?php echo $title_value; ?> class="wow fadeInUp" data-wow-delay="0.1s">
      <?php echo $title; ?>
    </<?php echo $title_value; ?>>
  </div>
  <div class="steps-grid-wrapper">

    <div class="item wow fadeInUp" data-wow-delay="0.1s">
      <?php
      $link = $step_1['link'];
      $image_1 = $step_1['image'];
      ?>
      <a href="<?php echo $link['url']; ?>" class="" target="<?php echo $link['target']; ?>">

        <div class="item-heading">
          <span><?php echo $step_1['caption_number']; ?></span>
          <span><?php echo $step_1['caption_text']; ?></span>
        </div>
        <figure>
          <img src="<?php echo $image_1['url']; ?>"
               alt="<?php echo $image_1['alt']; ?>">
        </figure>
        <h6 class="title"><?php echo $step_1['title']; ?></h6>
      </a>
    </div>
    <div class="item wow fadeInUp" data-wow-delay="0.3s">
      <?php
      $image_2 = $step_2['image'];
      ?>
      <div class="item-heading">
        <span><?php echo $step_2['caption_number']; ?></span>
        <span><?php echo $step_2['caption_text']; ?></span>
      </div>
      <figure>
        <img src="<?php echo $image_2['url']; ?>"
             alt="<?php echo $image_2['alt']; ?>">
      </figure>
      <h6 class="title"><?php echo $step_2['title']; ?></h6>
    </div>
    <div class="item wow fadeInUp" data-wow-delay="0.5s">
      <?php
      $image_3 = $step_3['image'];
      ?>
      <div class="item-heading">
        <span><?php echo $step_3['caption_number']; ?></span>
        <span><?php echo $step_3['caption_text']; ?></span>
      </div>
      <figure>
        <img src="<?php echo $image_3['url']; ?>"
             alt="<?php echo $image_3['alt']; ?>">
      </figure>
      <h6 class="title"><?php echo $step_3['title']; ?></h6>
    </div>
  </div>
  </div>
</section>
