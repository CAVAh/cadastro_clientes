$(function() {
    $('.cep').mask('00000-000');
    $('.ddd').mask('00');
    $('.cod_ibge').mask('0000000');
    $('.date:not(.placeholder)').mask('00/00/0000');
    $('.date.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.money').mask("#.##0,00", {reverse: true});
});
