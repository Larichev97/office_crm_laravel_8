@extends('layouts.app')

@section('title', 'Добавление клиента')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавление клиента</h1>
        <a href="{{route('clients.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Добавить</h6>
        </div>
        <form method="POST" action="{{route('clients.store')}}">
            @csrf
            <div class="card-body">
                {{-- Full Name --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>ФИО <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('full_name') is-invalid @enderror"
                            id="userFullName"
                            placeholder="Укажите ФИО..."
                            name="full_name"
                            value="{{ old('full_name') }}">

                        @error('full_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Address --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Адрес <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('address') is-invalid @enderror"
                            id="clientsAddress"
                            placeholder="Укажите адрес..."
                            name="address"
                            value="{{ old('address') }}">

                        @error('address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Mobile Number --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Мобильный номер <span style="color:red;">*</span></label>
                        <input
                            type="tel"
                            class="form-control form-control-user @error('mobile_number') is-invalid @enderror"
                            id="clientsMobile"
                            placeholder="Укажите мобильный номер..."
                            name="mobile_number"
                            value="{{ old('mobile_number') }}">

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
                            value="{{ old('cash_before') }}">
                        @error('cash_before')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Статус <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('status_id') is-invalid @enderror" name="status">
                            <option selected disabled>Выберите статус...</option>
                            <option value="1" selected>Новый</option>
                            <option value="2">В работе</option>
                            <option value="3">Обработан</option>
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
                            <option value="1">Агент1</option>
                            <option value="2">Агент2</option>
                            <option value="3">Агент3</option>
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
                            {{ old('comment') }}
                        </textarea>

                        @error('comment')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Сохранить</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('clients.index') }}">Отмена</a>
            </div>
        </form>
    </div>

</div>


@endsection

@section('scripts')
    <script>
        //$('#userMobile').inputmask("(999) 999-9999");
        //$('#userMobile').mask("+380999999999");
    </script>
@endsection
