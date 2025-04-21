<?php
$title = get_field('block_services_how_it_works_heading');
$steps = get_field('block_services_how_it_works_steps');

if (!$steps) {
    return; // Немає етапів - нічого не показуємо
}
?>

<section class="services-overview how-it-works">
    <div class="container">
        <?php if ($title): ?>
            <div class="services-section-heading wow fadeInUp">
                <h3 class="h3"><?php echo esc_html($title); ?></h3>
            </div>
        <?php endif; ?>

        <div class="services-overview-content">
            <?php foreach ($steps as $index => $step): ?>
                <div class="flex">
                    <div class="col-50">
                        <div class="caption-text wow fadeInUp" data-wow-delay="0.1s">
                            <?php echo esc_html($step['step_title']); ?>
                        </div>
                        <div class="caption-text duration wow fadeInUp" data-wow-delay="0.2s">
                            <?php echo esc_html($step['step_duration']); ?>
                        </div>
                    </div>
                    <div class="col-50">
                        <?php if (!empty($step['body_text_1'])): ?>
                            <div class="body-text-1 wow fadeInUp" data-wow-delay="0.3s">
                                <?php echo wp_kses_post($step['body_text_1']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($step['body_text_2'])): ?>
                            <div class="body-text-3 wow fadeInUp" data-wow-delay="0.4s">
                                <?php echo wp_kses_post($step['body_text_2']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>