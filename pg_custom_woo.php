<?php
/**

* Plugin Name:       Gigena Custom Woocommerce
* Plugin URI:        https://gigena.net/code
* Description:       macht eine Anpassung des Woocommerce Checkout-Formulars, um Benutzer mit ganz bestimmten Eigenschaften zu registrieren. Mod.
* mod in Orders list , adding Code and Product name Column.-
* from 1.2 add section in Dashborad for Blubox Analitica
* Version:           1.3
* Author:            Pablo Gigena
* Author URI:        https://gigena.net/code
* 
* Developed for PHP 7.4
* Index / Content:
* 
*  1- Custom UI 
*  2- Tooltip 
*   3- No Cache 
*   4- Default Country in Checkout 
*   5- test hook woocommerce_review_order_after_payment 
*   6- test hook woocommerce_checkout_billing 
*   7- hidden Bag Sale 
*   8- Remove Sales Flash
*   9- Checkout custom 
*  10- Mod in E-Mail 
*  11- THankyou page
*  12- Validating Data in Checkout Process
*  13- check Anbieter wechseln..
*  14- custom colors in checkout
*  15- add coupons code column
*  16- add column code in Bestellungen 
*  17- Adding a Product Name
*  18- Plugin Blubox Statisk
*  19- ENTFALTEN SIE DAS FELD, HABEN SIE EINEN GUTSCHEIN? AN DER KASSE 
*  20- load JS for BWE mit oder ohne Flügel
*  21- Do something in JS hook: woocommerce_after_edit_account_address_form
*  22- Remove required field requirement for first/last name in My Account Edit form
*  23- The WordPress Core woocommerce after save address validation hook. 
*  24- Birthday Date Formart in PDF (Webtofee)
* 
* last edit: 22.12.2022
*/

global $mi_data;
global $contador;


/* 1- Custom UI */
add_action( 'after_setup_theme', 'custom_UI_woocommerce');

function custom_UI_woocommerce(){
				
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );


			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
			
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
			

			remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 10 );
			add_action( 'woocommerce_after_cart_table', 'woocommerce_button_proceed_to_checkout', 5 );

			remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );

			add_action('woocommerce_before_edit_account_address_form', 'bb_myadress');
			function bb_myadress(){
				echo '<div id="bb_myadress">';
			}

			add_action('woocommerce_after_edit_account_address_form', 'close_bb_myadress');
			function close_bb_myadress(){
				echo '</div>';
			}

			add_filter('woocommerce_account_menu_items', 'bb_custom_konto');

			function bb_custom_konto($items){
				
				unset( $items['downloads']);	
				//unset( $items[ 'edit-address' ] ); // Addresses
				unset( $items[ 'dashboard' ] ); // Remove Dashboard
				unset( $items[ 'payment-methods' ] ); // Remove Payment Methods
				//unset( $items[ 'orders' ] ); // Remove Orders
				
				unset( $items[ 'downloads' ] ); // Disable Downloads
				//unset( $items[ 'edit-account' ] ); // Remove Account details tab
				//unset( $items[ 'customer-logout' ] ); // Remove Logout link

				$items = array(
					'orders'             => __( 'Meine BluBox', 'woocommerce' ),
					'edit-account'    => __( 'Konto-Details', 'woocommerce' ),
					'edit-address'       => __( 'Lieferadresse', 'woocommerce' ),
					'customer-logout'    => __( 'Abmelden', 'woocommerce' ),
					
				);

				return $items;


			}
/*
			function my_account_menu_order() {
				$menuOrder = array(
					'orders'             => __( 'Tus pedidos', 'woocommerce' ),
					'downloads'          => __( 'Tus descargas', 'woocommerce' ),
					'edit-address'       => __( 'Direcciones', 'woocommerce' ),
					'edit-account'    => __( 'Mis datos', 'woocommerce' ),
					'customer-logout'    => __( 'Salir', 'woocommerce' ),
				   'dashboard'          => __( 'Inicio', 'woocommerce' ),
				);
				return $menuOrder;
			}
			//add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );
*/

}// Fin function custom_UI_woocommerce


