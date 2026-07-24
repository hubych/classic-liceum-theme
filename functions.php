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
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap',
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

		// Бокове меню для сторінок розділу "Колектив" (шаблон
		// "Сторінка з боковим меню розділу"). Пункти додаються звично
		// через Зовнішній вигляд → Меню.
		'section_kolektyv' => __( 'Бокове меню — Колектив', 'astra-child' ),
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
 * Custom Post Type "Працівник" + таксономія "Підрозділ".
 *
 * Кожен працівник (адміністрація, вчителі тощо) — окремий запис:
 * ПІБ = заголовок, фото = Featured Image, решта (посада, предмет,
 * кваліфікація, стаж) — ACF-поля (див. inc/acf-fields.php).
 * Групуються таксономією "Підрозділ" (Адміністрація, кафедри…),
 * а сторінка-список кожного підрозділу — шаблон taxonomy-staff_group.php.
 */
add_action( 'init', function () {
	register_post_type( 'staff', array(
		'labels' => array(
			'name'          => __( 'Працівники', 'astra-child' ),
			'singular_name' => __( 'Працівник', 'astra-child' ),
			'add_new_item'  => __( 'Додати працівника', 'astra-child' ),
			'edit_item'     => __( 'Редагувати працівника', 'astra-child' ),
			'menu_name'     => __( 'Працівники', 'astra-child' ),
		),
		'public'       => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-businessperson',
		'supports'     => array( 'title', 'thumbnail', 'editor', 'page-attributes' ), // editor — для біографії у профілі; page-attributes — для сортування
		'has_archive'  => false,
		'rewrite'      => array( 'slug' => 'staff' ),
		'show_in_rest' => true,
	) );

	register_taxonomy( 'staff_group', 'staff', array(
		'labels' => array(
			'name'          => __( 'Підрозділи', 'astra-child' ),
			'singular_name' => __( 'Підрозділ', 'astra-child' ),
			'add_new_item'  => __( 'Додати підрозділ', 'astra-child' ),
			'edit_item'     => __( 'Редагувати підрозділ', 'astra-child' ),
			'menu_name'     => __( 'Підрозділи', 'astra-child' ),
		),
		'public'            => true,
		'hierarchical'      => true, // дозволяє кафедри як підтерми (напр. "Вчителі" → "Кафедра іноземних мов")
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'pidrozdil' ),
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

/**
 * Дата українською з назвою місяця в родовому відмінку — напр. "15 березня 2025".
 *
 * Працює НЕЗАЛЕЖНО від мови сайту: день/місяць/рік беремо як числа
 * (вони не залежать від локалі), а назву місяця підставляємо самі.
 * Використання в шаблонах: echo esc_html( school_date_uk() );
 *
 * @param int|WP_Post|null $post      Пост (за замовчуванням — поточний у циклі).
 * @param bool             $with_year Чи додавати рік (за замовчуванням — так).
 * @return string
 */
function school_date_uk( $post = null, $with_year = true ) {
	$months = array(
		1  => 'січня',
		2  => 'лютого',
		3  => 'березня',
		4  => 'квітня',
		5  => 'травня',
		6  => 'червня',
		7  => 'липня',
		8  => 'серпня',
		9  => 'вересня',
		10 => 'жовтня',
		11 => 'листопада',
		12 => 'грудня',
	);

	$day   = get_the_date( 'j', $post );
	$month = (int) get_the_date( 'n', $post );
	$year  = get_the_date( 'Y', $post );

	// Запасний варіант, якщо дату з якоїсь причини не вдалося прочитати.
	if ( ! isset( $months[ $month ] ) ) {
		return get_the_date( '', $post );
	}

	return $with_year
		? sprintf( '%s %s %s', $day, $months[ $month ], $year )
		: sprintf( '%s %s', $day, $months[ $month ] );
}

/**
 * Автоматична транслітерація кириличних слагів (URL) у латиницю.
 *
 * За замовчуванням WordPress лишає в URL кирилицю у вигляді %D0%BF...,
 * що виглядає нечитабельно. Цей фільтр перетворює українську кирилицю
 * на латиницю ДО стандартного очищення слага, тому має пріоритет 9
 * (раніше за вбудований sanitize_title_with_dashes на пріоритеті 10).
 *
 * УВАГА: діє лише на НОВІ слаги. Уже опубліковані пости зберігають свій
 * слаг — щоб оновити, треба перезберегти пост з очищеним полем "Ярлик".
 *
 * @param string $title Слаг-кандидат (може містити кирилицю).
 * @return string
 */
function school_transliterate_slug( $title ) {
	$cyr = array(
		'а', 'б', 'в', 'г', 'ґ', 'д', 'е', 'є', 'ж', 'з', 'и', 'і', 'ї', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ю', 'я', 'ъ', 'ы', 'э', 'ё',
		'А', 'Б', 'В', 'Г', 'Ґ', 'Д', 'Е', 'Є', 'Ж', 'З', 'И', 'І', 'Ї', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ь', 'Ю', 'Я', 'Ъ', 'Ы', 'Э', 'Ё',
	);
	$lat = array(
		'a', 'b', 'v', 'h', 'g', 'd', 'e', 'ie', 'zh', 'z', 'y', 'i', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'ts', 'ch', 'sh', 'shch', '', 'iu', 'ia', '', 'y', 'e', 'e',
		'A', 'B', 'V', 'H', 'G', 'D', 'E', 'Ie', 'Zh', 'Z', 'Y', 'I', 'I', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Kh', 'Ts', 'Ch', 'Sh', 'Shch', '', 'Iu', 'Ia', '', 'Y', 'E', 'E',
	);

	// Прибираємо апострофи (усі варіанти), щоб вони не ламали слаг.
	$title = str_replace( array( "'", '’', 'ʼ', '`' ), '', $title );

	return str_replace( $cyr, $lat, $title );
}
add_filter( 'sanitize_title', 'school_transliterate_slug', 9 );

/**
 * URL кореня розділу «Колектив» — перший пункт бокового меню розділу
 * (локація section_kolektyv). Використовується для посилання «Назад».
 * Якщо меню не призначено — повертає головну.
 *
 * @return string
 */
function school_section_root_url() {
	$locations = get_nav_menu_locations();

	if ( ! empty( $locations['section_kolektyv'] ) ) {
		$items = wp_get_nav_menu_items( $locations['section_kolektyv'] );
		if ( ! empty( $items ) && ! empty( $items[0]->url ) ) {
			return $items[0]->url;
		}
	}

	return home_url( '/' );
}

/**
 * На сторінці підрозділу (архів таксономії staff_group) показуємо всіх
 * працівників одразу й упорядковуємо за полем "Порядок" (page-attributes),
 * а за рівного порядку — за ПІБ.
 */
add_action( 'pre_get_posts', function ( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_tax( 'staff_group' ) ) {
		$query->set( 'posts_per_page', -1 );
		$query->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
		$query->set( 'order', 'ASC' );
	}
} );
