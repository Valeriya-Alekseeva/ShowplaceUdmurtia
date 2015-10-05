<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'sitemanager0');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'V6gWC}~^$|3jcGYwWLEyx N54hKOyrhT>T5j{h{v6SK2?Gv#b,(MP[HI{:=v756~');
define('SECURE_AUTH_KEY',  'q+qPp(#bX|:}iIWPTfj]%/iK (}ly`8[).z5;h):uN+h(Rt/N91NlPe=bUfD(>I ');
define('LOGGED_IN_KEY',    '@|^0SVzk-&d^oo|/.#cpHlodvk<;.Rl|W%cU }i2o8:n>$YtQY4iCUL+}=mf6ne?');
define('NONCE_KEY',        'V+A`j66 tE[No?h(;8j%8|#V09~Ksk$gt64UZQ:PQU?y>A6L<pM@sNgT:NS@6n-n');
define('AUTH_SALT',        'b%q(U]U8r6J/T5pzf^R^#+9rw}A,/qP}0)=M/)Ttntj#_s=SMT(8Kcf+.;;n!LRm');
define('SECURE_AUTH_SALT', 'IUj{W|-ce|9`EU7ANp&K!C-P[EaS+ P?]:NOVG2,].rA29e;L)?t@Rir3I5h82Cl');
define('LOGGED_IN_SALT',   'i/~,Dvld(bA+0hn8Z_=S]Kq?)#n?6{KRL;I{l|G@q`TG;|IvYr_mkcbLe{&T;A-+');
define('NONCE_SALT',       '6Skz8}K[O.ta~-d-zw;Hr/jH&E.C3S&T dpUa7EjxH$QMe.,L|w>(=5gSvh$dmsR');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
