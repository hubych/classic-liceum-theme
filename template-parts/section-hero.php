<?php
/**
 * Hero-секція головної сторінки.
 * Текст і посилання редагуються через ACF-поля на сторінці "Головна".
 *
 * Іконки карток — плейсхолдери (book / journal / medal).
 * Заміните на SVG, експортовані з Figma (Dev Mode → шар іконки → Export → SVG),
 * поклавши їх у assets/images/icons/ і підключивши тут за потреби.
 */

defined( 'ABSPATH' ) || exit;

$hero_title    = get_field( 'hero_title' );
$hero_subtitle = get_field( 'hero_subtitle' );

$cards = array(
	array(
		'title'    => get_field( 'hero_card1_title' ),
		'subtitle' => get_field( 'hero_card1_subtitle' ),
		'link'     => get_field( 'hero_card1_link' ),
		'icon'     => 'book',
	),
	array(
		'title'    => get_field( 'hero_card2_title' ),
		'subtitle' => get_field( 'hero_card2_subtitle' ),
		'link'     => get_field( 'hero_card2_link' ),
		'icon'     => 'journal',
	),
	array(
		'title'    => get_field( 'hero_card3_title' ),
		'subtitle' => get_field( 'hero_card3_subtitle' ),
		'link'     => get_field( 'hero_card3_link' ),
		'icon'     => 'medal',
	),
);

/**
 * Невеликий набір inline SVG-іконок за ключем.
 * Тримаємо в коді (не в БД) — легше стилізувати через currentColor.
 */
function school_hero_icon( $name ) {
	$icons = array(
		'book'    => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 5.5C4 4.67 4.67 4 5.5 4H11V20H5.5C4.67 20 4 19.33 4 18.5V5.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M20 5.5C20 4.67 19.33 4 18.5 4H13V20H18.5C19.33 20 20 19.33 20 18.5V5.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
		'journal' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="3" width="16" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M8 8H16M8 12H16M8 16H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'medal'   => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="9" r="5" stroke="currentColor" stroke-width="1.5"/><path d="M9 13.5L7.5 21L12 18.5L16.5 21L15 13.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}
?>

<section class="hero">
	<div class="hero__inner">

		<?php if ( $hero_title ) : ?>
			<h1 class="hero__title"><?php echo esc_html( $hero_title ); ?></h1>
		<?php endif; ?>

		<?php if ( $hero_subtitle ) : ?>
			<p class="hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
		<?php endif; ?>

		<div class="hero__cards">
			<?php foreach ( $cards as $card ) : ?>
				<?php if ( empty( $card['title'] ) ) { continue; } ?>
				<a
					class="hero-card"
					href="<?php echo esc_url( $card['link'] ? $card['link'] : '#' ); ?>"
				>
					<span class="hero-card__icon"><?php echo school_hero_icon( $card['icon'] ); ?></span>
					<span class="hero-card__text">
						<span class="hero-card__title"><?php echo esc_html( $card['title'] ); ?></span>
						<?php if ( $card['subtitle'] ) : ?>
							<span class="hero-card__subtitle"><?php echo esc_html( $card['subtitle'] ); ?></span>
						<?php endif; ?>
					</span>
					<span class="hero-card__arrow" aria-hidden="true">&rarr;</span>
				</a>
			<?php endforeach; ?>
		</div>

	</div>
</section>