/* 2- Tooltip */

//Instalando tooltip..
add_action( 'wp_footer', 'pg_tooltip', 9998);

function pg_tooltip(){

	echo '<!-- Tooltip CSS by PG -->';
	echo '<style type="text/css">';
	include 'include/tooltip.css';
	include 'include/pg_autocomplete_kasse.css';
	echo '</style>';

		echo '<script type="text/javascript" id="pg_tooltip">';
		include 'include/tooltip.js';
		echo '</script>';


		echo '<script type="text/javascript" id="pg_autocomplete_kasse">';
		include 'include/pg_autocomplete_kasse.js';
		echo '</script>';


}
//end fucntion pg_tooltip
/*
add_action('woocommerce_before_checkout_form', 'pg_load_tooltip_css');

function pg_load_tooltip_css(){
	echo '<!-- Tooltip CSS by PG -->';
	include 'include/tooltip.css';
}*/

/* 3- No Cache */
function hook_nocache() {
    ?>
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
    <?php
}
add_action('wp_head', 'hook_nocache');

/* 4- Default Country in Checkout */

add_filter( 'default_checkout_billing_country', 'change_default_checkout_country', 10, 1 );

function change_default_checkout_country( $country ) {
    // If the user already exists, don't override country
    if ( WC()->customer->get_is_paying_customer() ) {
        return $country;
    }

    return 'DE'; // Override default to Germany (an example)
}


/* 5- test hook woocommerce_review_order_after_payment*/

//add_action( 'woocommerce_review_order_after_payment', 'blubox_order_review', 10 );

function blubox_order_review(){
	//echo '<h1>Hey!</h1>';
}

/* 6- test hook woocommerce_checkout_billing*/

// add_action('woocommerce_checkout_billing', 'storeapps_checkout_billing');
function storeapps_checkout_billing() {
    echo '<h2>woocommerce_checkout_billing</h2>';
}


/* 7- borrar Bag de Sale */
add_filter( 'woocommerce_add_cart_item_data', 'mk_only_one_item_in_cart', 10, 1 );

function mk_only_one_item_in_cart( $cartItemData ) {
	wc_empty_cart();

	return $cartItemData;
}

// 8- Remove Sales Flash
add_filter('woocommerce_sale_flash', 'woo_custom_hide_sales_flash');
function woo_custom_hide_sales_flash()
{
    return false;
}


// 9-  Checkout custom 

// add_filter( 'woocommerce_checkout_fields' , 'woo_remove_billing_checkout_fields' );
/**
 * Remove unwanted checkout fields
 *
 * @return $fields array
*/
function woo_remove_billing_checkout_fields( $fields ) {
	// echo "se hace la funcion";
    
	    unset($fields['billing']['billing_company']);
	    unset($fields['billing']['billing_address_1']);
	    unset($fields['billing']['billing_address_2']);
	    unset($fields['billing']['billing_city']);
	    unset($fields['billing']['billing_postcode']);
	    unset($fields['billing']['billing_country']);
	    unset($fields['billing']['billing_state']);
	    unset($fields['billing']['billing_phone']);
	    unset($fields['order']['order_comments']);
	    unset($fields['billing']['billing_address_2']);
	    unset($fields['billing']['billing_postcode']);
	    unset($fields['billing']['billing_company']);
	    unset($fields['billing']['billing_city']);
    
    return $fields;
}

/* 10- Modification in E-Mail */
add_action('woocommerce_email_after_order_table', 'add_nothgin_else', 1,1);

function add_nothgin_else(){
	echo '<!-- all is a comment ';
}

add_action('woocommerce_email_order_meta', 'add_nothgin_more', 1,1);

function add_nothgin_more(){
	echo '-->';
}
//woocommerce_email_order_meta

add_action('woocommerce_email_order_meta', 'add_nothgin_end', 1,1);

function add_nothgin_end(){
	echo '<!-- all is a comment ';
}
//end mail modif.-


