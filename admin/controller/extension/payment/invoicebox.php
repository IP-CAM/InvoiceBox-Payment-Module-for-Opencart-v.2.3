<?php

/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/

class ControllerExtensionPaymentInvoicebox extends Controller
{
    private $error = array();
	public function __construct($registry) {
        parent::__construct($registry);
        $this->load->language('extension/payment/invoicebox');
        $this->document->setTitle($this->language->get('heading_title'));
    }
    
    public function index()
    {
        $data = array();
        
        $this->load->model('setting/setting');
        $this->load->model('setting/store');
        $this->load->model('extension/payment/invoicebox');
		$this->load->model('localisation/language');

        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $this->error = array();

		//CKEditor
        if ($this->config->get('config_editor_default')) {
            $this->document->addScript('view/javascript/ckeditor/ckeditor.js');
            $this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
        } else {
            $this->document->addScript('view/javascript/summernote/summernote.js');
            $this->document->addScript('view/javascript/summernote/opencart.js');
            $this->document->addStyle('view/javascript/summernote/summernote.css');
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            //unset($this->request->post['invoicebox_module']);

            $this->model_setting_setting->editSetting('invoicebox', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
        } else {
            if (!empty($this->error)) {
                $data['error_warning'] = array_shift($this->error);
            }
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['invoicebox_participant_id_label'] = $this->language->get('invoicebox_participant_id');
        $data['invoicebox_participant_ident_label'] = $this->language->get('invoicebox_participant_ident');
        $data['invoicebox_api_key_label'] = $this->language->get('invoicebox_api_key');
		$data['invoicebox_testmode_label'] = $this->language->get('invoicebox_testmode');
		
		$data['tab_settings'] = $this->language->get('tab_settings');
		$data['tab_general'] = $this->language->get('tab_general');
		$data['entry_laterpay_mode'] = $this->language->get('entry_laterpay_mode');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['help_laterpay_mode'] = $this->language->get('help_laterpay_mode');
		$data['entry_order_later_status'] = $this->language->get('entry_order_later_status');
		$data['help_order_later_status'] = $this->language->get('help_order_later_status');
		$data['oc_languages'] = $this->model_localisation_language->getLanguages();
		$data['ckeditor'] = $this->config->get('config_editor_default');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_instruction'] = $this->language->get('entry_instruction');

        $data['description_label'] = $this->language->get('description');
        $data['status_label'] = $this->language->get('status');
        $data['status_success_label'] = $this->language->get('status_success');
        $data['status_failed_label'] = $this->language->get('status_failed');
		$data['title_default'] = explode(',', $this->language->get('heading_title'));
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('help_title');
		$data['help_title'] = $this->language->get('help_title');
		$data['help_instruction'] = $this->language->get('help_instruction');
		$data['placeholder_instruction'] = $this->language->get('placeholder_instruction');
		$data['entry_order_confirm_status'] = $this->language->get('entry_order_confirm_status');
		$data['help_button_confirm'] = $this->language->get('help_button_confirm');
		$data['help_order_confirm_status'] = $this->language->get('help_order_confirm_status');
		$data['help_order_status'] = $this->language->get('help_order_status');
		$data['help_order_fail_status'] = $this->language->get('help_order_fail_status');
		
		$data['sample_button_confirm'] = $this->language->get('sample_button_confirm');
		$data['sample_mail_customer_success_subject'] = $this->language->get('sample_mail_customer_success_subject');
		$data['sample_mail_customer_success_content'] = $this->language->get('sample_mail_customer_success_content');
		$data['sample_mail_customer_fail_subject'] = $this->language->get('sample_mail_customer_fail_subject');
		$data['sample_mail_customer_fail_content'] = $this->language->get('sample_mail_customer_fail_content');
		$data['sample_mail_admin_success_subject'] = $this->language->get('sample_mail_admin_success_subject'); 
		$data['sample_mail_admin_success_content'] = $this->language->get('sample_mail_admin_success_content');
		$data['sample_mail_admin_fail_subject'] = $this->language->get('sample_mail_admin_fail_subject');
		$data['sample_mail_admin_fail_content'] = $this->language->get('sample_mail_admin_fail_content');
		$data['error_mail_customer_success_subject'] = isset($this->error['error_mail_customer_success_subject']) ? $this->error['error_mail_customer_success_subject'] : '';
        $data['error_mail_customer_success_content'] = isset($this->error['error_mail_customer_success_content']) ? $this->error['error_mail_customer_success_content'] : '';
        $data['error_mail_customer_fail_subject'] = isset($this->error['error_mail_customer_fail_subject']) ? $this->error['error_mail_customer_fail_subject'] : '';
        $data['error_mail_customer_fail_content'] = isset($this->error['error_mail_customer_fail_content']) ? $this->error['error_mail_customer_fail_content'] : '';
        $data['error_mail_admin_success_subject'] = isset($this->error['error_mail_admin_success_subject']) ? $this->error['error_mail_admin_success_subject'] : '';
        $data['error_mail_admin_success_content'] = isset($this->error['error_mail_admin_success_content']) ? $this->error['error_mail_admin_success_content'] : '';
        $data['error_mail_admin_fail_subject'] = isset($this->error['error_mail_admin_fail_subject']) ? $this->error['error_mail_admin_fail_subject'] : '';
        $data['error_mail_admin_fail_content'] = isset($this->error['error_mail_admin_fail_content']) ? $this->error['error_mail_admin_fail_content'] : '';
            
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['status_completed'] = $this->language->get('status_completed');
        $data['status_canceled'] = $this->language->get('status_canceled');
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/payment/invoicebox', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        //button actions
        $data['action'] = $this->url->link('extension/payment/invoicebox', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL');
		
		$data = array_merge($data, $this->_updateData(
            array(
                 'invoicebox_participant_id',
                 'invoicebox_participant_ident',
                 'invoicebox_api_key',
                 'invoicebox_sort_order',
                 'invoicebox_testmode',
                 'description',
                 'invoicebox_status',
                 'order_status_success_id',
                 'order_status_failed_id',
                 'invoicebox_laterpay_mode',
                 'invoicebox_order_later_status_id',
                 'invoicebox_langdata',
                 'invoicebox_order_status_completed',
                 'invoicebox_order_confirm_status_id',
                 'invoicebox_order_status_canceled',
                 'invoicebox_sort_order',
				 'invoicebox_notify_customer_success',
                 'invoicebox_notify_customer_fail',
                 'invoicebox_notify_admin_success',
                 'invoicebox_mail_admin_success_subject',
                 'invoicebox_mail_admin_success_content',
                 'invoicebox_notify_admin_fail',
                 'invoicebox_mail_admin_fail_subject',
                 'invoicebox_mail_admin_fail_content'
            ),
            array()
        ));

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $data['token'] = $this->session->data['token'];

        $this->template = 'extension/payment/invoicebox.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
		//echo '<pre>';print_r($data);echo '</pre>';
        $this->response->setOutput($this->load->view('extension/payment/invoicebox.tpl', $data));
    }

    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/payment/invoicebox')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (empty($this->request->post['invoicebox_participant_id'])) {
            $this->error['invoicebox_participant_id'] = $this->language->get('error_invoicebox_participant_id');
        }

        if (empty($this->request->post['invoicebox_participant_ident'])) {
            $this->error['invoicebox_participant_ident'] = $this->language->get('error_invoicebox_participant_ident');
        }

        if (empty($this->request->post['invoicebox_api_key'])) {
            $this->error['invoicebox_api_key'] = $this->language->get('error_invoicebox_api_key');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

	protected function _updateData($keys, $info = array()) {
        $data = array();
        foreach ($keys as $key) {
            if (isset($this->request->post[$key])) {
                $data[$key] = $this->request->post[$key];
            } elseif (isset($info[$key])) {
                $data[$key] = $info[$key];
            } else {
                $data[$key] = $this->config->get($key);
            }
        }
        return $data;
    }

	protected function _setData($values) {
        $data = array();
        foreach ($values as $key => $value) {
            if (is_int($key)) {
                $data[$value] = $this->language->get($value);
            } else {
                $data[$key] = $value;
            }
        }
        return $data;
    }

}
