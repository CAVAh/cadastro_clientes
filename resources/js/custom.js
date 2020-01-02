$(function() {
    $('.cep').mask('00000-000');
    $('.ddd').mask('00');
    $('.cod_ibge').mask('0000000');
    $('.date:not(.placeholder)').mask('00/00/0000');
    $('.date.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.money').mask("#.##0,00", {reverse: true});
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.phone').mask('(00) 0000-0000');
    $('.cellphone').mask('(00) 00000-0000');
});
