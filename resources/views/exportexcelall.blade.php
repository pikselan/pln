<table>
<thead>
  <tr>
    <th>No</th>
    <th>No BA</th>
    <th>Jenis Kegiatan</th>
    <th>ID Pel</th>
    <th>Tarif</th>
    <th>Daya</th>
    <th>Nama Pelanggan</th>
    <th>Alamat</th>
    <th>Merk Meter</th>
    <th>Tipe Meter</th>
    <th>Nomor Meter</th>
    <th>Merk Modem</th>
    <th>Tipe Modem</th>
    <th>Nomor Modem</th>
    <th>Provider GSM</th>
    <th>Nomor GSM</th>
    <th>Lokasi</th>
    <th>Telepon Pelanggan</th>
    <th>Berkas</th>
    <th>Nomor Box</th>
    <th>Nomor Urut</th>
    <th>Segel Lama</th>
    <th>Segel Baru</th>
    <th>Nomor Modem Baru</th>
    <th>Merk Modem Baru</th>
    <th>Tipe Modem Baru</th>
    <th>Provider GSM Baru</th>
    <th>Nomor GSM Baru</th>
    <th>Kondisi Box</th>
    <th>Kondisi Meter</th>
    <th>Shuntrip</th>
    <th>Pembatas</th>
    <th>Merek Pembatas</th>
    <th>Arus Pembatas</th>
    <th>Ratio CT</th>
    <th>Cosphi</th>
    <th>Arus R</th>
    <th>Arus S</th>
    <th>Arus T</th>
    <th>Tegangan R</th>
    <th>Tegangan S</th>
    <th>Tegangan T</th>
    <th>WBP</th>
    <th>LWBP1</th>
    <th>LWBP2</th>
    <th>Total</th>
    <th>kVarh</th>
    <th>Pintu Luar Atas</th>
    <th>Pintu Luar Bawah</th>
    <th>Terminal kWh</th>
    <th>Modem</th>
    <th>Peruntukan</th>
    <th>Kesimpulan</th>
    <th>Tanggal</th>
    <th>Petugas</th>
  </tr>
</thead>
<tbody>
@foreach ($data as $item)
  <tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$item->no_ba}}</td>
    <td>{{$item->kegiatan->jenis}}</td>
    
    <!-- @if(!empty($item->pelanggan->id_pelanggan))
        <td>{{$item->pelanggan->id_pelanggan}}</td>
        <td>{{$item->pelanggan->tarif_daya}}</td>
        <td>{{$item->pelanggan->nama}}</td>
        <td>{{$item->pelanggan->alamat}}</td>
        <td>{{$item->pelanggan->merk_meter}}</td>
        <td>{{$item->pelanggan->type_meter}}</td>
        <td>{{$item->pelanggan->nomor_meter}}</td>
        <td>{{$item->pelanggan->merk_modem}}</td>
        <td>{{$item->pelanggan->type_modem}}</td>
        <td>{{$item->pelanggan->nomor_modem}}</td>
        <td>{{$item->pelanggan->provider}}</td>
        <td>{{$item->pelanggan->gsm}}</td>
    @else
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    @endif -->

    @if(!empty($item->id_pelanggan))
        <td>{{$item->id_pelanggan}}</td>
        <td>{{explode("/", $item->tarif_daya)[0]}}</td>
        <td>{{explode("/", $item->tarif_daya)[1]}}</td>
        <td>{{$item->nama}}</td>
        <td>{{$item->alamat}}</td>
        <td>{{$item->merk_meter}}</td>
        <td>{{$item->type_meter}}</td>
        <td>{{$item->nomor_meter}}</td>
        <td>{{$item->merk_modem}}</td>
        <td>{{$item->type_modem}}</td>
        <td>{{$item->nomor_modem}}</td>
        <td>{{$item->provider}}</td>
        <td>{{$item->gsm}}</td>
    @else
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    @endif
    
    <td>{{$item->koordinat}}</td>
    <td>{{$item->telepon_pelanggan}}</td>
    <td>{{$item->data_box}}</td>
    <td>{{$item->nomor_box}}</td>
    <td>{{$item->nomor_urut}}</td>
    <td>{{$item->segel_lama}}</td>
    <td>{{$item->segel_baru}}</td>
    <td>{{$item->nomor_modem_baru}}</td>
    <td>{{$item->merk_modem_baru}}</td>
    <td>{{$item->type_modem_baru}}</td>
    <td>{{$item->provider_baru}}</td>
    <td>{{$item->gsm_baru}}</td>
    <td>
				@switch($item->kondisi_box)
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
    <td>
				@switch($item->kondisi_meter)
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
    <td>
				@switch($item->shuntrip)
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
    <td>
				@switch($item->pembatas)
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
    <td>{{$item->merek_pembatas}}</td>
    <td>{{$item->arus_pembatas}}</td>
    <td>{{$item->ratio_ct}}</td>
    <td>{{$item->cosphi}}</td>
    <td>{{$item->arus_r}}</td>
    <td>{{$item->arus_s}}</td>
    <td>{{$item->arus_t}}</td>
    <td>{{$item->tegangan_r}}</td>
    <td>{{$item->tegangan_s}}</td>
    <td>{{$item->tegangan_t}}</td>
    <td>{{$item->wbp}}</td>
    <td>{{$item->lwbp1}}</td>
    <td>{{$item->lwbp2}}</td>
    <td>{{$item->total}}</td>
    <td>{{$item->kvarh}}</td>
    <td>{{$item->pintu_luar_atas}}</td>
    <td>{{$item->pintu_luar_bawah}}</td>
    <td>{{$item->terminal_kwh}}</td>
    <td>{{$item->modem}}</td>
    <td>{{$item->peruntukan}}</td>
    <td>{{$item->kesimpulan}}</td>
    <td>{{$item->created_at}}</td>
    <td>{{$item->user->name}}</td>
  </tr>
@endforeach
</tbody>
</table>