@extends('pos.pos')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">

                <div class="col-md-12">
                    @if (auth()
            ->user()
            ->hasRole('super_admin'))
                        <a href="{{ route('clients.create') }}" style="margin-left:20px;margin-bottom:20px"
                            class="btn btn-theme">
                            {{ __('site.Add clients') }}
                        </a>
                    @endif

                    @if ($clients->count() > 0)

                        <div class="content-panel">
                            <form action="{{ route('clients.index') }}" method="get" class="pull-right mail-src-position">
                                <div class="input-append" style="margin-right:50px">
                                    <input name="search" type="text" class="form-control" value="{{ request()->search }}"
                                        placeholder="{{ __('site.Search clients') }}">
                                </div>
                            </form>
                            <table class="table table-striped table-advance table-hover">
                                <h4 style="text-align:center">{{ __('site.clients') }}
                                    <small>{{ $clients->total() }}</small>
                                </h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th> {{ __('site.Name') }}</th>
                                        <th class="hidden-phone"> {{ __('site.Phone') }}</th>
                                        <th class="hidden-phone"> {{ __('site.Address') }}</th>
                                        <th class="hidden-phone"> {{ __('site.Add order') }}</th>
                                        <th class="hidden-phone"> {{ __('site.action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>

                                            <td>
                                                {{ $client->name }}
                                            </td>

                                            <td class="hidden-phone">
                                                {{ $client->phone }}
                                            </td>
                                            <td class="hidden-phone">
                                                {{ $client->address }}
                                            </td>
                                            <td class="hidden-phone">

                                                <a href="{{ route('clients.orders.create', $client->id) }}">
                                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                                        {{ __('site.Add order') }}
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                @if (auth()
            ->user()
            ->hasPermission('clients-update'))
                                                    <a href="{{ route('clients.edit', $client->id) }}">
                                                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                                            {{ __('site.Edit') }}
                                                        </button>
                                                    </a>
                                                @endif

                                                @if (auth()
            ->user()
            ->hasPermission('clients-delete'))
                                                    <form action="{{ route('clients.destroy', $client->id) }}" method="post"
                                                        style="display: inline-block;">
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
                            {{ $clients->links() }}
                        </div>
                    @else
                        <h1 style="text-align:center">{{ __('site.not found clients') }}</h1>
                    @endif
                    <!-- /content-panel -->
                </div>
                <!-- /col-md-12 -->
            </div>

            <!-- /row -->




        @endsection
