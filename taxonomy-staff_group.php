<?php
/**
 * Список працівників підрозділу (таксономія staff_group) — за макетом Figma.
 *
 * Обслуговує сторінки на кшталт «Адміністрація», а також кафедри розділу
 * «Вчителі». Ліворуч — бокове меню розділу (локація section_kolektyv),
 * праворуч — назва підрозділу, опис і картки працівників.
 *
 * Header і footer підключаються стандартно через get_header()/get_footer().
 */

defined( 'ABSPATH' ) || exit;

get_header();

$term             = get_queried_object();
$has_sidebar_menu = has_nav_menu( 'section_kolektyv' );

$icon_back  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>';
$icon_award = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="5"/><path d="M8.5 12.5L7 22l5-3 5 3-1.5-9.5"/></svg>';
?>

<main id="main-content">
	<div class="section-page">

		<a href="<?php echo esc_url( school_section_root_url() ); ?>" class="section-page__back">
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

				<header class="staff-list__header">
					<h1 class="section-page__title"><?php echo esc_html( $term->name ); ?></h1>
					<?php if ( ! empty( $term->description ) ) : ?>
						<p class="staff-list__subtitle"><?php echo esc_html( $term->description ); ?></p>
					<?php endif; ?>
				</header>

				<?php if ( have_posts() ) : ?>

					<div class="staff-list">
						<?php
						while ( have_posts() ) :
							the_post();

							$position      = get_field( 'staff_position' );
							$subject       = get_field( 'staff_subject' );
							$qualification = get_field( 'staff_qualification' );
							$experience    = get_field( 'staff_experience' );
							?>
							<a href="<?php the_permalink(); ?>" class="staff-card">
								<div class="staff-card__photo">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
									<?php endif; ?>
								</div>
								<div class="staff-card__info">
									<h2 class="staff-card__name"><?php the_title(); ?></h2>

									<?php if ( $position ) : ?>
										<p class="staff-card__position"><?php echo esc_html( $position ); ?></p>
									<?php endif; ?>

									<?php if ( $subject ) : ?>
										<p class="staff-card__subject">
											<span class="staff-card__label"><?php esc_html_e( 'Предмет:', 'astra-child' ); ?></span>
											<?php echo esc_html( $subject ); ?>
										</p>
									<?php endif; ?>

									<?php if ( $qualification ) : ?>
										<p class="staff-card__qual">
											<span class="staff-card__qual-icon"><?php echo $icon_award; // phpcs:ignore -- статичний довірений SVG ?></span>
											<?php echo esc_html( $qualification ); ?>
										</p>
									<?php endif; ?>

									<?php if ( $experience ) : ?>
										<p class="staff-card__exp">
											<span class="staff-card__label"><?php esc_html_e( 'Педагогічний стаж:', 'astra-child' ); ?></span>
											<?php echo esc_html( $experience ); ?>
										</p>
									<?php endif; ?>
								</div>
							</a>
						<?php endwhile; ?>
					</div>

				<?php else : ?>

					<p class="staff-list__empty"><?php esc_html_e( 'У цьому підрозділі поки немає працівників.', 'astra-child' ); ?></p>

				<?php endif; ?>

			</div>

		</div>
	</div>
</main>

<?php
get_footer();
