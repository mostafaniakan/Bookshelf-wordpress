<?php

function wp_add_users()
{
    $nonce = $_POST['nonce'];
    if (!wp_verify_nonce($nonce)) {
        die('شیطنت نکن');
    }
    $user_name = sanitize_text_field($_POST['user_name']);
    $email = sanitize_email(sanitize_text_field($_POST['email']));
    $password = sanitize_text_field($_POST['password']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);

    if (username_exists($user_name)) {
        wp_send_json([
            'error' => true,
            'msg' => 'نام کاربری تکراری',

        ], 400);
    }
    if (email_exists($email)) {
        wp_send_json([
            'error' => true,
            'msg' => 'ایمیل وجود دارد',

        ], 400);
    }
    if (empty($user_name) || empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
        wp_send_json([
            'error' => true,
            'msg' => 'تمامی فیلد ها الزامی',

        ], 400);
    }
    $userdata = array(
        'user_pass' => $password,
        'user_login' => $user_name,
        'user_email' => $email,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'user_registered' => date('Y-m-d H:i:s'),
        'show_admin_bar_front' => false,
        'role' => 'subscriber',


    );
    wp_insert_user($userdata);

    $creds = array(
        'user_login' => $user_name,
        'user_password' => $password,
        'remember' => true
    );

    $log_in = wp_signon($creds, true);
    if (!$log_in->errors) {
        wp_send_json([
            'success' => true,
            'msg' => 'باموفقیت ثبت نام کردید',

        ], 200);

    }


}

function wp_login_user()
{
    $nonce = $_POST['nonce'];
    if (!wp_verify_nonce($nonce)) {
        die('شیطنت نکن');
    }
    $user_name = sanitize_text_field($_POST['user_name']);
    $password = sanitize_text_field($_POST['password']);
    $creds = array(
        'user_login' => $user_name,
        'user_password' => $password,
        'remember' => true
    );

    $log_in = wp_signon($creds, true);

    if (!$log_in->errors) {
        wp_send_json([
            'success' => true,
            'msg' => 'وارد',

        ], 200);
    } else {
        wp_send_json([
            'error' => true,
            'msg' => 'نام کاربری یا رمز عبور اشتباه',

        ], 400);
    }


}


function wp_create_post()
{
    $nonce = $_POST['nonce'];
    if (!wp_verify_nonce($nonce)) {
        die('شیطنت نکن');
    }
    global $wpdb;
    $table = $wpdb->prefix . 'my_bookshelf';


    $title = sanitize_text_field($_POST['title_post']);
    $author = sanitize_text_field($_POST['author_post']);
    $genre = sanitize_text_field($_POST['genre_post']);
    $publication_year = sanitize_text_field($_POST['publication_year']);
    $excerpt = sanitize_text_field($_POST['excerpt']);
    $user_id = get_current_user_id();
    $file = $_FILES['file_img'];


    foreach ($_POST as $field) {
        if (empty($field)) {
            wp_send_json([
                'error' => true,
                'msg' => 'تمامی فیلد ها الزامی',

            ], 400);
            return false;
        }
    }

    if (empty($file['name'])) {
        wp_send_json([
            'error' => true,
            'msg' => 'عکس الزامی',

        ], 400);
        return false;
    }


    $wpFilePath = wp_upload_dir();
    $filePath = $wpFilePath['basedir'] . "/Bookshelf_uploads_dir" . '/' . date('Y') . '/' . date('m') . '/';

    if (!file_exists($filePath)) {
        wp_mkdir_p($filePath);
    }

    $fileNamePart = explode('.', $file['name']);
    $newFileName = $fileNamePart[0] . rand(1000, 9999) . '.' . end($fileNamePart);


    $result = move_uploaded_file($file['tmp_name'], $filePath . $newFileName);

    $img_url = home_url() . "/wp-content/uploads/Bookshelf_uploads_dir" . '/' . date('Y') . '/' . date('m') . '/' . $newFileName;


    $data = [
        'title' => $title,
        'author' => $author,
        'genre' => $genre,
        'publication_year' => $publication_year,
        'image' => $img_url,
        'excerpt' => $excerpt,
        'user_id' => $user_id,
    ];
    $format = ['%s', '%s', '%s', '%s', '%s', '%s', '%d'];
    $stmt = $wpdb->insert(
        $table,
        $data,
        $format,
    );


    if ($stmt) {
        wp_send_json([
            'success' => true,
            'msg' => 'فایل مورد نظر شما با موفقیت آپلود گردید',

        ], 200);
    } else {
        wp_delete_file($filePath . $newFileName);
        wp_send_json([
            'error' => true,
            'msg' => $wpdb->last_error,

        ], 400);

    }

}

function wp_add_like()
{
    global $wpdb;
    $table = $wpdb->prefix . 'my_users_like_book';
    $book_id = sanitize_text_field($_POST['post_id']);
    $user_id = esc_attr(get_current_user_id());
    $date = [
        'user_id' => $user_id,
        'book_id' => $book_id,
    ];
    $filter = ['%d', '%d'];
    $wpdb->insert($table, $date, $filter);

}

function wp_delete_like()
{
    global $wpdb;
    $table = $wpdb->prefix . 'my_users_like_book';
    $book_id = sanitize_text_field($_POST['post_id']);
    $where = [
        'book_id' => $book_id
    ];
    $where_format = ['%d'];
    $wpdb->delete($table, $where, $where_format);

}

