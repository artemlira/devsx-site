<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DevsX_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<?php
if (get_field('show_transparent_header')) : $bodyClass = "transparent_header"; ?>

<?php endif; ?>
<body <?php body_class(); ?> class="<?php echo $bodyClass; ?>">
<?php wp_body_open(); ?>
<main id="page" class="site">

  <header id="masthead" class="site-header">
    <div class="container">
      <div class="flex aling-center justify-space-between">
        <div class="site-branding">
          <a href="/" rel="home">
            <img src="<?php echo get_template_directory_uri() ?>/images/svg/devsx-logo.svg"
                 alt="<?php bloginfo('name'); ?>">
          </a>
        </div>
        <nav id="site-navigation body-text-3" class="main-navigation">
          <button class="menu-toggle" aria-controls="primary-menu"
                  aria-expanded="false"><?php esc_html_e('Primary Menu', 'devsx-theme'); ?></button>
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'menu-1',
              'menu_id' => 'primary-menu',
            )
          );
          ?>
        </nav>
        <div class="header-cta">
          <a href="#">
            <button class="btn-52"><i></i><span>Lets Chat</span></button>
          </a>
        </div>
        <button class="header-burger"></button>
        <button class="close-mobile-menu"></button>
        <div class="mobile-menu">
          <div class="mobile-menu-inner">
            <?php
            wp_nav_menu(
              array(
                'theme_location' => 'menu-1',
                'menu_id' => 'primary-menu',
              )
            );
            ?>
            <div class="header-cta header-cta-mobile">
              <a href="#">
                <button class="btn-80"><i></i><span>Lets Chat</span></button>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </header>


