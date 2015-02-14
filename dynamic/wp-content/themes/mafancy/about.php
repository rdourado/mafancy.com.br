<?php
/*
Template name: About
*/
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
  wpcf7_enqueue_scripts();
}
?>
<?php get_header() ?>
    <main class="main" role="main">
      <?php while (have_posts()) : the_post(); ?>
      <article class="about">
        <div class="wrap">
          <div class="body">
            <h1 class="header"><?php the_title() ?>
            <small class="sub"><?php the_field('subtitle') ?></small></h1>
            <?php the_content() ?>
          </div>
          <div class="wallpapers">
            <?php if (get_field('wallpaper-iphone')) { ?>
            <a class="iphone" href="<?php the_field('wallpaper-iphone') ?>" target="_blank">Baixar<br>wallpaper<br>iPhone</a>
            <?php } if (get_field('wallpaper-desktop')) { ?>
            <a class="desktop" href="<?php the_field('wallpaper-desktop') ?>" target="_blank">Baixar<br>wallpaper<br>desktop</a>
            <?php } ?>
          </div>
        </div>
      </article>
      <section class="creator" id="me">
        <div class="wrap">
          <?php my_full_image('imagem', 'me') ?>
          <div class="body">
            <h2 class="header">Content Creator</h2>
            <?php the_field('content-creator') ?>
            <p class="social">
              <?php if (get_field('instagram')) { ?>
              <a class="icon instagram" href="<?php the_field('instagram') ?>" target="_blank"></a>
              <?php } if (get_field('facebook')) { ?>
              <a class="icon facebook" href="<?php the_field('facebook') ?>" target="_blank"></a>
              <?php } if (get_field('twitter')) { ?>
              <a class="icon twitter" href="<?php the_field('twitter') ?>" target="_blank"></a>
              <?php } if (get_field('pinterest')) { ?>
              <a class="icon pinterest" href="<?php the_field('pinterest') ?>" target="_blank"></a>
              <?php } if (get_field('email')) { ?>
              <a class="icon email" href="<?php the_field('email') ?>"></a>
              <?php } ?>
            </p>
          </div>
        </div>
      </section>
      <section class="contact" id="contato">
        <div class="wrap">
          <div class="body">
            <h2 class="header">Contato</h2>
            <?php the_field('contato') ?>
          </div>
          <?php echo do_shortcode('[contact-form-7 id="83" title="Contato"]'); ?>
        </div>
      </section>
      <section class="ad" id="anuncie">
        <div class="wrap">
          <h2 class="header">Anuncie</h2>
          <div class="body">
            <?php the_field('anuncie') ?>
          </div>
        </div>
      </section>
      <?php endwhile; ?>
    </main>
<?php get_footer() ?>