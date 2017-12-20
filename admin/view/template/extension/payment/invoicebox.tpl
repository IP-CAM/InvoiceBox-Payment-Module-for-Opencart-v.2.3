<?php echo $header; ?>
<?php echo $column_left; ?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>

            <h1><img src="view/image/payment/invoicebox.png" width = '160px;'><?php echo $heading_title; ?></h1>

            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <?php if (isset($error_warning)) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-general" data-toggle="tab"><i class="fa fa-power-off"></i> <?php echo $tab_general; ?></a></li>
						<li><a href="#tab-settings" data-toggle="tab"><i class="fa fa-wrench"></i> <?php echo $tab_settings; ?></a></li>
						
					</ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-general">
                            
							
							<div class="form-group">
                                <label class="col-sm-2 control-label" for="invoicebox_testmode"><?php echo $invoicebox_testmode_label; ?></label>

                                <div class="col-sm-10">
                                    <select name="invoicebox_testmode" class="form-control">
                                        <?php if ($invoicebox_testmode) { ?>
                                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <option value="0"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                        <option value="1"><?php echo $text_enabled; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- order statuses -->
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-order-confirm-status"><?php echo $entry_order_confirm_status; ?></label>
								<div class="col-sm-10">
								  <select name="invoicebox_order_confirm_status_id" id="input-order-confirm-status" class="form-control">
									<?php foreach ($order_statuses as $order_status) { ?>
									<?php if ($order_status['order_status_id'] == $invoicebox_order_confirm_status_id) { ?>
									<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
									<?php } ?>
									<?php } ?>
								  </select>
								  <span class="help-block"><?php echo $help_order_confirm_status; ?></span>
								</div>
							  </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="invoicebox_order_status_completed"><?php echo $status_completed; ?></label>
                                <div class="col-sm-10">
                                    <select name="invoicebox_order_status_completed" id="invoicebox_order_status_completed" class="form-control">
                                        <?php foreach ($order_statuses as $order_status) { ?>
                                        <?php if ($order_status['order_status_id'] == $invoicebox_order_status_completed) { ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
									<span class="help-block"><?php echo $help_order_status; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="invoicebox_order_status_canceled"><?php echo $status_canceled; ?></label>
                                <div class="col-sm-10">
                                    <select name="invoicebox_order_status_canceled" id="invoicebox_order_status_canceled" class="form-control">
                                        <?php foreach ($order_statuses as $order_status) { ?>
                                        <?php if ($order_status['order_status_id'] == $invoicebox_order_status_canceled) { ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select><span class="help-block"><?php echo $help_order_fail_status; ?></span>
                                </div>
                            </div>
                            
                           
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="invoicebox_status"><?php echo $status_label; ?></label>

                                <div class="col-sm-10">
                                    <select name="invoicebox_status" class="form-control">
                                        <?php if ($invoicebox_status) { ?>
                                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <option value="0"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                        <option value="1"><?php echo $text_enabled; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
								<div class="col-sm-10">
									<input type="text" name="invoicebox_sort_order" value="<?php echo $invoicebox_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_laterpay_mode; ?></label>
								<div class="col-sm-10">
								  <label class="radio-inline">
									<?php if ($invoicebox_laterpay_mode) { ?>
									<input type="radio" name="invoicebox_laterpay_mode" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="invoicebox_laterpay_mode" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								  </label>
								  <label class="radio-inline">
									<?php if (!$invoicebox_laterpay_mode) { ?>
									<input type="radio" name="invoicebox_laterpay_mode" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="invoicebox_laterpay_mode" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								  </label>
								  <span class="help-block"><?php echo $help_laterpay_mode; ?></span>
								</div>
							  </div>

							  <div class="form-group" id="laterpay-mode-tr" style="display: none;">
								<label class="col-sm-2 control-label" for="input-order-later-status"><?php echo $entry_order_later_status; ?></label>
								<div class="col-sm-10">
								  <select name="invoicebox_order_later_status_id" id="input-order-later-status" class="form-control">
									<?php foreach ($order_statuses as $order_status) { ?>
									<?php if ($order_status['order_status_id'] == $invoicebox_order_later_status_id) { ?>
									<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
									<?php } ?>
									<?php } ?>
								  </select>
								  <span class="help-block"><?php echo $help_order_later_status; ?></span>
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
								<div class="col-sm-10">
								  <?php foreach ($oc_languages as $language) { ?>
								  <div class="input-group">
									<?php $language_image = version_compare(VERSION, '2.2.0.0', '<') ? 'view/image/flags/' . $language['image'] : sprintf('language/%1$s/%1$s.png', $language['code']); ?>
									<span class="input-group-addon"><img src="<?php echo $language_image; ?>" title="<?php echo $language['name']; ?>" /></span>
									<input type="text" name="invoicebox_langdata[<?php echo $language['language_id']; ?>][title]"
										   value="<?php echo !empty($invoicebox_langdata[$language['language_id']]['title'])
												  ? $invoicebox_langdata[$language['language_id']]['title'] : $title_default[0]; ?>"
												  placeholder="<?php echo $entry_title; ?>" class="form-control" />
								  </div>
								  <?php } ?>
								  <span class="help-block"><?php echo $help_title; ?></span>
								</div>
							  </div>

							  <div class="form-group"> 
								<label class="col-sm-2 control-label"><?php echo $entry_instruction; ?></label>
								<div class="col-sm-10">
								  <?php foreach ($oc_languages as $language) { ?>
								  <div class="input-group">
									<?php $language_image = version_compare(VERSION, '2.2.0.0', '<') ? 'view/image/flags/' . $language['image'] : sprintf('language/%1$s/%1$s.png', $language['code']); ?>
									<span class="input-group-addon"><img src="<?php echo $language_image; ?>" title="<?php echo $language['name']; ?>" /></span>
									<textarea name="invoicebox_langdata[<?php echo $language['language_id']; ?>][instruction]" rows="5"
											  placeholder="<?php echo $placeholder_instruction; ?>"
											  name="invoicebox_langdata[<?php echo $language['language_id']; ?>][instruction]"
											  class="form-control"><?php echo !empty($invoicebox_langdata[$language['language_id']]['instruction'])
																   ? $invoicebox_langdata[$language['language_id']]['instruction'] : ''; ?></textarea>
								  </div>
								  <?php } ?>
								  <span class="help-block"><?php echo $help_instruction; ?></span>
								</div>
							  </div>
                    </div>
					<div class="tab-pane" id="tab-settings">
						<div class="form-group  required">
                                <label class="col-sm-2 control-label" for="invoicebox_participant_id"><?php echo $invoicebox_participant_id_label; ?></label>

                                <div class="col-sm-10">
                                    <input type="text" name="invoicebox_participant_id" value="<?php echo $invoicebox_participant_id; ?>" class="form-control"/>
                                    <?php if (isset($error['invoicebox_participant_id'])) { ?>
                                    <span class="error"><?php echo $error['invoicebox_participant_id']; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group  required">
                                <label class="col-sm-2 control-label" for="invoicebox_participant_ident"><?php echo $invoicebox_participant_ident_label; ?></label>

                                <div class="col-sm-10">
                                    <input type="text" name="invoicebox_participant_ident" value="<?php echo $invoicebox_participant_ident; ?>" class="form-control"/>
                                    <?php if (isset($error['invoicebox_participant_ident'])) { ?>
                                    <span class="error"><?php echo $error['invoicebox_participant_ident']; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group  required">
                                <label class="col-sm-2 control-label" for="invoicebox_payment_url"><?php echo $invoicebox_api_key_label; ?></label>

                                <div class="col-sm-10">
                                    <input type="text" name="invoicebox_api_key" value="<?php echo $invoicebox_api_key; ?>" class="form-control"/>
                                    <?php if (isset($error['invoicebox_api_key'])) { ?>
                                    <span class="error"><?php echo $error['invoicebox_api_key']; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
					 </div>
					
					
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
  <?php if ($ckeditor) { ?>
  ckeditorInit('input-mail-admin-success-content', getURLVar('token'));
  ckeditorInit('input-mail-admin-fail-content', getURLVar('token'));
  <?php } else { ?>
  $('#input-mail-admin-success-content').summernote({height: 300});
  $('#input-mail-admin-fail-content').summernote({height: 300});
  <?php } ?>

  <?php foreach ($oc_languages as $language) { ?>
  <?php if ($ckeditor) { ?>
  ckeditorInit('mail-customer-success-content<?php echo $language['language_id']; ?>', getURLVar('token'));
  ckeditorInit('mail-customer-fail-content<?php echo $language['language_id']; ?>', getURLVar('token'));
  <?php } else { ?>
  $('#mail-customer-success-content<?php echo $language['language_id']; ?>').summernote({height: 300});
  $('#mail-customer-fail-content<?php echo $language['language_id']; ?>').summernote({height: 300});
  <?php } ?>
  <?php } ?>

  $(document).ready(function(){
    $('input:radio[name^="invoicebox_laterpay_mode"]:checked').each(function(indx){
      changeLaterpayMode($(this).val());
    });
    $('input:radio[name^="invoicebox_notify_customer_success"]:checked').each(function(indx){
      changeNotifyCustomerSuccess($(this).val());
    });
    $('input:radio[name^="invoicebox_notify_customer_fail"]:checked').each(function(indx){
      changeNotifyCustomerFail($(this).val());
    });
    $('input:radio[name^="invoicebox_notify_admin_success"]:checked').each(function(indx){
      changeNotifyAdminSuccess($(this).val());
    });
    $('input:radio[name^="invoicebox_notify_admin_fail"]:checked').each(function(indx){
      changeNotifyAdminFail($(this).val());
    });
  });
    $('input:radio[name^="invoicebox_laterpay_mode"]').change(function(){
      changeLaterpayMode($(this).val());
    });
    $('input:radio[name^="invoicebox_notify_customer_success"]').change(function(){
      changeNotifyCustomerSuccess($(this).val());
    });
    $('input:radio[name^="invoicebox_notify_customer_fail"]').change(function(){
      changeNotifyCustomerFail($(this).val());
    });
    $('input:radio[name^="invoicebox_notify_admin_success"]').change(function(){
      changeNotifyAdminSuccess($(this).val());
    });
    $('input:radio[name^="invoicebox_notify_admin_fail"]').change(function(){
      changeNotifyAdminFail($(this).val());
    });
  function changeLaterpayMode(value) {
      value == '1' ? $("#laterpay-mode-tr").fadeIn('slow') : $("#laterpay-mode-tr").fadeOut('slow').delay(200);
  }
  function changeNotifyCustomerSuccess(value) {
      value == '1' ? $("#mail-customer-success-tr").fadeIn('slow') : $("#mail-customer-success-tr").fadeOut('slow').delay(200);
  }
  function changeNotifyCustomerFail(value) {
      value == '1' ? $("#mail-customer-fail-tr").fadeIn('slow') : $("#mail-customer-fail-tr").fadeOut('slow').delay(200);
  }
  function changeNotifyAdminSuccess(value) {
      value == '1' ? $("#mail-admin-success-tr").fadeIn('slow') : $("#mail-admin-success-tr").fadeOut('slow').delay(200);
  }
  function changeNotifyAdminFail(value) {
      value == '1' ? $("#mail-admin-fail-tr").fadeIn('slow') : $("#mail-admin-fail-tr").fadeOut('slow').delay(200);
  }


//--></script>
<?php echo $footer; ?>