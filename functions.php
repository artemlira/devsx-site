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
  wp_enqueue_style('devsx-swiper', 'https://cdn.jsdelivr.net/npm/swiper@7.4.0/swiper-bundle.min.css');
  wp_enqueue_style( 'devsx-style-animate', get_template_directory_uri() . '/css/animate.css', array(), _S_VERSION );
  wp_enqueue_style( 'devsx-theme-style-fonts', get_template_directory_uri() . '/css/fonts.css', array(), _S_VERSION );
  wp_enqueue_style( 'devsx-theme-style-main', get_template_directory_uri() . '/css/main.css', array(), _S_VERSION );
  wp_enqueue_style( 'devsx-theme-style-media', get_template_directory_uri() . '/css/media.css', array(), _S_VERSION );

  // JS
  wp_enqueue_script('devsx-slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);
  wp_enqueue_script('anime-js', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', array('jquery'), null, true);
  wp_enqueue_script('devsx-swiper', 'https://cdn.jsdelivr.net/npm/swiper@7.4.0/swiper-bundle.min.js', array('jquery'), '7.4.0', true);

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

add_filter('script_loader_tag', 'add_module_type_to_scripts', 10, 3);

function add_module_type_to_scripts($tag, $handle, $src) {
  if ('devsx-dotlottie-player-js' === $handle) {
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

      if (get_post_type() === 'post') {
        $blog_page_id = get_option('page_for_posts');
        if ($blog_page_id) {
          echo '<a href="' . get_permalink($blog_page_id) . '">' . get_the_title($blog_page_id) . '</a>';
        } else {
          echo '<a href="' . get_post_type_archive_link('post') . '">Blog</a>';
        }

        echo '<span class="separator"> / </span>';

        $category = get_the_category();
        if ($category) {
          $cat_link = get_category_link($category[0]->term_id);
          echo '<a href="' . esc_url($cat_link) . '">' . esc_html($category[0]->name) . '</a>';
          echo '<span class="separator"> / </span>';
        }
      } elseif (get_post_type() === 'cases') {
        echo '<a href="' . get_post_type_archive_link('cases') . '">' . apply_filters('cases_archive_title', 'Cases') . '</a>';
        echo '<span class="separator"> / </span>';

        $terms = get_the_terms(get_the_ID(), 'cases_rank');
        if ($terms && !is_wp_error($terms)) {
          $term = reset($terms);
          echo '<a href="' . get_term_link($term) . '">' . esc_html($term->name) . '</a>';
          echo '<span class="separator"> / </span>';
        }
      } else {
        $post_type_obj = get_post_type_object(get_post_type());
        if ($post_type_obj) {
          echo '<a href="' . get_post_type_archive_link(get_post_type()) . '">' . esc_html($post_type_obj->labels->name) . '</a>';
          echo '<span class="separator"> / </span>';
        }
      }

      echo '<span class="current">' . get_the_title() . '</span>';

    } elseif (is_category()) {

      $blog_page_id = get_option('page_for_posts');
      if ($blog_page_id) {
        echo '<a href="' . get_permalink($blog_page_id) . '">' . get_the_title($blog_page_id) . '</a>';
      } else {
        echo '<a href="' . home_url('/') . '">Blog</a>';
      }

      echo '<span class="separator"> / </span>';
      echo '<span class="current">' . single_cat_title('', false) . '</span>';

    } elseif (is_tag()) {

      $blog_page_id = get_option('page_for_posts');
      if ($blog_page_id) {
        echo '<a href="' . get_permalink($blog_page_id) . '">' . get_the_title($blog_page_id) . '</a>';
      } else {
        echo '<a href="' . home_url('/') . '">Blog</a>';
      }

      echo '<span class="separator"> / </span>';
      echo '<span class="current">' . single_tag_title('', false) . '</span>';

    } elseif (is_post_type_archive('cases')) {
      $archive_title = apply_filters('cases_archive_title', 'Cases');
      echo '<span class="current">' . esc_html($archive_title) . '</span>';
    } elseif (is_home()) {
      $blog_page_id = get_option('page_for_posts');
      if ($blog_page_id) {
        echo '<span class="current">' . get_the_title($blog_page_id) . '</span>';
      } else {
        echo '<span class="current">Блог</span>';
      }
    } elseif (is_tax()) {
      $term = get_queried_object();
      $taxonomy = get_taxonomy($term->taxonomy);
      $post_type = $taxonomy->object_type[0];
      $post_type_obj = get_post_type_object($post_type);

      if ($post_type_obj) {
        echo '<a href="' . get_post_type_archive_link($post_type) . '">' . esc_html($post_type_obj->labels->name) . '</a>';
        echo '<span class="separator"> / </span>';
      }

      echo '<span class="current">' . esc_html($term->name) . '</span>';
    } elseif (is_post_type_archive()) {
      $post_type_obj = get_post_type_object(get_post_type());
      if ($post_type_obj) {
        echo '<span class="current">' . esc_html($post_type_obj->labels->name) . '</span>';
      }
    } elseif (is_date()) {
      echo '<a href="' . get_permalink(get_option('page_for_posts')) . '">Blog</a>';
      echo '<span class="separator"> / </span>';

      if (is_day()) {
        echo '<span class="current">' . get_the_date() . '</span>';
      } elseif (is_month()) {
        echo '<span class="current">' . get_the_date('F Y') . '</span>';
      } elseif (is_year()) {
        echo '<span class="current">' . get_the_date('Y') . '</span>';
      }
    } elseif (is_author()) {
      echo '<a href="' . get_permalink(get_option('page_for_posts')) . '">Blog</a>';
      echo '<span class="separator"> / </span>';
      echo '<span class="current">' . get_the_author() . '</span>';
    } elseif (is_search()) {
      echo '<span class="current">Search results: ' . get_search_query() . '</span>';
    } elseif (is_404()) {
      // Для страницы 404
      echo '<span class="current">Page not found</span>';
    }

    echo '</nav>';
  }
}

add_filter( 'rest_url', function( $url ) {
  return str_replace( 'http://', 'https://', $url );
});

//Registering a new Post Type "Cases"
add_action('init', 'my_custom_init_cases');

function my_custom_init_cases()
{
  register_taxonomy('cases_rank', 'cases', array(
    'labels' => array(
      'name' => 'Cases Categories',
      'singular_name' => 'Case Category',
      'menu_name' => 'Cases Categories',
      'all_items' => 'Cases Categories',
      'edit_item' => 'Edit Case Category',
      'view_item' => 'View Case Category',
      'update_item' => 'Update Case Category',
      'add_new_item' => 'Add New Case Category',
      'new_item_name' => 'New Name Case Category',
      'search_items' => 'Search Cases Categories',
      'popular_items' => 'Popular Cases Categories',
      'not_found' => 'Not found Case Category',
      'back_to_items' => '← Back to Cases Categories',
    ),
    'show_in_quick_edit' => true,
    'show_admin_column' => true,
    'has_archive' => true,
    'hierarchical' => true,
  ));

  register_taxonomy('cases_tags', 'cases', array(
    'labels' => array(
      'name' => 'Case Tags',
      'singular_name' => 'Case Tag',
      'menu_name' => 'Case Tags',
      'all_items' => 'All Case Tags',
      'edit_item' => 'Edit Case Tag',
      'view_item' => 'View Case Tag',
      'update_item' => 'Update Case Tag',
      'add_new_item' => 'Add New Case Tag',
      'new_item_name' => 'New Case Tag Name',
      'search_items' => 'Search Case Tags',
      'popular_items' => 'Popular Case Tags',
      'not_found' => 'No Case Tags found',
      'back_to_items' => '← Back to Case Tags',
    ),
    'show_in_quick_edit' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'hierarchical' => false,
    'rewrite' => array('slug' => 'case-tag'),
  ));

  register_post_type('cases', array(
    'labels' => array(
      'name' => 'Cases',
      'singular_name' => 'Case',
      'add_new' => 'Add a Case',
      'add_new_item' => 'Add a Case',
      'edit_item' => 'Edit a Case',
      'new_item' => 'New a Case',
      'view_item' => 'View a Case',
      'search_items' => 'Search Case',
      'not_found' => 'Case not found',
      'not_found_in_trash' => 'Case not found in trash',
      'parent_item_colon' => '',
      'menu_name' => 'DevsX Cases'
    ),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => true,
    'menu_position' => 30,
    'menu_icon' => 'dashicons-portfolio',
    'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
//    'rewrite' => array('slug' => 'produkt', 'with_front' => false),
    'taxonomies' => array('cases_rank', 'cases_tags'),
  ));
}

//Registering a new Post Type "Career"
add_action('init', 'register_career_post_type');

function register_career_post_type()
{
  register_taxonomy('career_location', 'career', array(
    'labels' => array(
      'name'              => 'Locations',
      'singular_name'     => 'Location',
      'search_items'      => 'Search locations',
      'all_items'         => 'All locations',
      'parent_item'       => 'Parent location',
      'parent_item_colon' => 'Parent location:',
      'edit_item'         => 'Edit location',
      'update_item'       => 'Update location',
      'add_new_item'      => 'Add new location',
      'new_item_name'     => 'New location name',
      'menu_name'         => 'Locations',
    ),
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'career-location'),
    'show_in_rest'      => true,
  ));

  register_taxonomy('career_level', 'career', array(
    'labels' => array(
      'name'              => 'Levels',
      'singular_name'     => 'Level',
      'search_items'      => 'Search levels',
      'all_items'         => 'All levels',
      'parent_item'       => 'Parental level',
      'parent_item_colon' => 'Parental level:',
      'edit_item'         => 'Edit level',
      'update_item'       => 'Refresh level',
      'add_new_item'      => 'Add new level',
      'new_item_name'     => 'New level name',
      'menu_name'         => 'Levels',
    ),
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'career-level'),
    'show_in_rest'      => true,
  ));

  register_post_type('career', array(
    'labels' => array(
      'name'               => 'Career',
      'singular_name'      => 'Vacancy',
      'menu_name'          => 'DevsX Career',
      'add_new'            => 'Add a vacancy',
      'add_new_item'       => 'Add a new vacancy',
      'edit_item'          => 'Edit vacancy',
      'new_item'           => 'New vacancy',
      'view_item'          => 'View vacancy',
      'search_items'       => 'Search vacancies',
      'not_found'          => 'No vacancies found',
      'not_found_in_trash' => 'No vacancies found in the basket',
    ),
    'public'              => true,
    'has_archive'         => false,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 30,
    'menu_icon'           => 'dashicons-id-alt',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'rewrite'             => array('slug' => 'career'),
    'show_in_rest'        => true,
    'taxonomies' => array('career_location', 'career_level'),
  ));
}