// 11- THankyou page
//woocommerce_review_order_after_submit

add_action('woocommerce_review_order_after_submit', 'function_woocommerce_review_order_after_submit',1);
function function_woocommerce_review_order_after_submit() {
    echo '<!-- woocommerce_review_order_after_submit -->';
}

//woocommerce_after_checkout_form

add_action('woocommerce_after_checkout_form', 'function_woocommerce_after_checkout_form',11);
function function_woocommerce_after_checkout_form() {
	echo '<!-- woocommerce_after_checkout_form -->';
}



// 12- Validating Data in Checkout Process

/**
 * Process the checkout
 */

add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.


		$liefpflegeper = "die/den Angehörige(n)/Pflegeperson";
		if (  $_POST['billing_lieferung_der_blubox_an'] == $liefpflegeper){
			
			//anrede
			//nombre
			if ( ! $_POST['billing_vorname_angehoerige_person'] )
					wc_add_notice( __( '<strong>Bestellung: Vorname (Angehörige(r)/Pflegeperson)</strong> ist ein Pflichtfeld.' ), 'error' );
			//apellido
			if ( ! $_POST['billing_nachname_angehoerige_person'] )
					wc_add_notice( __( '<strong>Bestellung: Nachname (Angehörige(r)/Pflegeperson)</strong> ist ein Pflichtfeld.' ), 'error' );
			//telefono
			if ( ! $_POST['billing_telefon_angehoerige_person'] )
					wc_add_notice( __( '<strong>Bestellung: Telefon (Angehörige(r)/Pflegeperson)</strong> ist ein Pflichtfeld.' ), 'error' );
			//email
			if ( ! $_POST['billing_email_angehoerige_person'] )
					wc_add_notice( __( '<strong>Bestellung: E-Mail (Angehörige(r)/Pflegeperson)</strong> ist ein Pflichtfeld.' ), 'error' );
			//calle
			if ( ! $_POST['billing_address_angehoerige_person'] )
					wc_add_notice( __( '<strong>Bestellung: Straßenname und Hausnummer (Angehörige(r)/Pflegeperson)</strong> ist ein Pflichtfeld.' ), 'error' );
			//plz
			if ( ! $_POST['billing_postcode_angehoerige_person'] )
					wc_add_notice( __( '<strong>Bestellung: Postleitzahl (Angehörige(r)/Pflegeperson)</strong> ist ein Pflichtfeld.' ), 'error' );
			//ort
			if ( ! $_POST['billing_city_angehoerige_person'] )
					wc_add_notice( __( '<strong>Bestellung: Ort / Stadt (Angehörige(r)/Pflegeperson)</strong> ist ein Pflichtfeld.' ), 'error' );

			//si mando a Angehörige pflegeperson copio sus datos

			$_POST['shipping_first_name']=$_POST['billing_vorname_angehoerige_person'] ;
			$_POST['shipping_last_name']=$_POST['billing_nachname_angehoerige_person'] ;
			$_POST['shipping_address_1']=$_POST['billing_address_angehoerige_person'] ;
			$_POST['shipping_postcode']=$_POST['billing_postcode_angehoerige_person'] ;
			$_POST['shipping_city']=$_POST['billing_city_angehoerige_person'] ;
			$_POST['shipping_state']='' ;
			$_POST['shipping_country']='Deutschland' ;


		}else{

			//si mando a pflegeperson copio sus datos

			$_POST['shipping_first_name']=$_POST['billing_first_name'] ;
			$_POST['shipping_last_name']=$_POST['billing_last_name'] ;
			$_POST['shipping_address_1']=$_POST['billing_address_1'] ;
			$_POST['shipping_postcode']=$_POST['billing_postcode'] ;
			$_POST['shipping_city']=$_POST['billing_city'] ;
			$_POST['shipping_state']='' ;
			$_POST['shipping_country']='Deutschland' ;




		}

  // 13- Compruebo anbiter wechseln

			$awechsel = 'Anbieterwechsel';
			/*
			if (  $_POST['shipping_folgendes_mchte_ich_beantragen'] == $awechsel){

							if ( ! $_POST['shipping_name_des_vorherigen_anbieters'] )
							wc_add_notice( __( '<strong>Optionen: Der Name des vorherigen Anbieters</strong> ist Pflicht, wenn Sie zu BluBox wechseln möchten.' ), 'error' );
						
							if ( ! $_POST['shipping_vorherigen_anbieters_auftragsnummer'] )
								wc_add_notice( __( '<strong>Optionen: Auftragsnummer</strong> ist Pflicht, wenn Sie zu BluBox wechseln möchten.' ), 'error' );
							
							if ( ! $_POST['shipping_anschrift_des_vorherigen_anbieters'] )
								wc_add_notice( __( '<strong>Optionen: Anschrift des vorherigen Anbieters</strong> ist Pflicht, wenn Sie zu BluBox wechseln möchten.' ), 'error' );
							

			}*/ //chek disable because now the client want non Required Field
			//Coupons to var for PDF
			$_POST['billing_code_bekommen']=WC()->cart->get_applied_coupons();
			echo '<h1>';
			echo WC()->cart->get_applied_coupons().' -> ';
			echo $_POST['billing_code_bekommen'];
			echo '</h1>';

			global $privat_gesetz_versicherung;
			$privat_gesetz_versicherung = $_POST['billing_privat_oder_gesetzlich_versichert'];
}
/*End validate Data*/


