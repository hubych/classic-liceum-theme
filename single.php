<?php
/**
 * Шаблон окремого запису (новини) — за макетом Figma.
 *
 * Раніше окремий пост рендерився дефолтним шаблоном Astra (із сайдбаром
 * і чужими стилями), тому виглядав інакше за дизайн. Цей файл дає власну
 * розкладку: «Назад», заголовок, дата, головне зображення, текст статті
 * та секцію «Інші новини».
 *
 * Header і footer підключаються стандартно через get_header()/get_footer().
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Категорію "Новини" використовуємо і для кнопки "Назад" (веде до списку
// новин), і для добірки "Інші новини" нижче.
$news_category = get_term_by( 'name', 'Новини', 'category' );
$back_link     = $news_category ? get_category_link( $news_category ) : home_url( '/' );

// Іконки (inline SVG, як і в решті теми).
$icon_back     = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>';
$icon_calendar = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4.5" width="18" height="17" rx="3"/><path d="M3 9h18M8 2.5v4M16 2.5v4"/></svg>';
?>

<main id="main-content">
	<article class="single-post">
		<div class="single-post__inner">

			<a href="<?php echo esc_url( $back_link ); ?>" class="single-post__back">
				<?php echo $icon_back; // phpcs:ignore -- статичний довірений SVG ?>
				<span><?php esc_html_e( 'Назад', 'astra-child' ); ?></span>
			</a>

			<?php while ( have_posts() ) : the_post(); ?>

				<header class="single-post__header">
					<h1 class="single-post__title"><?php the_title(); ?></h1>
					<div class="single-post__meta">
						<?php echo $icon_calendar; // phpcs:ignore -- статичний довірений SVG ?>
						<span><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="single-post__thumbnail">
						<?php the_post_thumbnail( 'large' ); ?>
					</figure>
				<?php endif; ?>

				<div class="single-post__content">
					<?php the_content(); ?>
				</div>

			<?php endwhile; ?>

		</div>

		<?php
		// --- Інші новини ---
		$related_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => 2,
			'post_status'         => 'publish',
			'post__not_in'        => array( get_the_ID() ),
			'ignore_sticky_posts' => true,
		);

		if ( $news_category ) {
			$related_args['cat'] = $news_category->term_id;
		}

		$related_query = new WP_Query( $related_args );

		if ( $related_query->have_posts() ) :
			?>
			<section class="single-post__related">
				<div class="single-post__related-header">
					<h2 class="single-post__related-title"><?php esc_html_e( 'Інші новини', 'astra-child' ); ?></h2>
					<p class="single-post__related-subtitle"><?php esc_html_e( 'Слідкуйте за подіями нашої гімназії', 'astra-child' ); ?></p>
				</div>

				<div class="news__grid single-post__related-grid">
					<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
						<a href="<?php the_permalink(); ?>" class="news-card">
							<div class="news-card__image">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
								<?php endif; ?>
							</div>
							<div class="news-card__body">
								<span class="news-card__date"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
								<h3 class="news-card__title"><?php the_title(); ?></h3>
								<?php if ( get_the_excerpt() ) : ?>
									<p class="news-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
								<?php endif; ?>
							</div>
						</a>
					<?php endwhile; ?>
				</div>
			</section>
			<?php
			wp_reset_postdata();
		endif;
		?>

	</article>
</main>

<?php
get_footer();
