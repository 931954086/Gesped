<?php
namespace App\Helpers;
// Exemplo de classe estática para gestão de carrinho
class ShoppingCartManager {
    
    // Método estático para contar os produtos no carrinho
    public static function countCartItems() {
        // Obtém o carrinho da sessão
        $cart = session()->get('cart', []);
        
        $totalItems = 0;
        
        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
        }
        
        return $totalItems;
    }
    
}
?>