// 14-  custom colors in checkout


add_action( 'wp_footer', 'custom_color_checkout', 9997 );
 
function custom_color_checkout() {
		global $wp;
		if ( is_checkout() && empty( $wp->query_vars['order-pay'] ) && ! isset( $wp->query_vars['order-received'] ) ) {
		//fin del php
		?>
<style type="text/css">
	.pg_super_der{
		margin-right:0px!important;
		margin-left:58%!important;
	}
	@media ( min-width: 720px ) {  /** Größerer Viewport: Tablett **/
		.pg_super_der{
		margin-right:0px!important;
		margin-left:78%!important;
	}
	
}
@media ( min-width: 900px ) { 
	.pg_super_der{
		margin-right:0px!important;
		margin-left:88%!important;
	}
}
</style>
<?php
		echo '<script  type="text/javascript">';
		include "include/custom_ux.js"; 
		echo '</script>';

   }
}




// 15- add coupons code column

add_filter( 'manage_edit-shop_order_columns', 'woo_customer_order_coupon_column_for_orders' );
function woo_customer_order_coupon_column_for_orders( $columns ) {
    $new_columns = array();

    foreach ( $columns as $column_key => $column_label ) {
        if ( 'order_total' === $column_key ) {
            $new_columns['order_coupons'] = __('Code', 'woocommerce');
        }

        $new_columns[$column_key] = $column_label;
    }
    return $new_columns;
}

// 16- add colimn code in Bestellungen 

add_action( 'manage_shop_order_posts_custom_column' , 'woo_display_customer_order_coupon_in_column_for_orders' );
function woo_display_customer_order_coupon_in_column_for_orders( $column ) {
    global $the_order, $post;
    if( $column  == 'order_coupons' ) {
        if( $coupons = $the_order->get_coupon_codes() ) {
            echo implode(', ', $coupons) . ' ('.count($coupons).')';
        } else {
            echo '<small><em>'. __('ohne Code') . '</em></small>';
        }
    }
}
//------------------
// 17- Adding a Product Name

add_filter( 'manage_edit-shop_order_columns', 'woo_customer_product_name_column_for_orders' );
function woo_customer_product_name_column_for_orders( $columns ) {
    $new_columns = array();

    foreach ( $columns as $column_key => $column_label ) {
        if ( 'order_total' === $column_key ) {
            $new_columns['product_name'] = __('BluBox', 'woocommerce');
        }

        $new_columns[$column_key] = $column_label;
    }
    return $new_columns;
}

