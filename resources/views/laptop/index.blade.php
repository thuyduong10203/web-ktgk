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
       class="filter-btn {{ request('sort') === 'desc' ? 'active' : '' }}">
        Giá giảm dần
    </a>
</div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3 mb-4" style="flex: 0 0 20%; max-width: 20%;">
                    <div class="card h-100 border-0 shadow-sm">
                        <a href="{{ url('laptop/'.$product->id) }}" class="text-decoration-none text-dark">
                            <div class="ratio ratio-4x3 overflow-hidden bg-white">
                                <img src="{{ asset('storage/image/' . $product->hinh_anh) }}" width="150">               
                            </div>
                            <div class="card-body p-3">
                                <p style = 'text-align:center'><strong>{{ $product->tieu_de }}</strong></p>
                                <p style='color: red; text-align:center; font-style: italic;'><strong>{{ number_format($product->gia, 0, ',', '.') }} đ</strong></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-laptop-layout>
    @if($keyword !== '')
        <p class="mb-2">Kết quả cho từ khóa: <strong>{{ $keyword }}</strong> ({{ $laptops->count() }} sản phẩm)</p>
    @endif

    <div class="list-laptop">
        @forelse($laptops as $laptop)
            @php
                $imagePath = $laptop->hinh_anh
                    ? asset('storage/image/' . $laptop->hinh_anh)
                    : 'https://via.placeholder.com/220x150?text=Laptop';
            @endphp
            <div class="laptop">
                <div class="p-2">
                    <img
                        src="{{ $imagePath }}"
                        alt="{{ $laptop->tieu_de }}"
                        style="max-width:100%; height:150px; object-fit:contain;"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/220x150?text=Laptop';"
                    >
                </div>
                <div class="px-2 pb-2">
                    <div style="min-height:64px; font-weight:700;">{{ $laptop->tieu_de }}</div>
                    <div class="laptop-info mt-2" style="display:block; text-align:center;">
                        <strong style="color:#e53935; font-style:italic;">{{ number_format((float)$laptop->gia, 0, ',', '.') }} VNĐ</strong>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning mt-3" style="grid-column:1 / -1;">
                Không tìm thấy laptop phù hợp với từ khóa.
            </div>
        @endforelse
    </div>
</x-laptop-layout>
