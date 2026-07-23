<?php
/**
 * Секція "Про гімназію": текст + фото + 4 картки переваг.
 * Контент редагується через ACF на сторінці "Головна".
 *
 * Іконки карток — плейсхолдери, замінити на SVG з Figma за потреби
 * (те саме, що з іконками в Hero-секції).
 */

defined( 'ABSPATH' ) || exit;

$about_title    = get_field( 'about_title' );
$about_text     = get_field( 'about_text' );
$about_image    = get_field( 'about_image' );
$about_link_text = get_field( 'about_link_text' );
$about_link_url  = get_field( 'about_link_url' );

$advantage_cards = array(
	array(
		'title' => get_field( 'about_card1_title' ),
		'text'  => get_field( 'about_card1_text' ),
		'icon'  => 'user',
	),
	array(
		'title' => get_field( 'about_card2_title' ),
		'text'  => get_field( 'about_card2_text' ),
		'icon'  => 'teacher',
	),
	array(
		'title' => get_field( 'about_card3_title' ),
		'text'  => get_field( 'about_card3_text' ),
		'icon'  => 'ribbon',
	),
	array(
		'title' => get_field( 'about_card4_title' ),
		'text'  => get_field( 'about_card4_text' ),
		'icon'  => 'globe',
	),
);

function school_about_icon( $name ) {
	$icons = array(
		'user'    => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.5"/><path d="M5 20c1-3.5 4-5 7-5s6 1.5 7 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'teacher' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 8L12 4L21 8L12 12L3 8Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M7 10V15C7 15 9 17 12 17C15 17 17 15 17 15V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'ribbon'  => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="9" r="5" stroke="currentColor" stroke-width="1.5"/><path d="M9 13.5L7.5 21L12 18.5L16.5 21L15 13.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
		'globe'   => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.5"/><path d="M3.5 12H20.5M12 3.5C14.5 6 15.5 9 15.5 12C15.5 15 14.5 18 12 20.5C9.5 18 8.5 15 8.5 12C8.5 9 9.5 6 12 3.5Z" stroke="currentColor" stroke-width="1.5"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}
?>

<section class="about">
	<div class="about__inner">

		<div class="about__top">
			<div class="about__content">
				<?php if ( $about_title ) : ?>
					<h2 class="about__title"><?php echo esc_html( $about_title ); ?></h2>
				<?php endif; ?>

				<?php if ( $about_text ) : ?>
					<div class="about__text"><?php echo wp_kses_post( wpautop( $about_text ) ); ?></div>
				<?php endif; ?>

				<?php if ( $about_link_text ) : ?>
					<a href="<?php echo esc_url( $about_link_url ? $about_link_url : '#' ); ?>" class="about__link">
						<?php echo esc_html( $about_link_text ); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $about_image['url'] ) ) : ?>
				<div class="about__image">
					<img
						src="<?php echo esc_url( $about_image['url'] ); ?>"
						alt="<?php echo esc_attr( $about_image['alt'] ? $about_image['alt'] : ( $about_title ? $about_title : '' ) ); ?>"
						loading="lazy"
					>
				</div>
			<?php endif; ?>
		</div>

		<div class="about__cards">
			<?php foreach ( $advantage_cards as $card ) : ?>
				<?php if ( empty( $card['title'] ) ) { continue; } ?>
				<div class="advantage-card">
					<span class="advantage-card__icon"><?php echo school_about_icon( $card['icon'] ); ?></span>
					<h3 class="advantage-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
					<?php if ( $card['text'] ) : ?>
						<p class="advantage-card__text"><?php echo esc_html( $card['text'] ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
