<?php

namespace App\Http\Controllers\Modules;

use App\Helpers\ActionsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LaporanHasilProduksiRequest;
use App\Models\LaporanHasilProduksi;
use App\Models\MasterProduk;
use App\Services\LaporanHasilProduksiService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

class LaporanHasilProduksiController extends Controller
{
    private $menu = 'Laporan Hasil Produksi';
    private $laporanHasilProduksiService;

    public function __construct(LaporanHasilProduksiService $laporanHasilProduksiService)
    {
        $this->middleware("check-permission:{$this->menu},create")->only(['create', 'store']);
        $this->middleware("check-permission:{$this->menu},read")->only(['index', 'show']);
        $this->middleware("check-permission:{$this->menu},update")->only(['edit', 'update']);
        $this->middleware("check-permission:{$this->menu},delete")->only(['destroy']);

        $this->laporanHasilProduksiService = $laporanHasilProduksiService;
    }

    public function index(Request $request):View|JsonResponse
    {
        $data = LaporanHasilProduksi::with('masterProduk')->select('laporan_hasil_produksi.*');

    $search = $request->input('search');

    if ($search) {
        $columns = [
            'laporan_hasil_produksi.mesin',
            'laporan_hasil_produksi.nama_operator',
            'laporan_hasil_produksi.acuan_sampling',
            'laporan_hasil_produksi.aql_check',
            'laporan_hasil_produksi.temuan_defect',
            'laporan_hasil_produksi.tanggal',
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

            $data = $data->get()->map(function ($item) {
        if ($item->tanggal) {
            $item->tanggal = Carbon::parse($item->tanggal)->translatedFormat('l, d F Y');
        }
        return $item;
    });
        
        if (request()->ajax()) {
            $dataTable = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_produk', fn($row) => optional($row->masterProduk)->nama_produk ?? '-')
            ->addColumn('action', fn($row) => ActionsHelper::renderActionButtons($row, 'laporan_hasil_produksi.edit', $this->menu))
            ->rawColumns(['action']); 
            
            return $dataTable->make(true);
        }
    
        return view('modules.laporan_hasil_produksi.index');
    }

public function exportPdf(Request $request)
{
    $query = LaporanHasilProduksi::with('masterProduk');

    // Filter tanggal
    if ($request->filled(['start_date', 'end_date'])) {
        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();
        $query->whereBetween('tanggal', [$start, $end]);
    }

    // Filter pencarian
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->orWhere('mesin', 'like', "%{$search}%")
              ->orWhere('nama_operator', 'like', "%{$search}%")
              ->orWhere('acuan_sampling', 'like', "%{$search}%")
              ->orWhere('aql_check', 'like', "%{$search}%")
              ->orWhere('status_produk', 'like', "%{$search}%")
              ->orWhere('temuan_defect', 'like', "%{$search}%")
              ->orWhere('tanggal', 'like', "%{$search}%")
              ->orWhereHas('masterProduk', function ($q2) use ($search) {
                  $q2->where('nama_produk', 'like', "%{$search}%");
              });
        });
    }

    $data = $query->get();

    $pdf = Pdf::loadView('modules.laporan_hasil_produksi.pdf', compact('data'))
              ->setPaper('a4', 'landscape');

    return $pdf->download('laporan_hasil_produksi.pdf');
}

    private function selectColumn(): array
    {
        $columns = Schema::getColumnListing('laporan_hasil_produksi');
        $filteredColumns = array_filter($columns, function($col) {
            return $col != 'nama_produk';
        });

        $dhqcColumn = [];
        foreach ($filteredColumns as $value) {
            $dhqcColumn[] = 'laporan_hasil_produksi.' . $value;
        }

        $columns = [
            'master_produk.nama_produk',
        ];

        $columns = array_merge($dhqcColumn, $columns);

        return $columns;
    }

    public function create(): View|Factory
    {

        return view('modules.laporan_hasil_produksi.form',[
            'data' => new LaporanHasilProduksi(),
            'produks' => MasterProduk::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaporanHasilProduksiRequest $request): JsonResponse
    {
        $LaporanHasilProduksi = new LaporanHasilProduksi();

        $result = $this->laporanHasilProduksiService->saveData($request, $LaporanHasilProduksi);
        
        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $id): View|Factory
    {
        $data = LaporanHasilProduksi::findOrFail($id);
        return view('modules.laporan_hasil_produksi.form',[
            'data' => $data,
            'produks' => MasterProduk::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LaporanHasilProduksiRequest $request, $id): JsonResponse
    {
        $LaporanHasilProduksi = LaporanHasilProduksi::findOrFail($id);

        $result = $this->laporanHasilProduksiService->saveData($request, $LaporanHasilProduksi);

        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->laporanHasilProduksiService->delete($request->id);
        return response()->json(['text' => $result['message']], $result['status_code']);
    }
}