add_action( 'manage_shop_order_posts_custom_column' , 'woo_display_customer_products_name_in_column_for_orders' );

function woo_display_customer_products_name_in_column_for_orders( $column ) {
    global $the_order, $post;
	//echo $column;
    if( $column  == 'product_name' ) {
		
		foreach($the_order->get_items()  as $item_id => $item ) {
		
			echo $product_name = $item->get_name();
		
			if( $coupons = $the_order->get_coupon_codes() ) {

				$datosProCu =  $product_name.'-'.$coupons;
				$mi_data = $mi_data."<br>".$datosProCu;
				echo implode(', ', $coupons) . ' ('.count($coupons).')';
			}
			
		}
		
    }
	
}
//Note _ Ver mail A. Cavaleiro support para agregar filtros a la lista de orders 



// 18- Plugin para Blubox estadisticas
add_filter( 'the_content', 'dcms_list_data' );

function dcms_list_data( $content ) {
	$slug_page = 'blubox-analisis'; //slug page where show data
	$table_name = 'posts'; // custom table name
	$items_per_page = 10; // quantity per page



	if ( is_page($slug_page) ){
	    global $wpdb;
		
		//jetzt rufe ich die Liste Function 
		?>
		<h6>Bestellungsstatistik, Bestellungsstatistik mit Code und Differenzierung nach Produkt für BluBox24</h6>
		<?php
		pg_lista_product_and_coupon();
		?>
		<?php
		
	}

	return $content;
}

function dcms_print_search($search){
	return '<form method="get">
				<input type="search" minlength="2" placeholder="Ingresa el empleado" name="search" value="'.$search.'">
				<input type="submit" value="Buscar">
			</form>';
}

function dcms_print_table($items){
	$result = '';

	// field names
	foreach ($items as $item) {
		$result .= '<tr>
			<td>'.$item->id.'</td>
			<td>'.$item->first_name.'</td>
			<td>'.$item->last_name.'</td>
			<td>'.$item->email.'</td>
			<td>'.$item->birthdate.'</td>
		</tr>';
	}

	$template = '<table class="table-data">
				  <tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Correo</th>
					<th>Cumpleaños</th>
				  </tr>
				  {data}
				</table>';

	return str_replace('{data}', $result, $template);
}


function dcms_print_pagination($start_number, $items_per_page, $count, $search){
	$navbar = '';

	if ( $count > $items_per_page ){
		$nav_count = 0;
		$page_count = 1;
		$str_search = '';
		$current_page = $start_number/$items_per_page + 1;

		if ( $search ) $str_search = "&search=$search";

		while ( $nav_count < $count ) {
			if ( $page_count === $current_page ){
				$navbar .= "<span>{$page_count}</span> ";
			} else {
				$navbar .= "<a href='?start={$nav_count}{$str_search}'>{$page_count}</a> ";
			}
			$nav_count += $items_per_page;
			$page_count++;
		}

		$navbar = "<section>$navbar</section>";
	}

	return $navbar;
}

