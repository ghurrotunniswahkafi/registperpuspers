@extends('layouts.admin')

@section('title', 'USER')

@section('content')

<section class="verify-card member-list-card user-list-card">
    <div class="table-head">
        <h2>Daftar akun user</h2>
        <small>{{ $users->count() }} akun</small>
    </div>

    <table class="user-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Formulir</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                @php
                    $member = $membersByEmail->get($user->email);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>
                        <span class="avatar">
                            @if($user->google_avatar)
                                <img src="{{ $user->google_avatar }}" alt="{{ $user->name }}">
                            @else
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            @endif
                        </span>
                        {{ $user->name }}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="user-role">{{ str_replace('_', ' ', $user->role ?? '-') }}</span>
                    </td>
                    <td>
                        <span class="user-status {{ $member ? 'submitted' : 'empty' }}">
                            {{ $member ? ucfirst($member->status) : 'Belum submit' }}
                        </span>
                    </td>
                    <td>{{ optional($user->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-table">Belum ada akun user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>

@endsection
