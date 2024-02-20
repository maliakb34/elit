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

if( !empty( $stm_event_lesson_title ) ) : ?>

<?php endif; ?>



<?php
// Aramak istediğiniz kelimeyi belirleyin
if($stm_event_lesson_title==1)
{
    $arama_terimi = 'Şeffaf';

}
else
{
    $arama_terimi = 'Genelge';

}

// Belirli bir kelimeyi post başlıklarında aramak için sorguyu oluşturun
$post_sorgusu = new WP_Query( array(
    's' => $arama_terimi, // Arama terimi olarak post başlığı
    'post_type' => 'dlp_document'
) );

?>
<table id="document-library-1" class="document-library-table dataTable no-footer dtr-inline" data-page-length="20" data-paging="false" data-click-filter="true" data-scroll-offset="15" data-order="[]" cellspacing="0" width="100%" aria-describedby="document-library-1_info" style="width: 100%;">
<thead>
    <tr>
        <th>Tarih</th>
        <th>Konu</th>
        <th>Dosya</th>
    </tr>
</thead>
        
        <tbody>
        <?php
        if ( $post_sorgusu->have_posts() ) :
    while ( $post_sorgusu->have_posts() ) :
         $post_sorgusu->the_post();
        ?>
        

        
        <tr>
            <td class="dtr-control" tabindex="0"><?php echo get_the_date( 'd-m-Y' ); ?></td>
            <td><?php echo the_title(); ?></td>
            <td> <?php
        // Ekli dosyaları al
        $ekli_dosyalar = get_attached_media( 'application' );
        if ($ekli_dosyalar) {
            // Son dosyayı almak için dosya listesini tersine çevirin ve ilk öğeyi alın
            $son_dosya = end($ekli_dosyalar);
        
            // Post status kontrolü
            if ( 'publish' === get_post_status( $son_dosya->ID ) ) {
                $dosya_url = wp_get_attachment_url( $son_dosya->ID );
                echo '<a target="_blank" href="' . $dosya_url . '"><i class="fa fa-file-pdf"></i>' . $son_dosya->post_title . '</a>';
            } else {
                // İstenen post status'ü sağlanmıyorsa buraya işlem ekleyebilirsiniz
                echo 'Dosya yayınlanmamış veya silinmiş.';
            }
        } else {
            // Ekli dosya bulunamadığında yapılacak işlem
            echo 'Ekli dosya bulunamadı.';
        }
        ?>
        </td>
       </tr>

     
       
        <?php
    endwhile;

    ?>
        <?php
// Eğer yayınlar varsa işlem yapın

else :
    echo 'Belirtilen kelimeye sahip başlık içeren yayın bulunamadı.';
endif;
?>
    </tbody>
</table>
<?php
// Geri dönüş değerlerini sıfırlayın
wp_reset_postdata();
?>
         
   