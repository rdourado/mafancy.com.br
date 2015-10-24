<!DOCTYPE html>
<html <?php language_attributes('html') ?>>
  <head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=960">
    <?php wp_head() ?>
  </head>
  <body <?php body_class() ?>>
    <header class="head" role="banner">
      <?php my_logo() ?>
      <nav class="nav-head">
        <div class="wrap">
          <?php my_menu('site') ?>
          <?php my_menu('categories') ?>
          <?php my_menu('social') ?>
          <?php get_search_form() ?>
        </div>
      </nav>
    </header>
