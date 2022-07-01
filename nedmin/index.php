<?php require_once 'header.php';
require_once 'sidebar.php';
session_start();
?><div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card invoice-list-wrapper">
                                <div class="card-body card-responsive">
                                    <?php
                                  //  echo"<pre>";
                                 //   print_r($_SESSION['admins']);
                                 //   echo"</pre>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content-->

<?php require_once 'footer.php'; ?>