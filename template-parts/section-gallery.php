<?php
/**
 * Секція "Галерея активностей школи" — 3 фото з ACF.
 */

defined( 'ABSPATH' ) || exit;

$gallery_title    = get_field( 'gallery_title' );
$gallery_subtitle = get_field( 'gallery_subtitle' );

$images = array(
	get_field( 'gallery_image1' ),
	get_field( 'gallery_image2' ),
	get_field( 'gallery_image3' ),
);

$has_any_image = false;
foreach ( $images as $img ) {
	if ( ! empty( $img['url'] ) ) {
		$has_any_image = true;
		break;
	}
}

if ( ! $has_any_image ) {
	return;
}
?>

<section class="gallery">
	<div class="gallery__inner">

		<?php if ( $gallery_title ) : ?>
			<h2 class="gallery__title"><?php echo esc_html( $gallery_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $gallery_subtitle ) : ?>
			<p class="gallery__subtitle"><?php echo esc_html( $gallery_subtitle ); ?></p>
		<?php endif; ?>

		<div class="gallery__grid">
			<?php foreach ( $images as $img ) : ?>
				<?php if ( empty( $img['url'] ) ) { continue; } ?>
				<div class="gallery__item">
					<img
						src="<?php echo esc_url( $img['sizes']['medium_large'] ?? $img['url'] ); ?>"
						alt="<?php echo esc_attr( $img['alt'] ? $img['alt'] : ( $gallery_title ? $gallery_title : '' ) ); ?>"
						loading="lazy"
					>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
