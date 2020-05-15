<?php

class ModelExtensionPaymentInvoicebox extends Model {
	private static $_METHOD_CODE = 'invoicebox';
    public function getMethod($address, $total) {
		$this->language->load('extension/payment/invoicebox');
		$title = $this->config->get('invoicebox_langdata');

            if ($this->config->get('invoicebox_hide_mode')) {
                if (version_compare(VERSION, '2.2.0.0', '<')) {
                    $this->user = new User($this->registry);
                } else {
                    $this->user = new Cart\User($this->registry);
                }
                if (!$this->user->isLogged()) {
                    $status = false;
                }
            }
        return array(
            'code'       => self::$_METHOD_CODE,
            'terms' => "",
            'title'      => $title[$this->config->get('config_language_id')]['title'],
            'sort_order' => $this->config->get('invoicebox_sort_order')
        );
    }
	public function checkLaterpay($order_id) {
        return $this->isLaterpayButtonLK($order_id) || $this->isLaterpayMode($order_id);
    }

    public function getOrderStatusById($order_status_id, $language_id = false) {
        if (!$language_id) {
          $language_id = (int)$this->config->get('config_language_id');
        }
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . $language_id . "'");
        return $query->num_rows ? $query->row['name'] : '';
    }

    public function getCustomerGroup($customer_group_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer_group cg LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id) WHERE cg.customer_group_id = '" . (int)$customer_group_id . "' AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
        return $query->num_rows ? $query->row['name'] : '';
    }

    public function getOrder($order_id) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "'");
        return $query->num_rows ? $query->row : false;
    }

    protected function isLaterpayButtonLK($order_id) {
        
        if ($this->config->get('invoicebox_laterpay_button_lk')) {
            if (!isset($this->_order_info)) {
                $this->_order_info = $this->getOrder($order_id);
            }
            
            if (!$this->_order_info || ($this->_order_info['payment_code'] != self::$_METHOD_CODE) || !$this->config->get('invoicebox_status')) {
                return false;
            }

            return ($this->_order_info['order_status_id'] == $this->config->get('invoicebox_order_confirm_status_id')) || ($this->_order_info['order_status_id'] == $this->config->get('invoicebox_order_fail_status_id'));
        }

        return false;
    }

    protected function isLaterpayMode($order_id) {
        
        if ($this->config->get('invoicebox_laterpay_mode') && ($this->config->get('invoicebox_order_later_status_id') != $this->config->get('invoicebox_order_confirm_status_id'))) {
            if (!isset($this->_order_info)) {
                $this->_order_info = $this->getOrder($order_id);
            }

            if (!$this->_order_info || ($this->_order_info['payment_code'] != self::$_METHOD_CODE) || !$this->config->get('invoicebox_status')) {
                return false;
            }
              
            return $this->_order_info['order_status_id'] == $this->config->get('invoicebox_order_later_status_id');
        }

        return false;
    }
}
