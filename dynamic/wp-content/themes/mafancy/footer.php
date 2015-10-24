    <footer class="foot" role="contentinfo">
      <?php if (get_field('video', 'option')) : ?>
      <section class="tv">
        <div class="wrap">
          <h3 class="header"><img alt="MFTV" height="43" src="<?php echo get_template_directory_uri(); ?>/img/minilogo@2x.png" width="125"></h3>
          <?php if (get_field('youtube', 'option')) : ?>
          <a class="link subscribe" href="<?php the_field('youtube', 'option') ?>" target="_blank">Assine o canal</a>
          <?php endif; ?>
          <div class="media">
            <?php echo apply_filters('the_content', '[embed]' . get_field('video', 'option') . '[/embed]'); ?>
          </div>
        </div>
      </section>
      <?php endif; ?>
      <?php get_sidebar() ?>
      <?php if (have_rows('popular', 'option')) : ?>
      <section class="popular">
        <div class="wrap">
          <h3 class="header">Posts mais lidos</h3>
          <div class="tile-list">
            <?php
            while (have_rows('popular', 'option')) {
              the_row();
              $post = get_sub_field('post');
              get_template_part('loop');
            }
            ?>
          </div>
        </div>
      </section>
      <?php
      endif;
      wp_reset_postdata();
      ?>
      <div class="wrap">
        <div class="nav-foot">
          <?php my_menu('categories') ?>
          <?php my_menu('site') ?>
          <?php my_menu('social') ?>
        </div>
        <p class="copyright"><?php the_field('copyright', 'option') ?></p>
      </div>
    </footer>
    <!-- WP -->
    <?php wp_footer() ?>
  </body>
</html>