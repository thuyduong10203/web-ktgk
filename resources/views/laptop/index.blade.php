<x-laptop-layout>
    <x-slot name="title">
        Laptop
    </x-slot>

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