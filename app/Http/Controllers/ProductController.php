<?php

namespace App\Http\Controllers;

use App\Helpers\ProductImageHandler;
use App\Helpers\ShoppingCartManager as HelpersShoppingCartManager;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Exception;
use ShoppingCartManager;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products.create',  compact('products', 'categories'));
    }

    public function storee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'required|string|max:255',
            'qtd' => 'required|numeric',
            'qtd_min' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }







    /**
     * Função responsável pela lógica de crição do usuário
     *
     * @param   Request           $request  [$request description]
     *
     * @return  RedirectResponse            [return description]
     */
    /*public function store(Request $request): RedirectResponse
    {
     
        $request->validate([
            'name' => 'required|string|max:255|unique:' . Product::class,
            'price' => 'required|numeric',
            'qtd' => 'required|numeric',
            'qtd_min' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      dd($request);
      exit('Aqui');
        // Crie o produto
    $product = new Product([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'qtd' => $request->input('qtd'),
        'qtd_min' => $request->input('qtd_min'),
        'category_id' => $request->input('category_id'),
    ]);
    $product->save();
     /*  // Manipule a imagem do produto se estiver presente
        ProductImageHandler::handleImage($product, $request);
        // Salve o produto no banco de dados
        $product->save();
        return redirect()->route('products.index')->with('success', 'Usuário cadastrado com sucesso.'); 
    }*/

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:' . Product::class,
            'price' => 'required|numeric',
            'desce' => 'required|string|max:255',
            'qtd' => 'required|numeric',
            'qtd_min' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Criação do produto
        $product = new Product([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'desce' => $request->input('desce'),
            'qtd' => $request->input('qtd'),
            'qtd_min' => $request->input('qtd_min'),
            'category_id' => $request->input('category_id'),
        ]);
    
        // Salva o produto para obter o ID
        $product->save();
        // Manipulação da imagem do produto
        ProductImageHandler::handleImage($product, $request);
        // Redireciona para a página de listagem com mensagem de sucesso
        return redirect()->route('products.index')->with('success', 'Produto cadastrado com sucesso.');
    }
    
    







    public function edit($id)
    {
        try {
            $product = Product::find($id);
            $categories = Category::all();
            if (!$product || !$categories) {
                $message = "Product not found or categories not available.";
                return view('products.create', ['error' => $message]);
            }
            return view('products.create', ['product' => $product, 'categories' => $categories]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }









    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qtd' => 'required|numeric',
            'qtd_min' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Manipulação da imagem e atualização dos campos do produto
        $product = Product::findOrFail($id);
        ProductImageHandler::handleImageEdit($product, $request);
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }
    











    public function updatee(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qtd' => 'required|numeric',
            'qtd_min' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product and category updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        }
        return redirect()->route('categories.index')->with('error', 'Category not found.');
    }
}
