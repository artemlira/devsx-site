<?php
// ACF поля
$section_title = get_field('block_toggle_text_items_heading');
$services = get_field('block_toggle_text_items_items');

// Перевірка: якщо немає елементів — не рендеримо
if (!$services) {
    return;
}
?>

<section class="services-toggle-items">
    <div class="container">
        <?php if ($section_title): ?>
            <h3 class="section-title  wow fadeInUp" data-wow-delay="0.0s"><?php echo esc_html($section_title); ?></h3>
        <?php endif; ?>

        <?php foreach ($services as $index => $service): 
            $number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
            $title = $service['title'];
            $description = $service['description'];
            $additional_description = $service['additional_description'];
        ?>
            <div class="accordion-item active">
                <div class="accordion-header  wow fadeInUp">
                    <span class="accordion-number body-text-3 wow fadeInUp" data-wow-delay="0.0s"><?php echo esc_html($number); ?></span>
                    <h5 class="accordion-title h5 wow fadeInUp" data-wow-delay="0.2s"><?php echo esc_html($title); ?></h5>
                    <button class="accordion-toggle"></button>
                </div>
                <div class="accordion-content  wow fadeInUp" data-wow-delay="0.1s">
                
                    <div class="details-text caption-text wow fadeInUp" data-wow-delay="0.2s">
                        <?php echo esc_html($description); ?>
                    </div>
                    <?php if (!empty($additional_description)) : ?>
                        <div class="details-text additional body-text-1 wow fadeInUp" data-wow-delay="0.4s">
                            <?php echo esc_html($additional_description); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>