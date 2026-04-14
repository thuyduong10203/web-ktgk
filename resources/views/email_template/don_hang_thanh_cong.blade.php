<html>
    <head>
        <style>
            .book-table
            {
                border-collapse:collapse;
            }
            .book-table tr th
            {
                text-align:center;
            }
            .book-table tr th, .book-table tr td
            {
                border:1px solid #000;
                padding:3px;
            }
        </style>
    </head>
    <body>
    <div style='text-align:center;font-weight:bold;color:#15c;'>
        THÔNG TIN ĐƠN HÀNG
    </div>

    <table class='book-table' style='margin:0 auto; width:70%'>
        <thead>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
        </thead>
        <tbody>
            @php
                $tongTien = 0;
            @endphp
            @foreach($data as $key=>$row)
                <tr>
                    <td align='center'>{{$key+1}}</td>
                    <td>
                        @if(is_object($row))
                            {{$row->tieu_de}}
                        @else
                            {{$row['name'] ?? 'N/A'}}
                        @endif
                    </td>
                    <td align='center'>
                        @if(is_object($row))
                            {{$row->so_luong}}
                        @else
                            {{$row['quantity'] ?? 1}}
                        @endif
                    </td>
                    <td align='center'>
                        @php
                            if(is_object($row)) {
                                $price = $row->gia_ban ?? $row->gia ?? 0;
                                $qty = $row->so_luong ?? 1;
                            } else {
                                $price = $row['price'] ?? 0;
                                $qty = $row['quantity'] ?? 1;
                            }
                            $subtotal = $price * $qty;
                            $tongTien += $subtotal;
                        @endphp
                        {{number_format($price,0,',','.')}}đ
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan='3' align='center'><b>Tổng cộng</b></td>
                <td align='center'><b>{{number_format($tongTien,0,',','.')}}đ</b></td>
            </tr>
        </tbody>
    </table>
</body>
</html>