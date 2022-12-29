<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Total Entri <?= date('Y-m-d') ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="bar-example" style="width:100%; height:300px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Progress Pengerjaan Entri</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="widget_summary">
                            <div class="w_left w_20">
                                <span>Diterima IPDS</span>
                            </div>
                            <div class="w_center w_70">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" style="width: <?= $diterima_ipds_persen .  '%'; ?>">
                                        <span class="font-italic font-weight-bold"><?= $diterima_ipds_persen .  '%'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_10">
                                <h6><?php echo $diterima_ipds . '/' . $total_sls ?></h6>
                            </div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_20">
                                <span>Diterima Mitra</span>
                            </div>
                            <div class="w_center w_70">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" style="width: <?= $diterima_ipds_persen .  '%'; ?>">
                                        <span class="font-italic font-weight-bold"><?= $diterima_mitra_persen .  '%'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_10">
                                <h6><?php echo $diterima_mitra . '/' . $total_sls ?></h6>
                            </div>
                        </div>
                        <div class="widget_summary">
                            <div class="w_left w_20">
                                <span>Kembali Ke TU</span>
                            </div>
                            <div class="w_center w_70">
                                <div class="progress">
                                    <div class="progress-bar bg-green" role="progressbar" style="width: <?= $kembali_tu_persen .  '%'; ?>">
                                        <span class="font-italic font-weight-bold"><?= $kembali_tu_persen .  '%'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="w_right w_10">
                                <h6><?php echo $kembali_tu . '/' . $total_sls ?></h6>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Kode Kecamatan</th>
                                    <th>Nama Kecamatan</th>
                                    <th>Diterima IPDS</th>
                                    <th>Diterima Petugas</th>
                                    <th>Kembali Ke TU</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($progress as $p) : ?>
                                    <tr class="text-center">
                                        <td class="align-middle"><?= $p['k_kec']; ?></td>
                                        <td class="align-middle"><?= $p['n_kec']; ?></td>
                                        <td class="project_progress">
                                            <div class="progress progress_sm">
                                                <div class="progress-bar bg-green" role="progressbar" style="width: <?= $p['persentase'] .  '%'; ?>"></div>
                                            </div>
                                            <small><?= $p['persentase']; ?>%</small>
                                            (<?php echo $p['diterima_ipds'] . '/' . $p['total'] ?>)
                                        </td>
                                        <td class="align-middle"><?= $p['diterima_mitra']; ?></td>
                                        <td class="align-middle"><?= $p['kembali_tu']; ?></td>
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
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- morris.js -->
<script src="../vendors/raphael/raphael.min.js"></script>
<script src="../vendors/morris.js/morris.min.js"></script>

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

<script>
    Morris.Bar({
        element: 'bar-example',
        data: [
            <?php foreach ($entrian as $e) : ?> {
                    y: '<?= $e['nama']; ?>',
                    a: <?= $e['dok_clean']; ?>,
                    b: <?= $e['dok_warning']; ?>,
                    c: <?= $e['dok_error']; ?>,
                },
            <?php endforeach ?>
        ],
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['Dokumen Clean', 'Dokumen Warning', 'Dokumen Error'],
        xLabelAngle: -85,
        // hideHover: true,
        resize: true,
        stacked: true
    });
</script>

</body>

</html>