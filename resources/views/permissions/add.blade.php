@extends('layouts.app')

@section('title', 'Добавление доступа')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавление доступа</h1>
        <a href="{{route('permissions.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Добавление</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('permissions.store')}}">
                @csrf

                {{-- Name --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Доступ <span style="color:red;">*</span> (на английском)</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('name') is-invalid @enderror"
                            id="permissionName"
                            placeholder="Укажите доступ (пример: example-permission)..."
                            name="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Описание <span style="color:red;">*</span></label>
                        <textarea
                            type="text"
                            class="form-control form-control-user @error('Description') is-invalid @enderror"
                            id="permissionDescription"
                            placeholder="Укажите описание для доступа..."
                            name="description"
                            rows="3"
                            cols="3"
                         >
                            {{ old('description') }}
                        </textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Guard Name --}}
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Тип использования <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                            <option selected disabled>Укажите тип использования...</option>
                            <option value="web" selected>Для WEB</option>
                            <option value="api">Для API</option>
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
