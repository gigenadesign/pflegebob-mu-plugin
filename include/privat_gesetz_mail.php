<?php
/*
if ( ! $order_id || is_user_logged_in() ) {
    return;
}else{
    $order = wc_get_order($order_id); // Get an instance of the WC_Order object

   // wc_get_template( 'order/order-details-customer.php', array('order' => $order ));

}
$emailbest = $order->get_billing_email();
$test_order_key = $order->get_order_key();
echo '<br><br>test'.$test_order_key;
//$versichart = $order->get_billing_privat_oder_gesetzlich_versichert();
//echo "email: " . $emailbest;
//echo $order;


?>