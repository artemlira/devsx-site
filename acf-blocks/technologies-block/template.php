


<?php
$section_title = get_field('block_technologies_heading');
$categories = get_field('technology_categories_repeater');

if ( !$categories ) return;
?>

<section class="technologies-block">
    <div class="container">
        <?php if ( $section_title ): ?>
            <h3 class="section-title h3 wow fadeInUp"><?php echo esc_html($section_title); ?></h3>
        <?php endif; ?>

        <div class="technologies-list ">
            <?php foreach ( $categories as $category ): 
                $category_name = $category['category_name'];
                $technologies = $category['technologies'];
            ?>

                <div class="technology-category flex">
                    <div class="category-title caption-text col-50 wow fadeInUp" data-wow-delay="0.1s"><?php echo esc_html($category_name); ?></div>

                    <?php if ( $technologies ): ?>
                        <ul class="technology-tags col-50">
                            <?php foreach ( $technologies as $tech ): ?>
                                <li class="technology-tag body-text-3 wow fadeInUp" data-wow-delay="0.3s">
                                    <?php echo esc_html( $tech['technology_name'] ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>