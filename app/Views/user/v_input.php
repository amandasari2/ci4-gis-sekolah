<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php $errors = validation_errors() ?>
            <?php echo form_open_multipart('User/InsertData') ?>

            <div class="form-group">
                <label for="nama_user">Nama User</label>
                <input type="text" value="<?= old('nama_user') ?>" class="form-control" name="nama_user" placeholder="Masukkan Nama User">
                <p class="text-danger"><?= isset($errors['nama_user']) == isset($errors['nama_user']) ? validation_show_error('nama_user') : '' ?></p>
            </div>

            <div class="form-group">
                <label for="email">E - mail</label>
                <input type="text" value="<?= old('email') ?>" class="form-control" name="email" placeholder="Masukkan E - mail">
                <p class="text-danger"><?= isset($errors['email']) == isset($errors['email']) ? validation_show_error('email') : '' ?></p>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" value="<?= old('password') ?>" class="form-control" name="password" placeholder="Masukkan Password">
                <p class="text-danger"><?= isset($errors['password']) == isset($errors['password']) ? validation_show_error('password') : '' ?></p>
            </div>

            <div class="form-group">
                <label for="foto">Foto User</label>
                <input type="file" accept="image/.jpg/.png/.jpeg" value="<?= old('foto') ?>" class="form-control" name="foto">
                <p class="text-danger"><?= isset($errors['foto']) == isset($errors['foto']) ? validation_show_error('foto') : '' ?></p>
            </div>

            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('User') ?>" class="btn btn-success btn-flat">Kembali</a>

            <?php echo form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>