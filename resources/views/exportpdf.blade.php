<style>
   table {
    font-family: Open Sans,sans-serif;
    font-size:12px;
    display: table;
    width: 100%;
    max-width: 100%;
    background-color: transparent;
    border-collapse: collapse;
    border-spacing: 0;
    border-color: grey;
   }
   tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
   }
   tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
   }
   td {
    padding: 3px;
    /* line-height: 1.42857143; */
    vertical-align: top;
    /* border-top: 1px solid #ddd; */
   }
</style>

<table>
<tbody>
  <tr>
    <td colspan="8" style="text-align:center;font-weight:bold;font-size: 16px;">Data Kegiatan Perbaikan dan Pemeliharaan AMR</td>
  </tr>
  <tr>
    <td colspan="8"><hr></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">ID Pelanggan</td>
    <td colspan="2">{{$data->id_pelanggan}}</td>
    <td colspan="2" style="font-weight: bold;">No BA</td>
    <td colspan="2">{{$data->no_ba}}</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Nama</td>
    <td colspan="2">{{$data->nama}}</td>
    <td colspan="2" style="font-weight: bold;">Data Kegiatan</td>
    <td colspan="2">{{$data->data_sesudah}}</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Alamat</td>
    <td colspan="2">{{$data->alamat}}</td>
    <td colspan="2" style="font-weight: bold;">Koordinat</td>
    <td colspan="2">{{$data->koordinat}}</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Tarif / Daya</td>
    <td colspan="2">{{$data->tarif_daya}}</td>
    <td colspan="2" style="font-weight: bold;">Kondisi Box</td>
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
    <td colspan="2" style="font-weight: bold;">Merk dan No Meter</td>
    <td colspan="2">{{$data->merk_meter." / ".$data->type_meter." / ".$data->nomor_meter}}</td>
    <td colspan="2" style="font-weight: bold;">Kondisi Meter</td>
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
    <td colspan="2" style="font-weight: bold;">Merk dan No Modem</td>
    <td colspan="2">{{$data->merk_modem." / ".$data->type_modem." / ".$data->nomor_modem}}</td>
    <td colspan="2" style="font-weight: bold;">Shuntrip</td>
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
    <td colspan="2" style="font-weight: bold;">Nomor GSM</td>
    <td colspan="2">{{$data->provider}} / {{$data->gsm}}</td>
    <td colspan="2" style="font-weight: bold;">Pembatas</td>
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
    <td colspan="2" style="font-weight: bold;">Kegiatan</td>
    <td colspan="2">{{$data->kegiatan->jenis}}</td>
    <td colspan="2" style="font-weight: bold;">Merek Pembatas</td>
    <td colspan="2">{{$data->merek_pembatas}}</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Merk dan No Modem Terbaru</td>
    <td colspan="2">{{$data->merk_modem_baru." / ".$data->type_modem_baru." / ".$data->nomor_modem_baru}}</td>
    <td colspan="2" style="font-weight: bold;">Arus Pembatas</td>
    <td colspan="2">{{$data->arus_pembatas}}</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Nomor GSM Terbaru</td>
    <td colspan="2">{{$data->provider_baru}} / {{$data->gsm_baru}}</td>
    <td colspan="2" style="font-weight: bold;">Ratio CT</td>
    <td colspan="2">{{$data->ratio_ct}}</td>
  </tr>
  <tr>
    <td colspan="8"><hr></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center;font-weight:bold;font-size: 14px;">Stand Kwh Meter</td>
    <td></td>
    <td colspan="4" style="text-align:center;font-weight:bold;font-size: 14px;">Hasil Pengukuran</td>
  </tr>
  <tr>
    <td style="text-align:center;font-weight: bold;width:12.5%;max-width:12.5%;">Wbp</td>
    <td style="text-align:center;font-weight: bold;width:12.5%;max-width:12.5%;">Lwbp 1</td>
    <td style="text-align:center;font-weight: bold;width:12.5%;max-width:12.5%;">Lwbp 2</td>
    <td style="width:12.5%;max-width:12.5%;"></td>
    <td style="width:12.5%;max-width:12.5%;"></td>
    <td style="text-align:center;font-weight: bold;width:12.5%;max-width:12.5%;">R</td>
    <td style="text-align:center;font-weight: bold;width:12.5%;max-width:12.5%;">S</td>
    <td style="text-align:center;font-weight: bold;width:12.5%;max-width:12.5%;">T</td>
  </tr>
  <tr>
    <td style="text-align:center;">{{$data->wbp}} Kwh</td>
    <td style="text-align:center;">{{$data->lwbp1}} Kwh</td>
    <td style="text-align:center;">{{$data->lwbp2}} Kwh</td>
    <td></td>
    <td style="font-weight: bold;">Tegangan</td>
    <td style="text-align:center;">{{$data->tegangan_r}} V</td>
    <td style="text-align:center;">{{$data->tegangan_s}} V</td>
    <td style="text-align:center;">{{$data->tegangan_t}} V</td>
  </tr>
  <tr>
    <td style="text-align:center;font-weight: bold;">Total</td>
    <td style="text-align:center;font-weight: bold;">Kvarh</td>
    <td></td>
    <td></td>
    <td style="font-weight: bold;">Arus</td>
    <td style="text-align:center;">{{$data->arus_r}} A</td>
    <td style="text-align:center;">{{$data->arus_s}} A</td>
    <td style="text-align:center;">{{$data->arus_t}} A</td>
  </tr>
  <tr>
    <td style="text-align:center;">{{$data->total}} Kwh</td>
    <td style="text-align:center;">{{$data->kvarh}} Kwh</td>
    <td colspan="6"></td>
  </tr>
  <tr>
    <td colspan="8"><hr></td>
  </tr>
  <tr>
    <td colspan="4" style="text-align:center;font-weight:bold;font-size: 14px;">Nomor Segel</td>
    <td colspan="4" style="text-align:center;font-weight:bold;font-size: 14px;">Rincian</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Pintu Luar Atas</td>
    <td colspan="2">{{$data->pintu_luar_atas}}</td>
    <td colspan="2" style="font-weight: bold;">Peruntukan</td>
    <td colspan="2">{{$data->peruntukan}}</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Pintu Luar Bawah</td>
    <td colspan="2">{{$data->pintu_luar_bawah}}</td>
    <td colspan="2" style="font-weight: bold;">Kesimpulan</td>
    <td colspan="2">{{$data->kesimpulan}}</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Terminal Kwh</td>
    <td colspan="2">{{$data->terminal_kwh}}</td>
    <td colspan="2" style="font-weight: bold;">Dibuat</td>
    <td colspan="2">{{$data->created_at}}</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight: bold;">Modem</td>
    <td colspan="2">{{$data->modem}}</td>
    <td colspan="2" style="font-weight: bold;">Petugas</td>
    <td colspan="2">{{$data->user->name}}</td>
  </tr>
  <tr>
    <td colspan="8"><hr></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center;font-weight: bold;">Foto KWH Meter</td>
    <td colspan="2" style="text-align:center;font-weight: bold;">Foto MCCB/MCB</td>
    <td colspan="2" style="text-align:center;font-weight: bold;">Foto Box App</td>
    <td colspan="2" style="text-align:center;font-weight: bold;">Foto Modem</td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center;">@php if($data->foto_kwh) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_kwh)}}"> @php } @endphp</td>
    <td colspan="2" style="text-align:center;">@php if($data->foto_mcb) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_mcb)}}"> @php } @endphp</td>
    <td colspan="2" style="text-align:center;">@php if($data->foto_box_app) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_box_app)}}"> @php } @endphp</td>
    <td colspan="2" style="text-align:center;">@php if($data->foto_modem) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_modem)}}"> @php } @endphp</td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center;font-weight: bold;">Foto BA</td>
    <td colspan="2" style="text-align:center;font-weight: bold;">Foto Bangunan</td>
    <td colspan="2" style="text-align:center;font-weight: bold;">Foto 1</td>
    <td colspan="2" style="text-align:center;font-weight: bold;">Foto 2</td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center;">@php if($data->foto_ba) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_ba)}}"> @php } @endphp</td>
    <td colspan="2" style="text-align:center;">@php if($data->foto_bangunan) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_bangunan)}}"> @php } @endphp</td>
    <td colspan="2" style="text-align:center;">@php if($data->foto_1) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_1)}}"> @php } @endphp</td>
    <td colspan="2" style="text-align:center;">@php if($data->foto_2) { @endphp<img style="width:100px;" src="{{Storage::disk('public')->path($data->foto_2)}}"> @php } @endphp</td>
  </tr>
</tbody>
</table>