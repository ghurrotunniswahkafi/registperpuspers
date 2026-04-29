<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminDashboardController extends Controller
{
    public function dashboard()
{
    $todayCount = Member::whereDate('created_at', today())->count();
    $reviewCount = Member::where('status', 'pending')->count();
    $memberCount = Member::where('status', 'selesai')->count();

    $members = Member::latest()->take(5)->get();

    $todayCount = DB::table('members')
        ->whereDate('created_at', today())
        ->count();

    $totalMembers = DB::table('members')->count();

    $percentage = $totalMembers > 0 
        ? round(($todayCount / $totalMembers) * 100)
        : 0;

    // Data diagram garis berdasarkan asal_alamat
    $asalData = Member::selectRaw('asal_alamat, COUNT(*) as total')
        ->groupBy('asal_alamat')
        ->pluck('total', 'asal_alamat');

    $chartLabels = $asalData->keys();
    $chartValues = $asalData->values();

    // Data donut
    $soloRaya = Member::whereIn('asal_alamat', [
        'Surakarta',
        'Sukoharjo',
        'Karanganyar'
    ])->count();

    $lainnya = Member::whereNotIn('asal_alamat', [
        'Surakarta',
        'Sukoharjo',
        'Karanganyar'
    ])->count();

    return view('admin.dashboard', compact(
        'todayCount',
        'reviewCount',
        'memberCount',
        'members',
        'chartLabels',
        'chartValues',
        'soloRaya',
        'lainnya',
        'percentage'
    ));
}

    public function deleteDataAnggota(Member $member)
    {
        $member->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data anggota berhasil dihapus.');
    }

    public function verifikasi()
    {
        $belumDitinjau = Member::where('status', 'pending')->count();
        $sudahDiverifikasi = Member::whereIn('status', ['validasi', 'selesai'])->count();

        $members = Member::where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.verifikasi.index', compact(
            'belumDitinjau',
            'sudahDiverifikasi',
            'members'
        ));
    }

    public function showVerifikasi(Member $member)
    {
        return view('admin.verifikasi.show', compact('member'));
    }

    public function setujui(Member $member)
    {
        $member->update([
            'status' => 'selesai',
        ]);

        return redirect()->route('admin.verifikasi');
    }

    public function tolak(Request $request, Member $member)
    {
        $member->update([
            'status' => 'ditolak',
        ]);

        return redirect()->route('admin.verifikasi');
    }
    public function dataAnggota()
    {
        $members = Member::where('status', 'selesai')
            ->latest()
            ->get();

        return view('admin.data-anggota.index', compact('members'));
    }

    public function showDataAnggota(Member $member)
    {
        return view('admin.data-anggota.show', compact('member'));
    }

    public function updateDataAnggota(Request $request, Member $member)
    {
        $member->update([
            'nama' => $request->nama,
            'asal_alamat' => $request->asal_alamat,
            'no_identitas' => $request->no_identitas,
            'tempat' => $request->tempat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'sosmed' => $request->sosmed,
            'instansi' => $request->instansi,
            'alamat_instansi' => $request->alamat_instansi,
        ]);

        return redirect()->route('admin.data-anggota.show', $member->id);
    }

    public function destroyDataAnggota(Member $member)
    {
        $member->delete();

        return redirect()->route('admin.data-anggota')
            ->with('success', 'Data berhasil dihapus');
    }

    public function laporan(Request $request)
    {
        $periode = $request->periode;

        $query = DB::table('members')
            ->where('status', 'selesai');

        if ($periode) {
            $query->whereMonth('created_at', substr($periode, 5, 2))
                ->whereYear('created_at', substr($periode, 0, 4));
        }

        $members = $query->get();

        return view('admin.laporan', compact('members'));
    }

    public function exportExcel(Request $request)
    {
        $periode = $request->periode;

        $query = DB::table('members');

        if ($periode) {
            $query->whereMonth('created_at', substr($periode, 5, 2))
                ->whereYear('created_at', substr($periode, 0, 4));
        }

        $members = $query->get();

        $filename = 'laporan.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($members) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['No', 'Nama', 'Asal', 'Tanggal Daftar']);

            foreach ($members as $index => $member) {
                fputcsv($file, [
                    $index + 1,
                    $member->nama,
                    $member->asal_alamat,
                    $member->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $periode = $request->periode;

        $query = DB::table('members');

        if ($periode) {
            $query->whereMonth('created_at', substr($periode, 5, 2))
                ->whereYear('created_at', substr($periode, 0, 4));
        }

        $members = $query->get();

        $pdf = Pdf::loadView('admin.pdf.laporan', compact('members'));

        return $pdf->download('laporan.pdf');
    }

}