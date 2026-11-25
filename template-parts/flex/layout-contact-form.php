<?php
/**
 * Layout: Contact Form – links Eyebrow, Überschrift, Einleitung + Formular (Contact Form 7),
 * rechts die Kontaktdaten (Adresse, Telefon & E-Mail, Öffnungszeiten). Am Handy untereinander.
 * Ist das Modul das erste auf der Seite, wird die Überschrift zur H1.
 */
$eyebrow   = get_sub_field('eyebrow');
$title     = get_sub_field('title');
$text      = get_sub_field('text');
$shortcode = get_sub_field('shortcode');
$heading   = (get_row_index() === 1) ? 'h1' : 'h2';

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
<div class="tg-contact-form">
  <div class="tg-container tg-contact-form__grid">
    <div class="tg-contact-form__main">
      <?php if ($eyebrow) : ?><p class="eyebrow tg-contact-form__eyebrow"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
      <?php if ($title) : ?><<?php echo $heading; ?> class="h2 tg-contact-form__title"><?php echo esc_html($title); ?></<?php echo $heading; ?>><?php endif; ?>
      <?php if ($text) : ?><p class="tg-contact-form__text"><?php echo nl2br(esc_html($text)); ?></p><?php endif; ?>
      <?php
      if ($shortcode && shortcode_exists('contact-form-7')) {
        echo do_shortcode($shortcode);
      } elseif (current_user_can('edit_posts')) {
        echo '<p>Formular fehlt: Bitte das Plugin Contact Form 7 aktivieren und den Shortcode im Modul eintragen.</p>';
      }
      ?>
    </div>

    <?php if (have_rows('info')) : ?>
      <aside class="tg-contact-form__aside" aria-label="Kontaktdaten">
        <?php while (have_rows('info')) : the_row();
          $info_title = get_sub_field('title');
          $info_text  = get_sub_field('text');
        ?>
          <div class="tg-contact-info__item">
            <?php if ($info_title) : ?><h2 class="tg-contact-info__title"><?php echo esc_html($info_title); ?></h2><?php endif; ?>
            <?php if ($info_text) : ?>
              <p class="tg-contact-info__text"><?php echo implode('<br>', array_map($link_contact, preg_split('/\r\n|\r|\n/', $info_text))); ?></p>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </aside>
    <?php endif; ?>
  </div>
</div>
