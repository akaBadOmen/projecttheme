  </div><!-- #content -->

  <footer id="colophon" class="site-footer">
    <div class="footer-grid">

      <div class="footer-col footer-col--brand">
        <a class="footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Zur Startseite', 'textdomaintomodify' ); ?>">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="Tischlerei Gruber">
        </a>
        <p class="footer-text">Maßmöbel &amp; Innenausbau<br>aus der Steiermark.</p>
      </div>

      <div class="footer-col">
        <h2 class="footer-heading">Kontakt</h2>
        <p class="footer-text">
          Fladnitz an der Teichalm<br>
          <a href="tel:+43317900000">+43 3179 000 00</a><br>
          <a href="mailto:office@tischlerei-gruber.at">office@tischlerei-gruber.at</a>
        </p>
      </div>

      <nav class="footer-col" aria-label="<?php esc_attr_e( 'Seiten', 'textdomaintomodify' ); ?>">
        <h2 class="footer-heading">Seiten</h2>
        <?php wp_nav_menu( array( 'theme_location' => 'menu-main', 'menu_id' => 'menu-footer-pages', 'menu_class' => 'footer-menu', 'container' => false, 'depth' => 1 ) ); ?>
      </nav>

      <nav class="footer-col" aria-label="<?php esc_attr_e( 'Rechtliches', 'textdomaintomodify' ); ?>">
        <h2 class="footer-heading">Rechtliches</h2>
        <?php /* Fiktives Studienprojekt: Impressum & Datenschutz bewusst nur als Hinweis, ohne eigene Seiten/Links */ ?>
        <ul class="footer-menu">
          <li><span class="footer-placeholder">Impressum</span></li>
          <li><span class="footer-placeholder">Datenschutz</span></li>
          <li><a href="https://www.instagram.com/" target="_blank" rel="noopener">Instagram</a></li>
        </ul>
      </nav>

    </div>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
