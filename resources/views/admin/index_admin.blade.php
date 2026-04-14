<x-laptop-layout>
    <x-slot name="title">
        Quản lý sản phẩm
    </x-slot>

    <div class="container mt-4">
        <h3 class="text-center text-primary mb-4">QUẢN LÝ SẢN PHẨM</h3>
        
        <table id="laptopTable" class="table table-bordered table-striped">
            <thead class="bg-light">
                <tr>
                    <th>Tiêu đề</th>
                    <th>CPU</th>
                    <th>RAM</th>
                    <th>Ổ cứng</th>
                    <th>Khối lượng</th>
                    <th>Nhu cầu</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laptops as $laptop)
                <tr>
                    <td>{{ $laptop->tieu_de }}</td>
                    <td>{{ $laptop->cpu }}</td>
                    <td>{{ $laptop->ram }}</td>
                    <td>{{ $laptop->luu_tru }}</td>
                    <td>{{ $laptop->khoi_luong }}</td>
                    <td>{{ $laptop->nhu_cau }}</td>
                    <td>{{ $laptop->gia}}</td>
                    <td>
<img src="{{ asset('storage/image/' . $laptop->hinh_anh) }}" width="50">                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" title="Chức năng đang phát triển">Xem</a>
                        
                        <form action="{{ route('admin.laptop.softDelete', $laptop->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
$(document).ready(function() {
    $('#laptopTable').DataTable({
        "pageLength": 10, 
        "language": {
            "sLengthMenu": "_MENU_ entries per page",
            "sSearch": "Search:",
            "sEmptyTable": "Không có dữ liệu trong bảng",
            "sInfo": "Đang hiển thị từ _START_ đến _END_ của _TOTAL_ dữ liệu",
            "sInfoEmpty": "Đang hiển thị 0 đến 0 của 0 dữ liệu",
            "sInfoFiltered": "(được lọc từ _MAX_ dữ liệu)",
            "sZeroRecords": "Không tìm thấy kết quả phù hợp",
            "oPaginate": {
                "sFirst": "Đầu",
                "sLast": "Cuối",
                "sNext": "Tiếp",
                "sPrevious": "Trước"
            }
        },
        // Để placeholder "Nhập tìm kiếm..." xuất hiện trong ô input
        "initComplete": function() {
            $('#laptopTable_filter input').attr('placeholder', 'Nhập tìm kiếm...');
        }
    });
});
    </script>
</x-laptop-layout>