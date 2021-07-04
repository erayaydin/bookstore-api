<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
        <h2 class="font-medium text-base mr-auto">
            @if(isset($category))
                '{{ $category->name }}' Kategorisini Güncelle
            @else
                Yani @if($parentCategory) Alt @endif Kategori Ekle
            @endif
        </h2>
    </div>
    @if($parentCategory)
        <input type="hidden" name="parent_id" value="{{ $parentCategory->id }}" />
    @endif
    <div class="p-5" id="input">
        <div class="preview">
            <div class="mt-3">
                <label for="name">Kategori Adı</label>
                <input type="text" required class="input w-full border mt-2" name="name" id="name" @if(isset($category)) value="{{ old('name') ?? $category->name }}" @endif placeholder="Kategori Adı">
            </div>
        </div>
    </div>
</div>
