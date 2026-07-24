<?php
/**
 * Профіль окремого працівника (CPT staff) — за макетом Figma.
 *
 * Ліворуч — бокове меню розділу, праворуч — картка профілю: фото, ПІБ,
 * посада, блок фактів (категорія, стаж, освіта, робота) та детальний
 * контент (Педагогічне дослідження, Громадська діяльність, Особисті
 * досягнення, Сертифікати), який наповнюється у редакторі запису.
 *
 * Header і footer підключаються стандартно через get_header()/get_footer().
 */

defined( 'ABSPATH' ) || exit;

get_header();

$has_sidebar_menu = has_nav_menu( 'section_kolektyv' );

// Посилання "Назад" — до списку підрозділу, до якого належить працівник.
$terms    = get_the_terms( get_the_ID(), 'staff_group' );
$back_url = school_section_root_url();
if ( $terms && ! is_wp_error( $terms ) ) {
	$term_link = get_term_link( $terms[0] );
	if ( ! is_wp_error( $term_link ) ) {
		$back_url = $term_link;
	}
}

$icon_back = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>';

// Іконки для блоку фактів.
$fact_icons = array(
	'category'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="5"/><path d="M8.5 12.5L7 22l5-3 5 3-1.5-9.5"/></svg>',
	'experience' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',
	'education'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3L1 9l11 6 9-4.9V17"/><path d="M5 11.5V16c0 1.5 3.1 3 7 3s7-1.5 7-3v-4.5"/></svg>',
	'work'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>',
);

// Факти профілю: тільки заповнені поля.
$facts = array(
	array( 'icon' => 'category',   'label' => __( 'Категорія', 'astra-child' ),        'value' => get_field( 'staff_qualification' ) ),
	array( 'icon' => 'experience', 'label' => __( 'Педагогічний стаж', 'astra-child' ), 'value' => get_field( 'staff_experience' ) ),
	array( 'icon' => 'education',   'label' => __( 'Освіта', 'astra-child' ),           'value' => get_field( 'staff_education' ) ),
	array( 'icon' => 'work',        'label' => __( 'Робота у гімназії', 'astra-child' ), 'value' => get_field( 'staff_work_start' ) ),
);

$position = get_field( 'staff_position' );
?>

<main id="main-content">
	<div class="section-page">

		<a href="<?php echo esc_url( $back_url ); ?>" class="section-page__back">
			<?php echo $icon_back; // phpcs:ignore -- статичний довірений SVG ?>
			<span><?php esc_html_e( 'Назад', 'astra-child' ); ?></span>
		</a>

		<div class="section-page__inner<?php echo $has_sidebar_menu ? '' : ' section-page__inner--no-sidebar'; ?>">

			<?php if ( $has_sidebar_menu ) : ?>
				<aside class="section-page__sidebar">
					<nav class="section-nav" aria-label="<?php esc_attr_e( 'Меню розділу', 'astra-child' ); ?>">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'section_kolektyv',
							'container'      => false,
							'menu_class'     => 'section-nav__list',
							'fallback_cb'    => false,
							'depth'          => 0,
						) );
						?>
					</nav>
				</aside>
			<?php endif; ?>

			<div class="section-page__content">
				<?php while ( have_posts() ) : the_post(); ?>

					<article class="staff-profile">

						<div class="staff-profile__head">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="staff-profile__photo">
									<?php the_post_thumbnail( 'medium_large' ); ?>
								</div>
							<?php endif; ?>

							<div class="staff-profile__intro">
								<h1 class="staff-profile__name"><?php the_title(); ?></h1>

								<?php if ( $position ) : ?>
									<p class="staff-profile__position"><?php echo esc_html( $position ); ?></p>
								<?php endif; ?>

								<ul class="staff-profile__facts">
									<?php foreach ( $facts as $fact ) : ?>
										<?php if ( empty( $fact['value'] ) ) { continue; } ?>
										<li class="staff-fact">
											<span class="staff-fact__icon"><?php echo $fact_icons[ $fact['icon'] ]; // phpcs:ignore -- статичний довірений SVG ?></span>
											<span class="staff-fact__text">
												<span class="staff-fact__label"><?php echo esc_html( $fact['label'] ); ?></span>
												<span class="staff-fact__value"><?php echo esc_html( $fact['value'] ); ?></span>
											</span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>

						<?php if ( get_the_content() ) : ?>
							<div class="staff-profile__body">
								<?php the_content(); ?>
							</div>
						<?php endif; ?>

					</article>

				<?php endwhile; ?>
			</div>

		</div>
	</div>
</main>

<?php
get_footer();
