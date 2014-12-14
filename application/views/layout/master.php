<!-- Header -->
<?php $this->load->view('layout/header');?>
<!--start wrapper-->
<div class="container" id="wrapper">
        <!--Navigation-->
        <?php $this->load->view('layout/navigation');?>

        <!--Page-->
        <div class="container" id="page-wrapper">

            <!--Breadcrumb-->
            <?php echo set_breadcrumb(); ?>

            <!--Main Content-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="main_content">
                        <?php $this->load->view($main_content);?>
                    </div>
                </div>
            </div>
        </div>
        <!--#Page Wrapper-->
    </div>
<!-- /#wrapper -->

<!--Footer-->
<?php $this->load->view('layout/footer');?>

