<?php

class ModelExtensionPaymentInvoicebox extends Model {
    public function getMethod($address, $total) {
		$this->language->load('extension/payment/invoicebox');
        return array(
            'code'       => 'invoicebox',
            'terms' => "",
            'title'      => $this->language->get('text_title'),
            'sort_order' => $this->config->get('invoicebox_sort_order')
        );
    }
}

