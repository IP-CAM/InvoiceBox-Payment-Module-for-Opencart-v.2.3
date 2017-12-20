<?php
// Heading
$_['heading_title']      = '   Pay system Invoicebox';
$_['text_invoicebox']      = '<a href="https://www.invoicebox.ru/" target="_blank"><img src="view/image/payment/invoicebox.png" alt="Invoicebox" title="Invoicebox" style="border: 1px solid #EEEEEE;" width="95px" height="25px"/></a>';

// Text
$_['text_payment']       = 'Payment';
$_['text_success']       = 'Success: You have modified Invoicebox Bank account details!';
$_['button_save']        = 'Save';
$_['button_cancel']      = 'Cancel';
$_['tab_emails']      = 'E-mail notifikations';
$_['tab_settings']    = 'Pay setting';
$_['tab_log']         = 'Log';
$_['tab_information'] = 'Info';
$_['tab_general'] = 'General';
$_['entry_laterpay_mode']         = 'Режим отсроченной оплаты';
$_['text_no']                 = 'No';
$_['text_yes']                 = 'Yes';
$_['entry_order_later_status']    = 'Статус заказа для отсроченной оплаты';
$_['help_order_later_status']   = 'После проверки заказа менеджер магазина выставит данный статус, покупатель будет уведомлен по e-mail и сможет оплатить заказ. Также, ссылка на оплату появится в личном кабинете покупателя в разделе "Мои заказы".<br />БУДЬТЕ ВНИМАТЕЛЬНЫ!<br />Если данный статус будет совпадать со "статус заказа после подтверждения" - режим отсроченной оплаты будет отключен и покупатели будут перенаправляться на сайт "INVOICEBOX" для оплаты сразу после нажатия на кнопку "Оформить заказ".';
$_['entry_title']                 = 'Название';
$_['entry_instruction']           = 'Инструкция по оплате';
$_['help_title']                = 'Название метода оплаты на странице оформления заказа';
$_['help_instruction']          = 'Инструкция по оплате выводится при подтверждении заказа. Если поле не заполнено - инструкция по оплате выводиться не будет.';
$_['placeholder_instruction']  = 'Уважаемый покупатель! Просим Вас дождаться звонка от нашего менеджера перед оплатой. Это необходимо для подтверждения наличия товара на складе и возможности доставки в Ваш регион. После чего менеджер отправит Вам письмо со ссылкой на оплату заказа.';
$_['entry_notify_customer_success']       = 'Свой шаблон письма покупателю об успешной оплате';
$_['entry_order_confirm_status']  = 'Статус заказа после подтверждения';
$_['entry_mail_customer_success_subject'] = 'Тема письма покупателю об успешной оплате';
$_['entry_mail_customer_success_content'] = 'Шаблон письма покупателю об успешной оплате';
$_['entry_notify_customer_fail']          = 'Свой шаблон письма покупателю о неудачной оплате';
$_['entry_mail_customer_fail_subject']    = 'Тема письма покупателю о неудачной оплате';
$_['entry_mail_customer_fail_content']    = 'Шаблон письма покупателю о неудачной оплате';
$_['entry_notify_admin_success']          = 'Отправлять администратору уведомление по e-mail об успешной оплате';
$_['entry_mail_admin_success_subject']    = 'Тема письма администратору об успешной оплате клиентом';
$_['entry_mail_admin_success_content']    = 'Шаблон письма администратору об успешной оплате клиентом';
$_['entry_notify_admin_fail']             = 'Отправлять администратору уведомление по e-mail о неудачной оплате';
$_['entry_mail_admin_fail_subject']       = 'Тема письма администратору о неудачной оплате клиентом';
$_['entry_mail_admin_fail_content']       = 'Шаблон письма администратору о неудачной оплате клиентом';
$_['help_button_confirm']       = 'Кнопка выводится на последнем этапе оформления заказа. При нажатии на нее заказ будет сформирован окончательно и покупатель будет отправлен для оплаты на сайт платежной системы (если режим отсроченной оплаты отключен).';
$_['help_order_confirm_status'] = 'При нажатии на кнопку "Подтвердить" на последнем этапе оформления заказа, заказу будет установлен выбранный статус';
$_['help_order_fail_status']    = 'Если Invoicebox вернет покупателя после неудачного платежа, заказу будет установлен выбранный статус.';
$_['help_order_status']         = 'После успешной оплаты заказа, заказу будет установлен выбранный статус.';
$_['help_notify_customer_success']          = 'Если включено - после успешной оплаты покупателю на e-mail придет письмо, шаблон которого можно настроить ниже.<br />Если выключено - будет отправляться стандартное в Opencart письмо об изменении заказа.';
$_['help_mail_customer_success_subject']    = 'Поддерживается FastTemplate';
$_['help_mail_customer_success_content']    = 'Поддерживается FastTemplate.<br />Список возможных значений:';
$_['help_notify_customer_fail']             = 'Если включено - при неудачной оплате покупателю на e-mail придет письмо, шаблон которого можно настроить ниже.<br />Если выключено - будет отправляться стандартное в Opencart письмо об изменении заказа.';
$_['help_mail_customer_fail_subject']       = 'Поддерживается FastTemplate';
$_['help_mail_customer_fail_content']       = 'Поддерживается FastTemplate.<br />Список возможных значений:';
$_['help_notify_admin_success']             = 'Если включено - администратору и менеджерам ИМ будет отправляться уведомление по e-mail об успешной оплате клиентом. Дополнительные e-mail адреса для оповещений Вы можете добавить в "Система->Настройки->Изменить->вкладка "Почта"';
$_['help_mail_admin_success_subject']       = 'Поддерживается FastTemplate';
$_['help_mail_admin_success_content']       = 'Поддерживается FastTemplate.<br />Список возможных значений:';
$_['help_notify_admin_fail']                = 'Если включено - администратору и менеджерам ИМ будет отправляться уведомление по e-mail о неудачной оплате клиентом. Дополнительные e-mail адреса для оповещений Вы можете добавить в "Система->Настройки->Изменить->вкладка "Почта"';
$_['help_mail_admin_fail_subject']          = 'Поддерживается FastTemplate';
$_['help_mail_admin_fail_content']          = 'Поддерживается FastTemplate.<br />Список возможных значений:';
$_['sample_button_confirm']                 = 'Оплатить';
$_['sample_mail_customer_success_subject']  = 'Ваш заказ №{order_id} успешно оплачен';
$_['sample_mail_customer_success_content']  = 'Уважаемый {customer_firstname} {customer_lastname}! Ваш заказ {order_id} оплачен.';
$_['sample_mail_customer_fail_subject']     = 'Заказ №{order_id} отклонен платежной системой';
$_['sample_mail_customer_fail_content']     = 'Уважаемый {customer_firstname} {customer_lastname}! К сожалению, заказ №{order_id} был отклонен платежной системой {date_modified}. Пожалуйста, повторите заказ еще раз.';
$_['sample_mail_admin_success_subject']     = 'Заказ №{order_id} оплачен';
$_['sample_mail_admin_success_content']     = 'Заказ №{order_id} оплачен {date_modified} на сумму {total}. Статус: {order_status}; Покупатель: {customer_firstname} {customer_lastname}; E-mail: {customer_email}; Телефон: {customer_telephone}';
$_['sample_mail_admin_fail_subject']        = 'Заказ №{order_id} был отклонен платежной системой';
$_['sample_mail_admin_fail_content']        = 'Заказ №{order_id} от {date_added} на сумму {total} был отклонен {date_modified}. Текущий статус заказа: {order_status}. ';
$_['entry_button_confirm']        = 'Текст кнопки button_confirm ("Потвердить заказ"):'; 


