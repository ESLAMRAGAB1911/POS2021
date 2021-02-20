@extends('pos.pos')

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">

                <div class="col-md-12">
                    @if (auth()
            ->user()
            ->hasRole('super_admin'))
                        <a href="{{ route('users.create') }}" style="margin-left:20px;margin-bottom:20px"
                            class="btn btn-theme">
                            {{ __('site.Add Users') }}
                        </a>
                    @endif

                    @if ($users->count() > 0)

                        <div class="content-panel">
                            <form action="{{ route('users.index') }}" method="get" class="pull-right mail-src-position">
                                <div class="input-append" style="margin-right:50px">
                                    <input name="search" type="text" class="form-control" value="{{ request()->search }}"
                                        placeholder="{{ __('site.Search Users') }}">
                                </div>
                            </form>


                            <table class="table table-striped table-advance table-hover">
                                <h4 style="text-align:center">{{ __('site.users') }} <small>{{ $users->total() }}</small>
                                </h4>
                                <hr>
                                <thead>
                                    <tr>
                                        <th> {{ __('site.Name') }}</th>
                                        <th class="hidden-phone"> {{ __('site.Email') }}</th>
                                        <th class="hidden-phone"> {{ __('site.image') }}</th>
                                        <th class="hidden-phone"> {{ __('site.action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>

                                            <td>
                                                {{ $user->name }}
                                            </td>

                                            <td class="hidden-phone">
                                                {{ $user->email }}
                                            </td>
                                            <td class="hidden-phone">
                                                <img src="{{ asset('userImage') }}/{{ $user->image }}" style="width:100px"
                                                    class="img thumbnail" alt="">

                                            </td>
                                            <td>
                                                @if (auth()
            ->user()
            ->hasPermission('users-update'))
                                                    <a href="{{ route('users.edit', $user->id) }}">
                                                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                                            {{ __('site.Edit') }}
                                                        </button>
                                                    </a>
                                                @endif

                                                @if (auth()
            ->user()
            ->hasPermission('users-delete'))
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="post"
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
                            {{ $users->links() }}
                        </div>
                    @else
                        <h1 style="text-align:center">{{ __('site.not found users') }}</h1>
                    @endif
                    <!-- /content-panel -->
                </div>
                <!-- /col-md-12 -->
            </div>

            <!-- /row -->




        @endsection
