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
    <!--                create post-->
    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#sign-in">
        ایجاد پست
    </button>
    <!-- Modal -->
    <div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ایجاد پست</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form action="" id="create_post" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="first_name" class="form-label"> نام کتاب </label>
                                <input type="text" class="form-control" name="title_post" id="title_post"
                                       placeholder="نام کتاب ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="last_name" class="form-label">نویسنده </label>
                                <input type="text" class="form-control" name="author_post" id="author_post"
                                       placeholder="نویسنده ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="user_name" class="form-label">ژانر </label>
                                <input type="text" class="form-control" name="genre_post" id="genre_post"
                                       placeholder="ژانر ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="brand" class="form-label">تاریخ چاپ</label>
                                <input type="date" class="form-control" name="publication_year"
                                       id="publication_year"
                                       placeholder="تاریخ چاپ ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="model" class="form-label">انتخاب عکس</label>
                                <input type="file" name="file_img" class="form-control" id="file_img"
                                       accept="image/*" placeholder="انتخاب عکس ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="model" class="form-label">درباره کتاب</label>
                                <textarea type="text" class="form-control" name="excerpt" id="excerpt"
                                          placeholder="درباره کتاب ..."></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="add-create-user-nonce" value="<?= wp_create_nonce() ?>">
                </div>
                <div class="modal-footer mt-4">
                    <button type="submit" class="btn btn-success">ایجاد پست جدید</button>
                </div>
                </form>


            </div>
        </div>
    </div>


    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#ge_like_posts">
        پست های پسندیده
    </button>
    <!-- Modal -->
    <div class="modal fade" id="ge_like_posts" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">پست های پسندیده</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body like-book-body">

                    <?php $like = get_post_like();
                    if ($like): ?>
                        <?php foreach ($like as $post): ?>

                            <div class="card card_like">
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
                                </div>

                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-danger">هیچ کتابی پسند نشده</div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#my_post">
        پست های من
    </button>
    <!-- Modal -->
    <div class="modal fade" id="my_post" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">پست های پسندیده</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body like-book-body">

                    <?php $books = get_my_books();
                    if ($books): ?>
                        <?php foreach ($books as $books): ?>

                            <div class="card card_like">
                                <?php
                                if ($books->image):
                                    ?>

                                    <img class="img-fluid" src="<?= $books->image ?>"
                                         alt="image">
                                <?php else: ?>
                                    <img class="img-fluid"
                                         src="https://hackr.io/blog/what-is-programming-language/thumbnail/large"
                                         alt="image">
                                <?php endif; ?>

                                <h3 class="title" data-title="<?= $books->title?>" ><a> <?php echo $books->title ?></a></h3>
                                <p><?= $books->author . " " ?> نویسنده:</p>
                                <p><?= $books->publication_year . " " ?> تاریخ انتشار:</p>
                                <p><?= $books->genre . " " ?> ژانر:</p>
                                <p><?= $books->excerpt . " " ?> خلاصه:</p>

                                <div class="like">
                                    <svg class="like_post <?php
                                    $post_like = check_like($books->id);
                                    if ($post_like > 0) {
                                        echo 'like_active';
                                    }
                                    ?>" id="like" data-id="<?= $books->id ?>" title="Like undefined SVG File" width="21"
                                         height="21"
                                         viewBox="0 0 24 24" fill="none" stroke="#8899a4" stroke-width="2"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>

                                    <?php if (have_posts()): ?>
                                        <?php while (have_posts()): the_post(); ?>

                                            <?php if (get_the_title() == 'ویرایش'): ?>
                                                <h2>
                                                    <a href="<?= get_permalink() . '?book_id=' . $books->id ?>"><?= get_the_title() ?></a>
                                                </h2>
                                            <?php endif; ?>

                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>

                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-danger">هیچ کتابی پسند نشده</div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
    </div>
    <?php

} else {

    ?>

    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#sign-in">
        ثبت نام
    </button>
    <!-- Modal -->
    <div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ثبت نام</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form action="" id="create_user">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="first_name" class="form-label">نام </label>
                                <input type="text" class="form-control" id="first_name"
                                       placeholder="نام کاربری ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="last_name" class="form-label">نام خانوادگی </label>
                                <input type="text" class="form-control" id="last_name" placeholder="نام کاربری ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="user_name" class="form-label">نام کاربری </label>
                                <input type="text" class="form-control" id="user_name" placeholder="نام کاربری ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="brand" class="form-label">رمز عبور</label>
                                <input type="password" class="form-control" id="password"
                                       placeholder="رمز عبور ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="model" class="form-label">ایمیل</label>
                                <input type="email" class="form-control" id="email" placeholder="ایمیل ...">
                            </div>
                        </div>
                        <input type="hidden" id="add-create-user-nonce" value="<?= wp_create_nonce() ?>">
                </div>
                <div class="modal-footer mt-4">
                    <button type="submit" class="btn btn-success">افزودن</button>
                </div>
                </form>


            </div>
        </div>
    </div>
    </div>


    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#login">
        ورود
    </button>
    <!-- Modal -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ورود</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="login_user">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="name" class="form-label">نام کاربری </label>
                                <input type="text" class="form-control" id="name_login" placeholder="نام کاربری ...">
                            </div>
                            <div class="col-sm-12 col-md-6 mb-3">
                                <label for="brand" class="form-label">رمز عبور</label>
                                <input type="text" class="form-control" id="password_login" placeholder="رمز عبور ...">
                            </div>

                        </div>
                        <input type="hidden" id="login-user-nonce" value="<?= wp_create_nonce() ?>">
                </div>
                <div class="modal-footer mt-4">
                    <button type="submit" class="btn btn-success">ورود</button>
                </div>
                </form>


            </div>
        </div>
    </div>
    </div>
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
                        <svg class="like_post <?php
                        $post_like = check_like($post->id);
                        if ($post_like > 0) {
                            echo 'like_active';
                        }
                        ?>" id="like" data-id="<?= $post->id ?>" title="Like undefined SVG File" width="21" height="21"
                             viewBox="0 0 24 24" fill="none" stroke="#8899a4" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>

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