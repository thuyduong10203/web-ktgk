<x-laptop-layout>
    <x-slot name="title">
        Laptop
    </x-slot>

<style>
.filter-btn {
    padding: 6px 14px;
    font-size: 14px;
    border-radius: 8px;
    border: 1px solid #dcdcdc;
    background-color: #f5f5f5;
    color: #333;
    text-decoration: none;
    transition: all 0.2s ease;
}

.filter-btn:hover {
    background-color: #eaeaea;
}

.filter-btn.active {
    background-color: #e0e0e0;
    border-color: #cfcfcf;
    font-weight: 500;
}
a {
    text-decoration: none;
    color: inherit;
}
</style>


    <div class="container mt-4">
        <div class="d-flex align-items-center justify-content-center gap-2">
            <span class="fw-semibold text-dark">Tìm kiếm theo</span>

            <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}"
               class="filter-btn {{ request('sort') === 'asc' ? 'active' : '' }}">
                Giá tăng dần
            </a>

            <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}"
               class="fi
               
               lter-btn {{ request('sort') === 'desc' ? 'active' : '' }}">
                Giá giảm dần
            </a>
        </div>

        @if(($keyword ?? '') !== '')
            <p class="mt-3 mb-2 text-center">Kết quả cho từ khóa: <strong>{{ $keyword }}</strong> ({{ $products->count() }} sản phẩm)</p>
        @endif

        <div class="list-laptop">
            @forelse($products as $product)
                <div class="laptop">
                    <a href="{{ route('laptop.chitiet', ['id' => $product->id]) }}">
                        <div class="p-2">
                            <img
                                src="{{ asset('storage/image/' . $product->hinh_anh) }}"
                                alt="{{ $product->tieu_de }}"
                                style="max-width:100%; height:150px; object-fit:contain;"
                            >
                        </div>
                        <div class="px-2 pb-2">
                            <div style="min-height:64px; font-weight:700;">{{ $product->tieu_de }}</div>
                            <div class="laptop-info mt-2" style="display:block; text-align:center;">
                                <strong style="color:red; font-style:italic;">{{ number_format($product->gia, 0, ',', '.') }} đ</strong>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="alert alert-warning mt-3" style="grid-column:1 / -1;">
                    Không tìm thấy laptop phù hợp với từ khóa.
                </div>
            @endforelse
        </div>
    </div>
</x-laptop-layout>
