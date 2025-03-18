@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kagegori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Kategori</div>
            
            <div class="card-body">
                {{ $dataTable->table() }}
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; float:right;">
                    <a href="{{ route('kategori.create') }}" 
                   style="display: flex; align-items: center; justify-content: center; font-size: 12px; padding: 5px 10px; width: 60px; height: 40px;" 
                   class="btn btn-primary">
                    Add
                </a>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush