<?php echo $header; ?>
<?php echo $column_left; ?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>

            <h1><?php echo $heading_title; ?></h1>

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

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-general">
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
                                    </select>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>