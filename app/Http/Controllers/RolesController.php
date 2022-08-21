<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     *  Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::paginate(50);

        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     *  Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('roles.add', ['permissions' => $permissions]);
    }

    /**
     *  Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'guard_name' => 'required'
            ]);

            Role::create($request->all());

            DB::commit();
            return redirect()->route('roles.index')->with('success','Роль успешно добавлена.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('roles.add')->with('error',$th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     *  Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $role = Role::whereId($id)->with('permissions')->first();

        $permissions = Permission::all();

        return view('roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     *  Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            // Validate Request
            $request->validate([
                'name' => 'required',
                'guard_name' => 'required'
            ]);

            $role = Role::whereId($id)->first();

            $role->name = $request->name;
            $role->label = $request->label;
            $role->guard_name = $request->guard_name;
            $role->save();

            // Sync Permissions
            $permissions = $request->permissions;
            $role->syncPermissions($permissions);

            DB::commit();
            return redirect()->route('roles.index')->with('success','Роль успешно изменена.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('roles.edit',['role' => $role])->with('error',$th->getMessage());
        }
    }

    /**
     *  Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Role::whereId($id)->delete();

            DB::commit();
            return redirect()->route('roles.index')->with('success','Роль успешно удалена.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('roles.index')->with('error',$th->getMessage());
        }
    }
}
