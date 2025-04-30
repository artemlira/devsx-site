<?php

add_action('acf/init', 'devsx_register_acf_blocks');

function devsx_register_acf_blocks() {

  $blocks = [
    [
      'slug'        => 'services-hero',
      'title'       => __('DevsX - Services Hero Section', 'devsx'),
      'description' => __('Heading and text with media', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['hero', 'banner', 'heading']
    ],
    [
      'slug'        => 'about-hero',
      'title'       => __('DevsX - About Hero Section', 'devsx'),
      'description' => __('Heading and text with media', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['hero', 'banner', 'heading', 'about']
    ],
    [
      'slug'        => 'career-hero',
      'title'       => __('DevsX - Career Hero Section', 'devsx'),
      'description' => __('Heading and text', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['hero', 'heading', 'career']
    ],
    [
      'slug'        => 'about-ideas',
      'title'       => __('DevsX - About Our Ideas Section', 'devsx'),
      'description' => __('Heading and text with media', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['about', 'ideas']
    ],
    [
      'slug'        => 'our-clients',
      'title'       => __('DevsX - Our Clients Section', 'devsx'),
      'description' => __('Heading and text', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['about', 'clients']
    ],
    [
      'slug'        => 'our-approach',
      'title'       => __('DevsX - Our Approach Section', 'devsx'),
      'description' => __('Heading and text', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['about', 'approach']
    ],
    [
      'slug'        => 'our-culture',
      'title'       => __('DevsX - Our Culture Section', 'devsx'),
      'description' => __('Heading and text and author', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['about', 'culture']
    ],
    [
      'slug'        => 'our-team-slider',
      'title'       => __('DevsX - Our Team Slider Section', 'devsx'),
      'description' => __('Heading and slider', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['about', 'team', 'slider']
    ],
    [
      'slug'        => 'contacts-bottom',
      'title'       => __('DevsX - Contacts Bottom Section', 'devsx'),
      'description' => __('Heading, buttons and image', 'devsx'),
      'icon'        => 'cover-image',
      'keywords'    => ['page', 'bottom', 'contacts']
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
    $template_path = get_template_directory() . "/acf-blocks/{$slug}/template.php";

    // Проверяем, существует ли файл шаблона
    if (!file_exists($template_path)) {
      continue; // Пропускаем регистрацию блока, если шаблон не найден
    }

    // Пути к файлам стилей и скриптов
    $style_path = get_template_directory() . "/acf-blocks/{$slug}/style.css";
    $script_path = get_template_directory() . "/acf-blocks/{$slug}/script.js";

    // Параметры блока
    $block_args = [
      'name'              => $slug,
      'title'             => $block['title'],
      'description'       => $block['description'],
      'render_template'   => $template_path,
      'category'          => 'formatting',
      'icon'              => $block['icon'],
      'keywords'          => $block['keywords'],
      'mode'              => 'edit'
    ];

    // Добавляем стиль только если файл существует
    if (file_exists($style_path)) {
      $block_args['enqueue_style'] = get_template_directory_uri() . "/acf-blocks/{$slug}/style.css";
    }

    // Добавляем скрипт только если файл существует
    if (file_exists($script_path)) {
      $block_args['enqueue_script'] = get_template_directory_uri() . "/acf-blocks/{$slug}/script.js";
    }

    // Регистрируем блок
    acf_register_block_type($block_args);
  }
}

add_filter('body_class', 'devsx_add_custom_body_class');

function devsx_add_custom_body_class($classes) {
  if (is_singular() && get_field('show_transparent_header')) {
    $classes[] = 'transparent_header';
  }
  return $classes;
}