<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
  <head></head>
  <body>
    <form action="<?php echo $action ?>" method="get" name="checkout">
 <input type="hidden" name="itransfer_participant_id" value="<?php echo $parameters['invoicebox_participant_id']; ?>" />
   <input type="hidden" name="itransfer_participant_ident" value="<?php echo $parameters['invoicebox_participant_ident']; ?>" />
   <input type="hidden" name="itransfer_participant_sign" value="<?php echo $parameters['invoicebox_sign']; ?>" />
   <input type="hidden" name="itransfer_order_id" value="<?php echo $parameters['order_id']; ?>" />
   <input type="hidden" name="itransfer_order_amount" value="<?php echo $parameters['total']; ?>" />
   <input type="hidden" name="itransfer_order_quantity" value="<?php echo $parameters['quantity']; ?>" />
   <input type="hidden" name="itransfer_testmode" value="<?php echo $parameters['testmode']; ?>" />
   <input type="hidden" name="itransfer_order_currency_ident" value="<?php echo $parameters['currency_code']; ?>" />
   <input type="hidden" name="itransfer_order_description" value="<?php echo $parameters['invoice']; ?>" />
   <input type="hidden" name="itransfer_person_name" value="<?php echo $parameters['first_name'].' '.$parameters['last_name']; ?>" />
   <input type="hidden" name="itransfer_person_email" value="<?php echo $parameters['email']; ?>" />
   <input type="hidden" name="itransfer_person_phone" value="<?php echo $parameters['phone']; ?>" />
   <input type="hidden" name="itransfer_body_type" value="PRIVATE" />
   <input type="hidden" name="itransfer_url_return" value="<?php echo $parameters['return']; ?>" />
   <input type="hidden" name="itransfer_url_returnsuccess" value="<?php echo $parameters['returnsuccess']; ?>" />
   <input type="hidden" name="itransfer_url_notify" value="<?php echo $parameters['notify_url']; ?>" />
   <input name="itransfer_cms_name" value="Opencart" type="hidden">
   <?php 
   $i=0;
   foreach ($parameters['products'] as $product) { 
   $i++;?>
   <input type="hidden" name="itransfer_item<?php echo $i; ?>_name" value="<?php echo $product['name']; ?>" />
   <input type="hidden" name="itransfer_item<?php echo $i; ?>_quantity" value="<?php echo $product['quantity']; ?>" />
   <input type="hidden" name="itransfer_item<?php echo $i; ?>_price" value="<?php echo $product['price']; ?>" />
   <input type="hidden" name="itransfer_item<?php echo $i; ?>_vat" value="<?php echo $product['vat']; ?>" />
   <input type="hidden" name="itransfer_item<?php echo $i; ?>_measure" value="шт." />
   <?php } ?>
   
</form>
    <script type="text/javascript"><!--
      //document.forms['checkout'].submit();
    //--></script>
  </body>
</html>