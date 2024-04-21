<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php $errors = validation_errors() ?>
            <?php echo form_open('Wilayah/UpdateData/' . $wilayah['id_wilayah']) ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="wilayah">Nama Wilayah</label>
                        <input type="text" value="<?= $wilayah['nama_wilayah'] ?>" class="form-control" name="nama_wilayah">
                        <p class="text-danger"><?= isset($errors['nama_wilayah']) == isset($errors['nama_wilayah']) ? validation_show_error('nama_wilayah') : '' ?></p>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="warna">Warna Wilayah</label>
                        <input type="text" value="<?= $wilayah['warna'] ?>" class="form-control  my-colorpicker1" name="warna">
                        <p class="text-danger"><?= isset($errors['warna']) == isset($errors['warna']) ? validation_show_error('warna') : '' ?></p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="geojson">Geojson</label>
                <textarea name="geojson" rows="10" class="form-control"><?= $wilayah['geojson'] ?></textarea>
                <p class="text-danger"><?= isset($errors['geojson']) == isset($errors['geojson']) ? validation_show_error('geojson') : '' ?></p>
            </div>
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('Wilayah') ?>" class="btn btn-success btn-flat">Kembali</a>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
</script>