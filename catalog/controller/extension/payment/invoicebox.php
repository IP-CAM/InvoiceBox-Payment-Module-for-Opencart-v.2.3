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
        $coupon = 0;
        foreach ($order_totals as $order_total) {
            if ($order_total['code'] == 'tax') {
                $tax += $order_total['value'];
            } elseif ($order_total['code'] == 'shipping') {
                $shipping += $order_total['value'];
            } elseif ($order_total['code'] == 'coupon') {
                $coupon += $order_total['value'];
            }
        }
        if ($order_info) {

            $kcup = ($order_info['total'] - $shipping) / $this->cart->getSubTotal();
            $data['products'] = array();
            $quantity = 0;
            foreach ($this->cart->getProducts() as $product) {

                $data['products'][] = array(
                    'name' => htmlspecialchars($product['name']),
                    'price' => $this->currency->format(($product['price'] * $product['quantity']) * $kcup / $product['quantity'], $order_info['currency_code'], false, false),
                    'quantity' => $product['quantity'],
                    'vatrate' => $this->tax->getTax($product['price'], $product['tax_class_id'])
                );
                $quantity +=$product['quantity'];
            }
            $subtotal = $this->cart->getSubTotal();
            if ($shipping > 0) {
                $data['products'][] = array(
                    'name' => htmlspecialchars($order_info['shipping_method']),
                    'price' => $this->currency->format($shipping, $order_info['currency_code'], false, false),
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
            $langdata = $this->config->get('shoputils_payeer_langdata');
            $data['instruction'] = nl2br($langdata[$this->config->get('config_language_id')]['instruction']);
            $data['pay_status'] = ((!$this->config->get('invoicebox_laterpay_mode')) || ($this->config->get('invoicebox_order_later_status_id') == $this->config->get('invoicebox_order_confirm_status_id')));
            $data['continue'] = $this->url->link('checkout/success', '', 'SSL');
            $data['button_confirm'] = $langdata[$this->config->get('config_language_id')]['button_confirm'] ? : $this->language->get('button_confirm');

            $data['email'] = $order_info['email'];
            $data['invoice'] = $this->session->data['order_id'] . ' - ' . html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');

            $data['return'] = $this->url->link('checkout/failure');
            $data['returnsuccess'] = $this->url->link('checkout/success');
            $data['notify_url'] = $this->url->link('extension/payment/invoicebox/callback', '', true);
            //$data['cancel_return'] = $this->url->link('checkout/checkout', '', true);


            $signatureValue = md5(
                    $this->config->get('invoicebox_participant_id') .
                    $this->session->data['order_id'] .
                    $order_info['total'] .
                    $order_info['currency_code'] .
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
            $participantId = IntVal($this->request->post["participantId"]);
        }
        if (isset($this->request->post['participantOrderId'])) {
            $participantOrderId = IntVal($this->request->post["participantOrderId"]);
        }

        if (!($participantId && $participantOrderId )) {
            die("Данные запроса не переданы");
        }
        $order_id = trim($participantOrderId);
        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($order_id);

        if (!$order_info) {
            die("Указанный номер заказа не найден в системе: " . $participantOrderId);
        }

        $ucode = trim($this->request->post["ucode"]);
        $timetype = trim($this->request->post["timetype"]);
        $time = str_replace(' ', '+', trim($this->request->post["time"]));
        $amount = trim($this->request->post["amount"]);
        $currency = trim($this->request->post["currency"]);
        $agentName = trim(html_entity_decode($this->request->post["agentName"], ENT_QUOTES, 'UTF-8'));
        $agentPointName = trim(html_entity_decode($this->request->post["agentPointName"], ENT_QUOTES, 'UTF-8'));
        $testMode = trim($this->request->post["testMode"]);
        $sign = trim($this->request->post["sign"]);
        $participant_apikey = $this->config->get('invoicebox_api_key');
        $sign_strA = $participantId .
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
        $sign_crcA = md5($sign_strA);
        if (strtolower($sign_crcA) != strtolower($sign)) {
            die("Подпись запроса неверна");
        };
        $amount = $this->currency->format(trim($this->request->post["amount"]), $order_info['currency_code'], false, false);
        $total = $this->currency->format($order_info['total'], $order_info['currency_code'], false, false);

        if ($total == $amount) {
            $this->model_checkout_order->addOrderHistory((int) $order_id, $this->config->get('invoicebox_order_status_completed'));
            die('OK');
        } else {
            die("Сумма оплаты не совпадает с суммой заказа");
        }
    }

    public function laterpay() {
        if ($this->validateLaterpay()) {
            $this->response->setOutput($this->load->view('extension/payment/invoicebox_laterpay.tpl', $this->makeForm($this->request->get['order_id'])));
        } else {
            $this->language->load('checkout/success');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');

        if ($this->customer->isLogged()) {
            $data['text_message'] =
                sprintf($this->language->get('text_customer'),
                    $this->url->link('account/account', '', 'SSL'),
                    $this->url->link('account/order', '', 'SSL'),
                    $this->url->link('account/download', '', 'SSL'),
                    $this->url->link('information/contact'));
        } else {
            $data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
        }

        $data['button_continue'] = $this->language->get('button_continue');

        $data['continue'] = $this->url->link('common/home');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');

        return $this->response->setOutput($this->load->view('extension/payment/tinkoff_failure.tpl', $data));
        }
    }

    public function status() {

        if ($this->request->server['REQUEST_METHOD'] != 'POST') {
            $this->sendForbidden($this->language->get('text_error_post'));
            return;
        }

        if (!$this->validate(true)) {
            $this->sendFail($this->order['order_id']);
            return;
        }

        if ($this->order['order_status_id']) {
            $this->model_checkout_order->addOrderHistory($this->order['order_id'], $this->config->get('invoicebox_order_status_id'), sprintf($this->language->get('text_comment'), $this->request->post['amount']
                    ), $notify);
            
        }


        $this->sendOk($this->order['order_id']);
    }

    public function success() {


        if (!isset($this->session->data['order_id'])) {
            $this->session->data['order_id'] = $this->order['order_id']; //Добавляем в сессию номер заказа на случай, если в checkout/success на экран пользователю выводится номер заказа
        }
        $this->response->redirect($this->url->link('checkout/success', '', 'SSL'));
    }

    public function fail() {
        $this->load->model('checkout/order');

        //Система будет работать как с POST так и с GET данными
        $this->request->post = array_merge($this->request->post, $this->request->get);

        if ($this->validate(false)) {
            if ($this->order['order_status_id']) {
                //Reverse $this->config->get('invoicebox_notify_customer_fail')
                
                $this->model_checkout_order->addOrderHistory($this->order['order_id'], $this->config->get('invoicebox_order_fail_status_id'), 'Invoicebox - Payment Fail, Order ID: ' . $this->request->post['m_orderid'], $notify);

                
            }
        }
        $this->response->redirect($this->url->link('checkout/failure', '', 'SSL'));
    }

    public function confirm() {
        if (!empty($this->session->data['order_id']) && $this->session->data['payment_method']['code'] == 'invoicebox') {
            $this->load->model('checkout/order');
            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('invoicebox_order_confirm_status_id'));
        }
    }

    protected function makeForm($order_id = false) {
        $this->load->model('checkout/order');
        if (!$order_id) {
            if (isset($this->session->data['order_id'])) {
                $order_id = $this->session->data['order_id'];
            } else {
                die($this->language->get('error_fail_checkout_extension'));
            }
        }
        $order_info = $this->model_checkout_order->getOrder($order_id);
        $params = array();
        $params['invoicebox_participant_id'] = $this->config->get('invoicebox_participant_id');
        $params['invoicebox_participant_ident'] = $this->config->get('invoicebox_participant_ident');
        $params['testmode'] = $this->config->get('invoicebox_testmode');
        $params['action'] = 'https://go.invoicebox.ru/module_inbox_auto.u';
        $params['text_testmode'] = $this->language->get('text_testmode');
        $this->load->model('account/order');
        $order_totals = $this->model_account_order->getOrderTotals($order_id);

        $tax = $sub_total = $shipping = $coupon = 0;
        foreach ($order_totals as $order_total) {
            if ($order_total['code'] == 'sub_total') {
                $sub_total += $order_total['value'];
            } elseif ($order_total['code'] == 'tax') {
                $tax += $order_total['value'];
            } elseif ($order_total['code'] == 'shipping') {
                $shipping += $order_total['value'];
            } elseif ($order_total['code'] == 'coupon') {
                $coupon += $order_total['value'];
            }
        }
        if ($order_info) {

            $kcup = ($order_info['total'] - $shipping) / $sub_total;
            $params['products'] = array();
            $quantity = 0;
            $this->load->model('account/order');
            $products = $this->model_account_order->getOrderProducts($this->request->get['order_id']);
            foreach ($products as $product) {

                $params['products'][] = array(
                    'name' => htmlspecialchars($product['name']),
                    'price' => $this->currency->format(($product['price'] * $product['quantity']) * $kcup / $product['quantity'], $order_info['currency_code'], false, false),
                    'quantity' => $product['quantity'],
                    'vat' => $this->currency->format($product['tax'], $order_info['currency_code'], false, false)
                );
                $quantity +=$product['quantity'];
            }
            if ($shipping > 0) {
                $params['products'][] = array(
                    'name' => htmlspecialchars($order_info['shipping_method']),
                    'price' => $this->currency->format($shipping, $order_info['currency_code'], false, false),
                    'quantity' => 1,
                    'vat' => 0
                );
            }

            $params['quantity'] = $quantity;
            $params['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], false, false);
            $params['currency_code'] = $order_info['currency_code'];
            $params['first_name'] = html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
            $params['last_name'] = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
            $params['phone'] = html_entity_decode($order_info['telephone'], ENT_QUOTES, 'UTF-8');

            $params['email'] = $order_info['email'];
            $params['invoice'] = $order_id . ' - ' . html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');

            $params['return'] = $this->url->link('checkout/failure');
            $params['returnsuccess'] = $this->url->link('checkout/success');
            $params['notify_url'] = $this->url->link('extension/payment/invoicebox/callback', '', true);
            //$params['cancel_return'] = $this->url->link('checkout/checkout', '', true);


            $signatureValue = md5(
                    $this->config->get('invoicebox_participant_id') .
                    $order_id .
                    $order_info['total'] .
                    $order_info['currency_code'] .
                    $this->config->get('invoicebox_api_key')
            );
            $params['invoicebox_sign'] = $signatureValue;
            $params['order_id'] = $order_id;
            return array(
                'action' => $params['action'],
                'parameters' => $params
            );
        }
    }

    protected function validateLaterpay() {
        if (!isset($this->request->get['order_id']) || !isset($this->request->get['order_tt'])) {
            return false;
        } else {
            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($this->request->get['order_id']);

            if (!$order_info || ($this->request->get['order_id'] != $order_info['order_id']) || ($this->request->get['order_tt'] != $order_info['total']) || $order_info['order_status_id']!= $this->config->get('invoicebox_order_later_status_id')) {
                return false;
            }
        }
        return true;
    }

    private function validate($check_sign_hash = true) {
        $this->load->model('checkout/order');

        $participantId = false;
        $participantOrderId = false;
        if (isset($this->request->post['participantId'])) {
            $participantId = IntVal($this->request->post["participantId"]);
        } elseif (isset($this->request->get['participantId'])) {
            $participantId = IntVal($this->request->get["participantId"]);
        }
        if (isset($this->request->post['participantOrderId'])) {
            $order_id = IntVal($this->request->post["participantOrderId"]);
        } elseif (isset($this->request->get['participantOrderId'])) {
            $order_id = IntVal($this->request->get["participantOrderId"]);
        } else {
            $order_id = 0;
        }

        $this->order = $this->model_checkout_order->getOrder($order_id);

        if (!$this->order) {
            $this->sendForbidden(sprintf($this->language->get('text_error_order_not_found'), $order_id));
            return false;
        }


        if ($check_sign_hash) {
            if ($this->request->server['REQUEST_METHOD'] != 'POST') {
                $this->sendForbidden($this->language->get('text_error_post'));
                return false;
            } else {
                $ucode = trim($this->request->post["ucode"]);
                $timetype = trim($this->request->post["timetype"]);
                $time = str_replace(' ', '+', trim($this->request->post["time"]));
                $amount = trim($this->request->post["amount"]);
                $currency = trim($this->request->post["currency"]);
                $agentName = trim(html_entity_decode($this->request->post["agentName"], ENT_QUOTES, 'UTF-8'));
                $agentPointName = trim(html_entity_decode($this->request->post["agentPointName"], ENT_QUOTES, 'UTF-8'));
                $testMode = trim($this->request->post["testMode"]);
                $sign = trim($this->request->post["sign"]);
                $participant_apikey = $this->config->get('invoicebox_api_key');
                $sign_strA = $participantId .
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
                $sign_crcA = md5($sign_strA);
                if (strtolower($sign_crcA) != strtolower($sign))
                    $this->sendForbidden($this->language->get('text_error_m_sign'));


                return false;
            }
        }
        return true;
    }

    private function sendForbidden($error) {
        echo "<html>
                <head>
                   <title>403 Forbidden</title>
                </head>
                <body>
                    <p>" . $error . "</p>
                </body>
        </html>";
    }

    private function sendOk($order_id) {
        header('HTTP/1.1 200 OK');
        echo $order_id . "|success";
    }

    private function sendFail($order_id) {
        header('HTTP/1.1 200 OK');
        echo $order_id . "|error";
    }

    protected function _setData($values) {
        $this->data = array();
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $this->data[$value] = $this->language->get($value);
            } else {
                $this->data[$key] = $value;
            }
        }
    }

}
