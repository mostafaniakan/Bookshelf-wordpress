<?php $url = $_SERVER['REQUEST_URI']; // get the current URL
$parts = explode('/', $url); // split the URL into parts
$last_part = end($parts); // get the last part of the URL
$edit = urldecode($last_part); // decode the URL-encoded string
$edit = explode('?', $edit);
$edit = $edit[0];

get_header();
if (have_posts()):?>
    <?php while (have_posts()) the_post(); ?>
    <?php
    if (isset($_GET['book_id'])) {
        $book_id_query = sanitize_text_field($_GET['book_id']);
    }
    ?>
    <?php $query_get_post = get_all_book('`id`=' . $book_id_query);

    ?>
<?php endif; ?>
<div class="card card_like" >
    <?php
    if ($query_get_post[0]->image):
        ?>

        <img class="img-fluid" src="<?= $query_get_post[0]->image ?>"
             alt="image">
    <?php else: ?>
        <img class="img-fluid"
             src="https://hackr.io/blog/what-is-programming-language/thumbnail/large"
             alt="image">
    <?php endif; ?>

    <h3 class="title"><a> <?php echo $query_get_post[0]->title ?></a></h3>
    <p><?= $query_get_post[0]->author . " " ?> نویسنده:</p>
    <p><?= $query_get_post[0]->publication_year . " " ?> تاریخ انتشار:</p>
    <p><?= $query_get_post[0]->genre . " " ?> ژانر:</p>
    <p><?= $query_get_post[0]->excerpt . " " ?> خلاصه:</p>

    <div class="like">
        <svg class="like_post <?php
        $post_like = check_like($query_get_post[0]->id);
        if ($post_like > 0) {
            echo 'like_active';
        }
        ?>" id="like" data-id="<?= $query_get_post[0]->id ?>" title="Like undefined SVG File" width="21" height="21"
             viewBox="0 0 24 24" fill="none" stroke="#8899a4" stroke-width="2" stroke-linecap="round"
             stroke-linejoin="round">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
        </svg>
    </div>

</div>