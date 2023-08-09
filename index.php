<?php get_header() ?>
<?php
$all_Posts = 'http://localhost/wordpress/wp-json/wp/v2/posts?_fields=id,title,link,excerpt,custom_meta_box';
$all_Posts = file_get_contents($all_Posts);
$all_Posts = json_decode($all_Posts);

?>


    <div class="container">
    <div class="row">
        <?php if (is_user_logged_in()) { ?>
            <form action="<?php echo wp_logout_url(home_url()); ?>" method="post">
                <input type="submit" value="خروج">
            </form>
        <?php } ?>
        <?php

        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $user_name = get_userdata($user_id);
            echo $user_name->user_login;
            ?>

            <?php get_template_part('_inc/view/create-post', 'create-post') ?>


            <?php get_template_part('_inc/view/like-post', 'like-post') ?>

            <?php get_template_part('_inc/view/my-post', 'my-post') ?>
            <?php

        } else {

            ?>

            <?php get_template_part('_inc/view/create-post', 'create-post') ?>

            <?php get_template_part('_inc/view/login', 'login') ?>

            <?php
        }
        ?>


        <div class="books">
            <?php wp_get_current_user() ?>
            <?php
            $books = get_all_book();

            if ($books): ?>
                <?php foreach ($books as $post): ?>
                    <div class="card">
                        <?php
                        if ($post->image):
                            ?>

                            <img class="img-fluid" src="<?= $post->image ?>"
                                 alt="image">
                        <?php else: ?>
                            <img class="img-fluid"
                                 src="https://hackr.io/blog/what-is-programming-language/thumbnail/large"
                                 alt="image">
                        <?php endif; ?>

                        <h3 class="title"><a> <?php echo $post->title ?></a></h3>
                        <p><?= $post->author . " " ?> نویسنده:</p>
                        <p><?= $post->publication_year . " " ?> تاریخ انتشار:</p>
                        <p><?= $post->genre . " " ?> ژانر:</p>
                        <p><?= $post->excerpt . " " ?> خلاصه:</p>

                        <div class="like">
                            <?php if(is_user_logged_in()):?>
                                <svg class="like_post <?php
                                $post_like = check_like($post->id);
                                if ($post_like > 0) {
                                    echo 'like_active';
                                }
                                ?>" id="like" data-id="<?= $post->id ?>" title="Like undefined SVG File" width="21"
                                     height="21"
                                     viewBox="0 0 24 24" fill="none" stroke="#8899a4" stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            <?php else: ?>
                                <svg class="login_user_for_like"  title="Like undefined SVG File" width="21"
                                     height="21"
                                     viewBox="0 0 24 24" fill="none" stroke="#8899a4" stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            <?php endif;?>


                            <svg data-url="<?= get_site_url() . '/کتاب' . '?book_id=' . $post->id ?>" class="copy_link"
                                 height="21" width="21" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 442 442" xml:space="preserve">
                             <g>
                                 <polygon points="291,0 51,0 51,332 121,332 121,80 291,80 	"/>
                                 <polygon points="306,125 306,195 376,195 	"/>
                                 <polygon points="276,225 276,110 151,110 151,442 391,442 391,225 	"/>
                             </g>
                        </svg>

                        </div>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-danger">تاکنون مطلبی منتشر نشده است.</div>
            <?php endif; ?>


        </div>
    </div>

<?php get_footer() ?>