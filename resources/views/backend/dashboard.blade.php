@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-ticket"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tiket Terjual Hari Ini</span>
                    <span class="info-box-number">{{ $ticket->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pendaftaran Member Baru</span>
                    <span class="info-box-number">{{ $member->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-user-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Member</span>
                    <span class="info-box-number">{{ $allm->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pemasukan Tiket Hari Ini</span>
                    <span class="info-box-number">Rp. {{ number_format($ticket->sum('price')) }} ,-</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pemasukan Pendaftaran Member</span>
                    <span class="info-box-number">Rp. 1.000.000 ,-</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pemasukan Hari Ini</span>
                    <span class="info-box-number">Rp. 2.020.000 ,-</span>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->render() !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection