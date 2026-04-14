<x-laptop-layout>
    <x-slot name="title">
        {{ $data->tieu_de }}
    </x-slot>

    <style>
        .detail-title {
            text-align: left;
            font-size: 24px;
            font-weight: 500;
            margin: 10px 0 16px;
            color: #222;
        }

        .info {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
            align-items: start;
            margin-bottom: 30px;
        }

        .laptop-price {
            font-size: 28px;
            color: #e74c3c;
            font-weight: bold;
            margin: 15px 0;
        }

        .price-label {
            font-weight: 400;
            color: #222;
            font-size: 16px;
        }

        .price-value {
            color: #e74c3c;
            font-weight: 700;
            font-style: italic;
            font-size: 15px;
        }

        .quantity-box {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
        }

        .quantity-box input {
            width: 80px;
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-add-cart {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-add-cart:hover {
            background-color: #0056b3;
        }

        .other-info {
            margin-top: 20px;
            padding-top: 10px;
            line-height: 1.65;
        }

        .spec-label {
            font-weight: 400;
        }

        .section-title {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 10px;
        }
    </style>



    <div class='info'>
        <div>
            <img src="{{ asset('storage/image/' . $data->hinh_anh) }}" style="max-width:100%; height:auto;" alt="{{ $data->tieu_de }}">
        </div>
        <div>
            <h4 class="detail-title">{{ $data->tieu_de }}</h4>
            <div class="spec-label">CPU: {{ $data->cpu ?? 'N/A' }}</div>
            <div class="spec-label">RAM: {{ $data->ram ?? 'N/A' }}</div>
            <div class="spec-label">Ổ cứng: {{ $data->luu_tru ?? 'N/A' }}</div>
            <div class="spec-label">Chip đồ họa: {{ $data->chip_do_hoa ?? 'N/A' }}</div>
            <div class="spec-label">Nhu cầu: {{ $data->nhu_cau ?? 'N/A' }}</div>
            <div class="spec-label">Màn hình: {{ $data->man_hinh ?? 'N/A' }}</div>
            <div class="spec-label">Hệ điều hành: {{ $data->he_dieu_hanh ?? 'N/A' }}</div>

            <div><span class="price-label">Giá:</span> <span class="price-value">{{ number_format($data->gia, 0, ',', '.') }} VNĐ</span></div>

            <div class="quantity-box">
                <b>Số lượng mua:</b>
                <input type="number" id="product-number" min="1" value="1">
                <button class="btn-add-cart" id="add-to-cart" data-id="{{ $data->id }}">Thêm vào giỏ hàng</button>
            </div>

            <div class="other-info">
                <div class="section-title">Thông tin khác</div>
                <div class="spec-label">Khối lượng: {{ $data->khoi_luong ?? 'N/A' }}</div>
                <div class="spec-label">Webcam: {{ $data->webcam ?? 'N/A' }}</div>
                <div class="spec-label">Pin: {{ $data->pin ?? 'N/A' }}</div>
                <div class="spec-label">Kết nối không dây: {{ $data->ket_noi_khong_day ?? 'N/A' }}</div>
                <div class="spec-label">Bàn phím: {{ $data->ban_phim ?? 'N/A' }}</div>
                <div class="spec-label">Cổng kết nối: {!! $data->cong_ket_noi ?? 'N/A' !!}</div>
            </div>
        </div>
    </div>
</x-laptop-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#add-to-cart').click(function () {
            var id = $(this).data('id');
            var num = parseInt($('#product-number').val(), 10) || 1;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "{{ route('cartadd') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                    'num': num
                },
                beforeSend: function () {
                    $('#add-to-cart').text('Đang xử lý...').prop('disabled', true);
                },
                success: function (data) {
                    $('#cart-number-product').html(data);
                    $('#add-to-cart').text('Thêm vào giỏ hàng').prop('disabled', false);
                    alert('Đã thêm vào giỏ hàng!');
                },
                error: function (xhr) {
                    $('#add-to-cart').text('Thêm vào giỏ hàng').prop('disabled', false);
                    if (xhr.status === 401) {
                        alert('Vui lòng đăng nhập để thêm vào giỏ hàng!');
                        window.location.href = "{{ route('login') }}";
                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                }
            });
        });
    });
</script>