<?php
/**
 * DevsX Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DevsX_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function devsx_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on DevsX Theme, use a find and replace
		* to change 'devsx-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'devsx-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'devsx-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'devsx_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'devsx_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function devsx_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'devsx_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'devsx_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function devsx_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'devsx-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'devsx-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'devsx_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'devsx_theme_scripts' );

function devsx_theme_scripts() {
  wp_enqueue_style( 'devsx-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
  wp_style_add_data( 'devsx-theme-style', 'rtl', 'replace' );

  // CSS
  wp_enqueue_style('devsx-slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
  wp_enqueue_style('devsx-slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
  wp_enqueue_style( 'devsx-style-animate', get_template_directory_uri() . '/css/animate.css', array(), _S_VERSION );
  wp_enqueue_style( 'devsx-theme-style-fonts', get_template_directory_uri() . '/css/fonts.css', array(), _S_VERSION );
  wp_enqueue_style( 'devsx-theme-style-main', get_template_directory_uri() . '/css/main.css', array(), _S_VERSION );
  wp_enqueue_style( 'devsx-theme-style-media', get_template_directory_uri() . '/css/media.css', array(), _S_VERSION );

  // JS
  wp_enqueue_script('devsx-slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);
  wp_enqueue_script('anime-js', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', array('jquery'), null, true);

  // Регистрируем скрипт dotlottie-player, но не подключаем его сразу
  if (!is_admin()) {
    wp_enqueue_script( 'devsx-wow-js', get_template_directory_uri() . '/js/wow.js', array('jquery'), _S_VERSION, true );
    wp_register_script('devsx-dotlottie-player-js', 'https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs', array(), null, true);
    wp_enqueue_script('devsx-dotlottie-player-js');
  }

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  wp_enqueue_script( 'devsx-theme-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), _S_VERSION, true );
}

// Добавляем фильтр для изменения тега script
add_filter('script_loader_tag', 'add_module_type_to_scripts', 10, 3);

function add_module_type_to_scripts($tag, $handle, $src) {
  if ('devsx-dotlottie-player-js' === $handle) {
    // Заменяем стандартный тег script на тег с атрибутом type="module"
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
  }
  return $tag;
}

add_action( 'admin_enqueue_scripts', 'devsx_enqueue_block_editor_assets' );

function devsx_enqueue_block_editor_assets() {

	// CSS (бажано не підключати глобально в адмінці, але якщо треба — ось як)
	wp_enqueue_style( 'devsx-editor-slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' );
	wp_enqueue_style( 'devsx-editor-slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css' );
	wp_enqueue_style( 'devsx-editor-admin', get_template_directory_uri() . '/css/admin.css', array(), _S_VERSION );
	wp_enqueue_style( 'devsx-editor-animate', get_template_directory_uri() . '/css/animate.css', array(), _S_VERSION );
	wp_enqueue_style( 'devsx-editor-fonts', get_template_directory_uri() . '/css/fonts.css', array(), _S_VERSION );
	wp_enqueue_style( 'devsx-editor-main', get_template_directory_uri() . '/css/main.css', array(), _S_VERSION );
	wp_enqueue_style( 'devsx-editor-media', get_template_directory_uri() . '/css/media.css', array(), _S_VERSION );

	// JS
	wp_enqueue_script( 'devsx-editor-slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'devsx-editor-anime-js', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', array('jquery'), null, true );
	//wp_enqueue_script( 'devsx-editor-dotlottie-js', 'https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs', array('jquery'), null, true );
	//wp_enqueue_script( 'devsx-editor-wow-js', get_template_directory_uri() . '/js/wow.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'devsx-editor-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), _S_VERSION, true );
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * ACF Guttenberg Blocks
 */
require get_template_directory() . '/inc/acf-blocks.php';



function devsx_breadcrumbs() {
    if (!is_front_page()) {

        echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';

        echo '<a href="' . home_url() . '" class="breadcrumb-home">';
        echo '<img src="' . get_template_directory_uri() . '/images/svg/home.svg" alt="Home">';
        echo '</a>';

        echo '<span class="separator"> / </span>';

        if (is_page()) {

            global $post;
            $parents = get_post_ancestors($post);

            if ($parents) {
                $parents = array_reverse($parents);

                foreach ($parents as $parent) {
                    echo '<a href="' . get_permalink($parent) . '">' . get_the_title($parent) . '</a>';
                    echo '<span class="separator"> / </span>';
                }
            }

            echo '<span class="current">' . get_the_title() . '</span>';

        } elseif (is_single()) {

            $category = get_the_category();
            if ($category) {
                $cat_link = get_category_link($category[0]->term_id);
                echo '<a href="' . esc_url($cat_link) . '">' . esc_html($category[0]->name) . '</a>';
                echo '<span class="separator"> / </span>';
            }

            echo '<span class="current">' . get_the_title() . '</span>';

        } elseif (is_category()) {

            echo '<span class="current">' . single_cat_title('', false) . '</span>';

        } elseif (is_tag()) {

            echo '<span class="current">' . single_tag_title('', false) . '</span>';

        }

        echo '</nav>';
    }
}

add_filter( 'rest_url', function( $url ) {
  return str_replace( 'http://', 'https://', $url );
});
