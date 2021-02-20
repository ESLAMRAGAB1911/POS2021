@extends('pos.pos')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">

                <div class="col-md-12">
                    @if (auth()
            ->user()
            ->hasRole('super_admin'))
                        <a href="{{ route('products.create') }}" style="margin-left:20px;margin-bottom:20px"
                            class="btn btn-theme">
                            {{ __('site.Add products') }}
                        </a>
                    @endif

                    @if ($products->count() > 0)

                        <div class="content-panel">
                            <form action="{{ route('products.index') }}" method="get" class="form-inline">
                                <div class="form-group mx-sm-3 mb-2">
                                    <select name="category_id" class=" form-control">
                                        <option>{{ __('site.allcategories') }}</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mx-sm-3 mb-2">
                                    <input name="search" type="text" class="form-control" value="{{ request()->search }}"
                                        placeholder="{{ __('site.Search categories') }}">
                                </div>
                            <button type="submit" class="btn btn-primary mb-2">{{__('site.Search')}}</button>
                            </form>
                            <table class="table table-striped table-advance table-hover">
                                <h4 style="text-align:center">{{ __('site.products') }}</h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th> {{ __('site.Name') }}</th>
                                        <th> {{ __('site.description') }}</th>
                                        <th> {{ __('site.image') }}</th>
                                        <th> {{ __('site.purchase_price') }}</th>
                                        <th> {{ __('site.sale_price') }}</th>
                                        <th> {{ __('site.stock') }}</th>
                                        <th class="hidden-phone"> {{ __('site.action') }}</th>

                                    </tr>

                                </thead>

                                <tbody>


                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                {{ $product->description }}
                                            </td>
                                            <td>
                                                <img src="{{ asset('productImage') }}/{{ $product->image }}"
                                                    style="width:100px" class="img thumbnail" alt="">
                                            </td>
                                            <td>
                                                {{ $product->purchase_price }}
                                            </td>
                                            <td>
                                                {{ $product->sale_price }}
                                            </td>
                                            <td>
                                                {{ $product->stock }}
                                            </td>
                                            <td>
                                                @if (auth()
            ->user()
            ->hasPermission('products-update'))
                                                    <a href="{{ route('products.edit', $product->id) }}">
                                                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                                            {{ __('site.Edit') }}
                                                        </button>
                                                    </a>
                                                @endif

                                                @if (auth()
            ->user()
            ->hasPermission('products-delete'))
                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="post" style="display: inline-block;">
                                                        @csrf
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                                class="fa fa-trash"></i>
                                                            {{ __('site.delete') }}
                                                        </button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}

                        </div>
                    @else
                        <h1 style="text-align:center">{{ __('site.not found products') }}</h1>
                    @endif
                    <!-- /content-panel -->
                </div>
                <!-- /col-md-12 -->
            </div>

            <!-- /row -->
        @endsection
