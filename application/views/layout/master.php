<!-- Header -->
<?php $this->load->view('layout/header');?>
<!--start wrapper-->
<div class="container" id="wrapper">
        <!--Navigation-->
        <?php $this->load->view('layout/navigation');?>

        <!--Page-->
        <!--Page Header-->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12 page-header">
                    <!--Title -->
                    <h1 ><?=$title?></h1>
                    <!--Breadcrumb-->
                    <?php echo set_breadcrumb(); ?>
                </div>
            </div>


            <!--Main Content-->
            <div class="row">
                <div class="col-lg-12">
                    <?php $this->load->view($main_content);?>
                </div>
            </div>
        </div>
        <!--#Page Wrapper-->
    </div>
<!-- /#wrapper -->

<!--Footer-->
<?php $this->load->view('layout/footer');?>

