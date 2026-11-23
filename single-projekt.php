<?php
/**
 * Template: Projekt-Detailseite (Post Type "projekt")
 * Aufbau nach Figma "Projekt-Detail": Titelbild → Project Intro → Seitenmodule (Sketch Compare, Galerie, CTA …) → Project Navigation
 */
get_header(); ?>

<main id="main" class="site-main">
  <?php while (have_posts()) : the_post();
    $acf      = function_exists('get_field');
    $text     = $acf ? get_field('beschreibung') : '';
    $facts    = array(
      'Ort'      => $acf ? get_field('ort') : '',
      'Jahr'     => $acf ? get_field('jahr') : '',
      'Material' => $acf ? get_field('material') : '',
      'Leistung' => $acf ? get_field('leistung') : '',
    );
    $facts    = array_filter($facts);
    $overview = get_page_by_path('projekte') ? get_page_by_path('projekte') : get_page_by_path('work');
  ?>

    <?php if (has_post_thumbnail()) : ?>
      <div class="tg-image-full tg-image-full--large">
        <?php the_post_thumbnail('full', array('loading' => 'eager', 'fetchpriority' => 'high', 'sizes' => '100vw', 'alt' => '')); ?>
      </div>
    <?php endif; ?>

    <section class="tg-section tg-project-intro">
      <div class="tg-container">
        <?php if ($overview) : ?>
          <a class="tg-project-intro__back" href="<?php echo esc_url(get_permalink($overview)); ?>">&larr; Alle Projekte</a>
        <?php endif; ?>

        <div class="tg-project-intro__row">
          <div class="tg-project-intro__content">
            <h1 class="tg-project-intro__title"><?php the_title(); ?></h1>
            <?php if ($text) : ?>
              <div class="tg-project-intro__text"><?php echo wp_kses_post($text); ?></div>
            <?php elseif (has_excerpt()) : ?>
              <p class="tg-project-intro__text"><?php echo esc_html(get_the_excerpt()); ?></p>
            <?php endif; ?>
          </div>

          <?php if ($facts) : ?>
            <dl class="tg-project-intro__facts">
              <?php foreach ($facts as $label => $value) : ?>
                <div class="tg-project-intro__fact">
                  <dt><?php echo esc_html($label); ?></dt>
                  <dd><?php echo esc_html($value); ?></dd>
                </div>
              <?php endforeach; ?>
            </dl>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <?php
    // Weitere Module (Sketch Compare, Galerie, CTA …) aus dem Feld "Seitenmodule"
    if ($acf && have_rows('page_modules')) {
      get_template_part('templates/render', 'page-modules');
    }

    // Vorheriges / nächstes Projekt (nach Reihenfolge, dann Datum)
    $all = get_posts(array(
      'post_type'      => 'projekt',
      'posts_per_page' => -1,
      'orderby'        => array('menu_order' => 'ASC', 'date' => 'DESC'),
      'fields'         => 'ids',
    ));
    $pos  = array_search(get_the_ID(), $all, true);
    $prev = ($pos !== false && $pos > 0) ? $all[$pos - 1] : null;
    $next = ($pos !== false && $pos < count($all) - 1) ? $all[$pos + 1] : null;
    ?>

    <?php if ($prev || $next) : ?>
      <nav class="tg-project-nav" aria-label="Weitere Projekte">
        <div class="tg-container tg-project-nav__inner">
          <?php if ($prev) : ?>
            <a class="tg-project-nav__prev" href="<?php echo esc_url(get_permalink($prev)); ?>">&larr; <?php echo esc_html(get_the_title($prev)); ?></a>
          <?php else : ?><span></span><?php endif; ?>
          <?php if ($next) : ?>
            <a class="tg-project-nav__next" href="<?php echo esc_url(get_permalink($next)); ?>">Nächstes Projekt: <?php echo esc_html(get_the_title($next)); ?> &rarr;</a>
          <?php endif; ?>
        </div>
      </nav>
    <?php endif; ?>

  <?php endwhile; ?>
</main>

<?php get_footer();
