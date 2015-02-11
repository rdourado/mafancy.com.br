<?php get_header() ?>
    <main class="main" role="main">
      <div class="wrap">
        <div class="tile-list" id="masonry">
          <div class="sizer"></div>
          <?php
          while (have_posts()) {
            the_post();
            get_template_part('content');
          }
          ?>
        </div>
        <div class="pagination">
          <?php posts_nav_link( '&nbsp;&nbsp;&nbsp;&nbsp;', 'Recentes', 'Antigos' ); ?>
        </div>
      </div>
    </main>
<?php get_footer() ?>