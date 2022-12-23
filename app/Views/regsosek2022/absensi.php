<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Absensi <small><?= date('Y-m-d'); ?></small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Status</th>
                                    <th>Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <?php if ($absensi == null) : ?>
                                        <td>Datang (belum diisi)</td>
                                        <td><a href="/regsosek2022/absensi/datang" class="btn btn-secondary btn-sm">Cek</a></td>
                                    <?php else : ?>
                                        <td>Datang</td>
                                        <th><?= $absensi['datang']; ?></th>
                                    <?php endif ?>
                                </tr>
                                <tr class="text-center">
                                    <?php if (($absensi == null) || ($absensi['pulang'] == null)) : ?>
                                        <td>Pulang (belum diisi)</td>
                                        <td><a href="/regsosek2022/absensi/pulang" class="btn btn-secondary btn-sm">Cek</a></td>
                                    <?php else : ?>
                                        <td>Pulang</td>
                                        <th><?= $absensi['pulang']; ?></th>
                                    <?php endif ?>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kehadiran</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <td class="text-center">Tanggal</th>
                                                <td class="text-center">Masuk</th>
                                                <td class="text-center">Pulang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kehadiran as $k) : ?>
                                                <tr>
                                                    <td><?= $k['nama']; ?></td>
                                                    <td class="text-center"><?= $k['tanggal']; ?></td>
                                                    <td class="text-center"><?= $k['datang']; ?></td>
                                                    <td class="text-center"><?= $k['pulang']; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
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
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>

</html>