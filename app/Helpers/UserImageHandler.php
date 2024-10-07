<?php
// app/Helpers/UserImageHandler.php

namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserImageHandler
{

    public static function handleImage($user, $request)
    {
        // Salvar o usuário para obter o ID atribuído
        $user->save();
        // Recarregar o modelo para obter o ID atribuído
        $user->refresh();
        // Criar o diretório do usuário com base no ID atribuído
        $caminhoDestino = "public/users/perfil/{$user->id}/";
        Storage::makeDirectory($caminhoDestino, 0775, true);
        
        if ($request->hasFile('image')) {
            // Se houver uma imagem enviada, salvar no diretório específico do usuário
            $imagem = $request->file('image');
            $nomeImagem = $imagem->getClientOriginalName();
            Storage::putFileAs($caminhoDestino, $imagem, $nomeImagem);
            $user->image = $nomeImagem;
        } else {
            // Se não houver uma imagem enviada, copiar a imagem padrão
            $caminhoImagemPadrao = "public/users/default/default.png";
            Storage::copy($caminhoImagemPadrao, $caminhoDestino . 'default.png');
            $user->image = 'default.png';
        }
        // Salvar o nome da imagem no banco de dados
        $user->save();
    }
    
    

    
    

public static function handleImageEdit($user, $request)
{
    // Verificar se uma nova imagem foi enviada
    if ($request->hasFile('image')) {
        $usuarioID = $user->id;
        $caminho = "public/users/perfil/{$usuarioID}/";

        // Obter o caminho completo do diretório de perfil do usuário
        $diretorioPerfil = public_path("storage/users/perfil/{$usuarioID}/");
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
        $user->image = $nomeImagem;
    }
    // Verificar se a senha foi fornecida e atualizar no banco de dados
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }
    // Atualizar os outros campos do usuário
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->status_id = $request->input('status_id');

    $user->save();
  }
}