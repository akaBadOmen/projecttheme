<?php
/**
 * Layout: Contact Info – drei Spalten mit Linie oben (Adresse, Telefon & E-Mail, Öffnungszeiten)
 * Telefonnummern und E-Mail-Adressen werden automatisch klickbar.
 */
$link_contact = function ($line) {
  $line = trim($line);
  if (is_email($line)) {
    return '<a href="mailto:' . esc_attr($line) . '">' . esc_html($line) . '</a>';
  }
  if (preg_match('/^\+?[0-9 \/()-]{6,}$/', $line)) {
    return '<a href="tel:' . esc_attr(preg_replace('/[^0-9+]/', '', $line)) . '">' . esc_html($line) . '</a>';
  }
  return esc_html($line);
};
?>
<div class="tg-contact-info">
  <div class="tg-container">
    <?php if (have_rows('items')) : ?>
      <div class="tg-contact-info__grid">
        <?php while (have_rows('items')) : the_row();
          $title = get_sub_field('title');
          $text  = get_sub_field('text');
        ?>
          <div class="tg-contact-info__item">
            <?php if ($title) : ?><h2 class="tg-contact-info__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
            <?php if ($text) : ?>
              <p class="tg-contact-info__text"><?php echo implode('<br>', array_map($link_contact, preg_split('/\r\n|\r|\n/', $text))); ?></p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
