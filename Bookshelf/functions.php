<?php
defined('ABSPATH') || exit;
define('EXP_PATH', get_template_directory());
define('EXP_URL', get_template_directory_uri());


function lt_default_post_thumbnail(): string
{
    return '<img class="img-fluid" src="https://hackr.io/blog/what-is-programming-language/thumbnail/large" alt="image">';
}

function lt_theme_setup()
{
    add_theme_support('post-thumbnails');
    add_image_size('my-size', '200', '200', array('center', 'center'));
}

add_action('after_setup_theme', 'lt_theme_setup');

function remove_img_attr($html)
{
    return preg_replace('/(width|height)="\d+"\s/', "", $html);
}

add_filter('post_thumbnail_html', 'remove_img_attr');


//        pagination with posts_per_page
function lt_pagination($query_name)
{
    $GLOBALS['wp_query']->max_num_pages = $query_name->max_num_pages;
    the_posts_pagination([
        'screen_reader_text' => ' ',
        'prev_text' => 'مقاله قبلی',
        'next_text' => 'مقاله بعدی',
        'mid_size' => 1,
        'class' => 'test'
    ]);
}

include_once '_inc/register_assets.php';
include '_inc/book.php';


function add_book($request, $user_id)
{
    global $wpdb;
    $table = $wpdb->prefix . 'my_bookshelf';


    $title = sanitize_text_field($request['title_post']);
    $author = sanitize_text_field($request['author_post']);
    $genre = sanitize_text_field($request['genre_post']);
    $publication_year = sanitize_text_field($request['publication_year']);
    $excerpt = sanitize_text_field($request['excerpt']);

    if (empty($title) || empty($author) || empty($genre) || empty($publication_year) || empty($excerpt) || empty($_FILES['file_img']['name'])) {

        http_response_code(400);

        echo json_encode([
            'status' => 'error',
            'text' => 'تمامی اطلاعات الزامی',
        ]);
        exit;

    } else {

        $file = $_FILES['file_img'];

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
            echo json_encode([
                'success' => 'success',
                'msg' => 'فایل مورد نظر شما با موفقیت آپلود گردید'
            ]);
            http_response_code(200);
        } else {
//            delete img
            wp_delete_file( $filePath .$newFileName  );
            echo json_encode([
                'success' => 'error',
                'msg' => $wpdb->last_error
            ]);
            http_response_code(400);
        }
        exit;
    }
}

//create api
function add_book_api(): void
{
    register_rest_route('cwp/v1', 'book', [
        'methods' => WP_REST_Server::ALLMETHODS,
        'callback' => function (WP_REST_Request $request) {

            $user_data = $request;

            $result = wp_authenticate_email_password(null, $user_data['email'], $user_data['password']);

            if (is_wp_error($result)) {
                return $result;
            } else if ($result == null) {
                return [
                    'status' => 'ایمیل و کلمه عبور چک شود'
                ];
            }

            add_book($request, $result->ID);
        },
        'permission_callback' => '__return_true',
    ]);
}

add_action('rest_api_init', 'add_book_api');