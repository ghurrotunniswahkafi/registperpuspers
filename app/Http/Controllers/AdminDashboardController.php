<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
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

    $members = Member::where('status', 'selesai')->latest()->take(5)->get();

    $todayCount = DB::table('members')
        ->whereDate('created_at', today())
        ->count();

    $totalMembers = DB::table('members')->count();

    $percentage = $totalMembers > 0 
        ? round(($todayCount / $totalMembers) * 100)
        : 0;

    $dailyCounts = Member::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();

    $chartLabels = $dailyCounts->map(function ($item) {
        return \Carbon\Carbon::parse($item->tanggal)->format('d M Y');
    });

    $chartValues = $dailyCounts->map(function ($item) {
        return (int) $item->total;
    });

    $asalData = Member::selectRaw("COALESCE(asal_alamat, 'Tidak diketahui') as asal, COUNT(*) as total")
        ->groupBy('asal')
        ->orderByDesc('total')
        ->pluck('total', 'asal');

    $donutLabels = $asalData->keys();
    $donutValues = $asalData->values();
    $lastUpdated = now()->format('d/m/Y H:i');

    return view('admin.dashboard', compact(
        'todayCount',
        'reviewCount',
        'memberCount',
        'members',
        'chartLabels',
        'chartValues',
        'donutLabels',
        'donutValues',
        'lastUpdated',
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

    public function setujui(Request $request, Member $member)
    {
        $data = [
            'status' => 'selesai',
        ];

        if ($request->has('nomor_keanggotaan')) {
            $data['nomor_keanggotaan'] = $request->nomor_keanggotaan;
        }

        if ($request->has('jenis_keanggotaan')) {
            $data['jenis_keanggotaan'] = $request->jenis_keanggotaan;
        }

        $member->update($data);

        return redirect()->route('admin.verifikasi');
    }

    
    public function dataAnggota()
    {
        $members = Member::where('status', 'selesai')
            ->latest()
            ->get();

        return view('admin.data-anggota.index', compact('members'));
    }

    public function users()
    {
        $users = User::latest()->get();
        $membersByEmail = Member::select('email', 'status')
            ->get()
            ->keyBy('email');

        return view('admin.users.index', compact('users', 'membersByEmail'));
    }

    public function showDataAnggota(Member $member)
    {
        return view('admin.data-anggota.show', compact('member'));
    }

    public function updateDataAnggota(Request $request, Member $member)
    {
        $member->update([
            'nama' => $request->nama,
            'nomor_keanggotaan' => $request->nomor_keanggotaan,
            'jenis_keanggotaan' => $request->jenis_keanggotaan,
            'asal_alamat' => $request->asal_alamat,
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
        $periode = $this->getPeriode($request);
        $members = $this->getMembersSelesaiByPeriode($periode);

        return view('admin.laporan', compact('members', 'periode'));
    }

    public function exportExcel(Request $request)
    {
        $periode = $this->getPeriode($request);
        $members = $this->getMembersSelesaiByPeriode($periode);

        // Format bulan untuk filename
        $bulan = substr($periode, 5, 2);
        $tahun = substr($periode, 0, 4);
        $bulanText = $this->getBulanIndo($bulan) . '_' . $tahun;

        $filename = 'laporan_anggota_' . $bulanText . '.xlsx';

        return Excel::download(new MembersExport($members, $periode), $filename);
    }

    private function getBulanIndo($bulan)
    {
        $bulanIndo = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return $bulanIndo[$bulan] ?? $bulan;
    }

    public function exportPdf(Request $request)
    {
        $periode = $this->getPeriode($request);
        $members = $this->getMembersSelesaiByPeriode($periode);
        $periodeText = $this->getPeriodeText($periode);

        $pdf = Pdf::loadView('admin.pdf.laporan', compact('members', 'periodeText'));

        return $pdf->download('laporan_anggota_' . str_replace(' ', '_', $periodeText) . '.pdf');
    }

    private function getPeriode(Request $request)
    {
        return $request->filled('periode')
            ? $request->periode
            : now()->format('Y-m');
    }

    private function getMembersSelesaiByPeriode($periode)
    {
        return Member::where('status', 'selesai')
            ->whereMonth('created_at', substr($periode, 5, 2))
            ->whereYear('created_at', substr($periode, 0, 4))
            ->latest()
            ->get();
    }

    private function getPeriodeText($periode)
    {
        $bulan = substr($periode, 5, 2);
        $tahun = substr($periode, 0, 4);

        return $this->getBulanIndo($bulan) . ' ' . $tahun;
    }

}
