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
