@extends('layouts.frontend')

@section('judul1')
    {{$title ?? ''}}
@endsection

@section('judul2')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0"> {{$title ?? ''}}</h1>
        </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
    
@endsection

@section('content')

<div class="col-sm-6">
    <div id="map" style="width: 100%; height: 400px;"></div>
</div>
<div class="col-sm-6">
    <img src="{{ asset('foto') }}/{{ $sekolah->foto }}" width="100%" height="400px">
</div>

<div class="col-sm-12">
<br>
<br>
    <table class="table table-bordered table-striped">
        <tr>
            <td>Nama Sekolah</td>
            <td>:</td>
            <td>{{ $sekolah->nama_sekolah }}</td>
        </tr>
        <tr>
            <td>Jenjang</td>
            <td>:</td>
            <td>{{ $sekolah->jenjang }}</td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td>{{ $sekolah->kecamatan }}</td>
        </tr>
        <tr>
            <td>Alamat Sekolah</td>
            <td>:</td>
            <td>{{ $sekolah->alamat }}</td>
        </tr>
    </table>
</div>

<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    });

    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/satellite-v9'
    });


    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/dark-v10'
    }); 

    var map = L.map('map', {
        center: [{{$sekolah->posisi}}],
        zoom: 14,
        layers: [peta2],
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satelite": peta2,
        "Streets": peta3,
        "Dark": peta4,
    };

    L.control.layers(baseMaps).addTo(map);

    var iconsekolah = L.icon({
			iconUrl : '{{ asset('icon') }}/{{ $sekolah->icon }}',
			iconSize : [60, 60],
		});
	    L.marker([<?= $sekolah->posisi ?>], {icon : iconsekolah})
		.addTo(map);
</script>


@endsection