function pg_lista_product_and_coupon(){
	//importante se incluyen los estilos CSS
	include "include/estilo.css";

		/*loop shop order*/
		$loop = new WP_Query( array(
			'post_type'         => 'shop_order',
			'posts_per_page'    => -1,
			'post_status'       =>  'wc-ywraq-new' //will get the new order
		 ) );

	$totalBestellungen = 0;
	$codeBestellungen = 0;
	$totalBluBox1 = 0;
	$codeBluBox1 = 0;
	$totalBluBox2 = 0;
	$codeBluBox2 = 0;
	$totalBluBox3 = 0;
	$codeBluBox3 = 0;
	$totalBluBox4 = 0;
	$codeBluBox4 = 0;
	$totalBluBox5 = 0;
	$codeBluBox5 = 0;
	$totalBluBox6 = 0;
	$codeBluBox6 = 0;
	$result = '';


	$cabeza = '<table class="table-data">
				  <tr>
					<th>ID</th>
					<th>Datum</th>
					<th>Code</th>
					<th>Produkte</th>
					<th>PLZ</th>
				  </tr>
				';

		 // Your post loop
		 if ( $loop->have_posts() ): 
		   while ( $loop->have_posts() ) : $loop->the_post();
		   $totalBestellungen = count($loop)-1;
		   $order_id = $loop->post->ID;
		  // The object from WC_Order find the reference in woocommerce docs
		  $order = wc_get_order($loop->post->ID);
		  $elid = $order->get_id();
		  $ladata = $order->get_date_created();
		  $ladata = $ladata->date("d.m.Y");
		  //$elCodice =  implode(' ', $order->get_coupon_codes())
		  $lugar = $order->get_billing_postcode();
		 
		  foreach ( $order->get_items() as $item_id => $item ) {
			$product_name = $item->get_name();
			
			//$totalBluBox1++;
			$ending = str_replace(' ', '', $product_name);
			$ending = str_replace('#', '', $ending);
			${'total'.$ending}++;
		
			if ($order->get_coupon_codes()){
				$codeBestellungen++;
					//$codeBluBox1++;
				${'code'.$ending}++;
			  $result .= '<tr> <td>'.$elid.'</td><td>'. $ladata.'</td><td>'. implode(' ', $order->get_coupon_codes()).'</td><td>'.$product_name.'</td><td>'.$lugar.'</td></tr>';
				
			}
		}
	
	endwhile;
	
		   wp_reset_postdata(); // always
		 
		 endif;
		/*end loop*/
		//echo ('<table>');

	
	include "include/estilo.css";

	?>


		<div class="wrapper">
			<div class="tabs">

					<div class="tab">
									<input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
									<label for="tab-1" class="tab-label">Code auf jede Produkt</label>
									<div class="tab-content">
									<?php include 'include/tabelle.php'; ?>
										<?php include 'include/code_produkte.php'; ?>
									</div>
					</div>

					<div class="tab">
								<input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
								<label for="tab-2" class="tab-label">Bestellungen</label>
								<div class="tab-content">
										<h3>Bestellungen</h3>
										<?php include 'include/liste_bestellungen.php'; ?>
								</div>
					</div>

					<div class="tab">
								<input type="radio" name="css-tabs" id="tab-3" class="tab-switch">
								<label for="tab-3" class="tab-label">Produkte mit Code bestellt </label>
								<div class="tab-content">
									<div class="zone">
									
										<h3>Produkte mit Code bestellt</h3>
										<?php include "include/bestellungen_in_balken.php";?>
									</div>
								</div>
					</div>

			</div>
		</div>

	
			
			





<?php } //end function.-

//include "include/referencias.php";
//include "include/tabs.js";

/* Last mods checkout*/


/* 19- DESPLIEGA EL CAMPO ¿TIENES UN CUPÓN? EN EL CHECKOUT*/
// +
/// 20- load JS for BWE mit oder ohne Flügel

add_action( 'wp_footer', 'pg_mit_ohnefluegel', 999 );
function pg_mit_ohnefluegel() {
	echo '<style type="text/css">
	#billing_mit_oder_ohne_field{
		animation: mit_ohne 1s ease 0s 1 normal forwards;
	}
	@keyframes mit_ohne {
		0% {
			opacity: 0;
		}
	
		100% {
			opacity: 1;
		}
	}
	</style>
	<script type="text/javascript" id="pg_mit_oder_ohne">';
	include "include/mit_oder_ohne.js";
	echo '</script>';
}

// DISMISS 21- Do something in JS hook: woocommerce_after_edit_account_address_form
//add_action ('woocommerce_after_edit_account_address_form', 'delete_extrainfo');
function delete_extrainfo(){
echo 'script edit info 1.2';
	global $post;
    $post_slug = $post->post_name;
	echo $post_slug;

?>
<script type="text/javascript">

			const element = document.getElementById("bb_myadress");
			const formulario = document.querySelector("form");
			const ichWurde = document.querySelector('#shipping_versorgung_med_field');
			ichWurde.classList.remove('validate-required');
			ichWurde.setAttribute('style', 'font-size: big;');

			for (let i = 0; i < element.length; i++) {
					printf( element[i].innerHTML );
			}
			element.setAttribute('style', 'color: red;');
			formulario.setAttribute('style', 'color: blue;');
	</script>
<?php
}

