<?php

$cupones = [];
$i=0;

$the_cupones = new WP_Query( array(
    'post_type'         => 'shop_coupon' ));
// The Loop
if ( $the_cupones->have_posts() ) {


	while ( $the_cupones->have_posts() ) {
		$the_cupones->the_post();
		 $cupones[$i] = get_the_title();
         $i++;
	}
} else {
	// no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

$productos = [];
$i=0;


$the_productos = new WP_Query( array(
    'post_type'         => 'product' ));
// The Loop
if ( $the_productos->have_posts() ) {
	
	while ( $the_productos->have_posts() ) {
		$the_productos->the_post();
		$productos[$i] = get_the_title();
        $i++;
       // echo $productos[$i];
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

	 // Your post loop
     $sumoordenes=0;
     $codeBestellungen=0;
     $b1total = 0;
     $b2total = 0;
     $b3total = 0;
     $b4total = 0;
     $b5total = 0;
     $b6total = 0;
     $cancelao = 0;
     
    if ( $loop->have_posts() ): 
            while ( $loop->have_posts() ) : $loop->the_post();
                    $order_id = $loop->post->ID;
                    $order = wc_get_order($loop->post->ID);
                    $status = $order->get_status();
                    if($status!='cancelled'){
                            
                            $sumoordenes++;
                                foreach ( $order->get_items() as $item_id => $item ) {
                                    
                                    $product_name = $item->get_name();//leo el nombre
                                    $product_name = str_replace(' ', '', $product_name);//prod sin espacio
                                    ${'item'.$product_name}++;
                                    //get_used_coupons()
                                }


                                if ($order->get_coupon_codes()){
                                    $codeBestellungen++;
                                    $codigo = implode('',$order->get_coupon_codes());
                                    $codigo = strtoupper($codigo);//codigo en mayuscula

                                    $product_name = str_replace(' ', '', $product_name);//prod sin espacio
                                    ${$product_name.'conCodigo'}++;//total con codigop por producto
                                    ${$product_name.$codigo}++;//suma de cada codigo x producto
                                    //echo $product_name.'conCodigo = '.${$product_name.'conCodigo'};
                                }


                            $totalBestellungen++;

                    }else{
                       // echo $order_id."->".$status."/ ";
                        $cancelao++;
                    }
            endwhile;

    wp_reset_postdata(); // always

    endif;
     /*end loop*/
     //echo ('<table>');
     $prctj = round((($codeBestellungen*100)/$sumoordenes),2);
     $frase_cancelao = ($cancelao > 1) ? " stornierte Bestellungen." : " stornierte Bestellung.";
     if(0 == $cancelao){
    echo '<span class="woocommerce-message detalle">Bestellungen '.$sumoordenes.' davon mit Code: '.$codeBestellungen.' ('.$prctj.'%) / Es gibt keine stornierten Bestellungen.</span><br><br>';
    }else{
    echo '<span class="woocommerce-message detalle">Bestellungen '.$sumoordenes.' davon mit Code: '.$codeBestellungen.' ('.$prctj.'%) / Es gibt '.$cancelao.$frase_cancelao.'</span><br><br>';
        }
sort($cupones);
sort($productos);

/*
foreach ($cupones as $value)
    //    echo ' = ' . $value . '<br />';



foreach ($productos as $value)
  //  echo ' = ' . $value . '<br />';
*/
//echo '<hr>';
//echo '<h2>Total ventas con Cupones:'.$codeBestellungen.'</h2>';
$MaxAncho = 100;
$MaxCupPro = $codeBestellungen;
$ancho = round((($MaxCupPro * $MaxAncho) / $sumoordenes),2);

/* ?> <label><?php echo 'Bestellung mit Code:'.$MaxCupPro; ?></label>  <div class="suprabarra"><div class="boxAnalitica blonky"style="width:<?php echo $ancho; ?>vw"> </div> </div> <?php */


foreach ($productos as $prod){

    $prod = str_replace(' ', '', $prod);//productos son espacios

    if(${'item'.$prod}){
        $ancho = ${'item'.$prod} * $MaxAncho;
        $ancho = $ancho / $sumoordenes;
    $ancho = round($ancho,2);
    }else{
        $ancho=0;
    }

//defino cual caso es veo su MAX

if(${$prod.'conCodigo'})
    $MaxCupPro = ${$prod.'conCodigo'};
else
    $MaxCupPro = 0;
    //${$product_name.'conCodigo'}
    $idpro = str_replace('#', '', $prod);
?>
<h2 class="entry-title">
    <?php echo 'Bestellung '.$prod.': '.${'item'.$prod}; ?></h2> 
    <div class="boxAnalitica blinky"style="width:<?php echo $ancho; ?>vw"> </div>
<button class="close" id="<?php echo $idpro; ?>" onclick="mostrar(this)" >▼ davon mit Code: <?php echo $MaxCupPro; ?></button><div class="cuadro" id="cuadro_<?php echo $idpro; ?>"><button class="close" onclick="cerrar('<?php echo $idpro; ?>')">▲</button>
<!-- hasta aca ok -->
        <?php
        
        foreach ($cupones as $value){

           

            //echo $value;
            $valueMay = strtoupper($value);
            $prod = str_replace(' ', '', $prod);
            
            
            if(${$prod. $valueMay}){
                $MaxCupPro =${$prod. $valueMay};
                $ancho = round((($MaxCupPro*$MaxAncho)/$sumoordenes),2);
            ?>   <div class="suprabarra"><div class="boxAnalitica ponky"style="width:<?php echo $ancho; ?>vw"> </div> <span class="masinfo"><?php echo strtoupper($value).' : <strong>'.$MaxCupPro; ?></strong></span></div> <?php 
        }else{
        //echo '<div class="suprabarra"> <label class="noSales">Es gab keine Bestellungen mit dem Code  :  ' .strtoupper($value). '</label></div><br />';
        } //end else
       
    }//end foreach
    echo '</div> 
    <hr>

    ';
  
}

?>

<script type="text/javascript">

function mostrar(boton) {
    
    var xcuadro = "cuadro_"+ boton.id;
    var xboton = 'btn_'+ boton.id;
    
    var x = document.getElementById(xcuadro);
    
    x.setAttribute('style', 'display:block;');
    var y= document.getElementById(boton.id);
    y.setAttribute('style', 'display:none;');
  }

  function cerrar(valor){
    

    var xcuadro = "cuadro_"+ valor;
    var x = document.getElementById(xcuadro);
    x.setAttribute('style', 'display:none;');
    var y = document.getElementById(valor);
    y.setAttribute('style', 'display:block;');
  }

</script>