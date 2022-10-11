<?php

// Funcao limpar URL
function cleanUrl($url)
{
    // Caracteres nao aceitos
    $format_a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';

    // Caracteres aceitos
    $format_b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr________________________________________________________________________________________________';

    // Subtituir os caracteres nao aceitos pelo caracteres aceitos
    $content_strtr = strtr(utf8_decode($url), utf8_decode($format_a), $format_b);

    // Retirar o espaco em branco
    $content_replace = str_ireplace(" ", "", $content_strtr);

    // Retirar as tag
    $content_tag = strip_tags($content_replace);

    return $content_tag;
}
