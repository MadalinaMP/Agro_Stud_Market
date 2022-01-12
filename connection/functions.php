<?php
    require_once "../connection/db_controller.php";

    class ShoppingCart extends DBController {
        function getAllProduct($query) {
            $productResult = $this->getDBResult($query);
            return $productResult;
        }
        
        function getUserIDCartItem($user_id) {    
            $query = "SELECT products.*, cart.cart_id as cart_id,cart.quantity FROM products, cart WHERE
            products.product_id = cart.product_id AND cart.user_id = ?";
            
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $user_id
                )
            );
        
            $cartResult = $this->getDBResult($query, $params);
            return $cartResult;
        }
        
        function getProductByID($product_id) {
            $query = "SELECT * FROM products WHERE product_id=?";
            
            $params = array(
                array(
                    "param_type" => "s",
                    "param_value" => $product_id
                )
            );
        
            $productResult = $this->getDBResult($query, $params);
            return $productResult;
        }

        function getCartItemByProduct($product_id, $user_id) {
            $query = "SELECT * FROM cart WHERE product_id = ? AND user_id = ?";
            
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $product_id
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $user_id
                )
            );

            $cartResult = $this->getDBResult($query, $params);
            return $cartResult;
        }

        function addToCart($product_id, $quantity, $user_id) {
            $query = "INSERT INTO cart (product_id,quantity,user_id) VALUES (?, ?, ?)";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $product_id
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $quantity
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $user_id
                )
            );
            
            $this->updateDB($query, $params);
        }

        function updateCartQuantity($quantity, $cart_id) {
            $query = "UPDATE cart SET quantity = ? WHERE cart_id= ?";
            
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $quantity
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $cart_id
                )
            );

            $this->updateDB($query, $params);
        }

        function deleteCartItem($cart_id) {
            $query = "DELETE FROM cart WHERE cart_id = ?";
            
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $cart_id
                )
            );

            $this->updateDB($query, $params);
        }

        function emptyCart($user_id) {
            $query = "DELETE FROM cart WHERE user_id = ?";
            
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $user_id
                )
            );

            $this->updateDB($query, $params);
        }
    }

    class Category extends DBController {
        function getAllCategory($query) {
            $categoryResult = $this->getDBResult($query);
            return $categoryResult;
        }
    }

    class User extends DBController {
        function getAllUsers($query) {
            $userResult = $this->getDBResult($query);
            return $userResult;
        }
    }
?>