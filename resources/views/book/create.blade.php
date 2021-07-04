@extends('layout.page')

@section('page.title', 'Yeni Kitap Ekle')

@push("breadcrumbs")
    <a href="{{ route('book.index') }}">Kitaplar</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('book.create') }}" class="breadcrumb--active">Yeni Kitap Ekle</a>
@endpush

@section('page.contents')
    <div class="intro-y flex items-center justify-center mt-8">
        <form action="{{ route('book.store') }}" method="post" class="col-span-12" enctype="multipart/form-data">
            @csrf
            <div class="mt-5">
                <div class="intro-y col-span-12">
                    @include('book.form', ['publishers' => $publishers, 'authors' => $authors])
                    <button class="button mt-3 w-full mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Kaydet </button>
                </div>
            </div>
        </form>
    </div>
@stop

@push('page.scripts')

@endpush
