<?php
/**
 * Layout: CTA – Handlungsaufforderung auf hellgrauer Fläche
 */
$title  = get_sub_field('title');
$text   = get_sub_field('text');
$button = get_sub_field('button');
?>
<div class="tg-section tg-cta">
  <div class="tg-container tg-cta__inner">
    <?php if ($title) : ?><h2 class="tg-cta__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
    <?php if ($text) : ?><p class="tg-cta__text"><?php echo nl2br(esc_html($text)); ?></p><?php endif; ?>
    <?php if ($button) :
  $button_target = $button['target'] ? $button['target'] : '_self'; ?>
  <a class="tg-btn tg-btn--primary" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button_target); ?>"><?php echo esc_html($button['title']); ?></a>
<?php endif; ?>
  </div>
</div>
