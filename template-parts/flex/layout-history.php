<?php
/**
 * Layout: History – Geschichte mit Eyebrow, Überschrift, Text und Kennzahlen
 */
$eyebrow = get_sub_field('eyebrow');
$title   = get_sub_field('title');
$text    = get_sub_field('text');
?>
<div class="tg-section tg-history">
  <div class="tg-container">
    <div class="tg-history__row">
      <div class="tg-history__head">
        <?php if ($eyebrow) : ?><p class="eyebrow tg-history__eyebrow"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
        <?php if ($title) : ?><h2 class="tg-history__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
      </div>
      <?php if ($text) : ?><div class="tg-history__text"><?php echo wp_kses_post($text); ?></div><?php endif; ?>
    </div>
    <?php if (have_rows('stats')) : ?>
      <dl class="tg-history__stats">
        <?php while (have_rows('stats')) : the_row(); ?>
          <div class="tg-history__stat">
            <dt class="tg-history__number"><?php echo esc_html(get_sub_field('number')); ?></dt>
            <dd class="tg-history__label"><?php echo esc_html(get_sub_field('label')); ?></dd>
          </div>
        <?php endwhile; ?>
      </dl>
    <?php endif; ?>
  </div>
</div>
