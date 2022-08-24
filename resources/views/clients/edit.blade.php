@extends('layouts.app')

@section('title', 'Редактирование клиента')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Редактирование клиента</h1>
        <a href="{{route('clients.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Редактирование</h6>
        </div>
        <form method="POST" action="{{route('clients.update', ['client' => $client->id])}}">
            @csrf
            @method('PUT')

            <div class="card-body">
                {{-- First Name --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Имя <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('first_name') is-invalid @enderror"
                            id="clientFirstName"
                            placeholder="Укажите имя..."
                            name="first_name"
                            value="{{ old('first_name') ?  old('first_name') : $client->first_name}}">

                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Last Name --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Фамилия <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('last_name') is-invalid @enderror"
                            id="clientLastName"
                            placeholder="Укажите фамилию..."
                            name="last_name"
                            value="{{ old('last_name') ? old('last_name') : $client->last_name }}">

                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Surname --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Отчество <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('surname') is-invalid @enderror"
                            id="clientSurname"
                            placeholder="Укажите отчество..."
                            name="surname"
                            value="{{ old('surname') ? old('surname') : $client->surname }}">

                        @error('surname')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Mobile Number --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Мобильный номер <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('mobile_number') is-invalid @enderror"
                            id="clientMobileNumber"
                            placeholder="Укажите мобильный номер..."
                            name="mobile_number"
                            value="{{ old('mobile_number') ? old('mobile_number') : $client->mobile_number }}">

                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Cash before --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Доступные деньги</label>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            class="form-control form-control-user @error('cash_before') is-invalid @enderror"
                            id="clientCashBefore"
                            placeholder="Укажите сумму..."
                            name="cash_before"
                            value="{{ old('cash_before') ? old('cash_before') : $client->cash_before }}">

                        @error('cash_before')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Cash after --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Полученные деньги</label>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            class="form-control form-control-user @error('cash_after') is-invalid @enderror"
                            id="clientCashAfter"
                            placeholder="Укажите сумму..."
                            name="cash_after"
                            value="{{ old('cash_after') ? old('cash_after') : $client->cash_after }}">

                        @error('cash_after')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Статус <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('status_id') is-invalid @enderror" name="status_id">
                            <option selected disabled>Выберите статус...</option>
                            <option value="1" {{old('status_id') ? ((old('status_id') == 1) ? 'selected' : '') : (($client->status_id == 1) ? 'selected' : '')}}>Новый</option>
                            <option value="2" {{old('status_id') ? ((old('status_id') == 2) ? 'selected' : '') : (($client->status_id == 2) ? 'selected' : '')}}>В работе</option>
                            <option value="3" {{old('status_id') ? ((old('status_id') == 3) ? 'selected' : '') : (($client->status_id == 3) ? 'selected' : '')}}>Обработан</option>
                        </select>
                        @error('status_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Agent --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Агент <span style="color:red;">* (доработать: вывести список агентов из БД id => fio)</span></label>
                        <select class="form-control form-control-user @error('agent_id') is-invalid @enderror" name="agent_id">
                            <option selected disabled>Выберите агента...</option>
                            <option value="1" {{old('agent_id') ? ((old('agent_id') == 1) ? 'selected' : '') : (($client->agent_id == 1) ? 'selected' : '')}}>Агент1</option>
                            <option value="2" {{old('agent_id') ? ((old('agent_id') == 2) ? 'selected' : '') : (($client->agent_id == 2) ? 'selected' : '')}}>Агент2</option>
                            <option value="3" {{old('agent_id') ? ((old('agent_id') == 3) ? 'selected' : '') : (($client->agent_id == 3) ? 'selected' : '')}}>Агент3</option>
                        </select>
                        @error('agent_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Comment --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Комментарий</label>
                        <textarea
                            class="form-control form-control-user @error('comment') is-invalid @enderror"
                            id="clientsComment"
                            placeholder="Введите комментарий..."
                            name="comment"
                            rows="4"
                            cols="4"
                        >
                            {{ old('comment') ? old('comment') : $client->comment }}
                        </textarea>

                        @error('comment')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Сохранить</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">Отмена</a>
            </div>
        </form>
    </div>

</div>


@endsection
