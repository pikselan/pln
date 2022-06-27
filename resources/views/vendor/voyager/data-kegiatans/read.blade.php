@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                {{ __('voyager::generic.edit') }}
            </a>
        @endcan
        @can('browse', $dataTypeContent)
        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
        @endcan

        <!--<a href="{{url()->current()}}/excel" class="btn btn-success">-->
        <!--    <span class="voyager-file-text"></span>&nbsp;-->
        <!--    Excel-->
        <!--</a>-->

        <a href="{{url()->current()}}/pdf" class="btn btn-success">
            <span class="voyager-file-text"></span>&nbsp;
            PDF
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding:5px 0;">
                    <div class="container" style="padding-bottom:20px">
                        <h3 class="text-center">Data Kegiatan Perbaikan dan Pemeliharaan AMR</h3>
                    </div>
                    <!-- form start -->
                    <div class="container">
                        <hr style="border:3px solid #eee;">
                        <div class="row">
                            <div class="col-sm-6" style="margin-bottom:5px">
                                <table class="table">
                                    <tbody>
                                        @foreach($dataType->readRows as $row)
                                            @php
                                            if ($dataTypeContent->{$row->field.'_read'}) {
                                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                            }
                                            @endphp
                                                @if(in_array($row->field, array('data_kegiatan_belongsto_pelanggan_relationship')))
                                                    <tr>
                                                        <td><b>{{ $row->getTranslatedAttribute('display_name') }}</b></td>
                                                        <td>
                                                            @if (isset($row->details->view))
                                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                            @elseif($row->type == 'relationship')
                                                                @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-read')
                                                                <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                        @endforeach
                                        
                                        <tr>
                                            <td><b>Nama</b></td>
                                            <td>{{$dataTypeContent->nama}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td>{{$dataTypeContent->alamat}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Tarif / Daya</b></td>
                                            <td>{{$dataTypeContent->tarif_daya}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Merk dan No Meter</b></td>
                                            <td>{{$dataTypeContent->merk_meter}} / {{$dataTypeContent->type_meter}} / {{$dataTypeContent->nomor_meter}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Merk dan No Modem</b></td>
                                            <td>{{$dataTypeContent->merk_modem}} / {{$dataTypeContent->type_modem}} / {{$dataTypeContent->nomor_modem}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Berkas / Nomor Box / Nomor Urut</b></td>
                                            <td>{{$dataTypeContent->data_box}} / {{$dataTypeContent->nomor_box}} / {{$dataTypeContent->nomor_urut}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nomor GSM</b></td>
                                            <td>{{$dataTypeContent->provider}} / {{$dataTypeContent->gsm}}</td>
                                        </tr>

                                        @foreach($dataType->readRows as $row)
                                            @php
                                            if ($dataTypeContent->{$row->field.'_read'}) {
                                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                            }
                                            @endphp
                                                @if(in_array($row->field, array('data_kegiatan_belongsto_kegiatan_relationship')))
                                                    <tr>
                                                        <td><b>{{ $row->getTranslatedAttribute('display_name') }}</b></td>
                                                        <td>
                                                            @if (isset($row->details->view))
                                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                            @elseif($row->type == 'relationship')
                                                                @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-read')
                                                                <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                        @endforeach
                                        
                                        <tr>
                                            <td><b>Merk dan No Modem Terbaru</b></td>
                                            <td>{{$dataTypeContent->merk_modem_baru}} / {{$dataTypeContent->type_modem_baru}} / {{$dataTypeContent->nomor_modem_baru}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nomor GSM Terbaru</b></td>
                                            <td>{{$dataTypeContent->provider_baru}} / {{$dataTypeContent->gsm_baru}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6" style="margin-bottom:5px">
                                <table class="table">
                                    <tbody>
                                        @foreach($dataType->readRows as $row)
                                            @php
                                            if ($dataTypeContent->{$row->field.'_read'}) {
                                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                            }
                                            @endphp
                                                @if(in_array($row->field, array('no_ba','kondisi_box','kondisi_meter','shuntrip','pembatas','merek_pembatas','arus_pembatas','ratio_ct','cosphi_display','data_sesudah','koordinat')))
                                                    <tr>
                                                        <td><b>{{ $row->getTranslatedAttribute('display_name') }}</b></td>
                                                        <td>
                                                            @if (isset($row->details->view))
                                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                            @elseif($row->type == 'relationship')
                                                                @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-read')
                                                                <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr style="border:3px solid #eee;">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="container">
                                    <div class="row text-center"><h4>Stand Kwh Meter</h4></div>
                                    <div class="row">
                                        @foreach($dataType->readRows as $row)
                                            @php
                                            if ($dataTypeContent->{$row->field.'_read'}) {
                                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                            }
                                            @endphp
                                                @if(in_array($row->field, array('wbp','lwbp1','lwbp2','total','kvarh')))
                                                    <div class="col-sm-4" style="margin-bottom:5px">
                                                        <span><b>{{ $row->getTranslatedAttribute('display_name') }}</b>
                                                            <br>
                                                            @if (isset($row->details->view))
                                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-read')
                                                                <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                            @endif
                                                            Kwh
                                                        </span>
                                                    </div>
                                                @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="container">
                                    <div class="row text-center"><h4>Hasil Pengukuran</h4></div>
                                    <div class="row text-center">
                                        <div class="col-sm-3" style="margin-bottom:5px"></div>
                                        <div class="col-sm-3" style="margin-bottom:5px">R</div>
                                        <div class="col-sm-3" style="margin-bottom:5px">S</div>
                                        <div class="col-sm-3" style="margin-bottom:5px">T</div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-3" style="margin-bottom:5px">
                                            Tegangan
                                        </div>
                                        @foreach($dataType->readRows as $row)
                                            @php
                                            if ($dataTypeContent->{$row->field.'_read'}) {
                                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                            }
                                            @endphp
                                                @if(in_array($row->field, array('tegangan_r','tegangan_s','tegangan_t')))
                                                    <div class="col-sm-3" style="margin-bottom:5px">
                                                        <span>
                                                            @if (isset($row->details->view))
                                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-read')
                                                                <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                            @endif
                                                            V
                                                        </span>
                                                    </div>
                                                @endif
                                        @endforeach
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-3" style="margin-bottom:5px">
                                            Arus
                                        </div>
                                        @foreach($dataType->readRows as $row)
                                            @php
                                            if ($dataTypeContent->{$row->field.'_read'}) {
                                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                            }
                                            @endphp
                                                @if(in_array($row->field, array('arus_r','arus_s','arus_t')))
                                                    <div class="col-sm-3" style="margin-bottom:5px">
                                                        <span>
                                                            @if (isset($row->details->view))
                                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-read')
                                                                <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                            @endif
                                                            A
                                                        </span>
                                                    </div>
                                                @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="border:3px solid #eee;">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-center"><h4>Nomor Segel</h4></div>
                                <table class="table">
                                    <tbody>
                                        @foreach($dataType->readRows as $row)
                                            @php
                                            if ($dataTypeContent->{$row->field.'_read'}) {
                                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                            }
                                            @endphp
                                                @if(in_array($row->field, array('pintu_luar_atas','pintu_luar_bawah','terminal_kwh','modem')))
                                                    <tr>
                                                        <td><b>{{ $row->getTranslatedAttribute('display_name') }}</b></td>
                                                        <td>
                                                            @if (isset($row->details->view))
                                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-read')
                                                                <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-center"><h4>Rincian</h4></div>
                                <table class="table">
                                    <tbody>
                                        @foreach($dataType->readRows as $row)
                                            @php
                                            if ($dataTypeContent->{$row->field.'_read'}) {
                                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                            }
                                            @endphp
                                                @if(in_array($row->field, array('peruntukan','kesimpulan','created_at')))
                                                    <tr>
                                                        <td><b>{{ $row->getTranslatedAttribute('display_name') }}</b></td>
                                                        <td>
                                                            @if (isset($row->details->view))
                                                                @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                            @else
                                                                @include('voyager::multilingual.input-hidden-bread-read')
                                                                <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                        @endforeach
                                        <tr>
                                            <td><b>Petugas</b></td>
                                            <td>{{$dataTypeContent->user->name}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr style="border:3px solid #eee;">
                        <div class="row text-center" style="margin-bottom:10px;">
                            @foreach($dataType->readRows as $row)
                                @php
                                if ($dataTypeContent->{$row->field.'_read'}) {
                                    $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                }
                                @endphp
                                    @if(in_array($row->field, array('foto_kwh','foto_mcb','foto_box_app','foto_modem')))
                                        <div class="col-sm-3" style="margin-bottom:5px">
                                            <span><b>{{ $row->getTranslatedAttribute('display_name') }}</b>
                                                <br>
                                                @if (isset($row->details->view))
                                                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                @elseif($row->type == "image")
                                                    <img class="img-responsive"
                                                        src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                                                @else
                                                    @include('voyager::multilingual.input-hidden-bread-read')
                                                    <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                @endif
                                            </span>
                                        </div>
                                    @endif
                            @endforeach
                        </div>
                        <div class="row text-center" style="margin-bottom:20px;">
                            @foreach($dataType->readRows as $row)
                                @php
                                if ($dataTypeContent->{$row->field.'_read'}) {
                                    $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_read'};
                                }
                                @endphp
                                    @if(in_array($row->field, array('foto_ba','foto_bangunan','foto_1','foto_2')))
                                        <div class="col-sm-3" style="margin-bottom:5px">
                                            <span><b>{{ $row->getTranslatedAttribute('display_name') }}</b>
                                                <br>
                                                @if (isset($row->details->view))
                                                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => 'read', 'view' => 'read', 'options' => $row->details])
                                                @elseif($row->type == "image")
                                                    <img class="img-responsive"
                                                        src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                                                @else
                                                    @include('voyager::multilingual.input-hidden-bread-read')
                                                    <span>{{ $dataTypeContent->{$row->field} }}</span>
                                                @endif
                                            </span>
                                        </div>
                                    @endif
                            @endforeach
                        </div>
                        <!-- <hr style="border:3px solid #eee;"> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
