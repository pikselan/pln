@extends('voyager::master')

@section('page_title', 'Pengelolaan Data Box')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-book"></i> Pengelolaan Data Box
        </h1>
    
        {{-- notifikasi session --}}
        @if ($sukses = Session::get('sukses'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $sukses }}</strong>
        </div>
        @elseif ($sukses = Session::get('mencari'))
        <div class="alert alert-{{$result ?? 'default'}} alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $sukses }}</strong>
        </div>
        @endif
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                      <div class="col-md-12">
                        <form method="post" action="" enctype="multipart/form-data" class="form-inline">
                          {{ csrf_field() }}
                          <input type="text" class="form-control hidden" name="inpMode" id="inpMode" value="search">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="voyager-search"></i></div>
                              <input type="number" class="form-control" name="inpSearch" id="inpSearch" placeholder="Ketik ID Pelanggan" value="{{ $keyword ?? '' }}">
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                      </div>
                      <div class="col-md-6" style="margin-top:20px;">
                        <h4>Menampilkan Data Box</h4>
                        <form method="post" action="" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="text" class="form-control hidden" name="inpMode" id="inpMode" value="databox">
                          <input type="text" class="form-control hidden" name="inpId" id="inpId" value="{{ $data->id ?? '' }}">
                          <div class="form-group">
                            <label for="inpIdPelanggan">ID PELANGGAN</label>
                            <input type="text" class="form-control" name="inpIdPelanggan" id="inpIdPelanggan" value="{{ $data->id_pelanggan ?? '' }}" placeholder="Kosong" readonly>
                          </div>
                          <div class="form-group">
                            <label for="inpNama">NAMA</label>
                            <input type="text" class="form-control" name="inpNama" id="inpNama" value="{{ $data->nama ?? '' }}" placeholder="Kosong" readonly>
                          </div>
                          <div class="form-group">
                            <label for="inpAlamat">ALAMAT</label>
                            <input type="text" class="form-control" name="inpAlamat" id="inpAlamat" value="{{ $data->alamat ?? '' }}" placeholder="Kosong" readonly>
                          </div>
                          <div class="form-group">
                            <label for="inpTarifDaya">TARIF DAYA</label>
                            <input type="text" class="form-control" name="inpTarifDaya" id="inpTarifDaya" value="{{ $data->tarif_daya ?? '' }}" placeholder="Kosong" readonly>
                          </div>
                          <div class="form-group">
                            <label for="inpNomorBox">NOMOR BOX</label>
                            <input type="text" class="form-control" name="inpNomorBox" id="inpNomorBox" value="{{ $data->nomor_box ?? '' }}" placeholder="Isikan Nomor Box">
                          </div>
                          <div class="form-group">
                            <label for="inpNomorUrut">NOMOR URUT</label>
                            <input type="text" class="form-control" name="inpNomorUrut" id="inpNomorUrut" value="{{ $data->nomor_urut ?? '' }}" placeholder="Isikan Nomor Urut">
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script>

    </script>
@stop
