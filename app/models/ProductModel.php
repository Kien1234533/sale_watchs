<?php
class ProductModel extends Model
{
    public function getAllProducts()
    {
        // $sql = parent::$connection->prepare('SELECT * FROM products');
        //SELECT *, (SELECT COUNT(*) FROM product_user WHERE product_user.product_id = products.id) AS pLike FROM `products`;
        $sql = parent::$connection->prepare('SELECT *, COUNT(product_user.user_id) AS pLike FROM `products` LEFT JOIN product_user ON products.id = product_user.product_id GROUP BY products.id;');

        return parent::select($sql);
    }
    public function getProductById($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM products WHERE id=?');
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }
    public function getProductByCategory($id)
    {
        $sql = parent::$connection->prepare('SELECT *
        FROM ((products_categories
               JOIN categories on products_categories.category_id = categories.id)
              JOIN products on products_categories.product_id = products.id)
        WHERE categories.id = ?');;
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    public function getCategoryByCategoies($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM `categories` WHERE id = ?');;
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    public function getAllProductsBySearch($search){
        $sql = parent::$connection->prepare('SELECT * FROM products  WHERE product_name like ?');
        $search = "%{$search}%";
        $sql->bind_param('s', $search);
        return parent::select($sql);
    }
    //nut like
    public function likeProductUser($productId, $userId)
    {
        $sql = parent::$connection->prepare('INSERT INTO `product_user`(`product_id`, `user_id`) VALUES (?, ?)');
        $sql->bind_param('ii', $productId, $userId);
        return $sql->execute();
    }
    public function getAllProductsByPage($page, $perPage){
        $start = ($page -1)*$perPage;
        $sql = parent::$connection->prepare('SELECT *, count(product_user.user_id) as pLike FROM 
        `products` left join product_user on product_id=product_user.product_id group by products.id limit ?,?;');
        $sql->bind_param('ii', $start,$perPage);
        return parent::select($sql);
    }
    public function getToTalItem(){
        $sql = parent::$connection->prepare('SELECT count(id) as Total_item FROM `products`');
        return parent::select($sql)[0]['Total_item'];
    }
    //Tâm An: chỉnh sửa thông tin sản phẩm
    public function editProduct($product_name,$product_description,$product_price,$product_photo,$id)
    {
        $sql = parent::$connection->prepare('UPDATE `products` SET `product_name`=?,`product_description`=?,`product_price`=?,`product_photo`=? WHERE `id`=?');
        $sql->bind_param('ssisi', $product_name, $product_description, $product_price, $product_photo, $id);
        return $sql->execute();
    }
     // DELETE
    public function deleteProduct($id)
    {
        $sql = parent::$connection->prepare('DELETE FROM `products` WHERE `id`=?');
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
     //add product
     public function addProduct($productName, $productDescription, $productPrice, $productPhoto){
         $sql = parent::$connection->prepare('INSERT INTO `products`(`product_name`, `product_description`, 
         `product_price`, `product_photo`) VALUES (?,?,?,?)');
         $sql->bind_param('ssis',$productName, $productDescription, $productPrice, $productPhoto);
         return $sql->execute();
     }
    public function getProductByIds($arrId)
    {
        $chamHoi = str_repeat('?,', count($arrId) - 1);
        $chamHoi .= '?';      
        $i = str_repeat('i', count($arrId));
        $sql = parent::$connection->prepare("SELECT * FROM products WHERE id IN ( $chamHoi ) ORDER BY FIELD(id, $chamHoi ) DESC");
        $sql->bind_param($i . $i, ...$arrId, ...$arrId);
        return parent::select($sql);
    }
    //AI LIKE cung dc
    public function likeProduct($id){
        $sql = parent::$connection->prepare("UPDATE `products` SET `product_like`=`product_like`+1 WHERE id = ?");
        $sql->bind_param('i',$id);
        return $sql->execute();
    }
    public function unlikeProduct($id){
        $sql = parent::$connection->prepare("UPDATE `products` SET `product_like`=`product_like`-1 WHERE id = ?");
        $sql->bind_param('i',$id);
        return $sql->execute();
    }
}