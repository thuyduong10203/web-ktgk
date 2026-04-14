<x-laptop-layout>
    <x-slot name='title'>
        Đặt hàng
    </x-slot>

    <div>
        <div style='color:#15c; font-weight:bold;font-size:15px;text-align:center'>DANH SÁCH SẢN PHẨM</div>

        <table class='book-table' style='margin:0 auto; width:70%' border='1' cellspacing='0' cellpadding='5'>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên laptop</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $tongTien = 0;
                @endphp
                @if(isset($data) && count($data) > 0)
                    @foreach($data as $key => $row)
                        @php
                            $soLuong = 0;
                            if(isset($quantity[$row->id])) {
                                if(is_array($quantity[$row->id])) {
                                    $soLuong = (int)($quantity[$row->id][0] ?? 0);
                                } else {
                                    $soLuong = (int)$quantity[$row->id];
                                }
                            }
                        @endphp
                        <tr>
                            <td align='center'>{{ $key + 1 }}</td>
                            <td>{{ $row->tieu_de }}</td>
                            <td align='center'>{{ $soLuong }}</td>
                            <td align='center'>{{ number_format($row->gia, 0, ',', '.') }}đ</td>
                            <td align='center'>
                                <form method='post' action="{{ route('cartdelete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type='hidden' value='{{ $row->id }}' name='id'>
                                    <input type='submit' class='btn btn-sm btn-danger' value='Xóa'>
                                </form>
                            </td>
                        </tr>
                        @php
                            $tongTien += $soLuong * $row->gia;
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan='3' align='center'><b>Tổng cộng</b></td>
                        <td><b>{{ number_format($tongTien, 0, ',', '.') }}đ</b></td>
                        <td></td>
                    </tr>
                @else
                    <tr>
                        <td colspan='5' align='center'>Chưa có sản phẩm trong giỏ hàng</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div style='font-weight:bold;width:70%;margin:0 auto;text-align:center;'>
            @if(session('success'))
                <div class='alert alert-success mt-2'>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class='alert alert-danger mt-2'>
                    {{ session('error') }}
                </div>
            @endif

            @auth
                @if(isset($data) && count($data) > 0)
                    <form method='post' action="{{ route('ordercreate') }}">
                        @csrf
                        Hình thức thanh toán <br>
                        <div class='d-inline-flex'>
                            <select name='hinh_thuc_thanh_toan' class='form-control form-control-sm'>
                                <option value='1'>Tiền mặt</option>
                                <option value='2'>Chuyển khoản</option>
                            </select>
                        </div><br>
                        <input type='submit' class='btn btn-sm btn-primary mt-1' value='ĐẶT HÀNG'>
                    </form>
                @else
                    Vui lòng chọn sản phẩm cần mua
                @endif
            @else
                Vui lòng <a href="{{ route('login') }}">đăng nhập</a> trước khi đặt hàng
            @endauth
        </div>
    </div>
</x-laptop-layout>