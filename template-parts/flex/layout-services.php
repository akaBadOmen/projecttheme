<?php
/**
 * Layout: Services – Leistungen als Karten mit Bild
 */
$title = get_sub_field('title');
$text  = get_sub_field('text');
?>
<div class="tg-section tg-services">
  <div class="tg-container">
  <?php if ($title || $text) : ?>
    <header class="tg-services__head">
      <?php if ($title) : ?><h2 class="tg-services__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
      <?php if ($text) : ?><p class="tg-services__intro"><?php echo nl2br(esc_html($text)); ?></p><?php endif; ?>
    </header>
  <?php endif; ?>
  <?php if (have_rows('items')) : ?>
    <div class="tg-services__grid">
      <?php while (have_rows('items')) : the_row();
        $img   = get_sub_field('image');
        $ctitle = get_sub_field('title');
        $ctext = get_sub_field('text');
        $clink = get_sub_field('link');
        $tag   = $clink ? 'a' : 'div';
      ?>
        <<?php echo $tag; ?> class="tg-services__card"<?php if ($clink) : ?> href="<?php echo esc_url($clink['url']); ?>"<?php endif; ?>>
          <?php if ($img) : ?>
            <div class="tg-services__image"><?php echo wp_get_attachment_image($img, 'large', false, ['loading' => 'lazy', 'decoding' => 'async']); ?></div>
          <?php endif; ?>
          <div class="tg-services__body">
            <?php if ($ctitle) : ?><h3 class="tg-services__card-title"><?php echo esc_html($ctitle); ?></h3><?php endif; ?>
            <?php if ($ctext) : ?><p class="tg-services__card-text"><?php echo esc_html($ctext); ?></p><?php endif; ?>
          </div>
        </<?php echo $tag; ?>>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
  </div>
</div>
