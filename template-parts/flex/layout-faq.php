<?php
/**
 * Layout: FAQ – aufklappbare Fragen (details/summary)
 * Nur die ersten X Fragen sind sichtbar, der Rest erscheint per Klick auf "Weitere Fragen".
 */
$title      = get_sub_field('title');
$text       = get_sub_field('text');
$button     = get_sub_field('button');
$visible    = (int) get_sub_field('visible');
$visible    = $visible > 0 ? $visible : 3;
$more_label = get_sub_field('more_label') ? get_sub_field('more_label') : 'Weitere Fragen';
$items      = get_sub_field('items');
$total      = is_array($items) ? count($items) : 0;
$list_id    = 'faq-' . get_row_index();
?>
<div class="tg-section tg-faq">
  <div class="tg-container tg-container--narrow">
    <?php if ($title || $text) : ?>
      <div class="tg-faq__head">
        <?php if ($title) : ?><h2 class="tg-faq__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
        <?php if ($text) : ?><p class="tg-faq__intro"><?php echo nl2br(esc_html($text)); ?></p><?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if (have_rows('items')) : $i = 0; ?>
      <div class="tg-faq__list" id="<?php echo esc_attr($list_id); ?>">
        <?php while (have_rows('items')) : the_row();
          $q = get_sub_field('question');
          $a = get_sub_field('answer');
          if (!$q) continue;
          $i++;
        ?>
          <details class="tg-faq__item"<?php echo $i > $visible ? ' hidden data-faq-more' : ''; ?>>
            <summary class="tg-faq__question"><?php echo esc_html($q); ?><span class="tg-faq__icon" aria-hidden="true"></span></summary>
            <div class="tg-faq__answer"><?php echo wp_kses_post($a); ?></div>
          </details>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

    <?php if ($total > $visible || $button) : ?>
      <div class="tg-faq__actions">
        <?php if ($total > $visible) : ?>
          <button type="button" class="tg-btn tg-btn--secondary tg-faq__more" aria-controls="<?php echo esc_attr($list_id); ?>" aria-expanded="false"><?php echo esc_html($more_label); ?></button>
        <?php endif; ?>
        <?php if ($button) :
          $button_target = $button['target'] ? $button['target'] : '_self'; ?>
          <a class="tg-btn tg-btn--secondary" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button_target); ?>"><?php echo esc_html($button['title']); ?></a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
