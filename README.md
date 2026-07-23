# Astra Child — School (Класична гімназія)

Дочірня тема **Astra** для сайту гімназії. Кастомні header/footer та секції головної сторінки зроблені **кодом, без плагінів-білдерів**.

## Вимоги

- WordPress
- Батьківська тема **Astra**
- Плагін **Advanced Custom Fields** (безкоштовна версія) — для полів контенту секцій

## Структура

```
astra-child/
├── functions.php              # Підключення стилів/скриптів, меню, CPT "Партнери", віджет-зони
├── header.php                 # Кастомний header
├── footer.php                 # Кастомний footer
├── front-page.php             # Головна сторінка (збирається із секцій)
├── category.php               # Шаблон категорії
├── style.css                  # Мінімальний файл теми (реальні стилі — в assets/css/custom.css)
├── inc/
│   └── acf-fields.php          # Реєстрація полів ACF
├── template-parts/            # Секції головної сторінки
│   └── section-{hero,about,stats,news,partners,gallery}.php
└── assets/
    ├── css/custom.css          # Основні стилі
    ├── js/header.js            # Мобільне меню
    └── images/
```

## Встановлення

1. Скопіювати теку `astra-child/` у `wp-content/themes/`.
2. Активувати тему **Astra Child — School** у *Зовнішній вигляд → Теми*.
3. Активувати плагін **Advanced Custom Fields**.
4. Призначити меню в *Зовнішній вигляд → Меню* до локацій (Головне меню + 3 футер-меню).
5. У *Налаштування → Читання* обрати статичну головну сторінку.

## Шрифти

Playfair Display (заголовки) + Inter (текст/UI) підключаються з Google Fonts.
Для проду — розглянути самостійний хостинг шрифтів (плагін OMGF).
