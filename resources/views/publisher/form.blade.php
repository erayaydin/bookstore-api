<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
        <h2 class="font-medium text-base mr-auto">
            @if(isset($publisher))
                '{{ $publisher->name }}' Yayınevini Güncelle
            @else
                Yani Yayınevi Ekle
            @endif
        </h2>
    </div>
    <div class="p-5" id="input">
        <div class="preview">
            <div class="mt-3">
                <label for="name">Yayınevi Adı</label>
                <input type="text" required class="input w-full border mt-2" name="name" id="name" @if(isset($publisher)) value="{{ old('name') ?? $publisher->name }}" @endif placeholder="Yayınevi Adı">
            </div>
        </div>
    </div>
</div>
