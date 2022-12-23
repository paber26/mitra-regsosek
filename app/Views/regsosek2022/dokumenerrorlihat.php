<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Dokumen Error Regsosek 2022</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Kode Wilayah</th>
                                                <th>Mitra</th>
                                                <th>ID RT</th>
                                                <th>ID ART</th>
                                                <th>Jenis Validasi</th>
                                                <th>Perlakuan</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($dokumenerror as $dok) : ?>
                                                <tr>
                                                    <td><?= $dok['k_wil']; ?></td>
                                                    <td><?= $dok['mitra']; ?></td>
                                                    <td><?= $dok['rt']; ?></td>
                                                    <td><?= $dok['art']; ?></td>
                                                    <td><?= $dok['validasi']; ?></td>
                                                    <td><?= $dok['perlakuan']; ?></td>
                                                    <td><a href="<?php echo '/regsosek2022/dokumenerror/' . $dok['k_wil'] . '/' . $dok['id'] ?>" class="btn btn-secondary btn-sm">Edit</a></td>
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
<script src="<?= base_url('vendors/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap -->
<script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?= base_url('vendors/fastclick/lib/fastclick.js'); ?>"></script>
<!-- NProgress -->
<script src="<?= base_url('vendors/nprogress/nprogress.js'); ?>"></script>
<!-- iCheck -->
<script src="<?= base_url('vendors/iCheck/icheck.min.js'); ?>"></script>
<!-- Dropzone.js -->
<script src="<?= base_url('vendors/dropzone/dist/min/dropzone.min.js'); ?>"></script>

<!-- Datatables -->
<script src="<?= base_url('vendors/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-buttons/js/buttons.flash.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'); ?>"></script>
<script src="<?= base_url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js'); ?>"></script>
<script src="<?= base_url('vendors/jszip/dist/jszip.min.js'); ?>"></script>
<script src="<?= base_url('vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>

<!-- Custom Theme Scripts -->
<script src="<?= base_url('build/js/custom.min.js'); ?>"></script>

</body>

</html>