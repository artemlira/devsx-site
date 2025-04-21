<section class="devsx-services-hero-background  wow fadeIn" data-wow-delay="0.0s" style="background: url(<?php the_field('block_hero_section_with_background_url'); ?>); background-size: cover;">
    <div class="container">
    <div class="page-breadcrumps wow fadeIn" data-wow-delay="0.1s">
        
            <?php devsx_breadcrumbs(); ?>
       
    </div>
        <div class="flex">
            <div class="col-50">
                <h1 class="wow fadeIn" data-wow-delay="0.3s"><?php the_field('block_hero_section_with_background_heading'); ?></h1>
                <img class="wow fadeIn" data-wow-delay="0.5s" src="<?php the_field('icon block_hero_section_with_background_icon_url'); ?>" alt="<?php the_field('block_hero_section_with_background_heading'); ?>"> 
            </div>
            <div class="col-50">
                <p class="h6 wow fadeIn" data-wow-delay="0.6s"><?php the_field('block_hero_section_with_background_text'); ?></p>
            </div>
        </div>
    </div>
</section>