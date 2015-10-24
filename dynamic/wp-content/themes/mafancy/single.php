<?php get_header() ?>
    <main class="main" role="main">
      <?php while (have_posts()) : the_post(); ?>
      <article class="entry h-entry">
        <header class="entry-head">
          <div class="wrap">
            <h1 class="p-name"><?php the_title() ?></h1>
            <p class="p-category">
              <?php the_category(', ') ?>
            </p>
            <time class="dt-published" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('j F Y') ?></time>
          </div>
        </header>
        <div class="e-content">
          <div class="wrap">
            <?php the_content() ?>
            <div class="google-ad ad-2">
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <!-- Post -->
              <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5714615502356365" data-ad-slot="7019407735" data-ad-format="auto"></ins>
              <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
          </div>
        </div>
        <footer class="entry-foot">
          <div class="wrap">
            <p class="p-category">
              <?php the_tags('<strong>Tags:</strong>', ', ') ?>
            </p>
            <p class="entry-share">
              <strong>Compartilhe esse post:</strong>
              <a class="icon twitter" href="<?php echo 'https://twitter.com/home?status=' . urlencode('Curti este link: ' . get_permalink()); ?>" target="_blank"><!-- <span>456</span> --></a>
              <a class="icon facebook" href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(get_permalink()); ?>" target="_blank"><!-- <span>987</span> --></a>
              <?php if (has_post_thumbnail()) : ?>
              <a class="icon pinterest" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink() . '&media=' . wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) . '&description=' . get_the_title(); ?>" target="_blank"><!-- <span>134</span> --></a>
              <?php endif; ?>
              <a class="icon email" href="mailto:?Subject=<?php echo urlencode('Curti este link: ' . get_permalink()); ?>" target="_blank"></a>
            </p>
          </div>
          <?php
          $query = new WP_Query(my_related_query());
          if ($query->have_posts()) :
          ?>
          <section class="related">
            <div class="wrap">
              <h3 class="header">Posts relacionados</h3>
              <div class="tile-list">
                <?php
                while ($query->have_posts()) {
                  $query->the_post();
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
        </footer>
        <?php if (comments_open()) : ?>
        <section class="comments">
          <div class="wrap">
            <h3 class="header">Comentários</h3>
            <div class="comments-list">
              <div class="fb-comments" data-colorscheme="light" data-href="<?php the_permalink() ?>" data-numposts="5"></div>
            </div>
            <div class="google-ad ad-3">
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <!-- Comentários -->
              <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5714615502356365" data-ad-slot="2449607338" data-ad-format="auto"></ins>
              <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
          </div>
        </section>
        <?php endif; ?>
      </article>
      <?php endwhile; ?>
    </main>
<?php get_footer() ?>