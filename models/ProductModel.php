<?php

class ProductModel extends BaseModel {
    // Top 4 san pham moi nhat
    public function getTop4Lastest() {
        $sql = "SELECT pro.*, pro_im.image_url 
        FROM `products` as pro LEFT JOIN product_images as pro_im
        ON pro.id = pro_im.product_id 
        AND pro_im.is_main = 1 ORDER BY pro.id DESC LIMIT 4;"; 
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // Danh sach san pham theo category
    public function getAll(){
        $sql = "SELECT pro.*, cat.name as category_name
        FROM `products` as pro
        JOIN categories as cat
        ON pro.category_id = cat.id
        ORDER BY pro.id DESC;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

    }
    // Get BY ID
    public function getByID($id) {
        $sql = "SELECT pro.*, cat.name as category_name
        FROM `products` as pro
        JOIN categories as cat
        ON pro.category_id = cat.id
        AND pro.id = :id;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
     public function delete($id) {
        // vẫn muốn xóa trong TH có bản ghi trong bảng con liên quan 
        // C1: Sửa lại mối quan hệ CASCADE, SET NULL
        // C2: Xóa bản ghi liên quan nếu CSDL vẫn dùng RETRIC
        // Xóa bảng con 
        $sql = "DELETE FROM `products` WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    // Lưu dữ liệu vào csdl
    public function insert($data) {
        // Lưu dữ liệu vào bảng products
        $sql = "INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `quantity`, `description`, `created_at`) 
        VALUES (NULL, ?, ?, ?, ?, ?, ? );";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$data['category_id'], $data['name'],  $data['price'], 
        $data['quantity'],  $data['description'], date('Y-m-d')]);

        // Lưu dữ liệu vào bảng product-images
        if($data['img_cover'] != null) {
            $sql = "INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `is_main`) VALUES 
             (NULL, ?, ?, '1');";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute([$this->pdo->lastInsertId(), $data['img_cover']]);
        }
    }

    // Cập nhật dữ liệu mới
    public function update($data, $id) {
        // Cập nhật dữ liệu vào bảng products
        $sql = "UPDATE `products` SET `category_id` = ?, `name` = ?, 
        `price` = ? , `quantity` = ?, `description` = ? WHERE `products`.`id` = ?;";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$data['category_id'], $data['name'],  $data['price'], 
        $data['quantity'],  $data['description'], $id ]);
        if ($data['img_cover'] != null) {
            // xóa ảnh cũ
            $sql = "DELETE FROM product_images WHERE product_id = ?";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            // thêm ảnh mới
            $sql = "INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `is_main`) VALUES 
             (NULL, ?, ?, '1');";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute([$id, $data['img_cover']]);
        }

    }
}