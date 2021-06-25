@extends('layouts.frontend')

@section('content')

<div id="map" style="width: 100%; height: 600px;"></div>

<div class="col-sm-12">
	<br>
	<br>
	<div class="text-center"><h2><b>Data Sekolah {{ $title }}</b></h2></div>
	<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th width="30px" class="text-center">No</th>
				<th class="text-center">Nama Sekolah </th>
				<th width="50px" class="text-center">Jenjang</th>
				<th class="text-center">Status</th>
				<th class="text-center">Coordinat</th>
			</tr>
		</thead>  
		<tbody>
			<?php $no=1; ?>
			@foreach ($sekolah as $data)
				<tr>
					<td class="text-center">{{ $no++ }}</td>
					<td>{{ $data->nama_sekolah }}</td>
					<td>{{ $data->jenjang}}</td>
					<td>{{ $data->status }}</td>
					<td>{{ $data->posisi}}</td>
				</tr>
			@endforeach
		</tbody>                  
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

	@foreach ($jenjang as $data )
		var jenjang{{ $data->id }} = L.layerGroup();
	@endforeach
	
	var data{{ $kec->id }} = L.layerGroup(); 
	

    var map = L.map('map', {
        center: [-7.6291257683708, 111.52702129193571],
        zoom: 16,
        layers: [peta1,data{{ $kec->id }},
		@foreach ($jenjang as $data )
			jenjang{{ $data->id }},
		@endforeach
		]
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satelite": peta2,
        "Streets": peta3,
        "Dark": peta4,
    };

	var overlayer = {
			"{{ $kec->kecamatan }}" : data{{ $kec->id }},
			@foreach ($jenjang as $data )
				"{{ $data->jenjang }}" : jenjang{{ $data->id }},
			@endforeach
	};

    L.control.layers(baseMaps, overlayer).addTo(map);

	

	var kec = L.geoJSON(<?= $kec->geojs ?>,{
			style : {
				color : 'white',
				fillColor : '{{ $kec->warna }}',
				fillOpacity : 1.0,
			},
		}).addTo(data{{ $kec->id }});
	map.fitBounds(kec.getBounds());
	
	@foreach ($sekolah as $data)
		var iconsekolah = L.icon({
			iconUrl : '{{ asset('icon') }}/{{ $data->icon }}',
			iconSize : [60, 60],
		});

		var informasi = '<table class="table table-bordered"><tr><td colspan="2"><img src="{{ asset('foto') }}/{{ $data->foto }}" width="250px"></th></tr><tbody><tr><td><span>Nama Sekolah</span></td><td>{{ $data->nama_sekolah }}</td></tr><tr><td>Jenjang</td><td>{{ $data->jenjang }}</td></tr><tr><td>Status</td><td>{{ $data->status }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailsekolah/{{ $data->id_sekolah }}" class="btn btn-sm btn-default">Detail</a></td></tr></tbody></table>';
		L.marker([<?= $data->posisi ?>], {icon : iconsekolah})
		.addTo(jenjang{{ $data->id_jenjang }})
		.bindPopup(informasi);
	@endforeach

</script>


<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>

@endsection