if (function_exists('acf_add_options_page')) {
  acf_add_options_sub_page(array(
    'page_title'         => __('Cases Settings', 'devsx-theme'),
    'menu_title'         => __('Cases Settings', 'devsx-theme'),
    'menu_slug'          => 'cases-settings',
    'capability'         => 'edit_posts',
    'parent_slug'        => 'edit.php?post_type=cases',
    'position'           => false,
    'icon_slug'          => false
  ));
  acf_add_options_sub_page(array(
    'page_title'         => __('Blog Settings', 'devsx-theme'),
    'menu_title'         => __('Blog Settings', 'devsx-theme'),
    'menu_slug'          => 'blog-settings',
    'capability'         => 'edit_posts',
    'parent_slug'        => 'edit.php',
    'position'           => false,
    'icon_slug'          => false
  ));
  acf_add_options_sub_page(array(
    'page_title'         => __('Career Settings', 'devsx-theme'),
    'menu_title'         => __('Career Settings', 'devsx-theme'),
    'menu_slug'          => 'career-settings',
    'capability'         => 'edit_posts',
    'parent_slug'        => 'edit.php?post_type=career',
    'position'           => false,
    'icon_slug'          => false
  ));
}

/**
 * Register scripts and styles for Ajax request of blog page
 */
function devsx_blog_scripts() {
  wp_register_script(
    'blog-load-more',
    get_template_directory_uri() . '/js/blog-load-more.js',
    array('jquery'),
    '1.0.0',
    true
  );

  if (is_home() || is_archive() || is_search()) {
    wp_enqueue_script('blog-load-more');
  }
}
add_action('wp_enqueue_scripts', 'devsx_blog_scripts');

