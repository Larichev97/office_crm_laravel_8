@extends('layouts.app')

@section('title', 'Все клиенты')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Все клиенты</h1>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @hasanyrole('Admin|Director|Teamleader')
                    <div class="col-md-12">
                        @can('client-export')
                        <a href="{{ route('clients.export') }}" class="btn btn-sm btn-success float-right">
                            <i class="fa fa-file"></i> Экспорт в Excel
                        </a>
                        @endcan

                        @can('client-create')
                        <a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary float-right mr-2">
                            <i class="fas fa-plus"></i> Добавить клиента
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
                                <th width="10%">№ клиента</th>
                                <th width="20%">ФИО</th>
                                <th width="10%">Мобильный номер</th>
                                <th width="5%">Доступные деньги</th>
                                <th width="5%">Полученные деньги</th>
                                <th width="10%">Статус</th>
                                <th width="15%">Агент</th>
                                <th width="15%">Комментарий</th>
                                <th width="10%">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->getClientFullName() }}</td>
                                    <td>{{ $client->mobile_number }}</td>
                                    <td>{{ $client->cash_before }}</td>
                                    <td>{{ $client->cash_after }}</td>
                                    <td>
                                        {{ $client->getStatusName($client->status_id) }}
                                    </td>
                                    <td>
                                        {{ $client->agent ? $client->agent->getFullNameAttribute() : 'Агент не назначен'  }}
                                    </td>
                                    <td>
                                        {{ $client->comment }}
                                    </td>
                                    <td style="display: flex">
                                        @can('client-edit')
                                            <a href="{{ route('clients.edit', ['client' => $client->id]) }}"
                                                class="btn btn-primary m-2">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                        @endcan

                                        @can('client-delete')
                                            <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteClientModal">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('clients.delete-modal')

@endsection

@section('scripts')

@endsection
