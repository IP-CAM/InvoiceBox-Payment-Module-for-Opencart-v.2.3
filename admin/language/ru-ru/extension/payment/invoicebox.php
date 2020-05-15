<?php
// Heading
$_['heading_title']      = '   Платёжная система «ИнвойсБокс»';
$_['text_invoicebox']      = '<a href="https://www.invoicebox.ru/" target="_blank"><img src="view/image/payment/invoicebox.png" alt="InvoiceBox" title="InvoiceBox" style="border: 1px solid #EEEEEE;" width="95px" height="25px"/></a>';

// Text
$_['text_payment']       = 'Платёж';
$_['text_success']       = 'Настройки успешно соханены!';
$_['button_save']        = 'Сохранить';
$_['button_cancel']      = 'Отмена';
$_['tab_emails']      = 'E-mail уведомления';
$_['tab_settings']    = 'Настройка платежей';
$_['tab_log']         = 'Журнал';
$_['tab_information'] = 'Информация';
$_['tab_general'] = 'Основное';
$_['entry_laterpay_mode']         = 'Режим отсроченной оплаты';
$_['help_laterpay_mode']        = 'При включённом режиме отсроченной (отложенной) оплаты покупатель сможет оплатить заказ только после проверки заказа менеджером магазина.<br />Если Вам необходимо, чтобы у покупателя была возможность произвести оплату сразу после оформления заказа без подтверждения менеджером - не включайте эту опцию.';
$_['text_no']                 = 'Нет';
$_['text_yes']                 = 'Да';
$_['entry_order_later_status']    = 'Статус заказа для отсроченной оплаты';
$_['help_order_later_status']   = 'После проверки заказа менеджер магазина выставит данный статус, покупатель будет уведомлен по e-mail и сможет оплатить заказ. Также, ссылка на оплату появится в личном кабинете покупателя в разделе "Мои заказы".<br />БУДЬТЕ ВНИМАТЕЛЬНЫ!<br />Если данный статус будет совпадать со "статус заказа после подтверждения" - режим отсроченной оплаты будет отключен и покупатели будут перенаправляться на сайт «ИнвойсБокс» для оплаты сразу после нажатия на кнопку "Оформить заказ".';
$_['entry_title']                 = 'Название';
$_['entry_instruction']           = 'Инструкция по оплате';
$_['help_title']                = 'Название метода оплаты на странице оформления заказа';
$_['help_instruction']          = 'Инструкция по оплате выводится при подтверждении заказа. Если поле не заполнено - инструкция по оплате выводиться не будет.';
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
$_['help_order_confirm_status'] = 'При нажатии на кнопку "Подтвердить" на последнем этапе оформления заказа, заказу будет установлен выбранный статус';
$_['help_order_status']         = 'После успешной оплаты заказа, заказу будет установлен выбранный статус.';
$_['help_order_fail_status']    = 'Если «ИнвойсБокс» вернёт покупателя после неудачного платежа, заказу будет установлен выбранный статус.';
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

// Entry
$_['invoicebox_participant_id']       = 'Номер магазина (выдаётся «ИнвойсБокс»):';
$_['invoicebox_participant_ident']         = 'Региональный код магазина (выдаётся «ИнвойсБокс»):';
$_['currency']           = 'Валюта (по умолчанию рубли - 643)';
$_['invoicebox_api_key']        = 'Ключ безопасности магазина (выдаётся «ИнвойсБокс»):';
$_['invoicebox_testmode']        = 'Тестовый режим:';
$_['description']        = 'Описание платежа:';
$_['status']             = 'Статус:';
$_['status_success']     = 'Статус заказа после успешной оплаты:';
$_['status_failed']      = 'Статус заказа после неуспешной оплаты:';

// Error
$_['error_permission']   = 'Ошибка! У Вас нет прав на редактирование данного раздела!';
$_['error_invoicebox_participant_id'] = 'Введите номер магазина!';
$_['error_invoicebox_participant_ident']   = 'Введите Региональный код магазина!';
$_['error_invoicebox_api_key']  = 'Введите Ключ безопасности магазина!';
$_['error_currency']     = 'Введите валюту платежа!';

//statuses
$_['status_completed']   = 'Статус оплаченного заказа';
$_['status_canceled']    = 'Статус заказа при отмененной оплате';

$_['entry_sort_order']	 = 'Порядок сортировки';
