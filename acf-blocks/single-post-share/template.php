<?php
/**
 * Блок для шеринга статьи в социальных сетях
 */

// Получаем значения кастомных полей
$title = get_field('share_title', 'option') ?: 'Поделиться статьей';
$subtitle = get_field('share_subtitle', 'option') ?: 'Выберите социальную сеть';

// Получаем URL и заголовок текущей статьи
$post_url = get_permalink();
$post_url_encoded = urlencode($post_url);
$post_title = get_the_title();
$post_title_encoded = urlencode($post_title);

// Формируем массив с шаблонами URL для автоматической генерации
$share_url_templates = [
  'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$post_url_encoded}",
  'instagram' => "https://www.instagram.com/", // Instagram не поддерживает прямой шеринг, будем использовать JS
  'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url={$post_url_encoded}&title={$post_title_encoded}",
  'dribbble' => "https://dribbble.com/", // Dribbble не имеет стандартного URL для шеринга
  'tiktok' => "https://www.tiktok.com/", // TikTok не имеет стандартного URL для шеринга
  'upwork' => "https://www.upwork.com/", // Upwork не имеет стандартного URL для шеринга
  'clutch' => "https://clutch.co/" // Clutch не имеет стандартного URL для шеринга
];

// Генерируем уникальный ID для скрипта
$unique_id = uniqid('share-');

// Функция для определения режима шеринга
function get_sharing_mode($network)
{
  $standard_share = ['facebook', 'linkedin'];
  $clipboard_share = ['instagram', 'tiktok', 'dribbble', 'upwork', 'clutch'];

  if (in_array(strtolower($network), $standard_share)) {
    return 'standard';
  } elseif (in_array(strtolower($network), $clipboard_share)) {
    return 'clipboard';
  }

  return 'standard'; // По умолчанию
}

?>

<div id="<?php echo esc_attr($unique_id); ?>" class="post-share-block">
  <div class="post-share-header">
    <?php if ($title) : ?>
      <p class="post-share-title"><?php echo esc_html($title); ?></p>
    <?php endif; ?>

    <?php if ($subtitle) : ?>
      <p class="post-share-subtitle"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>
  </div>

  <div class="post-share-networks">
    <?php if (have_rows('social_networks', 'option')) : ?>
      <?php while (have_rows('social_networks', 'option')) : the_row();
        $network_name = get_sub_field('network_name');
        $network_slug = sanitize_title($network_name);
        $network_icon = get_sub_field('network_icon'); // ID изображения или массив с данными
        $custom_url = get_sub_field('custom_url');
        $use_auto_url = get_sub_field('use_auto_url');

        // Определяем URL для шеринга
        if ($use_auto_url && isset($share_url_templates[strtolower($network_slug)])) {
          $share_url = $share_url_templates[strtolower($network_slug)];
        } else {
          $share_url = $custom_url ?: '#';
        }

        // Определяем режим шеринга
        $sharing_mode = get_sharing_mode($network_slug);
        $share_class = ($sharing_mode === 'clipboard') ? 'share-clipboard' : 'share-standard';
        $data_attrs = ($sharing_mode === 'clipboard') ? 'data-url="' . esc_attr($post_url) . '" data-title="' . esc_attr($post_title) . '"' : '';
        ?>
        <a href="<?php echo esc_url($share_url); ?>"
           <?php if ($sharing_mode === 'standard'): ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>
           class="share-button share-<?php echo esc_attr($network_slug); ?> <?php echo esc_attr($share_class); ?>"
          <?php echo $data_attrs; ?>
           title="Share on <?php echo esc_attr($network_name); ?>" target="_blank">
          <?php if ($network_icon) : ?>
            <?php if (is_array($network_icon)) : ?>
              <img src="<?php echo esc_url($network_icon['url']); ?>"
                   alt="<?php echo esc_attr($network_name); ?>"
                   class="share-icon">
            <?php else : ?>
              <?php echo wp_get_attachment_image($network_icon, 'thumbnail', false, ['class' => 'share-icon']); ?>
            <?php endif; ?>
          <?php else : ?>
            <span class="share-icon-placeholder"><?php echo esc_html(substr($network_name, 0, 1)); ?></span>
          <?php endif; ?>
          <span class="screen-reader-text"><?php echo esc_html($network_name); ?></span>
        </a>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

  <!-- Всплывающее уведомление о копировании -->
  <div class="share-notification" style="display: none;">
    Link copied! Now you can share it on <?php echo esc_html($network_name); ?>
  </div>
</div>
