<?php

$chupones = [];
$i=0;

$the_chupones = new WP_Query( array(
    'post_type'         => 'shop_coupon' ));
// The Loop
if ( $the_chupones->have_posts() ) {


	while ( $the_chupones->have_posts() ) {
		$the_chupones->the_post();
		 $chupones[$i] = get_the_title();
         $i++;
	}
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

$iproductos = [];
$i=0;


$the_iproductos = new WP_Query( array(
    'post_type'         => 'product' ));
// The Loop
if ( $the_iproductos->have_posts() ) {
	
	while ( $the_iproductos->have_posts() ) {
		$the_iproductos->the_post();
		$iproductos[$i] = get_the_title();
        $i++;
       // echo $iproductos[$i];
	}
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
/*loop shop order*/
$loop = new WP_Query( array(
    'post_type'         => 'shop_order',
    'posts_per_page'    => -1,
    'post_status'       =>  'wc-ywraq-new' //will get the new order
 ) );


 if ( $loop->have_posts() ){ 
    while ( $loop->have_posts() ){
    $loop->the_post();
  
    $order_id = $loop->post->ID;
   
   $order = wc_get_order($loop->post->ID);
  
   foreach ( $order->get_items() as $item_id => $item ) {
     $product_name = $item->get_name();//leo el nombre
        $product_name = strtoupper($product_name);//a mayuscula
     if ($order->get_coupon_codes()){
       
        $codigo = implode('',$order->get_coupon_codes());
        $codigo = strtoupper($codigo);//a mayuscula

        ${$product_name.$codigo}++;

   }

}//endwhile;
}
 }
 wp_reset_postdata(); // always
      

?>
<h4>Anzahl pro Produkt</h4>
<table class="table-data">
				  <tr>
					<th>Anzahlt</th>
					<th>Produkt</th>
					<th>Code</th>
				  </tr>
<?php 
sort($chupones);
sort($iproductos);
        foreach ($iproductos as $iprod ){
            $iprod = strtoupper($iprod);
            //echo $iprod;
            foreach ($chupones as $chad ){
                $chad = strtoupper($chad);
                //echo $iprod;
if(${$iprod.$chad}){
        echo ' <tr><th>';
        echo ${$iprod.$chad};  
        echo '</th><th>';   
        echo $iprod;  
        echo '</th><th>';
        echo $chad;  
        echo '</th></tr>';
    }
            }
        }
        echo '</table><p>Produkte und Codes, die nicht verkauft werden, werden nicht angezeigt.</p>';
?>