<?php
/**
 * Сторінка результатів пошуку.
 *
 * Без цього файлу WordPress брав дефолтний шаблон Astra, тож результати
 * виглядали інакше за решту сайту (чужі стилі, сайдбар). Тут та сама
 * розкладка, що й в архіві категорії: сітка карток .news-card.
 *
 * Header і footer підключаються стандартно через get_header()/get_footer().
 */

defined( 'ABSPATH' ) || exit;

get_header();

global $wp_query;
$search_query = get_search_query();
$found        = (int) $wp_query->found_posts;
?>

<main id="main-content">
	<section class="archive search-results">
		<div class="archive__inner">

			<header class="archive__header">
				<h1 class="archive__title">
					<?php
					/* translators: %s — пошуковий запит. */
					printf( esc_html__( 'Результати пошуку: «%s»', 'astra-child' ), esc_html( $search_query ) );
					?>
				</h1>
				<?php if ( have_posts() ) : ?>
					<p class="archive__description">
						<?php
						/* translators: %d — кількість знайдених результатів. */
						printf( esc_html__( 'Знайдено результатів: %d', 'astra-child' ), $found );
						?>
					</p>
				<?php endif; ?>
			</header>

			<?php if ( have_posts() ) : ?>

				<div class="news__grid archive__grid">
					<?php while ( have_posts() ) : the_post(); ?>
						<a href="<?php the_permalink(); ?>" class="news-card">
							<div class="news-card__image">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
								<?php endif; ?>
							</div>
							<div class="news-card__body">
								<span class="news-card__date"><?php echo esc_html( school_date_uk() ); ?></span>
								<h3 class="news-card__title"><?php the_title(); ?></h3>
								<?php if ( get_the_excerpt() ) : ?>
									<p class="news-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
								<?php endif; ?>
							</div>
						</a>
					<?php endwhile; ?>
				</div>

				<div class="archive__pagination">
					<?php
					the_posts_pagination( array(
						'prev_text' => '←',
						'next_text' => '→',
					) );
					?>
				</div>

			<?php else : ?>

				<p class="archive__empty">
					<?php
					/* translators: %s — пошуковий запит. */
					printf( esc_html__( 'За запитом «%s» нічого не знайдено. Спробуйте інші слова.', 'astra-child' ), esc_html( $search_query ) );
					?>
				</p>

				<div class="search-results__form">
					<?php get_search_form(); ?>
				</div>

			<?php endif; ?>

		</div>
	</section>
</main>

<?php
get_footer();