// 22- Remove required field requirement for first/last name in My Account Edit form
//add_filter('woocommerce_save_account_details_required_fields', 'remove_required_fields');

function remove_required_fields( $required_fields ) {
	unset($required_fields['account_first_name']);
	unset($required_fields['account_last_name']);

	return $required_fields;
}


 /* 23- The WordPress Core woocommerce after save address validation hook.*/
 //add_action( 'woocommerce_after_save_address_validation','woo_address_updated',10, 4);
     
 function woo_address_updated($user_id, $load_address, $address)
 {
	global $woocommerce;

	 /* Get the user email*/
	 $user_info = get_userdata($user_id); 
	 $css_mail = "<style type='text/css'>

	 body{
	margin:50px auto;
	 width:400px; 
	 text-align:left; 
	 padding:30px; 
	 border:3px solid #00408B; 
	 color:#514F54;} 
	
</style>";
	
	 $subj = 'Benutzer: '. $user_info->user_login . ' hat seine Adresse geändert. ' ;
	 $body= $css_mail.'<body><h2> Username: ' . $user_info->user_login . '</h2>';

	 $body = $body . '<p> User roles: ' . implode(', ', $user_info->roles) . '</p>';
	 $body = $body . '<p> User ID: ' . $user_info->ID . '</p>';
	 
	 $customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

foreach ( $get_addresses as $name => $address_title ) :
	$address = wc_get_account_formatted_address( $name );
	$body = $body . '<h3>'.$address_title.'</h3><p>'.$address.'<p>';
endforeach; 


	 $emailLieferante = 'provider@blubox.de';
	 $headers = array('Content-Type: text/html; charset=UTF-8');
	 $body = $body .'</body>';
	 
	 /* Send email*/
	 wp_mail( $user_info->user_email, $subj, $body, $headers  );
	 wp_mail( $emailLieferante, $subj, $body , $headers );
	 wp_mail( 'info@blubox.de', $subj, $body , $headers );
	 //wp_mail('info@gigena.net', 'cambio direccion', $body, $headers  );
	 


 }

//  23- bis

add_action( 'woocommerce_customer_save_address', 'jsforwp_update_address_for_orders', 10, 2 );

function jsforwp_update_address_for_orders( $user_id ) {

    $customer_meta = get_user_meta( $user_id );
    $customer_orders = get_posts( array(
        'numberposts' => –1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $user_id,
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_order_statuses() )
    ) );
/*
    foreach( $customer_orders as $order ) {

      update_post_meta( $order->ID, '_billing_first_name', $customer_meta['billing_first_name'][0] );
      update_post_meta( $order->ID, '_billing_last_name', $customer_meta['billing_last_name'][0] );
      update_post_meta( $order->ID, '_billing_company', $customer_meta['billing_company'][0] );
      update_post_meta( $order->ID, '_billing_address_1', $customer_meta['billing_address_1'][0] );
      update_post_meta( $order->ID, '_billing_address_2', $customer_meta['billing_address_2'][0] );
      update_post_meta( $order->ID, '_billing_city', $customer_meta['billing_city'][0] );
      update_post_meta( $order->ID, '_billing_state', $customer_meta['billing_state'][0] );
      update_post_meta( $order->ID, '_billing_postcode', $customer_meta['billing_postcode'][0] );
      update_post_meta( $order->ID, '_billing_country', $customer_meta['billing_country'][0] );
      update_post_meta( $order->ID, '_billing_email', $customer_meta['billing_email'][0] );
      update_post_meta( $order->ID, '_billing_phone', $customer_meta['billing_phone'][0] );

    }
*/
$css_mail = "<style type='text/css'>

	 body{
	color:black;
	background-color:gray;
	} 
	.content{
		background-color:white;
		margin:50px auto;
		width:580px; 
		text-align:left; 
		padding:30px;  
	}
	
</style>";

$namex = $customer_meta['billing_first_name'][0] .' '.$customer_meta['billing_last_name'][0];
$mailx = $customer_meta['billing_email'][0];

$cuerpo = $css_mail.'<div class="content"><h3>User ID #:'.$user_id.'</h3><br><h4>Kundenadresse</h4><br><br>Name:<strong>';
$cuerpo = $cuerpo . $namex;
$cuerpo = $cuerpo .'</strong><br>Adresse:  ';
$cuerpo = $cuerpo . $customer_meta['billing_address_1'][0];
$cuerpo = $cuerpo .'<br>Stadt/Ort: ';
$cuerpo = $cuerpo . $customer_meta['billing_city'][0];
$cuerpo = $cuerpo .'<br>PLZ: ';
$cuerpo = $cuerpo . $customer_meta['billing_postcode'][0];
$cuerpo = $cuerpo .'<br>E-Mail: ';
$cuerpo = $cuerpo . $mailx;
$cuerpo = $cuerpo .'<br>Tel: ';
$cuerpo = $cuerpo . $customer_meta['billing_phone'][0];
$cuerpo = $cuerpo .'<br>';
$cuerpo = $cuerpo .'<br><h4>Abw. Lieferadresse</h4><br><br>Name: ';
$cuerpo = $cuerpo . $customer_meta['shipping_first_name'][0];
$cuerpo = $cuerpo .' ';
$cuerpo = $cuerpo . $customer_meta['shipping_last_name'][0];
$cuerpo = $cuerpo .'<br>Adresse: ';
$cuerpo = $cuerpo . $customer_meta['shipping_address_1'][0];
$cuerpo = $cuerpo .'<br>Stadt/Ort: ';
$cuerpo = $cuerpo . $customer_meta['shipping_city'][0];
$cuerpo = $cuerpo .'<br>PLZ: ';
$cuerpo = $cuerpo . $customer_meta['shipping_postcode'][0];
$cuerpo = $cuerpo .'<br></div>';

$tema = 'Die Adresse des Kunden '.$namex.' wurde aktualisiert.('.$mailx.')';

$headers = array('Content-Type: text/html; charset=UTF-8');

wp_mail($mailx, $tema, $cuerpo, $headers  );
wp_mail('provider@blubox.de', $tema, $cuerpo, $headers  );
wp_mail('info@blubox.de', $tema, $cuerpo, $headers  );

};





