<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    // ✅ FORM PAGE
    public function create()
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        
        // Check 1: Cek berdasarkan email yang di-submit di form
        $existingMember = Member::where('email', $userEmail)->first();
        
        // Check 2: Jika tidak ketemu email, cek juga field user_id jika ada
        if (!$existingMember && Member::where('email', strtolower($userEmail))->exists()) {
            $existingMember = Member::where('email', strtolower($userEmail))->first();
        }
        
        \Log::info('Form create check', [
            'user_id' => $userId,
            'user_email' => $userEmail,
            'existing_member' => $existingMember ? $existingMember->id : null
        ]);
        
        if ($existingMember) {
            // User sudah submit form sebelumnya, redirect ke success page
            \Log::info('User already has member record, redirecting to success', [
                'member_id' => $existingMember->id
            ]);
            return redirect()->route('success');
        }
        
        // User belum submit, tampilkan form
        \Log::info('Showing form for new user');
        return view('member.form');
    }

    // ✅ SIMPAN DATA
    public function store(Request $request)
    {
        // PREVENT DOUBLE SUBMISSION: Check if user already submitted
        $userEmail = auth()->user()->email;
        $existingMember = Member::where('email', $userEmail)->first();
        
        if ($existingMember) {
            \Log::warning('User tried to submit form twice', [
                'user_id' => auth()->user()->id,
                'existing_member_id' => $existingMember->id
            ]);
            return redirect()->route('success', $existingMember->id)
                ->with('warning', 'Anda sudah pernah melakukan pengisian formulir sebelumnya.');
        }

        // Debug: Log incoming request
        \Log::info('Member form submitted', [
            'user' => auth()->user()->id ?? 'guest',
            'data_keys' => array_keys($request->all())
        ]);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:255',
            'asal_alamat' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|min:12|max:12',
            'email' => 'required|email|max:255',
            'sosmed' => 'nullable|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'alamat_instansi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'ktp' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'tanggal_lahir.before' => 'Tanggal lahir harus di masa lalu, bukan masa depan.',
            'no_hp.min' => 'Nomor HP harus 12 digit.',
            'no_hp.max' => 'Nomor HP harus 12 digit.',
        ]);

        // Validasi tambahan untuk pengesahan jika asal_alamat = Lainnya
        if ($request->asal_alamat === 'Lainnya') {
            $request->validate([
                'pengesahan_nama' => 'required|string|max:255',
                'pengesahan_jabatan' => 'required|string|max:255',
                'pengesahan_kenal' => 'required|boolean',
            ]);
            $data['pengesahan_nama'] = $request->pengesahan_nama;
            $data['pengesahan_jabatan'] = $request->pengesahan_jabatan;
            $data['pengesahan_kenal'] = $request->pengesahan_kenal ? true : false;
        }

        // Gunakan email dari authenticated user, bukan dari input form
        $data['email'] = $userEmail;

        // upload file
        $data['foto'] = $request->file('foto')->store('foto', 'public');
        $data['ktp'] = $request->file('ktp')->store('ktp', 'public');

        // default status
        $data['status'] = 'pending';

        // simpan ke DB
        try {
            $member = Member::create($data);
            \Log::info('Member created successfully', ['member_id' => $member->id, 'email' => $userEmail]);
            return redirect()->route('success');
        } catch (\Exception $e) {
            \Log::error('Error creating member: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data
            ]);
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // ✅ HALAMAN SUCCESS
    public function success()
    {
        // Get member data for authenticated user
        $member = Member::where('email', auth()->user()->email)->first();
        
        if (!$member) {
            // User belum submit form, redirect ke form
            return redirect()->route('form')->with('info', 'Silakan isi formulir terlebih dahulu.');
        }
        
        return view('member.success', compact('member'));
    }

    // ✅ GENERATE PDF
    public function pdf($id)
    {
        $member = Member::findOrFail($id);

        $pdf = Pdf::loadView('pdf.pdf1', compact('member'));
        return $pdf->download('formulir.pdf');
    }

    // ✅ PROFILE
    public function profile()
    {
        // Get member data for authenticated user
        $member = Member::where('email', auth()->user()->email)->first();
        
        if (!$member) {
            // User belum submit form, redirect ke form
            return redirect()->route('form')->with('info', 'Silakan isi formulir terlebih dahulu untuk melihat profil.');
        }
        
        return view('member.profile', compact('member'));
    }

    // ✅ STATUS
    public function status()
    {
        // Get member data for authenticated user
        $member = Member::where('email', auth()->user()->email)->first();
        
        if (!$member) {
            // User belum submit form, redirect ke form
            return redirect()->route('form')->with('info', 'Silakan isi formulir terlebih dahulu untuk melihat status.');
        }
        
        return view('member.status', compact('member'));
    }
}