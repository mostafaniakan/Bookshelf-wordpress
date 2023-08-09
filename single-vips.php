
<?php
$args = array(
    'post_type' => 'vip',
//            'posts_per_page' => 1,
);

$your_posts = new WP_Query($args);
if($your_posts->have_posts()):?>
    <?php while ($your_posts->have_posts()) $your_posts->the_post(); ?>
    <?php echo get_the_ID() ?>
    <?php
    if (has_post_thumbnail()) {
        the_post_thumbnail('', [
            'class' => 'img-fluid',
            'id' => 'test',
            'alt' => get_the_title()

        ]);
    } else {
        echo lt_default_post_thumbnail();
    }
    ?>
    <?php the_content(); ?>

<?php endif;?>
<div>
    <?php previous_post_link(); ?>
    <?php next_post_link(); ?>
</div>
<?php get_footer(); ?>
