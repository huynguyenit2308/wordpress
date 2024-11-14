<?php
// Lấy file css và js
function load_style() {
    wp_enqueue_style("style_css", get_theme_file_uri('/css/nhaxinh.css'), array(), '1.0.0', 'all');
    wp_enqueue_style("child_css", get_theme_file_uri('/css/child.css'), array(), '1.0.1', 'all');    
    wp_enqueue_script("nhaxinh_js", get_theme_file_uri('/js/nhaxinh.js'), array('jquery'), '1.0.2', true);
}

add_action("wp_enqueue_scripts", "load_style");

// Sử dụng hàm để được hỗ trợ từ Woocommerce
function my_custom_wc_theme_support()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', 'my_custom_wc_theme_support');
function initTheme()
{
    // Chuyển trình soạn thảo về phiên bản cũ
    add_filter('use_block_editor_for_post', '__return_false');

    // Đăng kí Menu cho Website
    register_nav_menu('header-top', __('Menu top'));

    // Tính lượt View cho bài viết
    function setPostView($postID){
        $count_key = 'views';
        $count = get_post_meta($postID, $count_key, true);
        if($count == ''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
    function getPostViews($postID){
        $count_key = 'views';
        $count = get_post_meta($postID, $count_key, true);
        if($count == ''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return '0';
        }
        return $count;
    }
}
add_action('init', 'initTheme');

// Thêm Custom Post Type
function slider_post_type(){
    $label = array(
        'name' => 'Ảnh slider',
        'singular_name' => 'Ảnh slider'
    );
    $args = array(
        'labels' => $label,
        'description' => 'Ảnh slider', // Mô tả của Post type
        'supports' => array(
            'title',
            'thumbnail'  
        ), // Các tính năng được hỗ trợ trong Post type
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-gallery', // Biểu tượng menu
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('slider', $args);
}
add_action('init', 'slider_post_type');

// Tính % giảm giá
function precentSale($price, $priceSale){
    $sale = ($priceSale * 100) / $price;
    $precent = 100 - $sale;
    return number_format($precent, 1);
}

// Kích cỡ ảnh trong tin tức
add_image_size('custom-size', 600, 400, true);

// Xóa woocommerce_breadcrumb trong action woocommerce_before_main_content
function custom_remove_action_woo(){
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action('init', 'custom_remove_action_woo');


