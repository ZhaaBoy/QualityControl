<?php

namespace App\Http\Controllers\Modules;

use App\Helpers\ActionsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataHasilProduksiRequest;
use App\Models\DataHasilProduksi;
use App\Models\MasterProduk;
use App\Services\DataHasilProduksiService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

class DataHasilProduksiController extends Controller
{
    private $menu = 'Data Hasil Produksi';
    private $DataHasilProduksiService;

    public function __construct(DataHasilProduksiService $DataHasilProduksiService)
    {
        $this->middleware("check-permission:{$this->menu},create")->only(['create', 'store']);
        $this->middleware("check-permission:{$this->menu},read")->only(['index', 'show']);
        $this->middleware("check-permission:{$this->menu},update")->only(['edit', 'update']);
        $this->middleware("check-permission:{$this->menu},delete")->only(['destroy']);

        $this->DataHasilProduksiService = $DataHasilProduksiService;
    }

public function index(Request $request): View|JsonResponse
{
    // Gunakan with() untuk eager load relasi masterProduk
    $data = DataHasilProduksi::with('masterProduk')->select('data_hasil_produksi.*');

    $search = $request->input('search');

    if ($search) {
        $columns = [
            'data_hasil_produksi.mesin',
            'data_hasil_produksi.jenis_bahan',
            'data_hasil_produksi.acuan_sampling',
            'data_hasil_produksi.aql_check',
            'data_hasil_produksi.status_pre_order',
            'data_hasil_produksi.tanggal',
            'data_hasil_produksi.tanggal_start_awal',
        ];

        $data->where(function ($query) use ($search, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $search . '%');
            }

            // Pencarian nama produk dari relasi
            $query->orWhereHas('masterProduk', function ($q) use ($search) {
                $q->where('nama_produk', 'LIKE', '%' . $search . '%');
            });
        });
    }

    $data = $data->get();

    if ($request->ajax()) {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_produk', function ($row) {
                return optional($row->masterProduk)->nama_produk ?? '-';
            })
            ->addColumn('hari_tanggal', fn($row) =>
                $row->tanggal ? \Carbon\Carbon::parse($row->tanggal)->translatedFormat('l, d F Y') : '-'
            )
            ->addColumn('tanggal_start_awal', fn($row) =>
                $row->tanggal_start_awal ? \Carbon\Carbon::parse($row->tanggal_start_awal)->translatedFormat('l, d F Y') : '-'
            )
            ->addColumn('action', fn($row) =>
                ActionsHelper::renderActionButtons($row, 'data_hasil_produksi.edit', $this->menu)
            )
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('modules.data_hasil_produksi.index');
}

    private function selectColumn(): array
    {
        $columns = Schema::getColumnListing('data_hasil_produksi');
        $filteredColumns = array_filter($columns, function($col) {
            return $col !== 'nama_produk';
        });

        $dhpColumn = [];
        foreach ($filteredColumns as $value) {
            $dhpColumn[] = 'data_hasil_produksi.' . $value;
        }

        $columns = [
            'master_produk.nama_produk',
        ];

        $columns = array_merge($dhpColumn, $columns);

        return $columns;

    }

    public function create(): View|Factory
    {

        return view('modules.data_hasil_produksi.form',[
            'data' => new DataHasilProduksi(),
            'produks' => MasterProduk::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataHasilProduksiRequest $request): JsonResponse
    {
        $DataHasilProduksi = new DataHasilProduksi();

        $result = $this->DataHasilProduksiService->saveData($request, $DataHasilProduksi);
        
        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $id): View|Factory
    {
        $data = DataHasilProduksi::findOrFail($id);
        return view('modules.data_hasil_produksi.form',[
            'data' => $data,
            'produks' => MasterProduk::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataHasilProduksiRequest $request, $id): JsonResponse
    {
        $DataHasilProduksi = DataHasilProduksi::findOrFail($id);

        $result = $this->DataHasilProduksiService->saveData($request, $DataHasilProduksi);

        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->DataHasilProduksiService->delete($request->id);
        return response()->json(['text' => $result['message']], $result['status_code']);
    }
}