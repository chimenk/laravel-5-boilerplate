@extends('frontend.layouts.app')

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">Selamat datang, {{ Auth::user()->name }}</div>

                <div class="panel-body">

                    <div class="row">

                        <div class="col-md-4 col-md-push-8">

                            {{-- <ul class="media-list">
                                <li class="media">
                                    <div class="media-left">
                                        <img class="media-object profile-picture" src="{{ $logged_in_user->picture }}" alt="Profile picture">
                                    </div><!--media-left-->

                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            {{ $logged_in_user->name }}<br/>
                                            <small>
                                                {{ $logged_in_user->email }}<br/>
                                                Joined {{ $logged_in_user->created_at->format('F jS, Y') }}
                                            </small>
                                        </h4>

                                        {{ link_to_route('frontend.user.account', trans('navs.frontend.user.account'), [], ['class' => 'btn btn-info btn-xs']) }}

                                        @permission('view-backend')
                                            {{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration'), [], ['class' => 'btn btn-danger btn-xs']) }}
                                        @endauth
                                    </div><!--media-body-->
                                </li><!--media-->
                            </ul><!--media-list--> --}}

                            {{-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Sidebar Item</h4>
                                </div><!--panel-heading-->

                                <div class="panel-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.
                                </div><!--panel-body-->
                            </div><!--panel--> --}}

                            {{-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Sidebar Item</h4>
                                </div><!--panel-heading-->

                                <div class="panel-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.
                                </div><!--panel-body-->
                            </div><!--panel--> --}}
                        </div><!--col-md-4-->

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Total Tiket Terjual</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p style="font-size: 72px;text-align: center;">{{ $sold->count() }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Pendaftaran Member</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p style="font-size: 72px;text-align: center;">{{ $member->count() }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Member Masuk</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p style="font-size: 72px;text-align: center;">100</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Total Penjualan Tiket Umum</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p style="font-size: 72px;text-align: center;">Rp. {{ number_format($sold->sum('price')) }},-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Total Penjualan Tiket Member</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p style="font-size: 72px;text-align: center;">Rp. 1.999.900,-</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Total Penjualan Hari Ini</h4>
                                        </div><!--panel-heading-->

                                        <div class="panel-body">
                                            <p style="font-size: 72px;text-align: center;">Rp. {{ number_format($sold->sum('price')) }},-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
@endsection

@push('qrc')
<script type="text/javascript">
    $(document).ready(function() {
        var el = kjua({text: 'hello!'});
        document.querySelector('body').appendChild(el);
    });
</script>
@endpush