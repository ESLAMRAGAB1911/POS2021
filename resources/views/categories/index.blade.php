@extends('pos.pos')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">

                <div class="col-md-12">
                    @if (auth()
            ->user()
            ->hasRole('super_admin'))
                        <a href="{{ route('categories.create') }}" style="margin-left:20px;margin-bottom:20px"
                            class="btn btn-theme">
                            {{ __('site.Add categories') }}
                        </a>
                    @endif

                    @if ($categories->count() > 0)

                        <div class="content-panel">

                            <form action="{{ route('categories.index') }}" method="get"
                                class="pull-right mail-src-position">
                                <div class="input-append" style="margin-right:50px">
                                    <input name="search" type="text" class="form-control" value="{{ request()->search }}"
                                        placeholder="{{ __('site.Search categories') }}">
                                </div>
                            </form>
                            <table class="table table-striped table-advance table-hover">
                                <h4 style="text-align:center">{{ __('site.categories') }}
                                    <small>{{ $categories->total() }}</small>
                                </h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th> {{ __('site.Name') }}</th>
                                        <th> {{ __('site.products numbers') }}</th>
                                        <th> {{ __('site.relate products') }}</th>
                                        <th class="hidden-phone"> {{ __('site.action') }}</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td>
                                                {{ $category->products->count() }}
                                            </td>
                                            <td>
                                                <a href="{{ route('products.index', ['category_id' => $category->id]) }}"
                                                    class="btn btn-info">{{ __('site.relate products') }}</a>
                                            </td>
                                            <td>
                                                @if (auth()
            ->user()
            ->hasPermission('categories-update'))
                                                    <a href="{{ route('categories.edit', $category->id) }}">
                                                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                                            {{ __('site.Edit') }}
                                                        </button>
                                                    </a>
                                                @endif

                                                @if (auth()
            ->user()
            ->hasPermission('categories-delete'))
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
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
                            {{ $categories->links() }}

                        </div>
                    @else
                        <h1 style="text-align:center">{{ __('site.not found categories') }}</h1>
                    @endif
                    <!-- /content-panel -->
                </div>
                <!-- /col-md-12 -->
            </div>

            <!-- /row -->
        @endsection
