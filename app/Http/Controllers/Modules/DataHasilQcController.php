<?php

namespace App\Http\Controllers\Modules;

use App\Helpers\ActionsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataHasilQcRequest;
use App\Models\DataHasilQc;
use App\Models\MasterProduk;
use App\Services\DataHasilQcService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

class DataHasilQcController extends Controller
{
    private $menu = 'Data Hasil Produksi';
    private $dataHasilQcService;

    public function __construct(DataHasilQcService $dataHasilQcService)
    {
        $this->middleware("check-permission:{$this->menu},create")->only(['create', 'store']);
        $this->middleware("check-permission:{$this->menu},read")->only(['index', 'show']);
        $this->middleware("check-permission:{$this->menu},update")->only(['edit', 'update']);
        $this->middleware("check-permission:{$this->menu},delete")->only(['destroy']);

        $this->dataHasilQcService = $dataHasilQcService;
    }

public function index(Request $request): View|JsonResponse
{
    $data = DataHasilQc::with('masterProduk')->select('data_hasil_qc.*');

    $search = $request->input('search');

    if ($search) {
        $columns = [
            'data_hasil_qc.nama_mesin',
            'data_hasil_qc.jenis_bahan',
            'data_hasil_qc.aql_check',
            'data_hasil_qc.status_pre',
            'data_hasil_qc.tanggal',
        ];

        $data->where(function ($query) use ($search, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $search . '%');
            }

            $query->orWhereHas('masterProduk', function ($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%');
            });
        });
    }

    $data = $data->get();

    if ($request->ajax()) {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', fn($row) => $row->tanggal ? Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') : '-')
            ->addColumn('nama_produk', fn($row) => optional($row->masterProduk)->nama_produk ?? '-')
            ->addColumn('action', fn($row) => ActionsHelper::renderActionButtons($row, 'data_hasil_qc.edit', $this->menu))
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('modules.data_hasil_qc.index');
}


    private function selectColumn(): array
    {
        $columns = Schema::getColumnListing('data_hasil_qc');
        $filteredColumns = array_filter($columns, function($col) {
            return $col != 'nama_produk';
        });

        $dhqcColumn = [];
        foreach ($filteredColumns as $value) {
            $dhqcColumn[] = 'data_hasil_qc.' . $value;
        }

        $columns = [
            'master_produk.nama_produk',
        ];

        $columns = array_merge($dhqcColumn, $columns);

        return $columns;

    }

    public function create(): View|Factory
    {

        return view('modules.data_hasil_qc.form',[
            'data' => new DataHasilQc(),
            'produks' => MasterProduk::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataHasilQcRequest $request): JsonResponse
    {
        $DataHasilQc = new DataHasilQc();

        $result = $this->dataHasilQcService->saveData($request, $DataHasilQc);
        
        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $id): View|Factory
    {
        $data = DataHasilQc::findOrFail($id);
        return view('modules.data_hasil_qc.form',[
            'data' => $data,
            'produks' => MasterProduk::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataHasilQcRequest $request, $id): JsonResponse
    {
        $DataHasilQc = DataHasilQc::findOrFail($id);

        $result = $this->dataHasilQcService->saveData($request, $DataHasilQc);

        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->dataHasilQcService->delete($request->id);
        return response()->json(['text' => $result['message']], $result['status_code']);
    }
}