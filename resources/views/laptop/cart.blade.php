<x-laptop-layout title="Giỏ hàng">
    <div class="container mt-4">
        <div class="cart-header text-center mb-3">
            <h4 class="text-primary">DANH SÁCH SẢN PHẨM</h4>
        </div>

        @php $total = 0; @endphp
        <table class="table table-bordered text-center align-middle cart-table">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th class="text-left">Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-left">{{ $details['name'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ number_format($details['price'], 0, ',', '.') }}đ</td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table font-weight-bold">
                        <td colspan="3" class="text-center">Tổng cộng</td>
                        <td>{{ number_format($total, 0, ',', '.') }}đ</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="5">Giỏ hàng trống</td>
                    </tr>
                @endif
            </tbody>
        </table>

        @if(session('cart'))
            <div class="checkout-box text-center mt-4">
                <form action="{{ route('cart.checkout') }}" method="POST" class="d-inline-block text-left w-100">
                    @csrf
                    <div class="form-group row justify-content-center mb-3">
                        <label for="payment_method" class="col-form-label col-sm-4 text-sm-right">Hình thức thanh toán</label>
                        <div class="col-sm-4">
                            <select id="payment_method" name="payment_method" class="form-control">
                                <option value="1">Tiền mặt</option>
                                <option value="2">Chuyển khoản</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-4">ĐẶT HÀNG</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <style>
        .cart-table th,
        .cart-table td {
            vertical-align: middle;
        }

        .cart-table th.text-left,
        .cart-table td.text-left {
            text-align: left;
        }

        .checkout-box .form-group {
            margin-bottom: 1rem;
        }

        .checkout-box select.form-control {
            min-width: 220px;
        }

        @media (max-width: 576px) {
            .checkout-box .row {
                flex-direction: column;
            }
            .checkout-box label,
            .checkout-box .col-sm-4 {
                width: 100%;
                text-align: left;
            }
        }
    </style>
</x-laptop-layout>