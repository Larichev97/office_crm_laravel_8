@extends('layouts.app')

@section('title', 'Доступы')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Доступы</h1>
        <a href="{{route('permissions.create')}}" class="btn btn-sm btn-primary" >
            <i class="fas fa-plus"></i> Добавить доступ
        </a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Все доступы</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20%">Доступ</th>
                            <th width="60%">Описание</th>
                            <th width="10%">Тип использования</th>
                            <th width="10%">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($permissions as $permission)
                           <tr>
                               <td>{{$permission->name}}</td>
                               <td>{{$permission->description}}</td>
                               <td>{{$permission->guard_name}}</td>
                               <td style="display: flex">
                                   <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}" class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                   </a>
                                   <form method="POST" action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-2" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                   </form>
                               </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>

                {{$permissions->links()}}
            </div>
        </div>
    </div>

</div>


@endsection
