<table>
<thead>
  <tr>
    <th>No</th>
    <th>ID Pel</th>
    <th>Nama Pelanggan</th>
    <th>Alamat</th>
    <th>Tarif</th>
    <th>Daya</th>
    <th>Nomor Meter</th>
    <th>Merk Meter</th>
    <th>Tipe Meter</th>
    <th>Nomor Modem</th>
    <th>Merk Modem</th>
    <th>Tipe Modem</th>
    <th>Provider GSM</th>
    <th>Nomor GSM</th>
    <th>Berkas</th>
    <th>Nomor Box</th>
    <th>Nomor Urut</th>
  </tr>
</thead>
<tbody>
@foreach ($data as $item)
  <tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$item->id_pelanggan}}</td>
    <td>{{$item->nama}}</td>
    <td>{{$item->alamat}}</td>
    <td>{{explode("/", $item->tarif_daya)[0]}}</td>
    <td>{{explode("/", $item->tarif_daya)[1]}}</td>
    <td>{{$item->nomor_meter}}</td>
    <td>{{$item->merk_meter}}</td>
    <td>{{$item->type_meter}}</td>
    <td>{{$item->nomor_modem}}</td>
    <td>{{$item->merk_modem}}</td>
    <td>{{$item->type_modem}}</td>
    <td>{{$item->provider}}</td>
    <td>{{$item->gsm}}</td>
    <td>{{$item->data_box}}</td>
    <td>{{$item->nomor_box}}</td>
    <td>{{$item->nomor_urut}}</td>
  </tr>
@endforeach
</tbody>
</table>