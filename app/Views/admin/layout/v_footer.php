</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2022 Dinas Koperasi Usaha Kecil dan Menengah</span>
            <span>Kabupaten Batu Bara</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->

<script src="<?= base_url() ?>/template/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>/template/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>/template/js/sb-admin-2.min.js"></script>

<!-- Sweet Alert -->
<script src="<?= base_url() ?>/template/vendor/sweetalert/sweetalert2.all.js"></script>
<script src="<?= base_url() ?>/template/js/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>/template/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/template/js/demo/datatables-demo.js"></script>
<script src="<?= base_url() ?>/template/js/scripts.js"></script>

<!-- CK Editor 5-->
<script src="<?= base_url() ?>/template/ckeditor5/ckeditor.js"></script>


<script>
    $(document).ready(function() {
        $("#kecamatan").change(function() {
            var url = "<?php echo site_url('admin/umkm/add_ajax_des'); ?>/" + $(this).val();
            $('#desa').load(url);
            return false;
        })
    });
</script>

<?php
$request = \Config\Services::request(); { ?>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "<?= base_url('admin/' . $request->uri->getSegment(2) . '/ckeditorUpload/') ?>",
                }
            }).then(editor => {
                console.log(editor);
            }).catch(error => {
                console.log(error);
            });
    </script>
<?php } ?>

<script>
    function readURL(input, id) {
        id = id || '#blah';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .height(250)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(700, function() {
            $(this).remove();
        })
    }, 3000);
</script>

<?php
$errors = session()->getFlashdata('errors');
if (!empty($errors)) { ?>
    <?php foreach ($errors as $error) : ?>
        <script>
            $(window).on('load', function() {
                $('#errormsg').on('show');
                var content = {};
                content.message = '<?= esc($error) ?>';
                $.notify(content, {
                    type: "warning",
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    time: 1000,
                    delay: 0,
                });
            });
        </script>
    <?php endforeach ?>
<?php } ?>

</body>

</html>