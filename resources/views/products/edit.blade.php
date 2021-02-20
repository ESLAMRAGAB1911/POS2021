@extends('pos.pos')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">

                <div class="col-lg-12">

                    <h4 style="text-align:center">{{ __('site.edit product') }}</h4>

                    <div class="form-panel">
                        <div class=" form">
                            <form class="cmxform form-horizontal style-form" method="post"
                                action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('put') }}

                                @include('_error')

                                <div class="form-group ">

                                    <label for="cname"
                                        class="control-label col-lg-2">{{ __('site.choose category') }}</label>

                                    <div class="col-lg-10">

                                        <select name="category_id" class=" form-control">

                                            <option>{{ __('site.allcategories') }}</option>

                                            @foreach ($categories as $category)

                                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                                            @endforeach

                                        </select>

                                    </div>
                                </div>

                                <div class="form-group ">

                                    <label for="image" class="control-label col-lg-2">{{ __('site.image') }}</label>

                                    <div class="col-lg-10">

                                        <input class="form-control" type="file" name="image" id="imgInp" />

                                        <img id="blah" src="{{ asset('productImage') }}/{{ $product->image }}"
                                            style="width:150px;" class="img thumbnail" alt="">

                                    </div>
                                </div>
                                @foreach (config('translatable.locales') as $local)

                                    <div class="form-group ">
                                        <label for="cname"
                                            class="control-label col-lg-2">{{ __('site.' . $local . '.name') }}</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" name="{{ $local }}[name]" minlength="2" type="text"
                                                value="{{ $product->name }}" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="description"
                                            class="control-label col-lg-2">{{ __('site.' . $local . '.description') }}</label>
                                        <div class="col-lg-10">
                                            <textarea class=" form-control" name="{{ $local }}[description]"
                                                minlength="2">{{ $product->description }}</textarea>
                                        </div>
                                    </div>

                                @endforeach
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">{{ __('site.purchase_price') }}</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" type="number" name="purchase_price"
                                            value="{{ $product->purchase_price }}" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">{{ __('site.sale_price') }}</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" type="number" name="sale_price"
                                            value="{{ $product->sale_price }}" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">{{ __('site.stock') }}</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" type="number" name="stock"
                                            value="{{ $product->stock }}" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-theme" type="submit">{{ __('site.update') }}</button>
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
