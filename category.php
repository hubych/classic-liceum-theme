<?php
/**
 * Архів категорії. Використовується насамперед для /category/novyny/
 * ("Всі новини" з головної сторінки веде саме сюди).
 *
 * Якщо в майбутньому з'являться інші категорії — цей файл
 * обслуговуватиме їх архіви теж, заголовок підлаштується сам.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content">
	<section class="archive">
		<div class="archive__inner">

			<header class="archive__header">
				<h1 class="archive__title"><?php single_cat_title(); ?></h1>
				<?php
				$description = category_description();
				if ( $description ) :
					?>
					<div class="archive__description"><?php echo wp_kses_post( $description ); ?></div>
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
								<span class="news-card__date"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></span>
								<h3 class="news-card__title"><?php the_title(); ?></h3>
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

				<p class="archive__empty"><?php esc_html_e( 'Поки що немає новин у цій категорії.', 'astra-child' ); ?></p>

			<?php endif; ?>

		</div>
	</section>
</main>

<?php
get_footer();
