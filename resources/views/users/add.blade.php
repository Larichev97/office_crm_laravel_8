@extends('layouts.app')

@section('title', 'Добавление сотрудника')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавление сотрудника</h1>
        <a href="{{route('users.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Добавить</h6>
        </div>
        <form method="POST" action="{{route('users.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- First Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Имя <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('first_name') is-invalid @enderror"
                            id="userFirstName"
                            placeholder="Укажите имя..."
                            name="first_name"
                            value="{{ old('first_name') }}">

                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Фамилия <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('last_name') is-invalid @enderror"
                            id="userLastName"
                            placeholder="Укажите фамилию..."
                            name="last_name"
                            value="{{ old('last_name') }}">

                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Email <span style="color:red;">*</span></label>
                        <input
                            type="email"
                            class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="userEmail"
                            placeholder="Укажите email..."
                            name="email"
                            value="{{ old('email') }}">

                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Mobile Number --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Мобильный номер <span style="color:red;">*</span></label>
                        <input
                            type="tel"
                            class="form-control form-control-user @error('mobile_number') is-invalid @enderror"
                            id="userMobile"
                            placeholder="Укажите мобильный номер..."
                            name="mobile_number"
                            value="{{ old('mobile_number') }}">

                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Роль <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('role_id') is-invalid @enderror" name="role_id">
                            <option selected disabled>Выберете должность...</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}} ({{$role->label}})</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label>Статус <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                            <option selected disabled>Выберите статус...</option>
                            <option value="1" selected>Активный</option>
                            <option value="0">Отключен</option>
                        </select>
                        @error('status')
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

@section('scripts')
    <script>
        //$('#userMobile').inputmask("(999) 999-9999");
        //$('#userMobile').mask("+380999999999");
    </script>
@endsection
