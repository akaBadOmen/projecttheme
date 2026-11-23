<?php
/**
 * Layout: Image Full – Bild über die ganze Breite
 */
$image  = get_sub_field('image');
$height = get_sub_field('height') ? get_sub_field('height') : 'large';
if (!$image) return;
?>
<div class="tg-image-full tg-image-full--<?php echo esc_attr($height); ?>">
  <?php echo wp_get_attachment_image($image, 'full', false, array('loading' => 'lazy', 'decoding' => 'async', 'sizes' => '100vw')); ?>
</div>
