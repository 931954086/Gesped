<?php
namespace App\Helpers;

class AllHelper
{
    public static function validarNIF($nif)
    {
        // Remover espaços em branco e traços
        $nif = strtoupper(str_replace([' ', '-'], '', $nif));

        // Verificar se tem exatamente 14 caracteres
        if (strlen($nif) != 14) {
            return false;
        }

        // Verificar os primeiros 9 caracteres são dígitos
        if (!ctype_digit(substr($nif, 0, 9))) {
            return false;
        }

        // Verificar os próximos 2 caracteres são letras
        if (!ctype_alpha(substr($nif, 9, 2))) {
            return false;
        }

        // Verificar os últimos 3 caracteres são alfanuméricos
        if (!ctype_alnum(substr($nif, 11, 3))) {
            return false;
        }

        return true;
    }
}

/*
<div class="form-group">
    <label for="customer_id">Selecione o Cliente</label>
    <select name="customer_id" id="customer_id" class="form-control" required>
        <option value="">Selecione um cliente</option>
        @foreach($customers as $customer)
        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>
</div> */
// Exemplo de uso:
$numeroNIF = "007420639ZE046";
if (NIFHelper::validarNIFAngolano($numeroNIF)) {
    echo "O NIF angolano é válido.";
} else {
    echo "O NIF angolano não é válido.";
}

?>


