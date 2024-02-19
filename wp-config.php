<?php
/**
 * WordPress için başlangıç ayar dosyası.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * Bu dosya şu ayarları içerir:
 * 
 * * Veritabanı ayarları
 * * Gizli anahtarlar
 * * Veritabanı tablo ön eki
 * * ABSPATH
 * 
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Veritabanı ayarları - Bu bilgileri servis sağlayıcınızdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define( 'DB_NAME', 'u1470310_db8EB' );

/** Veritabanı kullanıcısı */
define( 'DB_USER', 'u1470310_user8EB' );

/** Veritabanı parolası */
define( 'DB_PASSWORD', 'LK4wA:x.8k8-7iJ:' );

/** Veritabanı sunucusu */
define( 'DB_HOST', '94.73.148.70' );

/** Yaratılacak tablolar için veritabanı karakter seti. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define( 'DB_COLLATE', '' );

/**#@+
 * Eşsiz doğrulama anahtarları ve tuzlar.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * 
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz.
 * Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '[,2NV{Fg!Jf%^c[I(=Miuo|fTF#%Pd5:r.eKs,3{Ri15&3gkmQX%;11pX ;8aj o' );
define( 'SECURE_AUTH_KEY',  '#^<pg-5IE~Du=)4om:~8|<{7)xB`b?tfrg~-_Y{aotyK+~.SGD`~v_@>j{YoZ8.y' );
define( 'LOGGED_IN_KEY',    '%9a~PpW6`i qbnv/AHeOhxZe4y.HtwHk/iba/ZDV4l)hSH#x.[0GQNJD* gy6Kgc' );
define( 'NONCE_KEY',        'h.pR]2U_ez%Uj&6oJ8fIQmA=N(;HgB{M=cSvLFg#:5i|j_U27NXCm#wlz@](mPu3' );
define( 'AUTH_SALT',        'TF9f&D.sGp};G2:L56jmQM }C&>oIG0O)b/&jy62RYn#weuQf5~@dIIeuxW AXw.' );
define( 'SECURE_AUTH_SALT', 'pHD`tlXaA?O/ytYsRZ,r,:/NB?f_^LHDP]_Rj4zR7Cw(p8QW_W]sJ*fCn-~2-!N[' );
define( 'LOGGED_IN_SALT',   'qAT<IzG57Agz[kW7aq|Z#:<)q.|vh&gW0#4l;Y7>MqXi8VsWL^h9U:T/t5M?w9< ' );
define( 'NONCE_SALT',       '@zLa1[r;e,BDXPN:N-u1;e$3F$;+P=cFKgRw,+x&q3Jr^$^ #u*|8mAOU]JIRL.g' );

/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix = 'wp_';

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri true olarak ayarlayıp geliştirme sırasında hataların ekrana
 * basılmasını sağlayabilirsiniz. Tema ve eklenti geliştiricilerinin geliştirme
 * aşamasında WP_DEBUG kullanmalarını önemle tavsiye ederiz.
 * 
 * Hata ayıklama için kullanabilecek diğer sabitler ile ilgili daha fazla bilgiyi
 * belgelerden edinebilirsiniz.
 * 
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Her türlü özel değeri bu satı ile "Hepsi bu kadar" yazan satır arasına ekleyebilirsiniz. */



/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** WordPress değişkenlerini ve yollarını kurar. */
require_once ABSPATH . 'wp-settings.php';