/**
 * Changing the URL structure for blog posts
 */
function devsx_custom_post_permalink($permalink, $post) {
  if ($post->post_type === 'post') {
    return home_url('/blog/' . basename($permalink));
  }
  return $permalink;
}
add_filter('post_link', 'devsx_custom_post_permalink', 10, 2);
add_filter('post_type_link', 'devsx_custom_post_permalink', 10, 2);

/**
 * Add a rewrite rule for the new URL structure
 */
function devsx_add_rewrite_rules() {
  add_rewrite_rule(
    '^blog/([^/]+)/?$',
    'index.php?name=$matches[1]',
    'top'
  );
}
add_action('init', 'devsx_add_rewrite_rules');

/**
 * AJAX handler for loading additional posts
 */
function devsx_load_more_posts() {
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'blog_load_more_nonce')) {
    wp_send_json_error('Security Error');
    die();
  }

  $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
  $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
  $tag = isset($_POST['tag']) ? sanitize_text_field($_POST['tag']) : '';

  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => $page,
    'post_status' => 'publish'
  );

  if (!empty($search)) {
    $args['s'] = $search;
  }

  if (!empty($tag)) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'post_tag',
        'field' => 'slug',
        'terms' => $tag,
      )
    );
  }

  $query = new WP_Query($args);
  $response = array();
  $html = '';

  if ($query->have_posts()) {
    ob_start();

    while ($query->have_posts()) {
      $query->the_post();
      ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
        <?php if (has_post_thumbnail()) : ?>
          <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('medium'); ?>
            </a>
          </div>
        <?php endif; ?>

        <div class="entry-content-wrapper">
          <div class="entry-meta">
            <span class="posted-on"><?php echo get_the_date(); ?></span>
          </div>

          <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>

          <div class="entry-content">
            <?php the_excerpt(); ?>
          </div>

          <div class="read-more">
            <a href="<?php the_permalink(); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M7 17L17 7M17 7H8M17 7V16" stroke="#F0F3FA" stroke-width="2" stroke-linecap="square"/>
              </svg>
            </a>
          </div>
        </div>
      </article>
      <?php
    }

    $html = ob_get_clean();
    wp_reset_postdata();

    $response['html'] = $html;
    $response['has_more'] = ($page < $query->max_num_pages);

    wp_send_json_success($response);
  } else {
    $response['html'] = '';
    $response['has_more'] = false;

    wp_send_json_success($response);
  }

  die();
}

