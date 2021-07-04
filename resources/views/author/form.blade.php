<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
        <h2 class="font-medium text-base mr-auto">
            @if(isset($author))
                '{{ $author->name }}' Yazarını Güncelle
            @else
                Yani Yazar Ekle
            @endif
        </h2>
    </div>
    <div class="p-5" id="input">
        <div class="preview">
            <div class="mt-3">
                <label for="name">Yazar Adı</label>
                <input type="text" required class="input w-full border mt-2" name="name" id="name" @if(isset($author)) value="{{ old('name') ?? $author->name }}" @endif placeholder="Yazar Adı">
            </div>
            <div class="mt-3">
                <label for="image">Öne Çıkan Resim</label>
                <input type="file" @if(!isset($author)) required @endif class="input w-full border mt-2" name="image" id="image">
            </div>
        </div>
    </div>
</div>
