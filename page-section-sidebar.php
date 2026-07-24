<?php
/**
 * Template Name: Сторінка з боковим меню розділу
 *
 * Шаблон для сторінок розділу «Колектив» (і подібних) за макетом Figma:
 * ліворуч — бокове меню розділу, праворуч — заголовок і контент сторінки.
 *
 * Як користуватися:
 *  1. Створити сторінку (напр. «Колектив гімназії»), у блоці «Атрибути
 *     сторінки → Шаблон» обрати «Сторінка з боковим меню розділу».
 *  2. Наповнити боке меню: Зовнішній вигляд → Меню → створити меню,
 *     додати пункти й призначити локацію «Бокове меню — Колектив».
 *  3. Текст і фото сторінки редагуються звично в редакторі.
 *
 * Header і footer підключаються стандартно через get_header()/get_footer().
 */

defined( 'ABSPATH' ) || exit;

get_header();

$has_sidebar_menu = has_nav_menu( 'section_kolektyv' );
?>

<main id="main-content">
	<div class="section-page">
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
					<h1 class="section-page__title"><?php the_title(); ?></h1>
					<div class="section-page__body">
						<?php the_content(); ?>
					</div>

					<?php
					// Головне зображення сторінки (Featured image), якщо його
					// встановлено в редакторі. Так фото колективу показується
					// під текстом, навіть коли його не вставлено в сам контент.
					if ( has_post_thumbnail() ) :
						?>
						<figure class="section-page__thumbnail">
							<?php the_post_thumbnail( 'large' ); ?>
						</figure>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>

		</div>
	</div>
</main>

<?php
get_footer();
