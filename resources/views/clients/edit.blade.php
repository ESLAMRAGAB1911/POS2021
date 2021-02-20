@extends('pos.pos')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">

                <div class="col-lg-12">

                    <h4 style="text-align:center">{{ __('site.Edit Clients') }}</h4>

                    <div class="form-panel">

                        <div class=" form">

                            <form class="cmxform form-horizontal style-form" method="post"
                                action="{{ route('clients.update', $clients->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('put') }}
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">{{ __('site.Name') }}</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" value="{{ $clients->name }}" name="name" minlength="2"
                                            type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cemail" class="control-label col-lg-2">{{ __('site.Phone') }}</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" value="{{ $clients->phone }}" type="number" name="phone"
                                            required />
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="cemail" class="control-label col-lg-2">{{ __('site.Address') }}</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" value="{{ $clients->address }}" type="text" name="address"
                                            required />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-theme" type="submit">{{ __('site.Edit') }}</button>
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
