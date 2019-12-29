@extends('layouts.app')

@section('content')
    <?php
        $count = isset($values) ? count($values) : 0;
    ?>
    <div id="header">
        <h2>{{ $title }}
            <span class="pull-right">
                <button type="button" id="btn-toggle-filter" class="btn btn-outline-secondary">
                    <svg width="18px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg>
                    <span class="d-none d-sm-inline">{{ __('Search') }}</span>
                </button>
                @can('create-' . $prefix, $class)
                    <a href="{{ route($prefix . '.create') }}" class="btn btn-success">
                        <svg width="18px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#fff" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                        <span class="d-none d-sm-inline">{{ __('Add') }} @yield('page')</span>
                    </a>
                @endcan
                @can('destroy-' . $prefix, $class)
                <!-- TODO: nao está apagando mais de um -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-all">
                        <svg width="18px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path></svg>
                        <span class="d-none d-sm-inline">{{ __('Delete') }} @yield('page')</span>
                    </button>
                @endcan
            </span>
        </h2>
        <hr>

        @if(session()->get('success'))
            <div class="alert alert-success">
                <strong>{{ __('Success') }}!</strong> {{ session()->get('success') }}
            </div>
        @endif

    </div>

    @can('index-' . $prefix, $class)
        @yield('filter')
        @yield('tabulation')

        <div class="table-responsive">
            @if($count === 0)
                <p id="table-msg" class="text-center">{{ __('No records found') }}.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        @foreach($values as $value)
                            @foreach($value->getFillable() as $fill)
                                @if(!in_array($fill, $value->getHidden()))
                                    <td>{{ __('attr.' . $fill) }}</td>
                                @endif
                            @endforeach

                            @canany(['edit-' . $prefix, 'destroy-' . $prefix], $class)
                                <td>{{ __('Actions') }}</td>
                            @endcanany

                            @break
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($values as $value)
                            {{ $value->format() }}
                            <tr>
                                @foreach($value->getFillable() as $fill)
                                    @if(!in_array($fill, $value->getHidden()))
                                        <td>{{ $value->{$fill} }}</td>
                                    @endif
                                @endforeach

                                @canany(['edit-' . $prefix, 'destroy-' . $prefix], $class)
                                    <td class="d-inline-flex text-center">
                                        @can('edit-' . $prefix, $class)
                                        <a href="{{ route($prefix . '.edit', $value->getKey()) }}" class="btn">
                                            <svg width="18px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pencil-alt" class="svg-inline--fa fa-pencil-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#333" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"></path></svg>
                                        </a>
                                        @endcan

                                        @can('destroy-' . $prefix, $class)
                                            <form action="{{ route($prefix . '.destroy', $value->getKey()) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link" type="submit">
                                                    <svg width="18px" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash-alt" class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#333" d="M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z"></path></svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Pagination -->
        @if($count !== 0)
            <div class="container h-100 mt-3">
                <div class="row h-100 justify-content-center align-items-center">
                    {{ $values->links() }}
                </div>
            </div>
        @endif
    @endcan

@endsection