$_['entry_notify_customer_success']       = 'Свой шаблон письма покупателю об успешной оплате';
$_['entry_mail_customer_success_subject'] = 'Тема письма покупателю об успешной оплате';
$_['entry_mail_customer_success_content'] = 'Шаблон письма покупателю об успешной оплате';
$_['entry_notify_customer_fail']          = 'Свой шаблон письма покупателю о неудачной оплате';
$_['entry_mail_customer_fail_subject']    = 'Тема письма покупателю о неудачной оплате';
$_['entry_mail_customer_fail_content']    = 'Шаблон письма покупателю о неудачной оплате';
$_['entry_notify_admin_success']          = 'Отправлять администратору уведомление по e-mail об успешной оплате';
$_['entry_mail_admin_success_subject']    = 'Тема письма администратору об успешной оплате клиентом';
$_['entry_mail_admin_success_content']    = 'Шаблон письма администратору об успешной оплате клиентом';
$_['entry_notify_admin_fail']             = 'Отправлять администратору уведомление по e-mail о неудачной оплате';
$_['entry_mail_admin_fail_subject']       = 'Тема письма администратору о неудачной оплате клиентом';
$_['entry_mail_admin_fail_content']       = 'Шаблон письма администратору о неудачной оплате клиентом';
$_['help_laterpay_mode']        = 'При включенном режиме отсроченной (отложенной) оплаты покупатель сможет оплатить заказ только после проверки заказа менеджером магазина.<br />Если Вам необходимо, чтобы у покупателя была возможность произвести оплату сразу после оформления заказа без подтверждения менеджером - не включайте эту опцию.';
// Entry
$_['invoicebox_participant_id']       = 'Shop ID (issued by the Invoicebox):';
$_['invoicebox_participant_ident']         = 'Region ID (issued by the Invoicebox):';
$_['currency']           = 'Currency (RUB by default - 643, US - 840))';
$_['invoicebox_api_key']        = 'Secret key (issued by the Invoicebox):';
$_['invoicebox_testmode']        = 'Test mode:';
$_['description']        = 'Payment description:';
$_['status']             = 'Status:';
$_['status_success']     = 'Order status after successfull payment:';
$_['status_failed']      = 'Order status after failed payment:';

// Error
$_['error_permission']   = 'Warning: You do not have permission to modify Invoicebox Bank account!';
$_['error_invoicebox_participant_id'] = 'Enter Shop ID!';
$_['error_invoicebox_participant_ident']   = 'Enter Region ID!';
$_['error_invoicebox_api_key']  = 'Enter Secret key!';
$_['error_currency']     = 'Enter Currency!';

//statuses
$_['status_completed']   = 'Order Status after success payment';
$_['status_canceled']    = 'Order Status after cancelled payment';

$_['entry_sort_order']	 = 'Sort Order';
?>