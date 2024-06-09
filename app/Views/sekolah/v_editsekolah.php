<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php $errors = validation_errors() ?>
            <?php echo form_open_multipart('Sekolah/UpdateData/' . $sekolah['id_sekolah']) ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nama_sekolah">Nama Sekolah</label>
                        <input type="text" value="<?= $sekolah['nama_sekolah'] ?>" class="form-control" name="nama_sekolah" placeholder="Masukkan Nama Sekolah">
                        <p class="text-danger"><?= isset($errors['nama_sekolah']) == isset($errors['nama_sekolah']) ? validation_show_error('nama_sekolah') : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="akreditasi">Akreditasi</label>
                        <input type="text" value="<?= $sekolah['akreditasi'] ?>" class="form-control" name="akreditasi" placeholder="Masukkan Akreditasi">
                        <p class="text-danger"><?= isset($errors['akreditasi']) == isset($errors['akreditasi']) ? validation_show_error('akreditasi') : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="<?= $sekolah['status'] ?>"><?= $sekolah['status'] ?></option>
                            <option value="Negeri">Negeri</option>
                            <option value="Swasta">Swasta</option>
                        </select>
                        <p class="text-danger"><?= isset($errors['status']) == isset($errors['status']) ? validation_show_error('status') : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="id_jenjang">Jenjang</label>
                        <select name="id_jenjang" id="" class="form-control">
                            <option value="">-- Pilih Jenjang --</option>
                            <?php foreach ($jenjang as $key => $value) { ?>
                                <option value="<?= $value['id_jenjang'] ?>" <?= $value['id_jenjang'] == $sekolah['id_jenjang'] ? 'selected' : '' ?>><?= $value['jenjang'] ?></option>
                            <?php } ?>
                        </select>
                        <p class="text-danger"><?= isset($errors['id_jenjang']) == isset($errors['id_jenjang']) ? validation_show_error('id_jenjang') : '' ?></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="coordinat">Coordinat Sekolah</label>
                <div id="map" style="width: 100%; height: 400px;"></div>
                <input type="text" id="Coordinat" value="<?= $sekolah['coordinat'] ?>" class="form-control" name="coordinat" readonly placeholder="Masukkan Coordinat">
                <p class="text-danger"><?= isset($errors['coordinat']) == isset($errors['coordinat']) ? validation_show_error('coordinat') : '' ?></p>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kepsek">Kepala Sekolah</label>
                        <input type="text" value="<?= $sekolah['kepsek'] ?>" class="form-control" name="kepsek" placeholder="Masukkan Nama Kepala Sekolah">
                        <p class="text-danger"><?= isset($errors['kepsek']) == isset($errors['kepsek']) ? validation_show_error('kepsek') : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kurikulum">Kurikulum</label>
                        <input type="text" value="<?= $sekolah['kurikulum'] ?>" class="form-control" name="kurikulum" placeholder="Masukkan Kurikulum Sekolah">
                        <p class="text-danger"><?= isset($errors['kurikulum']) == isset($errors['kurikulum']) ? validation_show_error('kurikulum') : '' ?></p>
                    </div>
                </div>
                 <div class="col-sm-4">
                    <div class="form-group">
                        <label for="stts_pemilik">Status Kepemilikan</label>
                        <input type="text" value="<?= $sekolah['stts_pemilik'] ?>" class="form-control" name="stts_pemilik" placeholder="Masukkan Status Kepemilikan">
                        <p class="text-danger"><?= isset($errors['stts_pemilik']) == isset($errors['stts_pemilik']) ? validation_show_error('stts_pemilik') : '' ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" value="<?= $sekolah['alamat'] ?>" class="form-control" name="alamat" placeholder="Masukkan Alamat">
                        <p class="text-danger"><?= isset($errors['alamat']) == isset($errors['alamat']) ? validation_show_error('alamat') : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="npsn">NPSN</label>
                        <input type="text" value="<?= $sekolah['npsn'] ?>" class="form-control" name="npsn" placeholder="Masukkan npsn">
                        <p class="text-danger"><?= isset($errors['npsn']) == isset($errors['npsn']) ? validation_show_error('npsn') : '' ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="foto">Foto Sekolah</label>
                        <img src="<?= base_url('foto/' . $sekolah['foto']) ?>" width="100px">

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="foto">Ganti Foto Sekolah</label>
                        <input type="file" accept="image/.jpg/.png/.jpeg" value="<?= old('foto') ?>" class="form-control" name="foto">
                        <p class="text-danger"><?= isset($errors['foto']) == isset($errors['foto']) ? validation_show_error('foto') : '' ?></p>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('Sekolah') ?>" class="btn btn-success btn-flat">Kembali</a>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFyZGFsaXVzIiwiYSI6ImNsZnVtbDdtZzAyYjMzdXRhdDN6djY5cWoifQ.Xqtyqa7hvGhQla2oAwpG_Q', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    });

    var peta2 = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        attribution: '© Google Maps',
        maxZoom: 20,
    });

    var peta3 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 18,
        id: 'mapbox/outdoors-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFyZGFsaXVzIiwiYSI6ImNsZnVtbDdtZzAyYjMzdXRhdDN6djY5cWoifQ.Xqtyqa7hvGhQla2oAwpG_Q'
    });

    var peta5 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta6 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFyZGFsaXVzIiwiYSI6ImNsZnVtbDdtZzAyYjMzdXRhdDN6djY5cWoifQ.Xqtyqa7hvGhQla2oAwpG_Q', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/dark-v10'
    });

    var peta7 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://carto.com/attributions">CARTO</a>'
    });

    var peta8 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Map data &copy; <a href="https://www.arcgis.com/">ArcGIS</a>'
    });

    var peta9 = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: 'Map data &copy; <a href="https://www.google.com/maps">Google Maps</a>'
    });

    var peta10 = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: 'Map data &copy; <a href="https://www.google.com/maps">Google Maps</a>'
    });

    const map = L.map('map', {
        center: [<?= $sekolah['coordinat'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta4]
    });

    const baseLayers = {
        'Default': peta4,
        'Gmaps': peta2,
        'Satellite': peta3,
        'OSM-Mapbox': peta1,
        'OSM': peta5,
        'Dark OSM': peta6,
        'Carto OSM': peta7,
        'ArcGis': peta8,
        'Gmaps Marker': peta9,
        'Light Marker': peta10
    };
    const layerControl = L.control.layers(baseLayers).addTo(map);

    //     const map = L.map('map').setView([2.981055335454086, 99.62576202954708], 13);

    // const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    // }).addTo(map);

    var coordinat = document.querySelector("[name=coordinat]");
    var curLocation = [<?= $sekolah['coordinat'] ?>];
    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable: 'true',
    });
    map.addLayer(marker);

    // Mengambil Coordinat Saat Marker Di Geser
    marker.on('dragend', function(e) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            curLocation
        }).bindPopup(position).update();
        $("#Coordinat").val(position.lat + ',' + position.lng);
    });

    // Mengambil Coordinat Saat Di Klik
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }
        coordinat.value = lat + "," + lng;
    });
</script>