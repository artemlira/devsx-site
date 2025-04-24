<?php
$title_value = get_field('block_our_culture_heading_value');
$title = get_field('block_our_culture_heading');
$text = get_field('block_our_culture_text');
$author_info = get_field('block_our_culture_author_info');
$author_photo = $author_info['image'];
$author_name = $author_info['name'];
$author_post = $author_info['post'];
?>

<section class="devsx-our-culture  wow fadeIn" data-wow-delay="0.0s">
  <div class="container">
    <?php if ($title): ?>
    <<?php echo $title_value ?> class="wow fadeIn section-title"
    data-wow-delay="0.1s"><?php echo $title; ?></<?php echo $title_value ?>>
  <?php endif; ?>

  <div class="section-content">
   <div class="author-quote">
     <?php echo $text; ?>
   </div>
    <div class="section-author-info">
      <div class="author-image">
        <img
          src="<?php echo $author_photo['url']; ?>"
          alt="<?php echo $author_photo['alt']; ?>"
          loading="lazy"
        >
      </div>
      <div>
        <p class="author-name"><?php echo $author_name; ?></p>
        <p class="author-post"><?php echo $author_post; ?></p>
      </div>
    </div>
  </div>
  </div>
</section>