<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Profil</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Report <small>Activity report</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3  profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <!-- <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar" title="Change the avatar"> -->
                                </div>
                            </div>
                            <h3><?= $nama; ?></h3>

                            <a href="/profil/edit" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>

                        </div>
                        <div class="col-md-9 col-sm-9 ">

                            <div class="profile_title">
                                <div class="col-md-12">
                                    <ul class="list-unstyled user_data">
                                        <li>
                                            <p>Rekening</p>
                                            <p><?= $rekening; ?></p>
                                        </li>
                                        <li>
                                            <p>Nomor Rekening</p>
                                            <p><?= $nomor_rekening; ?></p>
                                        </li>
                                        <li>
                                            <p>Gambar rekening</p>

                                            <?php echo '<img src="https://yt3.ggpht.com/yti/AHXOFjWxygyTbYYqrAK8DoJn5qWDP2__uO0A0YG82_Y=s48-c-k-c0x00ffffff-no-rj">' ?>

                                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($gambar_rekening) . '"/>' ?>
                                            <img src="data:image/jpg;base64,<?php echo base64_encode($gambar_rekening) ?>" />
                                            <?= base64_encode($gambar_rekening); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- morris.js -->
<script src="../vendors/raphael/raphael.min.js"></script>
<script src="../vendors/morris.js/morris.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>

</html>