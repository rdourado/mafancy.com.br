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
          <?php posts_nav_link( '&nbsp;&nbsp;&nbsp;&nbsp;', 'Mais Recentes', 'Carregar mais posts' ); ?>
        </div>
      </div>
      <?php endif; ?>
    </main>
<?php get_footer() ?>