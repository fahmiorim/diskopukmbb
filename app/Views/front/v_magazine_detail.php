<!-- Three Columns -->
<div class="container content">
    <div class="tag-box tag-box-v7 text-justify">
        <?php foreach ($detail as $key => $value) { ?>
            <iframe width="100%" style="height: 600px;" src="<?= $value['url'] ?>" seamless="seamless" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true"></iframe>
        <?php } ?>
    </div>
</div>

<!-- End Three Columns -->