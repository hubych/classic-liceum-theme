<?php
/**
 * Секція "Наші партнери".
 * Кожен партнер — окремий запис CPT "partner": назва, лого (Featured Image),
 * необов'язкове посилання (ACF-поле partner_link).
 */

defined( 'ABSPATH' ) || exit;

$partners_query = new WP_Query( array(
	'post_type'      => 'partner',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );

if ( ! $partners_query->have_posts() ) {
	return;
}
?>

<section class="partners">
	<div class="partners__inner">
		<h2 class="partners__title"><?php esc_html_e( 'Наші партнери', 'astra-child' ); ?></h2>

		<div class="partners__row">
			<?php while ( $partners_query->have_posts() ) : $partners_query->the_post(); ?>
				<?php
				$partner_link = get_field( 'partner_link' );
				$logo_html    = has_post_thumbnail()
					? get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'partners__logo-img', 'alt' => get_the_title(), 'loading' => 'lazy' ) )
					: '<span class="partners__logo-fallback">' . esc_html( get_the_title() ) . '</span>';
				?>
				<?php if ( $partner_link ) : ?>
					<a href="<?php echo esc_url( $partner_link ); ?>" class="partners__logo" target="_blank" rel="noopener noreferrer">
						<?php echo $logo_html; // phpcs:ignore -- trusted markup з get_the_post_thumbnail ?>
					</a>
				<?php else : ?>
					<span class="partners__logo">
						<?php echo $logo_html; // phpcs:ignore ?>
					</span>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php
wp_reset_postdata();
