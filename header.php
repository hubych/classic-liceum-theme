<?php
/**
 * Кастомний header для сайту гімназії.
 * Повністю замінює header.php батьківської теми Astra.
 */

defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
	<div class="site-header__inner">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<img
					src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.svg' ); ?>"
					alt="<?php bloginfo( 'name' ); ?>"
					class="site-header__logo-img"
					width="44" height="44"
				>
			<?php endif; ?>
			<span class="site-header__logo-text">
				<strong><?php bloginfo( 'name' ); ?></strong>
				<small><?php bloginfo( 'description' ); ?></small>
			</span>
		</a>

		<nav class="site-header__nav" aria-label="<?php esc_attr_e( 'Головна навігація', 'astra-child' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'site-header__menu',
				'fallback_cb'    => false,
				'depth'          => 2,
			) );
			?>
		</nav>

		<div class="site-header__actions">

			<button
				type="button"
				class="site-header__search-toggle"
				aria-label="<?php esc_attr_e( 'Пошук', 'astra-child' ); ?>"
				aria-expanded="false"
				aria-controls="site-header-search"
			>
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="1.5"/>
					<path d="M19 19L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
				</svg>
			</button>

			<?php
			$school_phone         = '+380322386986';
			$school_phone_display = '+38 (032) 238-69-86';
			if ( $school_phone ) :
			?>
				<a href="tel:<?php echo esc_attr( $school_phone ); ?>" class="site-header__phone">
					<?php echo esc_html( $school_phone_display ); ?>
				</a>
			<?php endif; ?>

			<button
				type="button"
				class="site-header__burger"
				aria-label="<?php esc_attr_e( 'Меню', 'astra-child' ); ?>"
				aria-expanded="false"
				aria-controls="site-header-mobile-nav"
			>
				<span></span><span></span><span></span>
			</button>

		</div>

	</div>

	<div class="site-header__search" id="site-header-search">
		<form role="search" method="get" class="site-header__search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input
				type="search"
				class="site-header__search-input"
				placeholder="<?php esc_attr_e( 'Пошук по сайту…', 'astra-child' ); ?>"
				value="<?php echo get_search_query(); ?>"
				name="s"
			>
			<button type="submit" class="site-header__search-submit"><?php esc_html_e( 'Знайти', 'astra-child' ); ?></button>
		</form>
	</div>

	<div class="site-header__mobile-nav" id="site-header-mobile-nav">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'site-header__mobile-menu',
			'fallback_cb'    => false,
			'depth'          => 2,
		) );
		?>
		<?php if ( isset( $school_phone ) && $school_phone ) : ?>
			<a href="tel:<?php echo esc_attr( $school_phone ); ?>" class="site-header__mobile-phone">
				<?php echo esc_html( $school_phone_display ); ?>
			</a>
		<?php endif; ?>
	</div>
</header>
