<div <?php post_class('tile') ?>>
  <a href="<?php the_permalink() ?>" style="background-image:url(<?php my_thumb() ?>)">
    <div class="tile-body">
      <p class="tile-category"><?php my_category() ?></p>
      <h2 class="tile-title"><?php the_title() ?></h2>
    </div>
  </a>
  <div class="tile-share">
    <a class="icon facebook" href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(get_permalink()); ?>" target="_blank"></a>
    <a class="icon twitter" href="<?php echo 'https://twitter.com/home?status=' . urlencode('Curti este link: ' . get_permalink()); ?>" target="_blank"></a>
    <?php if (has_post_thumbnail()) : ?>
    <a class="icon pinterest" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink() . '&media=' . wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) . '&description=' . get_the_title(); ?>" target="_blank"></a>
    <?php endif; ?>
    <a class="icon email" href="mailto:?Subject=<?php echo urlencode('Curti este link: ' . get_permalink()); ?>" target="_blank"></a>
    <?php edit_post_link( '', '', '' ) ?>
  </div>
</div>
