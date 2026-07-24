<?php
/**
 * Повний footer сайту (за макетом Figma).
 *
 * Розкладка: зліва — бренд (лого + назва), слоган і соцмережі;
 * справа — три колонки меню. Знизу — розділювач, копірайт і правові посилання.
 *
 * Соцмережі жорстко прописані нижче в масиві $social_links —
 * вони майже ніколи не змінюються, тож тримати їх у коді простіше,
 * ніж заводити для цього окремий ACF Options (Pro-фіча). Іконки
 * показуються завжди (як у макеті); якщо URL порожній — кнопка веде на "#".
 * Щоб підставити реальні посилання — правиться один масив тут.
 *
 * Три меню у футері (footer_menu_1/2/3) редагуються звично через
 * Зовнішній вигляд → Меню. Заголовок кожної колонки береться
 * автоматично з НАЗВИ меню, яке призначено цій локації — тобто
 * щоб перейменувати колонку, достатньо перейменувати саме меню.
 */

defined( 'ABSPATH' ) || exit;

// Рік заснування гімназії — для копірайту виду "© 1992–2025 …".
$founding_year = 1992;

$social_links = array(
	'facebook'  => '', // напр. https://facebook.com/...
	'instagram' => '', // напр. https://instagram.com/...
	'youtube'   => '', // напр. https://youtube.com/@...
	'email'     => '', // напр. mailto:info@gymnasium.lviv.ua
);

$social_icons = array(
	'facebook'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06C2 17.08 5.66 21.24 10.44 22V14.97H7.9v-2.91h2.54V9.85c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.91h-2.34V22C18.34 21.24 22 17.08 22 12.06Z"/></svg>',
	'instagram' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" stroke="none"/></svg>',
	'youtube'   => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="5.5" width="19" height="13" rx="3"/><path d="M10.5 9.5L15 12L10.5 14.5V9.5Z" fill="currentColor" stroke="none"/></svg>',
	'email'     => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3.5 7l8.5 6 8.5-6"/></svg>',
);

// Правові посилання в нижньому рядку. Перше веде на сторінку політики
// конфіденційності з Налаштування → Приватність (якщо її призначено).
$legal_links = array(
	__( 'Політика конфіденційності', 'astra-child' ) => get_privacy_policy_url() ? get_privacy_policy_url() : '#',
	__( 'Умови використання', 'astra-child' )        => '#',
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

				<div class="site-footer__brand-block">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php endif; ?>
						<span>
							<strong><?php bloginfo( 'name' ); ?></strong>
							<small><?php bloginfo( 'description' ); ?></small>
						</span>
					</a>

					<p class="site-footer__tagline">
						<?php esc_html_e( 'Формуємо інтелектуальну еліту України через якісну освіту та виховання громадянської відповідальності', 'astra-child' ); ?>
					</p>

					<div class="site-footer__social">
						<?php foreach ( $social_links as $network => $url ) : ?>
							<a href="<?php echo esc_url( $url ? $url : '#' ); ?>" class="site-footer__social-link"<?php echo ( $url && 0 !== strpos( $url, 'mailto:' ) ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?> aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>">
								<?php echo $social_icons[ $network ]; // phpcs:ignore -- статичний довірений SVG ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="site-footer__menus">
					<?php
					school_footer_menu_column( 'footer_menu_1' );
					school_footer_menu_column( 'footer_menu_2' );
					school_footer_menu_column( 'footer_menu_3' );
					?>
				</div>

			</div>

			<div class="site-footer__bottom">
				<p class="site-footer__copyright">
					&copy; <?php echo esc_html( $founding_year ); ?>&ndash;<?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>
				</p>
				<div class="site-footer__legal">
					<?php foreach ( $legal_links as $label => $href ) : ?>
						<a href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $label ); ?></a>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
