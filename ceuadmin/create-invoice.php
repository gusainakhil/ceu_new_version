<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<?php
include "connect.php";
include "functions.php";
if(empty($_SESSION['username'])){
    header("Location: login.php");
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>  Create Invoice </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">
    
</head>
<body>
    <div id="ebazar-layout" class="theme-blue">
        
        <!-- sidebar -->
        <?php include 'sidebar.php'?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4"> 

            <!-- Body: Header -->
            <?php include 'header.php' ?>

            <!-- Body: Body -->       
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Create Invoice</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3">
                        <div class="col-12">
                          <div class="card print_invoice">
                            <div class="card-header border-bottom fs-4">
                              <h5 class="card-title mb-0 fw-bold">INVOICE</h5>
                            </div>
                            <div class="card-body">
                              <div class="card p-3">
                                <div class="border-bottom pb-2">
                                  <textarea class="form-control address">Jone Martin,
    2838 Oliverio Drive
    Allen, Kansas 66833
    Phone: (620) 528-2614
                                  </textarea>
                                  <div id="logo">
                                    <div id="logoctr">
                                      <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                                      <a href="javascript:;" id="save-logo" title="Save changes">Save</a> | <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                                      <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
                                    </div>
                                    <div id="logohelp">
                                      <input id="imageloc" type="text" size="50" value=""><br> (max width: 540px, max height: 100px)
                                    </div>
                                    <img id="image" src="assets/images/logo.svg" alt="logo" width="100">
                                  </div>
                                </div>
                                <div style="clear:both"></div>
                                <div class="customer mt-4">
                                  <textarea class="form-control customer-title">Widget Catalog</textarea>
                                  <table class="meta">
                                    <tbody>
                                      <tr>
                                        <td class="meta-head">Invoice #</td>
                                        <td><textarea class="form-control">000123</textarea></td>
                                      </tr>
                                      <tr>
                                        <td class="meta-head">Date</td>
                                        <td><textarea class="form-control" id="date">October 18, 2022</textarea></td>
                                      </tr>
                                      <tr>
                                        <td class="meta-head">Amount Due</td>
                                        <td>
                                          <div class="due">$1151.00</div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div style="clear:both"></div>
                                <table class="items">
                                  <tbody>
                                    <tr>
                                      <th>Item</th>
                                      <th>Description</th>
                                      <th style="width: 140px;">Unit Cost</th>
                                      <th style="width: 70px;">Quantity</th>
                                      <th style="width: 140px;">Price</th>
                                    </tr>
                                    <tr class="item-row">
                                      <td class="item-name">
                                        <div class="delete-wpr"><textarea>Rado Watch</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div>
                                      </td>
                                      <td class="description">
                                        <textarea>Rado Watch for Ebazar (Oct. 1 - Oct. 30, 2022)</textarea>
                                      </td>
                                      <td><textarea class="cost">$594.00</textarea></td>
                                      <td><textarea class="qty">1</textarea></td>
                                      <td><span class="price">$594.00</span></td>
                                    </tr>
                                    <tr class="item-row">
                                      <td class="item-name">
                                        <div class="delete-wpr"><textarea>Flower Port</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div>
                                      </td>
                                      <td class="description"><textarea>Yearly Diwali of Flower Port gift on</textarea></td>
                                      <td><textarea class="cost">$199.00</textarea></td>
                                      <td><textarea class="qty">3</textarea></td>
                                      <td><span class="price">$557.00</span></td>
                                    </tr>
                                    <tr id="hiderow">
                                      <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" class="blank"> </td>
                                      <td colspan="2" class="total-line">Subtotal</td>
                                      <td class="total-value">
                                        <div id="subtotal">$1151.00</div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" class="blank"> </td>
                                      <td colspan="2" class="total-line">Total</td>
                                      <td class="total-value">
                                        <div id="total">$1151.00</div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" class="blank"> </td>
                                      <td colspan="2" class="total-line">Amount Paid</td>
                                      <td class="total-value"><textarea id="paid">$0.00</textarea></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" class="blank"> </td>
                                      <td colspan="2" class="total-line balance">Balance Due</td>
                                      <td class="total-value balance">
                                        <div class="due">$1151.00</div>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                                <div style="clear:both"></div>
                                <div class="footer-note mt-5">
                                  <h5>Terms</h5>
                                  <textarea class="form-control bg-light">NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 text-center text-md-end">
                          <button type="button" class="btn btn-lg btn-primary" onclick="window.print();return false"><i class="fa fa-print me-2"></i>Print Invoice</button>
                          <button type="button" class="btn btn-lg btn-secondary"><i class="fa fa-envelope me-2"></i>Send PDF</button>
                        </div>
                    </div><!-- Row end  -->
                </div>
            </div>
            
            <!-- Modal Custom Settings-->
            <div class="modal fade right" id="Settingmodal" tabindex="-1"  aria-hidden="true">
                <div class="modal-dialog  modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Custom Settings</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body custom_setting">
                            <!-- Settings: Color -->
                            <div class="setting-theme pb-3">
                                <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-color-bucket fs-4 me-2 text-primary"></i>Template Color Settings</h6>
                                <ul class="list-unstyled row row-cols-3 g-2 choose-skin mb-2 mt-2">
                                    <li data-theme="indigo"><div class="indigo"></div></li>
                                    <li data-theme="tradewind"><div class="tradewind"></div></li>
                                    <li data-theme="monalisa"><div class="monalisa"></div></li>
                                    <li data-theme="blue" class="active"><div class="blue"></div></li>
                                    <li data-theme="cyan"><div class="cyan"></div></li>
                                    <li data-theme="green"><div class="green"></div></li>
                                    <li data-theme="orange"><div class="orange"></div></li>
                                    <li data-theme="blush"><div class="blush"></div></li>
                                    <li data-theme="red"><div class="red"></div></li>
                                </ul>
                            </div>
                            <div class="sidebar-gradient py-3">
                                <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-paint fs-4 me-2 text-primary"></i>Sidebar Gradient</h6>
                                <div class="form-check form-switch gradient-switch pt-2 mb-2">
                                    <input class="form-check-input" type="checkbox" id="CheckGradient">
                                    <label class="form-check-label" for="CheckGradient">Enable Gradient! ( Sidebar )</label>
                                </div>
                            </div>
                            <!-- Settings: Template dynamics -->
                            <div class="dynamic-block py-3">
                                <ul class="list-unstyled choose-skin mb-2 mt-1">
                                    <li data-theme="dynamic"><div class="dynamic"><i class="icofont-paint me-2"></i> Click to Dyanmic Setting</div></li>
                                </ul>
                                <div class="dt-setting">
                                    <ul class="list-group list-unstyled mt-1">
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                            <label>Primary Color</label>
                                            <button id="primaryColorPicker" class="btn bg-primary avatar xs border-0 rounded-0"></button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                            <label>Secondary Color</label>
                                            <button id="secondaryColorPicker" class="btn bg-secondary avatar xs border-0 rounded-0"></button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                            <label class="text-muted">Chart Color 1</label>
                                            <button id="chartColorPicker1" class="btn chart-color1 avatar xs border-0 rounded-0"></button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                            <label class="text-muted">Chart Color 2</label>
                                            <button id="chartColorPicker2" class="btn chart-color2 avatar xs border-0 rounded-0"></button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                            <label class="text-muted">Chart Color 3</label>
                                            <button id="chartColorPicker3" class="btn chart-color3 avatar xs border-0 rounded-0"></button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                            <label class="text-muted">Chart Color 4</label>
                                            <button id="chartColorPicker4" class="btn chart-color4 avatar xs border-0 rounded-0"></button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                            <label class="text-muted">Chart Color 5</label>
                                            <button id="chartColorPicker5" class="btn chart-color5 avatar xs border-0 rounded-0"></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Settings: Font -->
                            <div class="setting-font py-3">
                                <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-font fs-4 me-2 text-primary"></i> Font Settings</h6>
                                <ul class="list-group font_setting mt-1">
                                    <li class="list-group-item py-1 px-2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="font" id="font-poppins" value="font-poppins">
                                            <label class="form-check-label" for="font-poppins">
                                                Poppins Google Font
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-1 px-2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="font" id="font-opensans" value="font-opensans" checked="">
                                            <label class="form-check-label" for="font-opensans">
                                                Open Sans Google Font
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-1 px-2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="font" id="font-montserrat" value="font-montserrat">
                                            <label class="form-check-label" for="font-montserrat">
                                                Montserrat Google Font
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-1 px-2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="font" id="font-mukta" value="font-mukta">
                                            <label class="form-check-label" for="font-mukta">
                                                Mukta Google Font
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Settings: Light/dark -->
                            <div class="setting-mode py-3">
                                <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-layout fs-4 me-2 text-primary"></i>Contrast Layout</h6>
                                <ul class="list-group list-unstyled mb-0 mt-1">
                                    <li class="list-group-item d-flex align-items-center py-1 px-2">
                                        <div class="form-check form-switch theme-switch mb-0">
                                            <input class="form-check-input" type="checkbox" id="theme-switch">
                                            <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center py-1 px-2">
                                        <div class="form-check form-switch theme-high-contrast mb-0">
                                            <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                            <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center py-1 px-2">
                                        <div class="form-check form-switch theme-rtl mb-0">
                                            <input class="form-check-input" type="checkbox" id="theme-rtl">
                                            <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-white border lift" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary lift">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div> 

        </div>
             
    </div>
    
    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/invoice.bundle.js"></script>
    <script src="assets/js/template.js"></script>

    
</body>

</html>