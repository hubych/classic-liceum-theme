<?php
/**
 * Шаблон статичної головної сторінки.
 * WordPress автоматично використовує цей файл для головної,
 * якщо в Налаштування → Читання обрано "Статична сторінка" і призначено Home.
 *
 * Секції підключаються по одній через get_template_part —
 * далі додамо "about", "stats", "news" і т.д. тим самим способом.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content">
	<?php get_template_part( 'template-parts/section', 'hero' ); ?>
	<?php get_template_part( 'template-parts/section', 'about' ); ?>
	<?php get_template_part( 'template-parts/section', 'stats' ); ?>
	<?php get_template_part( 'template-parts/section', 'news' ); ?>
	<?php get_template_part( 'template-parts/section', 'partners' ); ?>
	<?php get_template_part( 'template-parts/section', 'gallery' ); ?>
</main>

<?php
get_footer();