function get_all_book($book_id = 1)
{

    $filter = $book_id;
    global $wpdb;
    $table = $wpdb->prefix . 'my_bookshelf';
    $stmt = $wpdb->get_results("SELECT  `id`, `title`, `author`, `genre`, `publication_year`, `image`, `excerpt`  FROM {$table}  WHERE {$filter}");
    if ($stmt) {
        return $stmt;
    } else {
        return false;
    }
}

function check_like($post_id)
{

    global $wpdb;
    $table = $wpdb->prefix . 'my_users_like_book';
    $user_id = esc_attr(get_current_user_id());
    $post_id = sanitize_text_field($post_id);
    $stmt = $wpdb->get_var($wpdb->prepare("SELECT `id` FROM {$table} WHERE `user_id`= {$user_id} AND `book_id` = {$post_id}"));


    if ($stmt) {
        return $stmt;
    } else {
        return false;
    }
}

function get_post_like()
{
    $post_like = array();
    global $wpdb;
    $table = $wpdb->prefix . 'my_users_like_book';
    $books_table = $wpdb->prefix . 'my_bookshelf';
    $user_id = esc_attr(get_current_user_id());
    $stmt = $wpdb->get_results("SELECT `book_id` FROM {$table} WHERE `user_id`= {$user_id} ");
    foreach ($stmt as $id) {
        $post_like[] = $id->book_id;
    }

    $post_like_str = implode(',', $post_like);
    $get_posts_like = $wpdb->get_results("SELECT `id`, `title`, `author`, `genre`, `publication_year`, `image`, `excerpt`, `user_id` FROM {$books_table} WHERE `id` IN ({$post_like_str}); ");

    if ($get_posts_like) {
        return $get_posts_like;
    } else {
        return false;
    }
}

function get_my_books()
{
    global $wpdb;
    $books_table = $wpdb->prefix . 'my_bookshelf';
    $user_id = esc_attr(get_current_user_id());
    $stmt = $wpdb->get_results("SELECT `id`, `title`, `author`, `genre`, `publication_year`, `image`, `excerpt`, `user_id` FROM {$books_table} WHERE `user_id` = {$user_id};");

    if ($stmt) {
        return $stmt;
    } else {
        return false;
    }
}

function wp_update_book()
{
    $nonce = $_POST['nonce'];
    if (!wp_verify_nonce($nonce)) {
        die('شیطنت نکن');
    }
    global $wpdb;
    $table = $wpdb->prefix . 'my_bookshelf';

    $id = sanitize_text_field($_POST['post_id']);
    $title = sanitize_text_field($_POST['title_post']);
    $author = sanitize_text_field($_POST['author_post']);
    $genre = sanitize_text_field($_POST['genre_post']);
    $publication_year = sanitize_text_field($_POST['publication_year']);
    $excerpt = sanitize_text_field($_POST['excerpt']);
    $user_id = get_current_user_id();
    $file = $_FILES['file_img'];


    foreach ($_POST as $field) {
        if (empty($field)) {
            wp_send_json([
                'error' => true,
                'msg' => 'تمامی فیلد ها الزامی',

            ], 400);
            return false;
        }
    }

    if (!empty($file['name'])) {


        $wpFilePath = wp_upload_dir();
        $filePath = $wpFilePath['basedir'] . "/Bookshelf_uploads_dir" . '/' . date('Y') . '/' . date('m') . '/';

        if (!file_exists($filePath)) {
            wp_mkdir_p($filePath);
        }

        $fileNamePart = explode('.', $file['name']);
        $newFileName = $fileNamePart[0] . rand(1000, 9999) . '.' . end($fileNamePart);


        $result = move_uploaded_file($file['tmp_name'], $filePath . $newFileName);

        $img_url = home_url() . "/wp-content/uploads/Bookshelf_uploads_dir" . '/' . date('Y') . '/' . date('m') . '/' . $newFileName;

        $data = [
            'title' => $title,
            'author' => $author,
            'genre' => $genre,
            'publication_year' => $publication_year,
            'image' => $img_url,
            'excerpt' => $excerpt,
            'user_id' => $user_id,
        ];
        $format = ['%s', '%s', '%s', '%s', '%s', '%s', '%d'];


    } else {
        $data = [
            'title' => $title,
            'author' => $author,
            'genre' => $genre,
            'publication_year' => $publication_year,
            'excerpt' => $excerpt,
            'user_id' => $user_id,
        ];
        $format = ['%s', '%s', '%s', '%s', '%s', '%d'];

    }
    $where = [
        'id' => $id,
        'user_id'=>$user_id
        ];
    $where_format = ['%d','%d'];

    $stmt = $wpdb->update(
        $table,
        $data,
        $where,
        $format,
        $where_format,
    );

    if ($stmt) {
        wp_send_json([
            'success' => true,
            'msg' => 'فایل مورد نظر شما با موفقیت آپدیت شد گردید',

        ], 200);
    } else {
        wp_delete_file($filePath . $newFileName);
        wp_send_json([
            'error' => true,
            'msg' => $wpdb->last_error,

        ], 400);

    }
}

add_action('wp_ajax_nopriv_wp_add_users', 'wp_add_users');
add_action('wp_ajax_nopriv_wp_login_user', 'wp_login_user');
add_action('wp_ajax_wp_create_post', 'wp_create_post');
add_action('wp_ajax_wp_add_like', 'wp_add_like');
add_action('wp_ajax_wp_delete_like', 'wp_delete_like');
add_action('wp_ajax_wp_update_book', 'wp_update_book');

