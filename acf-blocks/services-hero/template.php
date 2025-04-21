<section class="servises-hero"> 
        <div class="container">
            <div class="flex">
                <div class="col-50 hero-title wow fadeInUp" data-wow-delay="0.2s">
                    <h1><?php the_field('block_services_hero_title'); ?></h1>
                </div>
                <div class="col-50 hero-descripton wow fadeInUp" data-wow-delay="0.3s">
                    <p>
                    <?php the_field('block_services_hero_text'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="services-hero-animation wow fadeInUp" data-wow-delay="0.4s">
        <img src="<?php the_field('block_services_hero_media'); ?>" >
    </div>