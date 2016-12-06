<?php
/**
 * Desenvolvedores: Beatriz Loffi Wensing May, Daniele Souza, Sinthia de Freitas e Tiago Murilo.
 */

function criptografiaNomeImg($file){

    $pathinfo = pathinfo($file);

    $nome_arquivo = MD5($pathinfo['filename'].time());

    $basenome = $nome_arquivo.'.'.$pathinfo['extension'];

    return $basenome;

}
?>
