<?php
// app/Helpers/UserImageHandler.php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductImageHandler
{

    public static function handleImage($product, $request)
    {
        // Salvar o usuário para obter o ID atribuído
        $product->save();
        // Recarregar o modelo para obter o ID atribuído
        $product->refresh();
        // Criar o diretório do usuário com base no ID atribuído
        $caminhoDestino = "public/products/perfil/{$product->id}/";
        Storage::makeDirectory($caminhoDestino, 0775, true);
        
        if ($request->hasFile('image')) {
            // Se houver uma imagem enviada, salvar no diretório específico do usuário
            $imagem = $request->file('image');
            $nomeImagem = $imagem->getClientOriginalName();
            Storage::putFileAs($caminhoDestino, $imagem, $nomeImagem);
            $product->image = $nomeImagem;
        } else {
            // Se não houver uma imagem enviada, copiar a imagem padrão
            $caminhoImagemPadrao = "public/products/default/default.png";
            Storage::copy($caminhoImagemPadrao, $caminhoDestino . 'default.png');
            $product->image = 'default.png';
        }
        // Salvar o nome da imagem no banco de dados
        $product->save();
    }
    
    



    public static function handleImageEdit($product, $request)
    {
        // Verificar se uma nova imagem foi enviada
        if ($request->hasFile('image')) {
            $produtoID = $product->id;
          $caminho = "public/products/perfil/{$produtoID}/";

            // Obter o caminho completo do diretório de perfil do produto
            $diretorioPerfil = public_path("storage/products/perfil/{$produtoID}/");
    
            // Verificar se o diretório existe
            if (File::exists($diretorioPerfil)) {
                // Obter todas as imagens no diretório
                $imagensNoDiretorio = File::allFiles($diretorioPerfil);
                // Percorrer todas as imagens e excluí-las
                foreach ($imagensNoDiretorio as $imagem) {
                    File::delete($imagem->getPathname());
                }
            }
            // Processar a lógica para a nova imagem
            $imagem = $request->file('image');
            $nomeImagem = $imagem->getClientOriginalName();
            $imagem->storeAs($caminho, $nomeImagem);
            // Salvar o nome da nova imagem no banco de dados
            $product->image = $nomeImagem;
        }
        // Atualizar os outros campos do produto
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->qtd = $request->input('qtd');
        $product->qtd_min = $request->input('qtd_min');
        $product->category_id = $request->input('category_id');
    
        $product->save();
    }
}    