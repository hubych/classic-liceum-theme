<?php
/**
 * Astra Child - School
 * Підключення стилів, шрифтів, скриптів та реєстрація меню.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Стилі та шрифти
 */
add_action( 'wp_enqueue_scripts', function () {

	// Стилі батьківської теми Astra
	wp_enqueue_style(
		'astra-parent-style',
		get_template_directory_uri() . '/style.css'
	);

	// Стилі дочірньої теми (цей файл)
	wp_enqueue_style(
		'astra-child-style',
		get_stylesheet_uri(),
		array( 'astra-parent-style' ),
		'1.0.0'
	);

	// Google Fonts: Playfair Display (заголовки) + Inter (текст/UI)
	// TODO: коли сайт піде на прод — розглянути самостійний хостинг шрифтів
	// (плагін OMGF), щоб не тягнути запит на fonts.googleapis.com.
	wp_enqueue_style(
		'school-google-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	// Кастомні стилі під дизайн (header, і далі решта секцій)
	wp_enqueue_style(
		'school-custom',
		get_stylesheet_directory_uri() . '/assets/css/custom.css',
		array( 'astra-child-style' ),
		filemtime( get_stylesheet_directory() . '/assets/css/custom.css' )
	);

	// JS для мобільного меню header'а
	wp_enqueue_script(
		'school-header',
		get_stylesheet_directory_uri() . '/assets/js/header.js',
		array(),
		filemtime( get_stylesheet_directory() . '/assets/js/header.js' ),
		true
	);
} );

/**
 * Поля ACF для контенту секцій (див. inc/acf-fields.php).
 * Потребує безкоштовний плагін Advanced Custom Fields.
 */
require_once get_stylesheet_directory() . '/inc/acf-fields.php';

/**
 * Реєстрація місця для меню.
 * Після активації теми: Зовнішній вигляд → Меню → прив'язати меню
 * до локації "Головне меню".
 */
add_action( 'after_setup_theme', function () {
	register_nav_menus( array(
		'primary'      => __( 'Головне меню', 'astra-child' ),
		'footer_menu_1' => __( 'Футер — меню 1', 'astra-child' ),
		'footer_menu_2' => __( 'Футер — меню 2', 'astra-child' ),
		'footer_menu_3' => __( 'Футер — меню 3', 'astra-child' ),
	) );

	// Дозволяє використовувати Site Identity (лого, назва, опис)
	// з Налаштування → Загальні / Customizer, як у header.php.
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 60,
		'flex-height' => true,
		'flex-width'  => true,
	) );
} );

/**
 * Custom Post Type "Партнери".
 * Школа додає/видаляє партнера як звичайний запис:
 * назва партнера + лого (Featured Image) + посилання (ACF-поле нижче).
 * Це працює на безкоштовному ACF, бо CPT — не repeater-поле.
 */
add_action( 'init', function () {
	register_post_type( 'partner', array(
		'labels' => array(
			'name'          => __( 'Партнери', 'astra-child' ),
			'singular_name' => __( 'Партнер', 'astra-child' ),
			'add_new_item'  => __( 'Додати партнера', 'astra-child' ),
			'edit_item'     => __( 'Редагувати партнера', 'astra-child' ),
		),
		'public'       => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-groups',
		'supports'     => array( 'title', 'thumbnail', 'page-attributes' ), // page-attributes дає поле "Порядок" для сортування
		'has_archive'  => false,
		'rewrite'      => array( 'slug' => 'partners' ),
		'show_in_rest' => true,
	) );
} );

/**
 * Widget area у футері — для контактної інформації (адреса, e-mail тощо).
 * Наповнюється через Зовнішній вигляд → Віджети → блок "Текст" або "Custom HTML".
 */
add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'Футер — Контакти', 'astra-child' ),
		'id'            => 'footer-contacts',
		'description'   => __( 'Додайте віджет "Текст" з адресою, телефоном і поштою гімназії.', 'astra-child' ),
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer-col__title">',
		'after_title'   => '</h3>',
	) );
} );
