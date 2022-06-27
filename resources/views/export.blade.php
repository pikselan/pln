<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
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

@php
    $dataPelanggan = App\Pelanggan::find($data->pelanggan_id);
    $dataKegiatan = App\Kegiatan::find($data->kegiatan_id);
@endphp

<table>
   <tbody>
      <tr>
         <td colspan="2" style="text-align:center;font-weight:bold;font-size: 16px;">
              Data Kegiatan Perbaikan dan Pemeliharaan AMR
          </td>
      </tr>
      <tr>
         <td colspan="2">
            <hr>
         </td>
      </tr>
      <tr>
         <td style="width:50%;max-widht:50%;">
            <table>
               <tbody>
                  <tr>
                     <td style="font-weight: bold;">ID Pelanggan</td>
                     <td>{{$dataPelanggan->id_pelanggan}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Nama</td>
                     <td>{{$dataPelanggan->nama}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Alamat</td>
                     <td>{{$dataPelanggan->alamat}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Tarif / Daya</td>
                     <td>{{$dataPelanggan->tarif_daya}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Merk & No Meter</td>
                     <td>{{$dataPelanggan->merk_meter}} / {{$dataPelanggan->type_meter}} / {{$dataPelanggan->nomor_meter}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Merk & No Modem</td>
                     <td>{{$dataPelanggan->merk_modem}} / {{$dataPelanggan->type_modem}} / {{$dataPelanggan->nomor_modem}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Nomor GSM</td>
                     <td>{{$dataPelanggan->provider}} / {{$dataPelanggan->gsm}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Kegiatan</td>
                     <td>{{$dataKegiatan->jenis}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Data Kegiatan</td>
                     <td>{{$data->data_sesudah}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Koordinat</td>
                     <td>{{$data->koordinat}}</td>
                  </tr>
               </tbody>
            </table>
         </td>
         <td style="width:50%;max-widht:50%;">
            <table>
               <tbody>
                  <tr>
                     <td style="font-weight: bold;">No BA</td>
                     <td>{{$data->no_ba}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Kondisi Box</td>
                     <td>{{$data->kondisi_box}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Kondisi Meter</td>
                     <td>{{$data->kondisi_meter}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Shuntrip</td>
                     <td>{{$data->shuntrip}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Pembatas</td>
                     <td>{{$data->pembatas}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Merek Pembatas</td>
                     <td>{{$data->merek_pembatas}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Arus Pembatas</td>
                     <td>{{$data->arus_pembatas}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Ratio CT</td>
                     <td>{{$data->ratio_ct}}</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
      <tr>
         <td colspan="2">
            <hr>
         </td>
      </tr>
      <tr>
         <td>
            <table>
               <tbody>
                  <tr>
                     <td colspan="3" style="text-align:center;font-weight:bold;font-size: 14px;">Stand Kwh Meter</td>
                  </tr>
                  <tr>
                     <td style="text-align:center;font-weight: bold;">Wbp</td>
                     <td style="text-align:center;font-weight: bold;">Lwbp 1</td>
                     <td style="text-align:center;font-weight: bold;">Lwbp 2</td>
                  </tr>
                  <tr>
                     <td style="text-align:center;">{{$data->wbp}} Kwh</td>
                     <td style="text-align:center;">{{$data->lwbp1}} Kwh</td>
                     <td style="text-align:center;">{{$data->lwbp2}} Kwh</td>
                  </tr>
                  <tr>
                     <td style="text-align:center;font-weight: bold;">Total</td>
                     <td style="text-align:center;font-weight: bold;">Kvarh</td>
                     <td style="text-align:center;"></td>
                  </tr>
                  <tr>
                     <td style="text-align:center;">{{$data->total}} Kwh</td>
                     <td style="text-align:center;">{{$data->kvarh}} Kwh</td>
                     <td style="text-align:center;"></td>
                  </tr>
               </tbody>
            </table>
         </td>
         <td>
            <table>
               <tbody>
                  <tr>
                     <td colspan="4" style="text-align:center;font-weight:bold;font-size: 14px;">Hasil Pengukuran</td>
                  </tr>
                  <tr>
                     <td style="width: 30%;"></td>
                     <td style="text-align:center;font-weight: bold">R</td>
                     <td style="text-align:center;font-weight: bold">S</td>
                     <td style="text-align:center;font-weight: bold">T</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Tegangan</td>
                     <td style="text-align:center;">{{$data->tegangan_r}} V</td>
                     <td style="text-align:center;">{{$data->tegangan_s}} V</td>
                     <td style="text-align:center;">{{$data->tegangan_t}} V</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Arus</td>
                     <td style="text-align:center;">{{$data->arus_r}} A</td>
                     <td style="text-align:center;">{{$data->arus_s}} A</td>
                     <td style="text-align:center;">{{$data->arus_t}} A</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
      <tr>
         <td colspan="2">
            <hr>
         </td>
      </tr>
      <tr>
         <td>
            <table>
               <tbody>
                  <tr>
                     <td colspan="2" style="text-align:center;font-weight:bold;font-size: 14px;">Nomor Segel</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Pintu Luar Atas</td>
                     <td>{{$data->pintu_luar_atas}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Pintu Luar Bawah</td>
                     <td>{{$data->pintu_luar_bawah}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Terminal Kwh</td>
                     <td>{{$data->terminal_kwh}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Modem</td>
                     <td>{{$data->modem}}</td>
                  </tr>
               </tbody>
            </table>
         </td>
         <td>
            <table>
               <tbody>
                  <tr>
                     <td colspan="2" style="text-align:center;font-weight:bold;font-size: 14px;">Rincian</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Peruntukan</td>
                     <td>{{$data->peruntukan}}</td>
                  </tr>
                  <tr>
                     <td style="font-weight: bold;">Kesimpulan</td>
                     <td>{{$data->kesimpulan}}</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
      <tr>
         <td colspan="2">
            <hr>
         </td>
      </tr>
      <tr>
         <td colspan="2">
            <table>
               <tbody>
                  <tr>
                     <td style="text-align:center;font-weight: bold;width:20%;max-widht:20%;">Foto KWH Meter</td>
                     <td style="text-align:center;font-weight: bold;width:20%;max-widht:20%;">Foto MCCB/MCB</td>
                     <td style="text-align:center;font-weight: bold;width:20%;max-widht:20%;">Foto Box App</td>
                     <td style="text-align:center;font-weight: bold;width:20%;max-widht:20%;">Foto BA</td>
                     <td style="text-align:center;font-weight: bold;width:20%;max-widht:20%;">Foto Bangunan</td>
                  </tr>
                  <tr>
                     <td><img style="width:100%;" src="\storage\{{$data->foto_kwh}}" onerror="this.onerror=null; this.src='/blank.png'"></td>
                     <td><img style="width:100%;" src="\storage\{{$data->foto_mcb}}" onerror="this.onerror=null; this.src='/blank.png'"></td>
                     <td><img style="width:100%;" src="\storage\{{$data->foto_box_app}}" onerror="this.onerror=null; this.src='/blank.png'"></td>
                     <td><img style="width:100%;" src="\storage\{{$data->foto_modem}}" onerror="this.onerror=null; this.src='/blank.png'"></td>
                     <td><img style="width:100%;" src="\storage\{{$data->foto_ba}}" onerror="this.onerror=null; this.src='/blank.png'"></td>
                  </tr>
                  <tr>
                     <td style="text-align:center;font-weight: bold;">Foto 1</td>
                     <td style="text-align:center;font-weight: bold;">Foto 2</td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td><img style="width:100%;" src="\storage\{{$data->foto_1}}" onerror="this.onerror=null; this.src='/blank.png'"></td>
                     <td><img style="width:100%;" src="\storage\{{$data->foto_2}}" onerror="this.onerror=null; this.src='/blank.png'"></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>