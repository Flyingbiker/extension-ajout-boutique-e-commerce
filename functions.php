<?php
// Add custom Theme Functions here

function generer_parametre_boutique(){
  $array = [];
  $array = [
    'background-color' => '#DCDCDC',
    'image-category' => 'https://nagelibre.fr/surfaces-clubs/wp-content/uploads/2021/06/asso-chasse-teaser.png',
    'start-date' => '2021-05-01',
    'end-date' => '2021-08-31',
    'periode' => 'Du 01 mai au 31 jullet 2021',
    'url-cat' => 'https://nagelibre.fr/surfaces-clubs/home-2/?slug=boutique-test-chasseurs',
    'shipping-type' => '1' // 1: livraison club, 2: livraison domicile gratuite, 3: livraison domicile payante
  ];
  $ser = serialize($array);
  echo $ser;
}

add_action('wp_head', 'get_page_permalink_from_name');
function get_page_permalink_from_name($page_name) {
  global $post;
  global $wpdb;
  $pageid_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $page_name . "' LIMIT 0, 1");
  return get_permalink($pageid_name);
}


add_action('init', 'NL_register_frontend_script');
function NL_register_frontend_script()
{
  wp_enqueue_style('NL_sc_modal_css',
    get_template_directory_uri() . '-child/css/modal.css', '', 1);
  wp_enqueue_script('NL_sc_modal_js', get_template_directory_uri() . '-child/js/modal.js', array('jquery'), 1, true);
  wp_enqueue_script( 'wc-add-to-cart-variation' );
  wp_enqueue_script( 'wc-add-to-cart-variation', get_template_directory_uri() . '/woocommerce/assets/js/frontend/add-to-cart-variation.js' , array( 'jquery' ), false, true );
//  wp_enqueue_script('NL_add-to-cart-variation', get_template_directory_uri() . '/js/frontend/add-to-cart-variation.js', array('jquery'), 1, true);
}

add_action('wp_head', 'get_current_product_category');
function get_current_product_category($p_id = 0){
  global $post;
  $cat = "";
  if($p_id === 0){
    $p_id = $post->ID;
  }
  $terms = get_the_terms( $p_id, 'product_cat' );
  $nterms = get_the_terms( $p_id, 'product_tag'  );
  if ($terms) {
    foreach ($terms  as $term  ) {
      $product_cat_id = $term->term_id;
      $product_cat_name = $term->name;
      $cat = $term;
      break;
    }
  }
  return $cat;
}

/*
 * ajout d'une action sur le pop-up
 */

add_action('woocommerce_after_add_to_cart_form', 'NL_sc_pop_up');
function NL_sc_pop_up()
{
  if (is_product()) {
    $a = '<div>
            <div id="NL_sc_show_popup" class="NL_sc_btn_popup NL_sc_btn_span NL_sc_call_poup">
                <div class="NL_sc_text_icon">
                    <span class="NL_sc_size_icon"></span>
                </div>
            </div>
            <div id="NL_sc_modal" class="NL_sc_modal">
              <div class="NL_sc_modal_content">
                <span class="NL_sc_modal_close">&times;</span>
                <div class="NL_sc_scroll_content">
                </div>
              </div>
            </div>
          </div>';
    return $a;
  }
}

//fonction pour ajouter les scripts et le style pour la page edit category du back-admin
function Serialize_description_shop_script_style(){
  if (get_admin_page_title() === 'Modifier la catégorie') {
	wp_enqueue_style('Serialize_description_shop_style', get_template_directory_uri() . '-child/css/serialize-description-shop.css');
  	wp_enqueue_script( 'Serialize_description_shop_script', get_template_directory_uri(). '-child/js/serialize-description-shop.js', array('jquery', 'wp-color-picker') );
  }
}
add_action( 'admin_enqueue_scripts', 'Serialize_description_shop_script_style' );
