<?php
class ControllerExtensionPaymentInvoicebox extends Controller {
	  
  public function index() {
    
    $this->language->load('extension/payment/invoicebox');
	$this->document->setTitle('Invoicebox Method Configuration');
    $data['button_confirm'] = $this->language->get('pay_button');
    $data['invoicebox_participant_id'] = $this->config->get('invoicebox_participant_id');
	$data['invoicebox_participant_ident'] = $this->config->get('invoicebox_participant_ident');
    $data['currency'] = $this->config->get('currency');
	$data['testmode'] = $this->config->get('invoicebox_testmode');
	$data['action'] = 'https://go.invoicebox.ru/module_inbox_auto.u';
    $data['text_testmode'] = $this->language->get('text_testmode');    
    $this->load->model('checkout/order');
    $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
	$this->load->model('account/order');
    $order_totals = $this->model_account_order->getOrderTotals($this->session->data['order_id']);
	
	$tax = 0;
    $shipping = 0;
	$coupon	= 0;
    foreach ($order_totals as $order_total) {
            if ($order_total['code'] == 'tax') {
                $tax += $order_total['value'];
            } elseif ($order_total['code'] == 'shipping') {
                $shipping += $order_total['value'];
            }elseif ($order_total['code'] == 'coupon') {
                $coupon += $order_total['value'];
            }
        }
    if ($order_info) {
	
			$kcup = ($order_info['total'] - $shipping)/$this->cart->getSubTotal();
			$data['products'] = array();
			$quantity = 0;
			foreach ($this->cart->getProducts() as $product) {
				
				$data['products'][] = array(
					'name'     => htmlspecialchars($product['name']),
					'price'    => $this->currency->format(($product['price']*$product['quantity'])*$kcup/$product['quantity'], $order_info['currency_code'], false, false),
					'quantity' => $product['quantity'],
					'vatrate' => $this->tax->getTax( $product['price'], $product['tax_class_id'])
				);
				$quantity +=$product['quantity'];
			}
			$subtotal = $this->cart->getSubTotal();
			if($shipping > 0) {
				$data['products'][] = array(
					'name'     => htmlspecialchars($order_info['shipping_method']),
					'price'    => $this->currency->format($shipping, $order_info['currency_code'], false, false),
					'quantity' => 1,
					'vatrate' => 0
				);
			}
			
			$data['quantity'] = $quantity;
			$data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], false, false);
			$data['currency_code'] = $order_info['currency_code'];
			$data['first_name'] = html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
			$data['last_name'] = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
			$data['phone'] = html_entity_decode($order_info['telephone'], ENT_QUOTES, 'UTF-8');
			
			$data['email'] = $order_info['email'];
			$data['invoice'] = $this->session->data['order_id'] . ' - ' . html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
			
			$data['return'] = $this->url->link('checkout/failure');
			$data['returnsuccess'] = $this->url->link('checkout/success');
			$data['notify_url'] = $this->url->link('extension/payment/invoicebox/callback', '', true);
			//$data['cancel_return'] = $this->url->link('checkout/checkout', '', true);

			
			$signatureValue = md5(
			$this->config->get('invoicebox_participant_id').
			$this->session->data['order_id'].
			$order_info['total'].
			$order_info['currency_code'].
			$this->config->get('invoicebox_api_key')
			); 
			$data['invoicebox_sign'] = $signatureValue;
			$data['order_id'] = $this->session->data['order_id'];

			return $this->load->view('extension/payment/invoicebox_checkout', $data);
		}
      
  }
  
  public function callback() {
	$participantId = false;
	$participantOrderId = false;
	if (isset($this->request->post['participantId'])) {
		$participantId 		= IntVal($this->request->post["participantId"]);
	}
	if (isset($this->request->post['participantOrderId'])) {
		$participantOrderId 	= IntVal($this->request->post["participantOrderId"]);
	}

	if ( !($participantId && $participantOrderId )){
		die( "Данные запроса не переданы" );
    }
	$order_id = trim($participantOrderId);
	$this->load->model('checkout/order');
	$order_info = $this->model_checkout_order->getOrder($order_id);
  
	if (!$order_info) {	
		die( "Указанный номер заказа не найден в системе: " . $participantOrderId );
	}
	
	$ucode 		= trim($this->request->post["ucode"]);
	$timetype 	= trim($this->request->post["timetype"]);
	$time 		= str_replace(' ','+',trim($this->request->post["time"]));
	$amount 	= trim($this->request->post["amount"]);
	$currency 	= trim($this->request->post["currency"]);
	$agentName 	= trim(html_entity_decode($this->request->post["agentName"], ENT_QUOTES, 'UTF-8'));
	$agentPointName = trim(html_entity_decode($this->request->post["agentPointName"], ENT_QUOTES, 'UTF-8'));
	$testMode 	= trim($this->request->post["testMode"]);
	$sign	 	= trim($this->request->post["sign"]);
	$participant_apikey 	=  $this->config->get('invoicebox_api_key');
		$sign_strA = 
			$participantId .
			$participantOrderId .
			$ucode .
			$timetype .
			$time .
			$amount .
			$currency .
			$agentName .
			$agentPointName .
			$testMode .
			$participant_apikey;
		$sign_crcA = md5( $sign_strA ); 
	if ( strtolower($sign_crcA) != strtolower($sign) )
		{
			die( "Подпись запроса неверна" );
		}; 
		$amount 	= $this->currency->format(trim($this->request->post["amount"]), $order_info['currency_code'], false, false);
		$total = $this->currency->format($order_info['total'], $order_info['currency_code'], false, false);
		
		if ($total == $amount){
		  $this->model_checkout_order->addOrderHistory((int) $order_id, $this->config->get('invoicebox_order_status_completed'));
		  die('OK'); 
		 }else{
			die ("Сумма оплаты не совпадает с суммой заказа");
		 }
  }
}
