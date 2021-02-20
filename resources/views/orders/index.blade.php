@extends('pos.pos')

@section('content')
    <section id="main-content">
        <section class="wrapper">

            <div class="row mt">

                <div class="col-md-12">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.orders')</h3>

                            <form action="{{ route('orders.index') }}" method="get">

                                <div class="row">

                                    <div class="col-md-8">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="@lang('site.search')" value="{{ request()->search }}">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                            @lang('site.search')</button>
                                    </div>

                                </div><!-- end of row -->

                            </form><!-- end of form -->

                        </div><!-- end of box header -->

                        @if ($orders->count() > 0)

                            <div class="box-body table-responsive">

                                <table class="table table-striped table-advance table-hover">
                                    <tr>
                                        <th>@lang('site.client_name')</th>
                                        <th>@lang('site.price')</th>
                                        {{-- <th>@lang('site.status')</th>
                                        --}}
                                        <th>@lang('site.created_at')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->client->name }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm order-products"
                                                    data-url="{{ route('orders.products', $order->id) }}" data-method="get">
                                                    <i class="fa fa-list"></i>
                                                    @lang('site.show')
                                                </button>
                                                @if (auth()
            ->user()
            ->hasPermission('orders-update'))
                                                    <a href="{{ route('clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id]) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>
                                                        @lang('site.edit')</a>

                                                @endif

                                                @if (auth()
            ->user()
            ->hasPermission('orders-delete'))
                                                    <form action="{{ route('orders.destroy', $order->id) }}" method="post"
                                                        style="display: inline-block;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                                class="fa fa-trash"></i> @lang('site.delete')</button>
                                                    </form>


                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach
                                </table><!-- end of table -->

                            @else

                                <div class="box-body">
                                    <h3>@lang('site.no_records')</h3>
                                </div>
                        @endif
                        <div class="col-md-12">

                            <div class="box box-primary">

                                <div class="box-header">
                                    <h3 class="box-title" style="margin-bottom: 10px">@lang('site.show_products')</h3>
                                </div><!-- end of box header -->

                                <div class="box-body">

                                    <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                                        <div class="loader"></div>
                                        <p style="margin-top: 10px">@lang('site.loading')</p>
                                    </div>

                                    <div id="order-product-list">
                                    </div>
                                </div><!-- end of box body -->
                            </div><!-- end of box -->

                        </div><!-- end of col -->

        </section><!-- end of content section -->

        <!-- /row -->
    @endsection
