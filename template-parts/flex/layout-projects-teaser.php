<?php
/**
 * Layout: Projects Teaser (Startseite) – 3 Projektkarten + Button "Alle Projekte"
 */
$title  = get_sub_field('title');
$text   = get_sub_field('text');
$button = get_sub_field('button');
?>
<div class="tg-section tg-teaser">
  <div class="tg-container">
  <?php if ($title || $text) : ?>
    <div class="tg-teaser__head">
      <?php if ($title) : ?><h2 class="tg-teaser__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
      <?php if ($text) : ?><p class="tg-teaser__intro"><?php echo nl2br(esc_html($text)); ?></p><?php endif; ?>
    </div>
  <?php endif; ?>
  <?php if (have_rows('items')) : ?>
    <div class="tg-teaser__grid">
      <?php while (have_rows('items')) : the_row();
        $img   = get_sub_field('image');
        $ctitle = get_sub_field('title');
        $ctext = get_sub_field('text');
        $clink = get_sub_field('link');
        $tag   = $clink ? 'a' : 'div';
      ?>
        <<?php echo $tag; ?> class="tg-teaser__card"<?php if ($clink) : ?> href="<?php echo esc_url($clink['url']); ?>"<?php endif; ?>>
          <?php if ($img) : ?>
            <div class="tg-teaser__image"><?php echo wp_get_attachment_image($img, 'large', false, ['loading' => 'lazy', 'decoding' => 'async']); ?></div>
          <?php endif; ?>
          <div class="tg-teaser__body">
            <?php if ($ctitle) : ?><h3 class="tg-teaser__card-title"><?php echo esc_html($ctitle); ?></h3><?php endif; ?>
            <?php if ($ctext) : ?><p class="tg-teaser__card-text"><?php echo esc_html($ctext); ?></p><?php endif; ?>
          </div>
        </<?php echo $tag; ?>>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
  <?php if ($button) : ?><div class="tg-teaser__actions">
  <?php if ($button) :
  $button_target = $button['target'] ? $button['target'] : '_self'; ?>
  <a class="tg-btn tg-btn--secondary" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button_target); ?>"><?php echo esc_html($button['title']); ?></a>
<?php endif; ?>
  </div><?php endif; ?>
  </div>
</div>
