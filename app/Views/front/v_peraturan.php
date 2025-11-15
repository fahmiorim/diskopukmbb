<!-- Four Columns -->
<div class="container content">
    <!--Table Bordered-->
    <div class="panel panel-grey margin-bottom-40">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-gavel"></i> Peraturan</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-responsive" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th class="hidden-sm">Lampiran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($peraturan as $key => $value) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['judul']; ?></td>
                            <td><?= $value['file']; ?></td>
                            <td><a href="<?= base_url() ?>/media/peraturan/<?= $value['file']; ?>" target="blank"><button class="btn btn-success btn-xs"><i class="fa fa-cloud-download"></i> Download</button></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--End Table Bordered-->
</div>
<!-- End Four Columns -->