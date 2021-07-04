@extends('layout.page')

@section('page.title', $publisher->name . ' Yayınevini Güncelle')

@push("breadcrumbs")
    <a href="{{ route('publisher.index') }}">Yayınevleri</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <a href="{{ route('publisher.edit', ['publisher' => $publisher]) }}" class="breadcrumb--active">'{{ $publisher->name }}' Yayınevini Güncelle</a>
@endpush

@section('page.contents')
    <div class="intro-y flex items-center justify-center mt-8">
        <form action="{{ route('publisher.update', ['publisher' => $publisher]) }}" method="post" class="col-span-12">
            @csrf
            <input type="hidden" name="_method" value="PUT" />
            <div class="mt-5">
                <div class="intro-y col-span-12">
                    @include('publisher.form', ['publisher' => $publisher])
                    <button class="button mt-3 w-full mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Kaydet </button>
                </div>
            </div>
        </form>
    </div>
@stop

@push('page.scripts')

@endpush
