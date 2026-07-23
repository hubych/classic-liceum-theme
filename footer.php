<?php
/**
 * Повний footer сайту.
 *
 * Соцмережі жорстко прописані нижче в масиві $social_links —
 * вони майже ніколи не змінюються, тож тримати їх у коді простіше,
 * ніж заводити для цього окремий ACF Options (Pro-фіча). Якщо школа
 * захоче змінити посилання — правиться один масив тут.
 *
 * Три меню у футері (footer_menu_1/2/3) редагуються звично через
 * Зовнішній вигляд → Меню. Заголовок кожної колонки береться
 * автоматично з НАЗВИ меню, яке призначено цій локації — тобто
 * щоб перейменувати колонку, достатньо перейменувати саме меню.
 */

defined( 'ABSPATH' ) || exit;

$social_links = array(
	'facebook'  => '',
	'instagram' => '',
	'youtube'   => '',
);

$social_icons = array(
	'facebook'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06C2 17.08 5.66 21.24 10.44 22V14.97H7.9v-2.91h2.54V9.85c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.91h-2.34V22C18.34 21.24 22 17.08 22 12.06Z"/></svg>',
	'instagram' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" stroke="none"/></svg>',
	'youtube'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="5.5" width="19" height="13" rx="3"/><path d="M10.5 9.5L15 12L10.5 14.5V9.5Z" fill="currentColor" stroke="none"/></svg>',
);

/**
 * Виводить одну колонку футер-меню. Якщо для локації ще не
 * призначено меню (Зовнішній вигляд → Меню) — колонка не виводиться.
 */
function school_footer_menu_column( $location ) {
	$locations = get_nav_menu_locations();

	if ( empty( $locations[ $location ] ) ) {
		return;
	}

	$menu = wp_get_nav_menu_object( $locations[ $location ] );

	if ( ! $menu ) {
		return;
	}
	?>
	<div class="site-footer__col">
		<h3 class="footer-col__title"><?php echo esc_html( $menu->name ); ?></h3>
		<?php
		wp_nav_menu( array(
			'theme_location' => $location,
			'container'      => false,
			'menu_class'     => 'footer-col__list',
			'fallback_cb'    => false,
		) );
		?>
	</div>
	<?php
}
?>

	<footer class="site-footer">
		<div class="site-footer__inner">

			<div class="site-footer__top">

				<div class="site-footer__brand">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php endif; ?>
						<span>
							<strong><?php bloginfo( 'name' ); ?></strong><br>
							<small><?php bloginfo( 'description' ); ?></small>
						</span>
					</a>

					<div class="site-footer__social">
						<?php foreach ( $social_links as $network => $url ) : ?>
							<?php if ( ! $url ) { continue; } ?>
							<a href="<?php echo esc_url( $url ); ?>" class="site-footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>">
								<?php echo $social_icons[ $network ]; // phpcs:ignore -- статичний довірений SVG ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>

				<?php
				school_footer_menu_column( 'footer_menu_1' );
				school_footer_menu_column( 'footer_menu_2' );
				school_footer_menu_column( 'footer_menu_3' );
				?>

				<div class="site-footer__col">
					<?php if ( is_active_sidebar( 'footer-contacts' ) ) : ?>
						<?php dynamic_sidebar( 'footer-contacts' ); ?>
					<?php else : ?>
						<h3 class="footer-col__title"><?php esc_html_e( 'Контакти', 'astra-child' ); ?></h3>
						<p class="footer-col__text">
							<?php esc_html_e( 'Додайте контакти через Зовнішній вигляд → Віджети → "Футер — Контакти"', 'astra-child' ); ?>
						</p>
					<?php endif; ?>
				</div>

			</div>

			<div class="site-footer__bottom">
				<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Усі права захищено.', 'astra-child' ); ?></p>
			</div>

		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
