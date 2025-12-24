<?php
global $post;

$classname = '';

if ($post instanceof WP_Post && ! empty($post->post_name)) {
  $classname = 'p-' . $post->post_name;
}
get_header(); ?>

<div class="<?= esc_attr($classname);?>">

  <?php get_template_part('include/l_header'); ?>
  <!-- l_header -->

  <div class="l-wrapper">

    <main class="l-main">
      <div class="l-contents">
        <?php get_template_part('include/l_lower_mv'); ?>

        <?php get_template_part('include/breadcrumb'); ?>

        <?php if (! empty($post->post_name)) get_template_part('contents/page/' . $post->post_name); ?>
      </div>
    </main>
    <!-- l_main -->

  </div>
  <!-- l_wrapper -->

  <?php get_template_part('include/l_footer'); ?>
  <!-- l_footer -->

</div>
<!-- l_container -->

<?php get_footer(); ?>
