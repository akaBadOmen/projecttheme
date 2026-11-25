<?php
/**
 * Layout: Project List – listet automatisch alle Projekte (Post Type "projekt")
 * Bild und Text wechseln sich links/rechts ab. Daten: Titelbild, Textauszug, Kategorie, Ort, Jahr.
 */
$count    = (int) get_sub_field('count');
$category = get_sub_field('category');
$button   = get_sub_field('button_label') ? get_sub_field('button_label') : 'Projekt ansehen';

$args = array(
  'post_type'      => 'projekt',
  'posts_per_page' => $count > 0 ? $count : -1,
  'orderby'        => array('menu_order' => 'ASC', 'date' => 'DESC'),
  'no_found_rows'  => true,
);
if ($category) {
  $args['tax_query'] = array(array(
    'taxonomy' => 'projektkategorie',
    'field'    => 'term_id',
    'terms'    => (array) $category,
  ));
}
$projects = new WP_Query($args);
?>
<div class="tg-project-list">
  <div class="tg-container">
    <?php if ($projects->have_posts()) : ?>
      <div class="tg-project-list__items">
        <?php while ($projects->have_posts()) : $projects->the_post();
          $terms = get_the_terms(get_the_ID(), 'projektkategorie');
          $meta  = array_filter(array(
            ($terms && !is_wp_error($terms)) ? $terms[0]->name : '',
            function_exists('get_field') ? get_field('ort') : '',
            function_exists('get_field') ? get_field('jahr') : '',
          ));
        ?>
          <article class="tg-project">
            <a class="tg-project__image" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
              <?php if (has_post_thumbnail()) {
                the_post_thumbnail('large', array('loading' => 'lazy', 'decoding' => 'async', 'alt' => '', 'sizes' => '(min-width: 768px) 50vw, 100vw'));
              } ?>
            </a>
            <div class="tg-project__content">
              <?php if ($meta) : ?>
                <p class="tg-project__meta"><?php echo esc_html(implode('   \\   ', $meta)); ?></p>
              <?php endif; ?>
              <h2 class="tg-project__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php if (has_excerpt()) : ?><p class="tg-project__text"><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
              <a class="tg-btn tg-btn--secondary tg-project__button" href="<?php the_permalink(); ?>"><?php echo esc_html($button); ?><span class="screen-reader-text">: <?php the_title(); ?></span></a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php elseif (current_user_can('edit_posts')) : ?>
      <p>Noch keine Projekte angelegt – im WP-Admin unter <strong>Projekte → Neues Projekt</strong> hinzufügen.</p>
    <?php endif; ?>
  </div>
</div>
