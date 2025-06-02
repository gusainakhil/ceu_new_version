<?php
include "../ceuadmin/connect.php";
include "../ceuadmin/functions.php";
  $order_id = $_GET['order_detail'];

?>
    <?php
                 
                 $a = 0;
                  $result = mysqli_query($con, "SELECT 
                    user_info.*,
                    order_details.*,
                    course_detail.title
                from user_info, order_details, course_detail 
                where 
                    user_info.id = order_details.user_id and order_details.course_id = course_detail.id and order_details.order_id = '$order_id' ");
                while ($row = mysqli_fetch_assoc($result))
                {
                 //print_r($row);
                
                     $a++;
    ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Laralink" />

    <title><?php $order_id = $_GET['order_detail']; ?></title>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <div class="tm_container">
      <div class="tm_invoice_wrap">
        <div class="tm_invoice tm_style1" id="tm_download_section">
          <div class="tm_invoice_in">
            <div class="tm_invoice_head tm_align_center tm_mb20">
              <div class="tm_invoice_left">
                <div class="tm_logo">
                  <img src="../assets/img/Logo.png" alt="Logo" />
                </div>
              </div>
              <div class="tm_invoice_right tm_text_right">
                <div class="tm_primary_color tm_f50 tm_text_uppercase">
                  Invoice
                </div>
              </div>
            </div>
            <div class="tm_invoice_info tm_mb20">
              <div class="tm_invoice_seperator tm_gray_bg"></div>
              <div class="tm_invoice_info_list">
                <p class="tm_invoice_number tm_m0">
                  Invoice No: <b class="tm_primary_color"> <?php echo $row['order_id']; ?></b>
                </p>
                <p class="tm_invoice_date tm_m0">
                  Date: <b class="tm_primary_color"><?php echo $row['trans_date']; ?></b>
                </p>
              </div>
            </div>
            <div class="tm_invoice_head tm_mb10">
              <div class="tm_invoice_left">
                <p class="tm_mb2">
                  <b class="tm_primary_color">Invoice To:</b>
                </p>
                <p>
                   <?php echo $row['name'] . "<br>" . $row['company_name'] . "<br>" . $row['address'] . "<br>" . $row['state'] . "<br>" . $row['country'] . "<br>" . $row['pin_code']; ?>
                </p>
              </div>
              <div class="tm_invoice_right tm_text_right">
                <p class="tm_mb2"><b class="tm_primary_color">Pay To:</b></p>
                <p>
                  
                  304 S. Jones Blvd #5255,  <br />
                  Las Vegas,NV, 89107 <br />
                 United States <br />
                info@ceutrainers.com
                </p>
              </div>
            </div>
            <div class="tm_table tm_style1 tm_mb30">
              <div class="tm_round_border">
                <div class="tm_table_responsive">
                  <table>
                    <thead>
                      <tr>
                        <th
                          class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg"
                        >
                          Item
                        </th>
                        <th
                          class="tm_width_4 tm_semi_bold tm_primary_color tm_gray_bg"
                        >
                         Webinar
                        </th>
                        <th
                          class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg"
                        >
                          selling options
                        </th>
                       
                        <th
                          class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg tm_text_right"
                        >
                          Amount
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="">1</td>
                        <td class="tm_width_6">
                          <?php echo $row['title']; ?>
                        </td>
<<td class="tm_width_2">
    <?php
    // Check if the selling_options field contains JSON
    $isJson = is_string($row['selling_options']) && is_array(json_decode($row['selling_options'], true)) && (json_last_error() == JSON_ERROR_NONE);

    if ($isJson) {
        // Decode JSON into an associative array
        $array = json_decode($row['selling_options'], true);

        foreach ($array as $key1 => $innerArray) {
            if (is_array($innerArray)) { ?>
                <strong><?php echo htmlspecialchars((string)$key1); ?>:</strong><br>
                <?php foreach ($innerArray as $key => $value) { ?>
                    <?php echo htmlspecialchars((string)$key); ?>: $<?php echo htmlspecialchars((string)$value); ?><br>
                <?php }
            } else { ?>
                <strong><?php echo htmlspecialchars((string)$key1); ?>:</strong> $<?php echo htmlspecialchars((string)$innerArray); ?><br>
            <?php }
        }
    } elseif (is_string($row['selling_options'])) {
        // If the data is a plain string (not JSON)
        echo htmlspecialchars($row['selling_options']);
    } else {
        // Handle non-JSON, non-array data (fallback)
        echo "Invalid format";
    }
    ?>
</td>




                        
                        <td class="tm_width_2 tm_text_right"><?php echo "$".$row['amount']; ?></td>
                      </tr>
                    

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tm_invoice_footer">
                <div class="tm_left_footer">
                  <p class="tm_mb2">
                    <b class="tm_primary_color">Payment info:</b>
                  </p>
                  <p class="tm_m0">
                    payer Email - <?php echo $row['payer_email']; ?> <br />Amount: <?php echo "$".$row['amount']; ?> </br> Transaction Id : <?php echo $row['txn_id']; ?>
                  </p>
                </div>
                <div class="tm_right_footer">
                  <table>
                    <tbody>
                      <tr>
                        <td
                          class="tm_width_3 tm_primary_color tm_border_none tm_bold"
                        >
                          Subtoal
                        </td>
                        <td
                          class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold"
                        >
                         <?php echo "$".$row['amount']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td
                          class="tm_width_3 tm_primary_color tm_border_none tm_pt0"
                        >
                          Discount <span class="tm_ternary_color">(0%)</span>
                        </td>
                        <td
                          class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0"
                        >
                        <?php echo "$".$row['coupon_discount']; ?>
                        </td>
                      </tr>
                      <tr class="tm_border_top tm_border_bottom">
                        <td
                          class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color"
                        >
                          Grand Total
                        </td>
                        <td
                          class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right"
                        >
                          <?php echo "$".$row['amount']; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="tm_padd_15_20 tm_round_border">
              <p class="tm_mb5">
                <b class="tm_primary_color">Terms & Conditions:</b>
              </p>
              <ul class="tm_m0 tm_note_list">
                <li>
                  Payment(<strong><?php echo "$".$row['amount']; ?>.00</strong>) Processed by paypal, Transaction ID <strong>  <?php echo $row['txn_id']; ?> </strong>This is an electronically generated
                invoice/receipt and does not require any signature or official stamp.

                </li>
                <li>
               Billing & Payments: ceutrainers manages the payments done on our website, which are secured throughPaypal payment processor. All your bank/credit/debit card/PayPal, and/or any other billing statements will disclose
                      "ceuTrainers Webinar" for your payments done to ceu-trainers.com For any inquiries regarding yearly subscription, billing info,
                   corrections to your invoice, etc., please contact us at <a href="mailto:support@ceutrainers.com"> support@ceutrainers.com</a> Our service hours are: Mon - Fri, 10 am - 5 pm EST. All
                 the delivery are done on email In case your firewall blocked our email. Please contact us / Write to us/ Go to live Chat. We will
            Respond to you Soon
                </li>
                <li>For terms and use :- <a href="https://ceu-trainers.com/privacy-policy.php" target="blank">ceu-trainers.com/privacy-policy</a></li>
              </ul>
            </div>
                <?php } ?>
            <!-- .tm_note -->
          </div>
        </div>
        <div class="tm_invoice_btns tm_hide_print">
          <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
            <span class="tm_btn_icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="ionicon"
                viewBox="0 0 512 512"
              >
                <path
                  d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                  fill="none"
                  stroke="currentColor"
                  stroke-linejoin="round"
                  stroke-width="32"
                />
                <rect
                  x="128"
                  y="240"
                  width="256"
                  height="208"
                  rx="24.32"
                  ry="24.32"
                  fill="none"
                  stroke="currentColor"
                  stroke-linejoin="round"
                  stroke-width="32"
                />
                <path
                  d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24"
                  fill="none"
                  stroke="currentColor"
                  stroke-linejoin="round"
                  stroke-width="32"
                />
                <circle cx="392" cy="184" r="24" fill="currentColor" />
              </svg>
            </span>
            <span class="tm_btn_text">Print</span>
          </a>
          <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
            <span class="tm_btn_icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="ionicon"
                viewBox="0 0 512 512"
              >
                <path
                  d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03"
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="32"
                />
              </svg>
            </span>
            <span class="tm_btn_text">Download</span>
          </button>
        </div>
      </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jspdf.min.js"></script>
    <script src="assets/js/html2canvas.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
