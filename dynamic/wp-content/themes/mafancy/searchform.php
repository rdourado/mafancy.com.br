<form action="<?php echo home_url('/'); ?>" class="search-form" method="get">
  <fieldset>
    <legend>Busca</legend>
    <input class="search-field" id="s" name="s" placeholder="Busca" required type="search" value="<?php the_search_query() ?>">
    <button class="search-submit" type="submit"><i class="icon search"></i></button>
  </fieldset>
</form>
