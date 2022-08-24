@extends('layouts.app')

@section('title', 'Добавление роли')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавление роли</h1>
        <a href="{{route('roles.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Новая роль (должность)</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('roles.store')}}">
                @csrf

                {{-- Role --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Роль (на английском) <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('name') is-invalid @enderror"
                            id="roleName"
                            placeholder="Укажите роль (пример: ExampleRole)..."
                            name="name"
                            value="{{ old('name') }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Label --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Должность <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('label') is-invalid @enderror"
                            id="roleLabel"
                            placeholder="Укажите должность..."
                            name="label"
                            value="{{ old('label') }}">

                        @error('label')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Type --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Тип использования <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                            <option selected disabled>Укажите тип использования...</option>
                            <option value="web" selected>Для WEB</option>
                            <option value="api" disabled>Для API</option>
                        </select>
                        @error('guard_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Добавить
                </button>

            </form>
        </div>
    </div>

</div>


@endsection
