@extends('layouts.admin')

@section('title', 'Akun')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Akun
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- Change Password -->
                <div class="card mb-4">
                    <h5 class="card-header">Ubah Password</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.account.updatePassword') }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="currentPassword">Password Saat Ini</label>
                                    <div class="input-group input-group-merge ">
                                        <input class="form-control @error('currentPassword') is-invalid @enderror"
                                            type="password" name="currentPassword" id="currentPassword"
                                            placeholder="············">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        @error('currentPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="newPassword">Password Baru</label>
                                    <div class="input-group input-group-merge ">
                                        <input class="form-control @error('newPassword') is-invalid @enderror"
                                            type="password" id="newPassword" name="newPassword" placeholder="············">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        @error('newPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="confirmPassword">Konfirmasi Password Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('confirmPassword') is-invalid @enderror"
                                            type="password" name="confirmPassword" id="confirmPassword"
                                            placeholder="············">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        @error('confirmPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="fw-medium mt-2">Persyaratan Password:</p>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">
                                            Minimal 8 Karakter
                                        </li>
                                        <li class="mb-1">Terdapat huruf kecil dan huruf besar</li>
                                        <li>Terdiri dari simbol dan angka</li>
                                    </ul>
                                </div>
                                <div class="col-12 mt-1">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                </div>
                            </div>
                            <input type="hidden">
                        </form>
                    </div>
                </div>
                <!--/ Change Password -->
            </div>
        </div>
    </div>
@endsection
