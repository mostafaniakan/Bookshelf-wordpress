<?php
$url = $_SERVER['REQUEST_URI']; // get the current URL
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
    <?php if ($edit == 'ویرایش'): ?>
     <?php include EXP_PATH.'/_inc/view/form_update.php' ?>
    <?php elseif ($edit == 'کتاب'): ?>
   <?php include EXP_PATH.'/_inc/view/share_link.php'?>
    <?php endif; ?>
<?php endif; ?>
