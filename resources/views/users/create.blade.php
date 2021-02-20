@extends('pos.pos')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">

                <div class="col-lg-12">

                    <h4 style="text-align:center">{{ __('site.Add Users') }}</h4>

                    <div class="form-panel">

                        <div class=" form">
                            @include('_error')

                            <form class="cmxform form-horizontal style-form" method="post"
                                action="{{ route('users.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">{{ __('site.Name') }}</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" name="name" minlength="2" type="text" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cemail" class="control-label col-lg-2">{{ __('site.Email') }}</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" type="email" name="email" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="image" class="control-label col-lg-2">{{ __('site.image') }}</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" type="file" name="image" id="imgInp" />
                                        <img id="blah" src="" style="width:150px;" class="img thumbnail" alt="">

                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="curl" class="control-label col-lg-2">{{ __('site.Password') }}</label>
                                    <div class="col-lg-10">
                                        <input class="form-control " type="password" name="password" />
                                    </div>
                                </div>
                                @php

                                $models = ['users', 'categories', 'products', 'clients','orders'];
                                $maps = ['create','update','read','delete'];

                                @endphp
                                <p>
                                    @foreach ($models as $model)
                                        <button class="btn btn-primary" type="button" data-toggle="collapse"
                                            data-target="#{{ $model }}" aria-expanded="false" aria-controls="{{ $model }}">
                                            {{ __('site.' . $model) }}
                                        </button>
                                    @endforeach
                                </p>
                                @foreach ($models as $model)

                                    <div class="collapse" id="{{ $model }}">
                                        <div class="card-body" style="height:25px">
                                            <div class="checkbox">

                                                @foreach ($maps as $map)

                                                    <label><input type="checkbox" name="permissions[]"
                                                            value="{{ $model . '-' . $map }}">{{ __('site.' . $map) }}</label>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-theme" type="submit">{{ __('site.Save') }}</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                    <!-- /form-panel -->
                </div>
                <!-- /col-lg-12 -->
            </div>

        @endsection
