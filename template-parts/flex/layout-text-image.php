<?php
/**
 * Text Image layout.
 * Fields: image (image ID), headline (text), text (WYSIWYG), cta (link array).
 */
$image_id = get_sub_field('image');
$headline = get_sub_field('headline');
$text     = get_sub_field('text');
$cta      = get_sub_field('cta');

$cta_url    = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '';
$cta_title  = is_array($cta) && !empty($cta['title']) ? $cta['title'] : '';
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel    = $cta_target === '_blank' ? 'noopener noreferrer' : '';
?>
<div class="projecttheme-text-image">
  <div class="projecttheme-text-image__row">
    <?php if ($image_id): ?>
      <div class="projecttheme-text-image__image-wrap">
        <?php
        echo wp_get_attachment_image($image_id, 'large', false, [
          'class' => 'projecttheme-text-image__image',
          'loading' => 'lazy',
          'decoding' => 'async',
        ]);
        ?>
      </div>
    <?php endif; ?>

    <div class="projecttheme-text-image__content">
      <?php if ($headline): ?>
        <h2 class="projecttheme-text-image__headline"><?php echo esc_html($headline); ?></h2>
      <?php endif; ?>

      <?php if ($text): ?>
        <div class="projecttheme-text-image__text rte"><?php echo wp_kses_post($text); ?></div>
      <?php endif; ?>

      <?php if ($cta_url): ?>
        <a
          class="projecttheme-text-image__cta"
          href="<?php echo esc_url($cta_url); ?>"
          target="<?php echo esc_attr($cta_target); ?>"
          rel="<?php echo esc_attr($cta_rel); ?>"
        >
          <?php echo esc_html($cta_title ?: __('Mehr erfahren', 'projecttheme')); ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>
