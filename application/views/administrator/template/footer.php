</div>

<footer class="main-footer">
    <small>
        Copyright &copy; <?= date('Y'); ?>
        <a href="<?= base_url('') ?>"><b><?= $configs['copyright']; ?></b></a>.
        <span class="d-none d-sm-inline-block">
            powered by-<i><?= $configs['powered']; ?></i>.
        </span>
        <div class="float-right d-none d-sm-inline-block">
            <a href="http://adminlte.io">AdminLTE.io</a> Version 3.0.5
        </div>
    </small>
</footer>
</div>

<script>
    function previewImg() {
        const sampul = document.querySelector('#image');
        const img_preview = document.querySelector('.img-preview');
        const file_sampul = new FileReader();
        file_sampul.readAsDataURL(sampul.files[0]);
        file_sampul.onload = function(e) {
            img_preview.src = e.target.result;
        }
    }
</script>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url(''); ?>assets/admin-lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url(''); ?>assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= base_url(''); ?>assets/admin-lte/dist/js/adminlte.js"></script>
<!-- Summernote -->
<script src="<?= base_url(''); ?>assets/admin-lte/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function() {
        // Summernote
        $('.textarea').summernote({
            tabsize: 2,
            height: 600
        })
    })
</script>
</body>

</html>