<?php

namespace App\Http\Controllers\Modules;

use App\Helpers\ActionsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\KelolaPermasalahanRequest;
use App\Models\KelolaPermasalahan;
use App\Models\MasterProduk;
use App\Services\KelolaPermasalahanService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;

class KelolaPermasalahanController extends Controller
{
    private $menu = 'Kelola Permasalahan';
    private $kelolaPermasalahanService;

    public function __construct(KelolaPermasalahanService $kelolaPermasalahanService)
    {
        $this->middleware("check-permission:{$this->menu},create")->only(['create', 'store']);
        $this->middleware("check-permission:{$this->menu},read")->only(['index', 'show']);
        $this->middleware("check-permission:{$this->menu},update")->only(['edit', 'update']);
        $this->middleware("check-permission:{$this->menu},delete")->only(['destroy']);

        $this->kelolaPermasalahanService = $kelolaPermasalahanService;
    }

    public function index(Request $request):View|JsonResponse
    {
        $data = KelolaPermasalahan::with('masterProduk')->select('kelola_permasalahan.*');

    $search = $request->input('search');

    if ($search) {
        $columns = [
            'kelola_permasalahan.mesin',
            'kelola_permasalahan.nama_operator',
            'kelola_permasalahan.penyebab',
            'kelola_permasalahan.permasalahan',
            'kelola_permasalahan.inline',
            'kelola_permasalahan.jam',
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
        
        if (request()->ajax()) {
            $dataTable = DataTables::of($data)
    ->addIndexColumn()
    ->addColumn('hari_tanggal', function ($row) {
        $tanggal = \Carbon\Carbon::parse($row->jam); // Asumsi field `jam` adalah datetime
        return $tanggal->translatedFormat('l, d F Y'); // Contoh: Senin, 16-06-2025
    })
    ->addColumn('nama_produk', fn($row) => optional($row->masterProduk)->nama_produk ?? '-')
    ->addColumn('jam_saja', function ($row) {
        $jam = \Carbon\Carbon::parse($row->jam);
        return $jam->format('H:i'); // Contoh: 14:30
    })
    ->addColumn('action', fn($row) => ActionsHelper::renderActionButtons($row, 'kelola_permasalahan.edit', $this->menu))
    ->rawColumns(['action']);
            
            return $dataTable->make(true);
        }
    
        return view('modules.kelola_permasalahan.index');
    }

    private function selectColumn(): array
    {
        $columns = Schema::getColumnListing('kelola_permasalahan');
        $filteredColumns = array_filter($columns, function($col) {
            return $col != 'nama_produk';
        });

        $dhqcColumn = [];
        foreach ($filteredColumns as $value) {
            $dhqcColumn[] = 'kelola_permasalahan.' . $value;
        }

        $columns = [
            'master_produk.nama_produk',
        ];

        $columns = array_merge($dhqcColumn, $columns);

        return $columns;

    }

    public function create(): View|Factory
    {

        return view('modules.kelola_permasalahan.form',[
            'data' => new KelolaPermasalahan(),
            'produks' => MasterProduk::get(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi
    $request->validate([
        'jam' => 'required',
        'mesin' => 'required',
        'nama_operator' => 'required',
        'nama_produk' => 'required',
        'permasalahan' => 'required',
        'inline' => 'required',
        'penyebab' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // validasi file
    ]);

    // Simpan data
    $data = $request->only([
        'jam',
        'mesin',
        'nama_operator',
        'nama_produk',
        'permasalahan',
        'inline',
        'penyebab',
    ]);

    // Jika ada file foto
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $filename = time() . '_' . $foto->getClientOriginalName();
        $foto->storeAs('public/kelola_permasalahan/foto', $filename);
        $data['foto'] = $filename;
    }

    KelolaPermasalahan::create($data);

    return redirect()->route('kelola_permasalahan')->with('success', 'Data berhasil disimpan');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Int $id): View|Factory
    {
        $data = KelolaPermasalahan::findOrFail($id);
        return view('modules.kelola_permasalahan.form',[
            'data' => $data,
            'produks' => MasterProduk::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelolaPermasalahanRequest $request, $id): JsonResponse
    {
        $KelolaPermasalahan = KelolaPermasalahan::findOrFail($id);

        $result = $this->kelolaPermasalahanService->saveData($request, $KelolaPermasalahan);

        return response()->json(['text' => $result['message']], $result['status_code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->kelolaPermasalahanService->delete($request->id);
        return response()->json(['text' => $result['message']], $result['status_code']);
    }
}