// 24- Birthday Date Formart in PDF

add_filter('wf_pklist_alter_find_replace', 'wt_pklist_change_dob_format', 10, 6);
function wt_pklist_change_dob_format($find_replace, $template_type, $order, $box_packing, $order_package, $html)
{
 if($template_type=='invoice' )
 {
 if(isset($find_replace['[wfte_extra_field_billing_geburtstag_pfleg]']))
 {
 $date_meta=$find_replace['[wfte_extra_field_billing_geburtstag_pfleg]'];
 if(!empty($date_meta))
 {
 $old_date_timestamp = strtotime($date_meta);
 $new_date = date('d.m.Y', $old_date_timestamp);   
 if(!empty($new_date))
 {
 $find_replace['[wfte_extra_field_billing_geburtstag_pfleg]']=$new_date;
 }
 }
 else
 {
 $find_replace['[wfte_extra_field_billing_geburtstag_pfleg]']='';
 }
 }
 else
 {
 $find_replace['[wfte_extra_field_billing_geburtstag_pfleg]']='';
 }
 }
 return $find_replace;
}

// 25- Privat oder Gesetz versicherung - MAIL
/* Dont need that
add_action('woocommerce_thankyou', 'pg_custom_mail_privat_gesetz', 10, 1);
function pg_custom_mail_privat_gesetz() {
global $privat_gesetz_versicherung;


	include "include/privat_gesetz_mail.php";

}*/

?>