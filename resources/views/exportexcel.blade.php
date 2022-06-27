<table>
	<thead>
		<tr>
			<th colspan="8">Data Kegiatan Perbaikan dan Pemeliharaan AMR</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="2">ID Pelanggan</td>
			<td colspan="2">{{$data->pelanggan->id_pelanggan}}</td>
			<td colspan="2">No BA</td>
			<td colspan="2">{{$data->no_ba}}</td>
		</tr>
		<tr>
			<td colspan="2">Nama</td>
			<td colspan="2">{{$data->pelanggan->nama}}</td>
			<td colspan="2">Kondisi Box</td>
			<td colspan="2">
				@switch($data->kondisi_box)
						@case('baik')
								Baik
								@break
						@case('rusak')
								Rusak Karatan
								@break
						@case('terbakar')
								Terbakar
								@break
						@default
								-
				@endswitch			
			</td>
		</tr>
		<tr>
			<td colspan="2">Alamat</td>
			<td colspan="2">{{$data->pelanggan->alamat}}</td>
			<td colspan="2">Kondisi Meter</td>
			<td colspan="2">
				@switch($data->kondisi_meter)
						@case('baik')
								Baik
								@break
						@case('lcd_buram')
								LCD Buram
								@break
						@case('terbakar')
								Terbakar
								@break
						@case('blank')
								Blank
								@break
						@default
								-
				@endswitch	
			</td>
		</tr>
		<tr>
			<td colspan="2">Tarif / Daya</td>
			<td colspan="2">{{$data->pelanggan->tarif_daya}}</td>
			<td colspan="2">Shuntrip</td>
			<td colspan="2">
				@switch($data->shuntrip)
						@case('terpasang')
								Terpasang
								@break
						@case('tidak_terpasang')
								Tidak Terpasang
								@break
						@default
								-
				@endswitch	
			</td>
		</tr>
    <tr>
      <td colspan="2">Merk dan No Meter</td>
      <td colspan="2">{{$data->pelanggan->merk_meter." / ".$data->pelanggan->type_meter." / ".$data->pelanggan->nomor_meter}}</td>
      <td colspan="2">Pembatas</td>
      <td colspan="2">
				@switch($data->pembatas)
						@case('mccb')
								MCCB
								@break
						@case('mcb')
								MCB
								@break
						@case('nh_fuse')
								NH Fuse
								@break
						@default
								-
				@endswitch
			</td>
    </tr>
    <tr>
      <td colspan="2">Merk dan No Modem</td>
      <td colspan="2">{{$data->pelanggan->merk_modem." / ".$data->pelanggan->type_modem." / ".$data->pelanggan->nomor_modem}}</td>
      <td colspan="2">Merek Pembatas</td>
      <td colspan="2">{{$data->merek_pembatas}}</td>
    </tr>
		<tr>
			<td colspan="2">Nomor GSM</td>
			<td colspan="2">{{$data->pelanggan->provider." / ".$data->pelanggan->gsm}}</td>
			<td colspan="2">Arus Pembatas</td>
			<td colspan="2">{{$data->arus_pembatas}}</td>
		</tr>
		<tr>
			<td colspan="2">Kegiatan</td>
			<td colspan="2">{{$data->kegiatan->jenis}}</td>
			<td colspan="2">Ratio CT</td>
			<td colspan="2">{{$data->ratio_ct}}</td>
		</tr>
		<tr>
			<td colspan="2">Data Kegiatan</td>
			<td colspan="2">{{$data->data_sesudah}}</td>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td colspan="2">Koordinat</td>
			<td colspan="2">{{$data->koordinat}}</td>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="3">Stand Kwh Meter</td>
			<td></td>
			<td colspan="4">Hasil Pengukuran</td>
		</tr>
		<tr>
			<td>Wbp</td>
			<td>Lwbp 1</td>
			<td>Lwbp 2</td>
			<td></td>
			<td></td>
			<td>R</td>
			<td>S</td>
			<td>T</td>
		</tr>
		<tr>
			<td>{{$data->wbp}} Kwh</td>
			<td>{{$data->lwbp1}} Kwh</td>
			<td>{{$data->lwbp2}} Kwh</td>
			<td></td>
			<td>Tegangan</td>
			<td>{{$data->tegangan_r}} V</td>
			<td>{{$data->tegangan_s}} V</td>
			<td>{{$data->tegangan_t}} V</td>
		</tr>
		<tr>
			<td>Total</td>
			<td>Kvarh</td>
			<td></td>
			<td></td>
			<td>Arus</td>
			<td>{{$data->arus_r}} A</td>
			<td>{{$data->arus_s}} A</td>
			<td>{{$data->arus_t}} A</td>
		</tr>
		<tr>
			<td>{{$data->total}} Kwh</td>
			<td>{{$data->kvarh}} Kwh</td>
			<td colspan="6"></td>
		</tr>
		<tr>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="4">Nomor Segel</td>
			<td colspan="4">Rincian</td>
		</tr>
		<tr>
			<td colspan="2">Pintu Luar Atas</td>
			<td colspan="2">{{$data->pintu_luar_atas}}</td>
			<td colspan="2">Petugas</td>
			<td colspan="2">{{$data->user->name}}</td>
		</tr>
		<tr>
			<td colspan="2">Pintu Luar Bawah</td>
			<td colspan="2">{{$data->pintu_luar_bawah}}</td>
			<td colspan="2">Dibuat</td>
			<td colspan="2">{{$data->created_at}}</td>
		</tr>
		<tr>
			<td colspan="2">Terminal Kwh</td>
			<td colspan="2">{{$data->terminal_kwh}}</td>
			<td colspan="2">Peruntukan</td>
			<td colspan="2">{{$data->peruntukan}}</td>
		</tr>
		<tr>
			<td colspan="2">Modem</td>
			<td colspan="2">{{$data->modem}}</td>
			<td colspan="2">Kesimpulan</td>
			<td colspan="2">{{$data->kesimpulan}}</td>
		</tr>
		<tr>
			<td colspan="8"></td>
		</tr>
		<tr>
			<td colspan="2">Foto KWH Meter</td>
			<td colspan="2">Foto MCCB/MCB</td>
			<td colspan="2">Foto Box App</td>
			<td colspan="2">Foto Modem</td>
		</tr>
		<tr>
			<td colspan="2">@php if($data->foto_kwh) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_kwh)}}"> @php } @endphp</td>
			<td colspan="2">@php if($data->foto_mcb) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_mcb)}}"> @php } @endphp</td>
			<td colspan="2">@php if($data->foto_box_app) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_box_app)}}"> @php } @endphp</td>
			<td colspan="2">@php if($data->foto_modem) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_modem)}}"> @php } @endphp</td>
		</tr>
		<tr>
			<td colspan="2">Foto BA</td>
			<td colspan="2">Foto Bangunan</td>
			<td colspan="2">Foto 1</td>
			<td colspan="2">Foto 2</td>
		</tr>
		<tr>
			<td colspan="2">@php if($data->foto_ba) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_ba)}}"> @php } @endphp</td>
			<td colspan="2">@php if($data->foto_bangunan) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_bangunan)}}"> @php } @endphp</td>
			<td colspan="2">@php if($data->foto_1) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_1)}}"> @php } @endphp</td>
			<td colspan="2">@php if($data->foto_2) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_2)}}"> @php } @endphp</td>
		</tr>
	</tbody>
</table>