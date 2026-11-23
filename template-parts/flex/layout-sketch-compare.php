<?php
/**
 * Layout: Sketch Compare – Handskizze und fertiger Raum nebeneinander
 */
$title        = get_sub_field('title');
$sketch       = get_sub_field('sketch');
$sketch_label = get_sub_field('sketch_label') ? get_sub_field('sketch_label') : 'Handskizze';
$result       = get_sub_field('result');
$result_label = get_sub_field('result_label') ? get_sub_field('result_label') : 'Fertiger Raum';
if (!$sketch && !$result) return;
?>
<div class="tg-sketch">
  <div class="tg-container">
    <?php if ($title) : ?><h2 class="tg-sketch__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
    <div class="tg-sketch__grid">
      <?php foreach (array(array($sketch, $sketch_label), array($result, $result_label)) as $item) :
        if (!$item[0]) continue; ?>
        <figure class="tg-sketch__card">
          <div class="tg-sketch__image"><?php echo wp_get_attachment_image($item[0], 'large', false, array('loading' => 'lazy', 'decoding' => 'async')); ?></div>
          <figcaption class="tg-sketch__label"><?php echo esc_html($item[1]); ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</div>
