<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .customer-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .order-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 0 0 8px 8px;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Đơn hàng của bạn đã được xác nhận!</h1>
        </div>

        <div class="content">
            <p>Kính chào <strong>{{ $user->name ?? 'Quý khách' }}</strong>,</p>

            <p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi! Đơn hàng của bạn đã được xác nhận thành công và đang được xử lý.</p>

            <div class="customer-info">
                <h3>Thông tin khách hàng:</h3>
                <p><strong>Tên:</strong> {{ $user->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $user->email ?? 'N/A' }}</p>
                <p><strong>Ngày đặt:</strong> {{ date('d/m/Y H:i') }}</p>
            </div>

            <h3>Chi tiết đơn hàng:</h3>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $item)
                        @php
                            $price = $item['gia'] ?? 0;
                            $quantity = $item['so_luong'] ?? 1;
                            $subtotal = $price * $quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['ten_sp'] ?? 'N/A' }}</td>
                            <td>{{ $quantity }}</td>
                            <td>{{ number_format($price, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($subtotal, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                <p>Tổng cộng: {{ number_format($total, 0, ',', '.') }} VND</p>
            </div>

            <p><strong>Thông tin giao hàng:</strong></p>
            <p>Chúng tôi sẽ liên hệ với bạn trong vòng 24 giờ để xác nhận thông tin giao hàng.</p>

            <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi:</p>
            <ul>
                <li>Email: laptop.com</li>
                <li>Điện thoại: 0123 456 789</li>
                <li>Website: www.laptop.com</li>
            </ul>

            <a href="{{ url('/') }}" class="button">Tiếp tục mua sắm</a>
        </div>

    </div>
</body>
</html>