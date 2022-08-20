@extends('layouts.app')

@section('title', 'Редактирование роли')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Редактирование роли</h1>
        <a href="{{route('roles.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Редактирование роли</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('roles.update', ['role' => $role->id])}}">
                @csrf
                @method('PUT')
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Роль (на английском) <span style="color:red;">*</span></label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('name') is-invalid @enderror"
                            id="exampleName"
                            placeholder="Укажите роль (пример: ExampleRole)..."
                            name="name"
                            value="{{ old('name') ? old('name') : $role->name }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    {{-- Guard Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label>Тип использования <span style="color:red;">*</span></label>
                        <select class="form-control form-control-user @error('guard_name') is-invalid @enderror" name="guard_name">
                            <option selected disabled>Укажите тип использования...</option>
                            <option value="web" {{old('guard_name') ? ((old('guard_name') == 'web') ? 'selected' : '') : (($role->guard_name == 'web') ? 'selected' : '')}}>Для WEB</option>
                            <option value="api" {{old('guard_name') ? ((old('guard_name') == 'api') ? 'selected' : '') : (($role->guard_name == 'api') ? 'selected' : '')}}>Для API</option>
                        </select>
                        @error('guard_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <label> <span style="color:red;">*</span> Доступы</label>
                        <input type="checkbox" name="check-all" class="form-contol" id="checkAllPermissions" {{ (count($permissions) == count($role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}/> All
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach ($permissions as $permissionIndex => $permission)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input permission-input" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }} type="checkbox" name="permissions[]" id="inlineCheckbox_{{$permissionIndex}}"  value="{{$permission->id}}">
                                        <label class="form-check-label" for="inlineCheckbox{{$permissionIndex}}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Сохранить
                </button>

            </form>
        </div>
    </div>

</div>


@endsection


@section('scripts')
<script>
    $("#checkAllPermissions").click(function(){
        $('.permission-input').not(this).prop('checked', this.checked);
    });
</script>
@endsection
