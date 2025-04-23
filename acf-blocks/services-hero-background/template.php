<?php
$background = get_field('block_hero_section_with_background_url');
$title = get_field('block_hero_section_with_background_heading');
$icon = get_field('icon block_hero_section_with_background_icon_url');
$description = get_field('block_hero_section_with_background_text');
?>

<section class="devsx-services-hero-background  wow fadeIn" data-wow-delay="0.0s" <?php if ($background):?> style="background: url(<?php echo $background; ?>); background-size: cover;" <?php endif;?>>
    <div class="container">
    <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
            <?php devsx_breadcrumbs(); ?>
    </div>
        <div class="flex">
            <div class="col-50">
              <?php if ($title):?>
                <h1 class="wow fadeIn" data-wow-delay="0.3s"><?php echo $title; ?></h1>
              <?php endif;?>
              <?php if ($icon):?>
                <img class="wow fadeIn" data-wow-delay="0.5s" src="<?php echo $icon; ?>" alt="<?php echo $title; ?>">
              <?php endif;?>
            </div>
          <?php if ($description):?>
            <div class="col-50">
                <p class="h6 wow fadeIn" data-wow-delay="0.6s"><?php echo $description; ?></p>
            </div>
          <?php endif;?>
        </div>
    </div>
</section>