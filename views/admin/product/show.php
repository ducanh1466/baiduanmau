<div class="row">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
                <tr>
                        <td><?= $pro['id'] ?></td>
                        <td><?= $pro['name'] ?></td>
                        <td><?= $pro['category_name'] ?></td>
                        <td><?= $pro['price'] ?></td>
                        <td><?= $pro['quantity'] ?></td>
                        <td><?= $pro['description'] ?></td>
                        <td><?= $pro['created_at'] ?></td>
                        <td>
                            <a href="<?=  BASE_URL_ADMIN . '&action=product-show&id=' . $pro['id'] ?>"
                             class="btn btn-info">Xem</a>
                            <a href="<?=  BASE_URL_ADMIN . '&action=product-edit&id=' . $pro['id'] ?>"
                             class="btn btn-warning ms-1 me-1 mb-1 mt-1">Sửa</a>
                            <a href="<?=  BASE_URL_ADMIN . '&action=product-delete&id=' . $pro['id'] ?>"
                             onclick="return confirm('Có chắc xóa không?')"
                             class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                <tr>
    
            </table>
        