add_action('wp_ajax_devsx_load_more_posts', 'devsx_load_more_posts');
add_action('wp_ajax_nopriv_devsx_load_more_posts', 'devsx_load_more_posts');

/**
 * ====================================================================================================================
 * Register scripts and styles for Ajax request of cases page
 */
function devsx_cases_scripts() {
  wp_register_script(
    'cases-load-more',
    get_template_directory_uri() . '/js/cases-load-more.js',
    array('jquery'),
    '1.0.0',
    true
  );

  // Localize the script with new data
  $script_data = array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('cases_load_more_nonce')
  );
  wp_localize_script('cases-load-more', 'ajax_object', $script_data);

  if (is_post_type_archive('cases') || is_tax('cases_rank') || is_tax('cases_tags')) {
    wp_enqueue_script('cases-load-more');
  }
}
add_action('wp_enqueue_scripts', 'devsx_cases_scripts');

/**
 * AJAX handler for loading additional cases
 */
function load_more_cases() {
  // Check security nonce
  if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'cases_load_more_nonce')) {
    wp_send_json_error('Security check failed');
    die();
  }

  $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
  $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 8;
  $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
  $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

  $args = array(
    'post_type' => 'cases',
    'posts_per_page' => $posts_per_page,
    'paged' => $page + 1,
    'post_status' => 'publish',
  );

  // Add category filter if specified
  if (!empty($category)) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'cases_rank',
        'field' => 'slug',
        'terms' => $category,
      )
    );
  }

  $query = new WP_Query($args);
  $response = array();
  $html = '';
  $count = 0;

  if ($query->have_posts()) {
    ob_start();

    while ($query->have_posts()) {
      $query->the_post();
      $count++;
      ?>
      <li class="section-cases-item">
        <?php if (has_post_thumbnail()) : ?>
          <a class="section-cases-item-image-wrapper" href="<?php the_permalink(); ?>"
             title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail('large'); ?>
          </a>
        <?php else: ?>
          <a class="section-cases-item-image-wrapper" href="<?php the_permalink(); ?>">
            <img
                src="<?php echo esc_url(get_template_directory_uri()); ?>/images/content/No-Image-Placeholder.png"
                alt="No image available"
                loading="lazy"
            >
          </a>
        <?php endif; ?>
        <div class="section-cases-item-info-wrapper">
          <h3 class="section-cases-item-title"><?php the_title(); ?></h3>
          <?php
          $terms = get_terms_in_order(get_the_ID(), 'cases_tags');

          if ($terms && !is_wp_error($terms)): ?>
            <div class="section-cases-item-tags">
              <?php foreach($terms as $term): ?>
                <span class="section-cases-item-tag"><?= $term->name; ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </li>
      <?php
    }

    $html = ob_get_clean();
    wp_reset_postdata();
  }

  wp_send_json_success(array(
    'html' => $html,
    'count' => $count,
    'has_more' => ($count >= $posts_per_page)
  ));

  die();
}

add_action('wp_ajax_load_more_cases', 'load_more_cases');
add_action('wp_ajax_nopriv_load_more_cases', 'load_more_cases');

/**
 * Helper function to get taxonomy terms in the order they were assigned to the post
 */
function get_terms_in_order($post_id, $taxonomy) {
  $terms = get_the_terms($post_id, $taxonomy);

  if (!$terms || is_wp_error($terms)) {
    return array();
  }

  return $terms;
}