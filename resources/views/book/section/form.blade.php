<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
        <h2 class="font-medium text-base mr-auto">
            @if(isset($bookSection))
                '{{ $bookSection->name }}' Bölümünü Güncelle
            @else
                Yani @if($parentSection) Alt @endif Bölüm Ekle
            @endif
        </h2>
    </div>
    @if($parentSection)
        <input type="hidden" name="parent_id" value="{{ $parentSection->id }}" />
    @endif
    <div class="p-5" id="input">
        <div class="preview">
            <div class="mt-3">
                <label for="name">Bölüm Adı</label>
                <input type="text" required class="input w-full border mt-2" name="name" id="name" @if(isset($bookSection)) value="{{ old('name') ?? $bookSection->name }}" @endif placeholder="Bölüm Adı">
            </div>
            <div class="mt-3">
                <label for="page">Başlangıç Sayfa Numarası</label>
                <input type="text" required class="input w-full border mt-2" name="page" id="page" @if(isset($bookSection)) value="{{ old('page') ?? $bookSection->page }}" @endif placeholder="Bölümün başladığı sayfa numarası">
            </div>
        </div>
    </div>
</div>
