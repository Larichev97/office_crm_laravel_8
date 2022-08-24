@extends('layouts.app')

@section('title', 'Все сотрудники')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Все сотрудники</h1>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @hasanyrole('Admin|Director|Teamleader')
                    <div class="col-md-12">
{{--                        <a href="{{ route('users.export') }}" class="btn btn-sm btn-success float-right">--}}
{{--                            <i class="fa fa-file"></i> Экспорт в Excel--}}
{{--                        </a>--}}
                        @can('user-create')
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary float-right mr-2">
                                <i class="fas fa-plus"></i> Добавить сотрудника
                            </a>
                        @endcan
                    </div>
                @endhasanyrole
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="20%">ФИО</th>
                                <th width="25%">Почта</th>
                                <th width="15%">Мобильный номер</th>
                                <th width="15%">Должность</th>
                                <th width="15%">Статус</th>
                                <th width="10%">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile_number }}</td>
                                    <td>{{ $user->roles ? $user->roles->pluck('label')->first() : 'Без должности' }}</td>
                                    <td>
                                        @if ($user->status == 0)
                                            <span class="badge badge-danger">Отключен</span>
                                        @elseif ($user->status == 1)
                                            <span class="badge badge-success">Активный</span>
                                        @endif
                                    </td>
                                    <td style="display: flex">
                                        @hasanyrole('Admin|Director')
                                            @if ($user->status == 0)
                                                <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 1]) }}"
                                                    class="btn btn-success m-2">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @elseif ($user->status == 1)
                                                <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 0]) }}"
                                                    class="btn btn-danger m-2">
                                                    <i class="fa fa-ban"></i>
                                                </a>
                                            @endif
                                        @endhasanyrole

                                        @can('user-edit')
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                class="btn btn-primary m-2">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                        @endcan

                                        @can('user-delete')
                                            <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('users.delete-modal')

@endsection

@section('scripts')

@endsection
