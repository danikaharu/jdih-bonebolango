@extends('layouts.admin')

@section('title')
    Profil
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> Profil
        </h4>

        <div class="row">
            <div class="col-md-12">
                @include('admin.profile.include.tab')
                <div class="card mb-4">
                    <h5 class="card-header">{{ $profile->title }}</h5>
                    <!-- Profil -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            {!! $profile->body !!}
                        </div>

                        <a class="btn btn-md btn-primary mt-2"
                            href="{{ route('admin.profile.edit', $profile->slug) }}">Edit</a>

                    </div>
                    <!-- /Profil -->
                </div>
            </div>
        </div>
    </div>
@endsection
