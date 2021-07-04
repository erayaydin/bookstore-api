<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
        <h2 class="font-medium text-base mr-auto">
            @if(isset($book))
                '{{ $book->name }}' Kitabını Güncelle
            @else
                Yani Kitap Ekle
            @endif
        </h2>
    </div>
    <div class="p-5" id="input">
        <div class="preview">
            <div class="mt-3">
                <label for="name">Kitap Adı</label>
                <input type="text" required class="input w-full border mt-2" name="name" id="name" @if(isset($book)) value="{{ old('name') ?? $book->name }}" @endif placeholder="Kitap Adı">
            </div>
            <div class="mt-3">
                <label for="isbn">ISBN</label>
                <input type="text" class="input w-full border mt-2" name="isbn" id="isbn" @if(isset($book)) value="{{ old('isbn') ?? $book->isbn }}" @endif placeholder="ISBN">
            </div>
            <div class="mt-3">
                <label for="published_at">Yayınlanma Tarihi</label>
                <input type="text" class="input w-full border mt-2" name="published_at" id="published_at" @if(isset($book)) value="{{ old('published_at') ?? $book->published_at->format('d.m.Y') }}" @endif placeholder="GG.AA.YYYY">
            </div>
            <div class="mt-3">
                <label for="publisher_id">Yayınevi</label>
                <select class="input w-full border mt-2" name="publisher_id" id="publisher_id">
                    <option value="">Seçiniz</option>
                    @foreach($publishers as $publisherId => $publisherName)
                        <option value="{{ $publisherId }}" @if(isset($book) && $book->publisher->id === $publisherId) selected @endif>{{ $publisherName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label for="authors">Yazarlar</label>
                <select class="input w-full border mt-2" name="authors[]" id="authors" multiple>
                    @foreach($authors as $authorId => $authorName)
                        <option value="{{ $authorId }}" @if(isset($book) && $book->authors()->where('authors.id', $authorId)->exists()) selected @endif>{{ $authorName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label for="pdf">PDF</label>
                <input type="file" @if(!isset($book)) required @endif class="input w-full border mt-2" name="pdf" id="pdf">
            </div>
            <div class="mt-3">
                <label for="image">Öne Çıkan Resim</label>
                <input type="file" @if(!isset($book)) required @endif class="input w-full border mt-2" name="image" id="image">
            </div>
        </div>
    </div>
</div>
