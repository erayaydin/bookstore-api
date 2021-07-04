@extends('layout.page')

@section('page.title', 'Kategoriler')

@push("breadcrumbs")
    <a href="{{ route('category.index') }}" class="breadcrumb--active">Kategoriler</a>
@endpush

@section('page.contents')
    <div class="intro-y mt-10 flex flex-wrap sm:flex-no-wrap justify-between items-center">
        <h2 class="text-lg font-medium">
            Kategori Listesi
            @if ($parentCategory)
                / {{ $parentCategory->name }}
            @endif
        </h2>
        <a href="{{ route('category.create', ['parent' => $parentCategory?->id]) }}" class="button text-white bg-theme-1 shadow-md">
            Yeni @if ($parentCategory) Alt @endif Kategori Ekle
        </a>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">
        @if ($categories->count() > 0)
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                    <tr>
                        <th class="text-center whitespace-no-wrap">ID</th>
                        <th class="text-center whitespace-no-wrap" style="width: 50%;">Kategori Adı</th>
                        <th class="text-center whitespace-no-wrap">UUID</th>
                        <th class="text-center whitespace-no-wrap">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr class="intro-x">
                            <td class="text-center">{{$category->id}}</td>
                            <td class="text-center">{{$category->name}}</td>
                            <td class="text-center">{{$category->uuid}}</td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center text-theme-1 mr-3" href="{{ route('category.index', ['parent' => $category]) }}"> <i data-feather="list" class="w-4 h-4 mr-1"></i> Alt Kategoriler </a>
                                    <a class="flex items-center mr-3" href="{{ route('category.edit', ['category' => $category]) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Güncelle </a>
                                    <a class="flex items-center text-theme-6 delete" style="cursor: pointer;" data-action="{{ route('category.destroy', ['category' => $category]) }}" data-toggle="modal" data-target="#delete-confirmation-modal"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Sil </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $categories->render() !!}
            </div>
        @else
            @include('partials.no-record')
        @endif
    </div>

    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Silmek istediğinden emin misin?</div>
                <div class="text-gray-600 mt-2">Bu veriyi silmek istediğinizden emin misiniz?</div>
            </div>
            <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">İptal</button>
                <form id="deleteForm" method="post" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <button data-method="delete"  type="submit" class="button w-24 bg-theme-6 text-white">Sil</button>
                </form>
            </div>
        </div>
    </div>
@stop

@push('page.scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.js"  integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
    <script>
        $(".delete").click(function () {
            const selectedAction = $(this).data('action');
            $('#deleteForm').attr('action', selectedAction);
        });
    </script>
@endpush
