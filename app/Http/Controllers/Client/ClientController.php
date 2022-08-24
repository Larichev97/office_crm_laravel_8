<?php

namespace App\Http\Controllers\Client;

use App\Exports\ClientsExport;
use App\Http\Controllers\Controller;
use App\Imports\ClientsImport;
use App\Models\Client\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     *  Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:client-list', ['only' => ['index']]);
        $this->middleware('permission:client-create', ['only' => ['create','store']]);
        $this->middleware('permission:client-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:client-delete', ['only' => ['delete']]);
        $this->middleware('permission:client-import', ['only' => ['importClients', 'uploadClients']]);
        $this->middleware('permission:client-export', ['only' => ['exportClients']]);
    }

    /**
     *  List Clients
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $clients = Client::with('agent')->paginate(100);

        return view('clients.index', ['clients' => $clients]);
    }

    /**
     *  Create Client
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('clients.add');
    }

    /**
     *  Store Client
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13',
            'cash_before'   =>  'regex:/^\d+(\.\d{1,2})?$/',
            'cash_after'    =>  'regex:/^\d+(\.\d{1,2})?$/',
            'status_id'     =>  'required|integer',
            'agent_id'      =>  'integer',
            'comment'       =>  'text|max:255',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $client = Client::create([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'surname'       => $request->surname,
                'mobile_number' => $request->mobile_number,
                'cash_before'   => $request->cash_before,
                'cash_after'    => $request->cash_after,
                'status_id'     => $request->status_id,
                'agent_id'      => $request->agent_id,
                'comment'       => $request->comment,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('clients.index')->with('success','Клиент успешно добавлен.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     *  Edit Client
     *
     * @param Client $client
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Client $client)
    {
        return view('clients.edit')->with([
            'client'  => $client
        ]);
    }

    /**
     *  Update Client
     *
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Client $client)
    {
        // Validations
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13',
            'cash_before'   =>  'regex:/^\d+(\.\d{1,2})?$/',
            'cash_after'    =>  'regex:/^\d+(\.\d{1,2})?$/',
            'status_id'     =>  'required|integer',
            'agent_id'      =>  'integer',
            'comment'       =>  'text|max:255',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $client_updated = Client::whereId($client->id)->update([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'surname'       => $request->surname,
                'mobile_number' => $request->mobile_number,
                'cash_before'   => $request->cash_before,
                'cash_after'    => $request->cash_after,
                'status_id'     => $request->status_id,
                'agent_id'      => $request->agent_id,
                'comment'       => $request->comment,
            ]);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('clients.index')->with('success','Данные клиента успешно обновлены.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     *  Delete Client
     *
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Client $client)
    {
        DB::beginTransaction();
        try {
            // Delete Client
            Client::whereId($client->id)->delete();

            DB::commit();
            return redirect()->route('clients.index')->with('success', 'Сотрудник успешно удален!.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     *  Import Clients
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function importClients()
    {
        return view('clients.import');
    }

    /**
     *  Upload file with Clients
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadClients(Request $request)
    {
        Excel::import(new ClientsImport(), $request->file);

        return redirect()->route('clients.index')->with('success', 'Клиенты успешно импортированы!');
    }

    /**
     *  Export Clients
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportClients()
    {
        return Excel::download(new ClientsExport(), 'clients_' . date('d_m_Y') . '.xlsx');
    }
}
