# Description of the payment module InvoiceBox for OpenCart 2.3+

Payment module for integrating the InvoiceBox system and CMS OpenCart version 2.3.
Payment API support has been implemented. Tested on OpenCart 2.3 system.

## Installing the module

1. Unpack the archive to the root of the site;
2. In the administrative panel of OpenCart go to the section <strong> "Modules / Extensions" -> "Modules / Extensions" -> In the filter, select "Payment" </strong>;
3. Find the <strong> "InvoiceBox" </strong> module and activate it in the <strong> Action </strong> section.

### OCMOD functions

For ** deferred payment ** to work correctly, you need to install the OCMOD extension of the module.

1. In the "Administrator Panel" - "Modules" - "Install Extensions", click the "Download" button and select the ocmod / invoicebox_laterpay.ocmod file from the distribution kit;
2. After the message "The module is successfully installed!" you need to go to "Admin Panel" - "Modules" - "Modifiers" and click the "Update" button.

## Module configuration

1. In the administrative panel of OpenCart go to the section <strong> "Modules / Extensions" -> "Modules / Extensions" -> In the filter select "Payment" </strong>;
2. Click on the active edit button;
3. In the settings editing window that opens, fill in the fields:
    - "Shop ID"
    - "Regional store code"
    - "Store security key"
4. Set up the statuses of orders, choosing for each status from the list of possible ones;
5. Specify the sorting order for the module and select the status for the module: <strong> Enabled </strong>.

### Specific settings

Test mode - enable it to make test payments, when you enable this mode, you will go through all the steps in the "InvoiceBox" payment terminal,
but money will not be debited from your card.

Order status after payment - After successful payment of the order, the order will be set to the selected status.

Order status after confirmation - When you click on the "Confirm" button at the last stage of ordering, the order will be set to the selected status.
   
Order status after unsuccessful payment - If "InvoiceBox" returns the buyer after unsuccessful payment, the order will be set to the selected status.
    
Order status for deferred payment - After checking the order, the store manager will set this status, the buyer will be notified by email and
will be able to pay for the order. Also, a link to payment will appear in the buyer's personal account in the "My orders" section.

BE CAREFUL!
If this status matches the "order status after confirmation" - the deferred payment mode will be disabled and customers will be redirected to
website "InvoiceBox" for payment immediately after clicking on the "Checkout" button.
    
Deferred payment mode - When the deferred (deferred) payment mode is enabled, the buyer can pay for the order only after the order is checked by the store manager.
If you need the buyer to be able to make a payment immediately after placing the order without confirmation by the manager, do not enable this option.

Title - The name of the payment method on the checkout page.
    
Payment instructions - Payment instructions are displayed upon order confirmation. If the field is not filled in, payment instructions will not be displayed.

Display the "Pay for order" icon in the buyer's personal account if payment for the order is interrupted.

How it works? The buyer went to the website of the payment system and did not pay for the order (changed his mind, did not have enough money, cut off the electricity in
home or office, etc.). Then an icon "P" will appear in his Personal Account (LC) in the order history list, by clicking on which the buyer can again
try to pay for your order. The icon will appear only if the current status of the buyer's order matches the status of the order specified
in the fields "Order status after confirmation" and "Order status after unsuccessful payment".
    
Button text button_confirm ("Confirm order") - The button is displayed at the last stage of ordering. When you click on it, the order will be generated
finally, and the buyer will be sent for payment to the payment system website (if the deferred payment mode is disabled).

### Setting up the InvoiceBox panel:

1. To configure the control panel "InvoiceBox" go to the url - https://login.invoicebox.ru/;
2. Log in and go to the "My Stores" section. "Getting Started" -> "Settings" -> "My Stores";
3. Go to the "Protocol notifications" tab -> select "Notification type" "Payment / HTTP / Post (HTTP POST request with payment data in variables)"
4. In the "Notification URL" field, enter:

    `<site_domain> /index.php? route = extension / payment / invoicebox / callback`

5. Save your changes.


### Frequently asked Questions

Question: When choosing a payment method, the order disappears from the store control panel, even if the client paid for the order;
Answer: Check the correctness of the payment notification link in the personal account of the InvoiceBox system.
The order is displayed in the control panel of the store only if the payment system has correctly transmitted to the store
payment information 
