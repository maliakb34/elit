<?php

/**
 *
 * @var $stm_event_lesson_title
 * @var $date_format
 * @var $time_format
 * @var $datepicker
 * @var $heading
 */

$stm_event_lesson_date = strtotime($datepicker);
$id = rand(0,999999);

if(  $stm_event_lesson_title==1  ) : ?>
  <span>1</span>
<?php endif; ?>


if(  $stm_event_lesson_title==2  ) : ?>
  <span>1</span>
<?php endif; ?>

<table id="document-library-1" class="document-library-table dataTable no-footer dtr-inline" data-page-length="20" data-paging="false" data-click-filter="true" data-scroll-offset="15" data-order="[]" cellspacing="0" width="100%" aria-describedby="document-library-1_info" style="width: 100%;"><thead><tr><th data-name="id" data-priority="3" data-width="" class="sorting" tabindex="0" aria-controls="document-library-1" rowspan="1" colspan="1" style="width: 72px;" aria-label="ID: activate to sort column ascending">ID</th><th data-name="title" data-priority="1" data-width="" class="sorting" tabindex="0" aria-controls="document-library-1" rowspan="1" colspan="1" style="width: 334px;" aria-label="Title: activate to sort column ascending">Title</th><th data-name="content" data-priority="5" data-width="" class="sorting" tabindex="0" aria-controls="document-library-1" rowspan="1" colspan="1" style="width: 202px;" aria-label="Description: activate to sort column ascending">Description</th><th data-name="date" data-priority="2" data-width="" class="sorting" tabindex="0" aria-controls="document-library-1" rowspan="1" colspan="1" style="width: 157px;" aria-label="Date: activate to sort column ascending">Date</th><th data-name="link" data-priority="4" data-width="" class="sorting" tabindex="0" aria-controls="document-library-1" rowspan="1" colspan="1" style="width: 158px;" aria-label="Link: activate to sort column ascending">Link</th></tr></thead><tbody><tr class="odd"><td class="dtr-control" tabindex="0">7325</td><td>2020-seffaflik-raporu.pdf</td><td></td><td>2024/02/19</td><td><a href="http://192.168.1.37:8080/elit/wp-content/uploads/2024/02/2020-seffaflik-raporu.pdf" class="document-library-button button btn" download="2020-seffaflik-raporu.pdf" type="application/pdf">İndir</a></td></tr></tbody></table>


<?php
// Aramak istediğiniz kelimeyi belirleyin
$arama_terimi = 'seffaf';

// Belirli bir kelimeyi içeren postları bulmak için sorguyu oluşturun
$post_sorgusu = new WP_Query( array(
    's' => $arama_terimi, // Arama terimi olarak post başlığı
    'posts_per_page' => -1 // Tüm yayınları almak için -1
) );

// Eğer yayınlar varsa işlem yapın
if ( $post_sorgusu->have_posts() ) :
    while ( $post_sorgusu->have_posts() ) :
        $post_sorgusu->the_post();
        ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>

        <?php
        // Ekli dosyaları al
        $ekli_dosyalar = get_attached_media( 'application,audio,image,text,video' );
        if ( $ekli_dosyalar ) {
            foreach ( $ekli_dosyalar as $dosya ) {
                $dosya_url = wp_get_attachment_url( $dosya->ID );
                echo '<p><a href="' . $dosya_url . '">' . $dosya->post_title . '</a></p>';
            }
        }
        ?>

        <?php
    endwhile;
else :
    echo 'Belirtilen kelimeye sahip başlık içeren yayın bulunamadı.';
endif;

// Geri dönüş değerlerini sıfırlayın
wp_reset_postdata();
?>