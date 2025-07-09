<?php

namespace App\Http\Controllers\Modules;

use App\Helpers\ActionsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterProdukRequest;
use App\Models\MasterProduk;
use App\Services\MasterProdukService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

class MasterProdukController extends Controller
{
    private $menu = 'Master Produk';
    private $masterProdukService;

    public function __construct(MasterProdukService $masterProdukService)
    {
        $this->middleware("check-permission:{$this->menu},create")->only(['create', 'store']);
        $this->middleware("check-permission:{$this->menu},read")->only(['index', 'show']);
        $this->middleware("check-permission:{$this->menu},update")->only(['edit', 'update']);
        $this->middleware("check-permission:{$this->menu},delete")->only(['destroy']);

        $this->masterProdukService = $masterProdukService;
    }

    public function index(Request $request):View|JsonResponse
    {
        $data = MasterProduk::select($this->selectColumn());
        $search = $request->input('search');  
        
        if ($search) {
            $columns = Schema::getColumnListing('master_produk'); 

            $data->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $search . '%');
                }
            });
        }

        $data = $data->get();
        
        if (request()->ajax()) {
            $dataTable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', fn($row) => ActionsHelper::renderActionButtons($row, 'master_produk.edit', $this->menu))
            ->rawColumns(['action']); 
            
            return $dataTable->make(true);
        }
    
        return view('modules.master_produk.index');
    }

    private function selectColumn(): array
    {
        $columns = Schema::getColumnListing('master_produk');
        $filteredColumns = array_filter($columns, function($col) {
            return $col;
        });

        return $filteredColumns;
    }

    public function create(): View|Factory
    {

        return view('modules.master_produk.form',[
            'data' => new MasterProduk(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterProdukRequest $request): JsonResponse
    {
        $MasterProduk = new MasterProduk();

        $result = $this->masterProdukService->saveData($request, $MasterProduk);
        
        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $id): View|Factory
    {
        $data = MasterProduk::findOrFail($id);
        return view('modules.master_produk.form',[
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MasterProdukRequest $request, $id): JsonResponse
    {
        $MasterProduk = MasterProduk::findOrFail($id);

        $result = $this->masterProdukService->saveData($request, $MasterProduk);

        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->masterProdukService->delete($request->id);
        return response()->json(['text' => $result['message']], $result['status_code']);
    }
}