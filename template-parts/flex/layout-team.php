<?php
/**
 * Layout: Team – Personen mit Foto, Name und Rolle
 */
$title = get_sub_field('title');
?>
<div class="tg-team">
  <div class="tg-container">
    <?php if ($title) : ?><h2 class="tg-team__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
    <?php if (have_rows('members')) : ?>
      <ul class="tg-team__grid">
        <?php while (have_rows('members')) : the_row();
          $img  = get_sub_field('image');
          $name = get_sub_field('name');
          $role = get_sub_field('role');
        ?>
          <li class="tg-team__member">
            <div class="tg-team__image">
              <?php if ($img) echo wp_get_attachment_image($img, 'large', false, array('loading' => 'lazy', 'decoding' => 'async', 'alt' => $name ? $name : '', 'sizes' => '(min-width: 992px) 25vw, 50vw')); ?>
            </div>
            <?php if ($name) : ?><p class="tg-team__name"><?php echo esc_html($name); ?></p><?php endif; ?>
            <?php if ($role) : ?><p class="tg-team__role"><?php echo esc_html($role); ?></p><?php endif; ?>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
