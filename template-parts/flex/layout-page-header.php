<?php
/**
 * Layout: Page Header – Kopfbereich der Unterseiten (Eyebrow, große Überschrift, Einleitung)
 */
$eyebrow = get_sub_field('eyebrow');
$title   = get_sub_field('title');
$text    = get_sub_field('text');
?>
<div class="tg-page-header">
  <div class="tg-container">
    <?php if ($eyebrow) : ?><p class="eyebrow tg-page-header__eyebrow"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
    <?php if ($title) : ?><h1 class="tg-page-header__title"><?php echo esc_html($title); ?></h1><?php endif; ?>
    <?php if ($text) : ?><p class="tg-page-header__text"><?php echo nl2br(esc_html($text)); ?></p><?php endif; ?>
  </div>
</div>
