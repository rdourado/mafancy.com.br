<?php get_header() ?>
    <main class="main" role="main">
      <?php if (have_posts()) : ?>
      <div class="wrap">
        <div class="tile-list" id="content">
          <div class="sizer"></div>
          <?php
          while (have_posts()) {
            the_post();
            get_template_part('loop');
          }
          ?>
        </div>
        <div class="pagination" id="nav-below">
          <?php posts_nav_link( '&nbsp;&nbsp;&nbsp;&nbsp;', 'Go Back', 'More Posts' ); ?>
        </div>
        <div class="google-ad ad-1">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- Index -->
          <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5714615502356365" data-ad-slot="6879806939" data-ad-format="auto"></ins>
          <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
        </div>
      </div>
      <?php endif; ?>
    </main>
<?php get_footer() ?>