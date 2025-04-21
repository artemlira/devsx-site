<?php 

add_action('acf/init', 'devsx_register_acf_blocks');

function devsx_register_acf_blocks() {

    $blocks = [
        [
            'slug'        => 'services-hero',
            'title'       => __('DevsX - Services Hero Section', 'devsx'),
            'description' => __('Heding and text with media', 'devsx'),
            'icon'        => 'cover-image',
            'keywords'    => ['hero', 'banner', 'heading']
        ],
        [
            'slug'        => 'services-about',
            'title'       => __('DevsX - Services About', 'devsx'),
            'description' => __('About us block', 'devsx'),
            'icon'        => 'screenoptions',
            'keywords'    => ['services', 'about']
        ],
        [
            'slug'        => 'services-benefits',
            'title'       => __('DevsX - Services Benefits', 'devsx'),
            'description' => __('Benefits tiles', 'devsx'),
            'icon'        => 'screenoptions',
            'keywords'    => ['services', 'about']
        ],
        [
            'slug'        => 'services-how-it-works',
            'title'       => __('DevsX - Services How It Works', 'devsx'),
            'description' => __('Services list with titles and text', 'devsx'),
            'icon'        => 'screenoptions',
            'keywords'    => ['services', 'about']
        ],
        [
            'slug'        => 'heading-and-image',
            'title'       => __('DevsX - Heading & Image', 'devsx'),
            'description' => __('Block with heading and image', 'devsx'),
            'icon'        => 'screenoptions',
            'keywords'    => ['services', 'about']
        ],
        [
            'slug'        => 'services-hero-background',
            'title'       => __('DevsX - Hero Section with Background', 'devsx'),
            'description' => __('Block Hero Section with Background and Icon', 'devsx'),
            'icon'        => 'screenoptions',
            'keywords'    => ['services', 'about']
        ],
        [
            'slug'        => 'services-toggle-items',
            'title'       => __('DevsX -  Toggle Items', 'devsx'),
            'description' => __('Toggle items block with headings and text', 'devsx'),
            'icon'        => 'screenoptions',
            'keywords'    => ['services', 'about']
        ],
        [
            'slug'        => 'technologies-block',
            'title'       => __('DevsX -  Technologies Block', 'devsx'),
            'description' => __('Technologies Block with categories and names', 'devsx'),
            'icon'        => 'screenoptions',
            'keywords'    => ['services', 'about']
        ],
        //Technologies Block
        // Додавай скільки треба блоків
    ];

    foreach ($blocks as $block) {

        $slug = $block['slug'];

        acf_register_block_type([
            'name'              => $slug,
            'title'             => $block['title'],
            'description'       => $block['description'],
            'render_template'   => get_template_directory() . "/acf-blocks/{$slug}/template.php",
            'category'          => 'formatting',
            'icon'              => $block['icon'],
            'keywords'          => $block['keywords'],
            'enqueue_style'     => get_template_directory_uri() . "/acf-blocks/{$slug}/style.css",
            'enqueue_script'    => get_template_directory_uri() . "/acf-blocks/{$slug}/script.js",
            'mode'              => 'edit'
        ]);
    }

}



add_filter( 'body_class', 'devsx_add_custom_body_class' );

function devsx_add_custom_body_class( $classes ) {
    if ( is_singular() && get_field('show_transparent_header') ) {
        $classes[] = 'transparent_header';
    }
    return $classes;
}