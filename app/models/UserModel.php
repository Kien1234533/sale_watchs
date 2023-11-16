<?php
class UserModel extends Model
{
    // public function login($username, $password){
    //     $sql = parent::$connection->prepare('SELECT * FROM users  WHERE username=?');
    //     $sql->bind_param('s', $username);
    //     $user = parent::select($sql)[0];
    //     if(password_verify($password, $user['password'])){
    //         return $user;
    //     }
    //     return false;
        
    // }
    public function login($username, $password){
        $sql = parent::$connection->prepare('SELECT * FROM users  WHERE username=?');
        $sql->bind_param('s', $username);
        $user = parent::select($sql)[0];
        if(password_verify($password, $user['password'])){
            // Đăng nhập thành công -> trả về 0 hoặc 1 (role user)
            return $user['role'];
        }
        // đăng nhập thất bại -> trả về -1
        return -1;
    }
    
    
    public function addUser($username,$password,$name,$phone){
        $password = password_hash($password,PASSWORD_DEFAULT);
        $sql = parent::$connection->prepare("INSERT INTO `users` (`username`, `password`,`name`,`phone`) 
        VALUES (?,?,?,?);");
        $sql -> bind_param('sssi',$username,$password,$name,$phone);
        return $sql ->execute();
    }  
    public function getView($id){
        $sql = parent::$connection->prepare('UPDATE products set product_view = product_view+1 where id =?');
        $sql->bind_param('i',$id);
        return $sql ->execute();
    }
    //Tâm An
    public function addProduct_Cart($idUser, $idProduct)
    {
        $sql = parent::$connection->prepare('INSERT INTO `cart`(`id_user`, `id_product`) VALUES (?,?)');
        $sql->bind_param('ii',$idUser, $idProduct);
        return $sql ->execute();
    }
    // Tâm An
    public function getIdByUsername($username)
    {
        $sql = parent::$connection->prepare('SELECT id FROM users WHERE username=?');
        $sql->bind_param('s', $username);
        return parent::select($sql)[0]['id'];
    }

    // Tâm An: Lấy danh sách sản phẩm trong giỏ hàng của người mua
    public function getAllProductInCart($idUser)
    {
        $sql = parent::$connection->prepare('SELECT products.id, products.product_name,products.product_description,products.product_price,products.product_photo
        FROM cart, products
        WHERE cart.id_product = products.id AND `id_user` =?');
        $sql->bind_param('i', $idUser);
        return parent::select($sql);
    }
    public function deleteProductInCart($idUser, $idProduct)
    {
        $sql = parent::$connection->prepare('DELETE FROM `cart` WHERE `id_user`=? AND`id_product`=?');
        $sql->bind_param('ii', $idUser, $idProduct);
        return $sql ->execute();
    }
    public function deleteAllProductInCart($idUser)
    {
        $sql = parent::$connection->prepare('DELETE FROM `cart` WHERE `id_user`=?');
        $sql->bind_param('i', $idUser);
        return $sql ->execute();
    }
    public function countProductsInCart($idUser)
    {
        $sql = parent::$connection->prepare('SELECT COUNT(*)AS numberProductsInCart FROM `cart` WHERE `id_user`=?');
        $sql->bind_param('i', $idUser);
        return parent::select($sql)[0];     
    }    
    public function changePassword($idUser, $newPsas)
    {
        $newPsas = password_hash($newPsas,PASSWORD_DEFAULT);
        $sql = parent::$connection->prepare("UPDATE users SET password = ? WHERE id = ?");
        $sql -> bind_param('si',$newPsas,$idUser);
        return $sql ->execute();
    }
    public function getAllUser($username){
        $sql = parent::$connection->prepare('SELECT * from users where username = ?');
        $sql ->bind_param('s',$username);
        return parent::select($sql)[0];
    }
}