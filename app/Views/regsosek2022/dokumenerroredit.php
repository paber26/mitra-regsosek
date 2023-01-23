<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit dokumen error</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="<?= base_url('/regsosek2022/dokumenerror/' . $arusdokumen['k_wil'] . '/' . $dokumenerror['id']); ?>" method="post" novalidate>
                            <span class="section">Informasi Dokumen</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Kode Wilayah</label>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-control"><?= $arusdokumen['k_wil']; ?></label>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Kecamatan</label>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-control"><?php echo '[' . $arusdokumen['k_kec'] . '] ' . $arusdokumen['n_kec'] ?></label>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Desa</label>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-control"><?php echo '[' . $arusdokumen['k_desa'] . '] ' . $arusdokumen['n_desa'] ?></label>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">SLS - Sub SLS</label>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-control"><?php echo '[' . $arusdokumen['k_sls'] . ' - ' . $arusdokumen['k_subsls'] . '] ' . $arusdokumen['n_sls'] ?></label>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-control"><?= $arusdokumen['ket']; ?></label>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Mitra</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <label class="form-control"><?= $arusdokumen['mitra']; ?></label>
                                </div>
                            </div>

                            <span class="section"></span>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Validasi</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea disabled class="form-control"><?= $dokumenerror['validasi']; ?></textarea>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Perlakuan</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea disabled class="form-control"><?= $dokumenerror['perlakuan']; ?></textarea>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Catatan</label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea class="form-control" name="catatan"><?= $dokumenerror['catatan']; ?></textarea>
                                </div>
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?= base_url('vendors/validator/multifield.js'); ?>"></script>
<script src="<?= base_url('vendors/validator/validator.js'); ?>"></script>

<!-- Javascript functions	-->
<script>
    function hideshow() {
        var password = document.getElementById("password1");
        var slash = document.getElementById("slash");
        var eye = document.getElementById("eye");

        if (password.type === 'password') {
            password.type = "text";
            slash.style.display = "block";
            eye.style.display = "none";
        } else {
            password.type = "password";
            slash.style.display = "none";
            eye.style.display = "block";
        }

    }
</script>

<script>
    // initialize a validator instance from the "FormValidator" constructor.
    // A "<form>" element is optionally passed as an argument, but is not a must
    var validator = new FormValidator({
        "events": ['blur', 'input', 'change']
    }, document.forms[0]);
    // on form "submit" event
    document.forms[0].onsubmit = function(e) {
        var submit = true,
            validatorResult = validator.checkAll(this);
        console.log(validatorResult);
        return !!validatorResult.valid;
    };
    // on form "reset" event
    document.forms[0].onreset = function(e) {
        validator.reset();
    };
    // stuff related ONLY for this demo page:
    $('.toggleValidationTooltips').change(function() {
        validator.settings.alerts = !this.checked;
        if (this.checked)
            $('form .alert').remove();
    }).prop('checked', false);
</script>

<!-- jQuery -->
<script src="<?= base_url('vendors/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap -->
<script src="<?= base_url('vendors/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?= base_url('vendors/fastclick/lib/fastclick.js'); ?>"></script>
<!-- NProgress -->
<script src="<?= base_url('vendors/nprogress/nprogress.js'); ?>"></script>
<!-- validator -->
<script src="<?= base_url('vendors/validator/validator.js'); ?>"></script>

<!-- Custom Theme Scripts -->
<script src="<?= base_url('build/js/custom.min.js'); ?>"></script>

</body>

</html>