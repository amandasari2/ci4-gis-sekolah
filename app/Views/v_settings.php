<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '  <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>
            <?php echo form_open('Admin/UpdateSetting') ?>

            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label>Nama Website</label>
                        <input class="form-control" value="<?= $web['nama_web'] ?>" name="nama_web" placeholder="Masukkan Nama Website" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Coordinat Wilayah</label>
                        <input class="form-control" value="<?= $web['coordinat_wilayah'] ?>" name="coordinat_wilayah" placeholder="Masukkan Coordinat Wilayah" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Zoom View</label>
                        <input type="number" value="<?= $web['zoom_view'] ?>" name="zoom_view" min="1" max="20" class="form-control" placeholder="Zoom View" required>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Simpan</button>


            <?php echo form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<div class="col-md-12">
    <div id="map" style="width: 100%; height: 800px;"></div>
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
        center: [<?= $web['coordinat_wilayah'] ?>],
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
</script>