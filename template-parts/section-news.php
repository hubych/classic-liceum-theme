<?php
/**
 * Секція "Останні новини".
 * На відміну від Hero/About/Stats — контент тут НЕ з ACF,
 * а звичайні Записи (Posts) WordPress. Школа публікує новину
 * як звичний пост — секція сама підтягує 3 найновіші.
 */

defined( 'ABSPATH' ) || exit;

$news_title    = get_field( 'news_title' );
$news_subtitle = get_field( 'news_subtitle' );

// Шукаємо категорію саме за назвою "Новини" — вона точно збігається з тим,
// що ви бачите в адмінці, на відміну від ярлика (slug), який легко переплутати.
$news_category = get_term_by( 'name', 'Новини', 'category' );

$query_args = array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'ignore_sticky_posts' => true,
);

if ( $news_category ) {
	$query_args['cat'] = $news_category->term_id;
}

$news_query = new WP_Query( $query_args );

// Запасний варіант: якщо в категорії "Новини" ще нема постів (або її не знайдено),
// показуємо просто останні опубліковані записи, щоб секція не зникала мовчки.
if ( ! $news_query->have_posts() ) {
	$news_query = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'ignore_sticky_posts' => true,
	) );
}

// Посилання "Всі новини" — архів категорії "Новини", якщо вона є.
$all_news_link = $news_category ? get_category_link( $news_category ) : home_url( '/' );

if ( ! $news_query->have_posts() ) {
	return;
}
?>

<section class="news">
	<div class="news__inner">

		<div class="news__header">
			<div>
				<?php if ( $news_title ) : ?>
					<h2 class="news__title"><?php echo esc_html( $news_title ); ?></h2>
				<?php endif; ?>
				<?php if ( $news_subtitle ) : ?>
					<p class="news__subtitle"><?php echo esc_html( $news_subtitle ); ?></p>
				<?php endif; ?>
			</div>
			<a href="<?php echo esc_url( $all_news_link ); ?>" class="news__all-link">
				<?php esc_html_e( 'Всі новини', 'astra-child' ); ?>
			</a>
		</div>

		<div class="news__grid">
			<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
				<a href="<?php the_permalink(); ?>" class="news-card">
					<div class="news-card__image">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
						<?php endif; ?>
					</div>
					<div class="news-card__body">
						<span class="news-card__date"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></span>
						<h3 class="news-card__title"><?php the_title(); ?></h3>
					</div>
				</a>
			<?php endwhile; ?>
		</div>

	</div>
</section>
<?php
wp_reset_postdata();
