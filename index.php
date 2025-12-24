<?php
global $post;
get_header(); ?>

<div class="p-<?= $post->post_name; ?>">

  <?php get_template_part('include/l_header'); ?>
  <!-- l_header -->

  <div class="l-wrapper">

    <main class="l-main">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
          the_content();
        endwhile;
      endif;
      ?>
    </main>
    <!-- l_main -->

  </div>
  <!-- l_wrapper -->

  <?php get_template_part('include/l_footer'); ?>
  <!-- l_footer -->

</div>
<!-- l_container -->

<?php get_footer(); ?>