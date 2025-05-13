<?php
$title_value = get_field('page_home_hero_title_value');
$title = get_field('page_home_hero_title');
$subtitle = get_field('page_home_hero_subtitle');
$video_url = get_field('page_home_hero_video');
$button = get_field('page_home_hero_button');
?>

<section class="home-hero">
  <video class="home-hero-video wow fadeIn" data-wow-delay="0.1s" autoplay muted playsinline data-wf-ignore="true"
         data-object-fit="cover">
    <source src="<?php echo $video_url; ?>" type="video/mp4">
    <p class="video-error"><?php esc_html_e('Your browser doesen\'t support HTML5 video', 'partybaby'); ?></p>
  </video>
  <div class="home-hero-video-mobile wow fadeIn" data-wow-delay="0.1s">
    <div class="overlay">
      <div class="video-action wow fadeIn" data-wow-delay="0.3s">
        <button id="play-video"></button>
        <span>PLAY VIDEO</span>
      </div>

    </div>
    <video id="hero-video-mobile" src="<?php echo $video_url; ?>" playsinline
           data-wf-ignore="true" data-object-fit="cover"
           poster="<?php echo get_template_directory_uri(); ?>/video/hero-video-poster.webp">>
      <source src="<?php echo $video_url; ?>" type="video/mp4">
      <p class="video-error"><?php esc_html_e('Your browser doesen\'t support HTML5 video', 'partybaby'); ?></p>
    </video>
  </div>
  <div class="container">
    <div class="hero-heading wow fadeIn" data-wow-delay="0.4s">
      <<?php echo $title_value; ?>><?php echo $title; ?></<?php echo $title_value; ?>>
    <p class="subheading-2 wow fadeIn" data-wow-delay="0.5s"><?php echo $subtitle; ?></p>
  </div>
  <div class="hero-cta wow fadeIn" data-wow-delay="0.6s">
    <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>">
      <button class="btn-80"><i></i><?php echo $button['title']; ?></button>
    </a>
  </div>
  </div>
</section>
