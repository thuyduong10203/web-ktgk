<x-laptop-layout title="{{ $laptop->tieu_de ?? 'Chi tiết laptop' }}">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('storage/image/' . $laptop->hinh_anh) }}" 
                     class="img-fluid border rounded" 
                     alt="{{ $laptop->tieu_de }}"
                     style="width: 100%;">
            </div>

            <div class="col-md-7">
                <h2 class="mb-3" style="color: #122333; font-weight: bold;">{{ $laptop->tieu_de }}</h2>
                
                <div class="mb-3">
                    <span style="font-size: 24px; color: #e74c3c; font-weight: bold;">
                        Giá: {{ number_format($laptop->gia, 0, ',', '.') }} VNĐ
                    </span>
                </div>

                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th style="width: 35%; background-color: #f8f9fa;">CPU</th>
                            <td>{{ $laptop->cpu ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">RAM</th>
                            <td>{{ $laptop->ram ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Ổ cứng</th>
                            <td>{{ $laptop->luu_tru ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Chip đồ họa</th>
                            <td>{{ $laptop->chip_do_hoa ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Nhu cầu</th>
                            <td>{{ $laptop->nhu_cau ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Màn hình</th>
                            <td>{{ $laptop->man_hinh ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Hệ điều hành</th>
                            <td>{{ $laptop->he_dieu_hanh ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- nút thêm vào giỏ hàng -->
                <form action="{{ route('cart.add') }}" method="POST" class="form-inline mt-3">
                    @csrf
                    <input type="hidden" name="id" value="{{ $laptop->id }}">
                    <label class="mr-2 font-weight-bold">Số lượng mua:</label>
                    <input type="number" name="quantity" value="1" min="1" class="form-control mr-2"
                        style="width: 80px;">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </form>
            </div>
        </div>

        <!-- thông tin khác -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h4 class="mb-3" style="color: #122333; border-bottom: 2px solid #122333; padding-bottom: 10px;">
                    Thông tin khác
                </h4>
                
                <table class="table table-bordered table-sm">
                    <tbody>
                        <tr>
                            <th style="width: 35%; background-color: #f8f9fa;">Khối lượng</th>
                            <td>{{ $laptop->khoi_luong ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Webcam</th>
                            <td>{{ $laptop->webcam ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Pin</th>
                            <td>{{ $laptop->pin ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Kết nối không dây</th>
                            <td>{{ $laptop->ket_noi_khong_day ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Bàn phím</th>
                            <td>{{ $laptop->ban_phim ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #f8f9fa;">Cổng kết nối</th>
                            <td>{!! $laptop->cong_ket_noi ?? 'N/A' !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-laptop-layout>