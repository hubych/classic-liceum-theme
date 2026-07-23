<?php
/**
 * Поля ACF для секцій головної сторінки.
 *
 * Реєструємо через PHP (acf_add_local_field_group), а не через адмінку —
 * так поля живуть у коді теми, версіюються і переносяться разом із сайтом
 * без експорту/імпорту JSON вручну.
 *
 * Вимагає безкоштовний плагін "Advanced Custom Fields".
 */

defined( 'ABSPATH' ) || exit;

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key'      => 'group_home_hero',
		'title'    => 'Головна — Hero секція',
		'fields'   => array(

			array(
				'key'   => 'field_hero_title',
				'label' => 'Заголовок',
				'name'  => 'hero_title',
				'type'  => 'text',
				'default_value' => 'Класична гімназія при ЛНУ м. І. Франка',
			),
			array(
				'key'   => 'field_hero_subtitle',
				'label' => 'Підзаголовок',
				'name'  => 'hero_subtitle',
				'type'  => 'textarea',
				'rows'  => 2,
				'default_value' => 'Формуємо інтелектуальну еліту України через якісну освіту, виховання громадянської відповідальності та розвиток творчого потенціалу',
			),

			// --- Картка 1 ---
			array(
				'key'   => 'field_hero_card1_tab',
				'label' => 'Картка 1',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_hero_card1_title',
				'label' => 'Заголовок картки 1',
				'name'  => 'hero_card1_title',
				'type'  => 'text',
				'default_value' => 'Навчання',
			),
			array(
				'key'   => 'field_hero_card1_subtitle',
				'label' => 'Підпис картки 1',
				'name'  => 'hero_card1_subtitle',
				'type'  => 'text',
				'default_value' => 'Програми та вступ',
			),
			array(
				'key'   => 'field_hero_card1_link',
				'label' => 'Посилання картки 1',
				'name'  => 'hero_card1_link',
				'type'  => 'url',
			),

			// --- Картка 2 ---
			array(
				'key'   => 'field_hero_card2_tab',
				'label' => 'Картка 2',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_hero_card2_title',
				'label' => 'Заголовок картки 2',
				'name'  => 'hero_card2_title',
				'type'  => 'text',
				'default_value' => 'Електронний Журнал',
			),
			array(
				'key'   => 'field_hero_card2_subtitle',
				'label' => 'Підпис картки 2',
				'name'  => 'hero_card2_subtitle',
				'type'  => 'text',
				'default_value' => 'Оцінки і відвідуваність',
			),
			array(
				'key'   => 'field_hero_card2_link',
				'label' => 'Посилання картки 2',
				'name'  => 'hero_card2_link',
				'type'  => 'url',
			),

			// --- Картка 3 ---
			array(
				'key'   => 'field_hero_card3_tab',
				'label' => 'Картка 3',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_hero_card3_title',
				'label' => 'Заголовок картки 3',
				'name'  => 'hero_card3_title',
				'type'  => 'text',
				'default_value' => 'Досягнення',
			),
			array(
				'key'   => 'field_hero_card3_subtitle',
				'label' => 'Підпис картки 3',
				'name'  => 'hero_card3_subtitle',
				'type'  => 'text',
				'default_value' => 'Нагороди та результати',
			),
			array(
				'key'   => 'field_hero_card3_link',
				'label' => 'Посилання картки 3',
				'name'  => 'hero_card3_link',
				'type'  => 'url',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		),
		'menu_order' => 0,
		'position'   => 'normal',
		'instruction_placement' => 'field',
	) );

	acf_add_local_field_group( array(
		'key'    => 'group_home_about',
		'title'  => 'Головна — Про гімназію',
		'fields' => array(

			array(
				'key'   => 'field_about_title',
				'label' => 'Заголовок секції',
				'name'  => 'about_title',
				'type'  => 'text',
				'default_value' => 'Про гімназію',
			),
			array(
				'key'   => 'field_about_text',
				'label' => 'Текст',
				'name'  => 'about_text',
				'type'  => 'textarea',
				'rows'  => 6,
				'new_lines' => 'wpautop',
			),
			array(
				'key'   => 'field_about_image',
				'label' => 'Фото',
				'name'  => 'about_image',
				'type'  => 'image',
				'return_format' => 'array',
				'preview_size'  => 'medium',
			),
			array(
				'key'   => 'field_about_link_text',
				'label' => 'Текст посилання',
				'name'  => 'about_link_text',
				'type'  => 'text',
				'default_value' => 'Дізнатись Більше',
			),
			array(
				'key'   => 'field_about_link_url',
				'label' => 'URL посилання',
				'name'  => 'about_link_url',
				'type'  => 'url',
			),

			// --- Картка переваги 1 ---
			array(
				'key'   => 'field_about_card1_tab',
				'label' => 'Картка 1 — Індивідуальний підхід',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_card1_title',
				'label' => 'Заголовок',
				'name'  => 'about_card1_title',
				'type'  => 'text',
				'default_value' => 'Індивідуальний Досвід',
			),
			array(
				'key'   => 'field_about_card1_text',
				'label' => 'Текст',
				'name'  => 'about_card1_text',
				'type'  => 'textarea',
				'rows'  => 2,
			),

			// --- Картка переваги 2 ---
			array(
				'key'   => 'field_about_card2_tab',
				'label' => 'Картка 2 — Викладачі',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_card2_title',
				'label' => 'Заголовок',
				'name'  => 'about_card2_title',
				'type'  => 'text',
				'default_value' => 'Досвідчений Викладацький Склад',
			),
			array(
				'key'   => 'field_about_card2_text',
				'label' => 'Текст',
				'name'  => 'about_card2_text',
				'type'  => 'textarea',
				'rows'  => 2,
			),

			// --- Картка переваги 3 ---
			array(
				'key'   => 'field_about_card3_tab',
				'label' => 'Картка 3 — Результати',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_card3_title',
				'label' => 'Заголовок',
				'name'  => 'about_card3_title',
				'type'  => 'text',
				'default_value' => 'Високі Результати',
			),
			array(
				'key'   => 'field_about_card3_text',
				'label' => 'Текст',
				'name'  => 'about_card3_text',
				'type'  => 'textarea',
				'rows'  => 2,
			),

			// --- Картка переваги 4 ---
			array(
				'key'   => 'field_about_card4_tab',
				'label' => 'Картка 4 — Міжнародні можливості',
				'type'  => 'tab',
			),
			array(
				'key'   => 'field_about_card4_title',
				'label' => 'Заголовок',
				'name'  => 'about_card4_title',
				'type'  => 'text',
				'default_value' => 'Міжнародні Можливості',
			),
			array(
				'key'   => 'field_about_card4_text',
				'label' => 'Текст',
				'name'  => 'about_card4_text',
				'type'  => 'textarea',
				'rows'  => 2,
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		),
		'menu_order' => 1,
		'position'   => 'normal',
		'instruction_placement' => 'field',
	) );

	acf_add_local_field_group( array(
		'key'    => 'group_home_stats',
		'title'  => 'Головна — Статистика',
		'fields' => array(

			array(
				'key'   => 'field_stat1_number',
				'label' => 'Цифра 1',
				'name'  => 'stat1_number',
				'type'  => 'text',
				'default_value' => '30+',
			),
			array(
				'key'   => 'field_stat1_label',
				'label' => 'Підпис 1',
				'name'  => 'stat1_label',
				'type'  => 'text',
				'default_value' => 'Років досвіду',
			),

			array(
				'key'   => 'field_stat2_number',
				'label' => 'Цифра 2',
				'name'  => 'stat2_number',
				'type'  => 'text',
				'default_value' => '95%',
			),
			array(
				'key'   => 'field_stat2_label',
				'label' => 'Підпис 2',
				'name'  => 'stat2_label',
				'type'  => 'text',
				'default_value' => 'Вступ до ВНЗ',
			),

			array(
				'key'   => 'field_stat3_number',
				'label' => 'Цифра 3',
				'name'  => 'stat3_number',
				'type'  => 'text',
				'default_value' => '200+',
			),
			array(
				'key'   => 'field_stat3_label',
				'label' => 'Підпис 3',
				'name'  => 'stat3_label',
				'type'  => 'text',
				'default_value' => 'Переможців олімпіад',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		),
		'menu_order' => 2,
		'position'   => 'normal',
		'instruction_placement' => 'field',
	) );

	acf_add_local_field_group( array(
		'key'    => 'group_home_news',
		'title'  => 'Головна — Заголовок секції новин',
		'fields' => array(
			array(
				'key'   => 'field_news_title',
				'label' => 'Заголовок',
				'name'  => 'news_title',
				'type'  => 'text',
				'default_value' => 'Останні новини',
			),
			array(
				'key'   => 'field_news_subtitle',
				'label' => 'Підзаголовок',
				'name'  => 'news_subtitle',
				'type'  => 'text',
				'default_value' => 'Слідкуйте за подіями нашої гімназії',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		),
		'menu_order' => 3,
		'position'   => 'normal',
		'instruction_placement' => 'field',
	) );

	// Поле "Посилання" для кожного партнера (CPT "partner", не front page)
	acf_add_local_field_group( array(
		'key'    => 'group_partner_link',
		'title'  => 'Посилання партнера',
		'fields' => array(
			array(
				'key'   => 'field_partner_link',
				'label' => 'Сайт партнера',
				'name'  => 'partner_link',
				'type'  => 'url',
				'instructions' => 'Необов’язково. Якщо заповнено — лого стане клікабельним посиланням.',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'partner',
				),
			),
		),
	) );

	acf_add_local_field_group( array(
		'key'    => 'group_home_gallery',
		'title'  => 'Головна — Галерея активностей школи',
		'fields' => array(
			array(
				'key'   => 'field_gallery_title',
				'label' => 'Заголовок',
				'name'  => 'gallery_title',
				'type'  => 'text',
				'default_value' => 'Галерея активностей школи',
			),
			array(
				'key'   => 'field_gallery_subtitle',
				'label' => 'Підзаголовок',
				'name'  => 'gallery_subtitle',
				'type'  => 'text',
				'default_value' => 'Моменти шкільного життя та подій у фотографіях',
			),
			array(
				'key'   => 'field_gallery_image1',
				'label' => 'Фото 1',
				'name'  => 'gallery_image1',
				'type'  => 'image',
				'return_format' => 'array',
				'preview_size'  => 'medium',
			),
			array(
				'key'   => 'field_gallery_image2',
				'label' => 'Фото 2',
				'name'  => 'gallery_image2',
				'type'  => 'image',
				'return_format' => 'array',
				'preview_size'  => 'medium',
			),
			array(
				'key'   => 'field_gallery_image3',
				'label' => 'Фото 3',
				'name'  => 'gallery_image3',
				'type'  => 'image',
				'return_format' => 'array',
				'preview_size'  => 'medium',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		),
		'menu_order' => 4,
		'position'   => 'normal',
		'instruction_placement' => 'field',
	) );

} );
