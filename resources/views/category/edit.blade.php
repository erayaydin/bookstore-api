@extends('layout.page')

@section('page.title', $category->name . ' Kategorisini Güncelle')

@push("breadcrumbs")
    <a href="{{ route('category.index') }}">Kategoriler</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('category.edit', ['category' => $category]) }}" class="breadcrumb--active">'{{ $category->name }}' Kategorisini Güncelle</a>
@endpush

@section('page.contents')
    <div class="intro-y flex items-center justify-center mt-8">
        <form action="{{ route('category.update', ['category' => $category]) }}" method="post" class="col-span-12">
            @csrf
            <input type="hidden" name="_method" value="PUT" />
            <div class="mt-5">
                <div class="intro-y col-span-12">
                    @include('category.form', ['category' => $category, 'parentCategory' => null])
                    <button class="button mt-3 w-full mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Kaydet </button>
                </div>
            </div>
        </form>
    </div>
@stop

@push('page.scripts')

@endpush
