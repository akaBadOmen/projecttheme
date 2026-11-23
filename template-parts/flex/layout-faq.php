<?php
/**
 * Layout: FAQ – aufklappbare Fragen (details/summary, ohne JavaScript)
 */
$title  = get_sub_field('title');
$text   = get_sub_field('text');
$button = get_sub_field('button');
?>
<div class="tg-section tg-faq">
  <div class="tg-container tg-container--narrow">
  <?php if ($title || $text) : ?>
    <header class="tg-faq__head">
      <?php if ($title) : ?><h2 class="tg-faq__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
      <?php if ($text) : ?><p class="tg-faq__intro"><?php echo nl2br(esc_html($text)); ?></p><?php endif; ?>
    </header>
  <?php endif; ?>
  <?php if (have_rows('items')) : ?>
    <div class="tg-faq__list">
      <?php while (have_rows('items')) : the_row();
        $q = get_sub_field('question');
        $a = get_sub_field('answer');
        if (!$q) continue;
      ?>
        <details class="tg-faq__item">
          <summary class="tg-faq__question"><?php echo esc_html($q); ?><span class="tg-faq__icon" aria-hidden="true"></span></summary>
          <div class="tg-faq__answer"><?php echo wp_kses_post($a); ?></div>
        </details>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
  <?php if ($button) : ?><div class="tg-faq__actions">
  <?php if ($button) :
  $button_target = $button['target'] ? $button['target'] : '_self'; ?>
  <a class="tg-btn tg-btn--secondary" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button_target); ?>"><?php echo esc_html($button['title']); ?></a>
<?php endif; ?>
  </div><?php endif; ?>
  </div>
</div>
