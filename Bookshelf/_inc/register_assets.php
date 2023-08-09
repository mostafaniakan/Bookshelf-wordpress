<?php
function wp_register_assets(){
    wp_enqueue_script('front_ajax',get_template_directory_uri().'/assets/js/dashbord.js',['jquery'],'1.0.0');
    wp_enqueue_style('style_front',get_template_directory_uri().'/assets/css/style.css','','1.0.0');
    wp_enqueue_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.rtl.min.css', '', '5.2.0');
    wp_enqueue_script('bootstrap-5-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js', '', '5.2.0', '');
    wp_enqueue_script('sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', '', '2.0.0', '');
    wp_localize_script('front_ajax','ajax',['ajax_url'=>admin_url('admin-ajax.php'),'_nonce'=>wp_create_nonce(),]);
}
add_action('wp_enqueue_scripts','wp_register_assets');