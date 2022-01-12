<?php
    require_once "admin_db_controller.php";

    class Category extends DBController {
        function deleteCategory($category_id) {
            $query = "DELETE FROM categories WHERE category_id = ?";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $category_id
                )
            );

            $this->updateDB($query, $params);
        }

    }

    class Product extends DBController {
        function deleteProduct($product_id) {
            $query = "DELETE FROM products WHERE product_id = ?";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $product_id
                )
            );

            $this->updateDB($query, $params);
        }
    }

    class User extends DBController {
        function deleteUser($user_id) {
            $query = "DELETE FROM users WHERE user_id = ?";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $user_id
                )
            );

            $this->updateDB($query, $params);
        }
    }

    class Order extends DBController {
        function deleteOrder($order_id) {
            $query = "DELETE FROM orders WHERE order_id = ?";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $order_id
                )
            );

            $this->updateDB($query, $params);
        }
    }
?>