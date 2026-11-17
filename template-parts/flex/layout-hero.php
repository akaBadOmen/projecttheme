<?php
/**
 * Hero layout.
 * Fields: title (text), subtitle (textarea), cta (link array),
 *         background_image (image ID).
 */
$title  = get_sub_field('title');
$body   = get_sub_field('subtitle');
$cta    = get_sub_field('cta');
$img_id = get_sub_field('background_image');

$cta_url    = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '';
$cta_title  = is_array($cta) && !empty($cta['title']) ? $cta['title'] : '';
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel    = $cta_target === '_blank' ? 'noopener noreferrer' : '';
?>
<div class="projecttheme-hero">
  <?php if ($img_id): ?>
    <?php
    echo wp_get_attachment_image($img_id, 'full', false, [
      'class' => 'projecttheme-hero__image',
      'alt' => '',
      'loading' => 'eager',
      'decoding' => 'async',
      'aria-hidden' => 'true',
    ]);
    ?>
  <?php endif; ?>

  <div class="projecttheme-hero__overlay" aria-hidden="true"></div>

  <div class="projecttheme-hero__content">
    <?php if ($title): ?>
      <h1 class="projecttheme-hero__title"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>

    <?php if ($body): ?>
      <div class="projecttheme-hero__subtitle"><?php echo nl2br(esc_html($body)); ?></div>
    <?php endif; ?>

    <?php if ($cta_url): ?>
      <a
        class="projecttheme-hero__cta"
        href="<?php echo esc_url($cta_url); ?>"
        target="<?php echo esc_attr($cta_target); ?>"
        rel="<?php echo esc_attr($cta_rel); ?>"
      >
        <?php echo esc_html($cta_title ?: __('Projekt anfangen', 'projecttheme')); ?>
      </a>
    <?php endif; ?>
  </div>
</div>
