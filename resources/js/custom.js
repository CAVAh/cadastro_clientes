validarCPF = function (cpf) {
    function validaDigito(cpf, nro_digito) {
        let add = 0;
        let aux = 9;

        if(nro_digito === 2) {
            aux = 10;
        }

        for (let i = 0; i < aux; i++) {
            add += parseInt(cpf.charAt(i)) * (aux + 1 - i);
        }

        let rev = 11 - (add % 11);

        if (rev === 10 || rev === 11) {
            rev = 0;
        }

        return rev === parseInt(cpf.charAt(aux));
    }

    cpf = cpf.replace(/[^\d]+/g,'');

    if(cpf === '') {
        return false;
    }

    // Elimina CPFs invalidos conhecidos
    if (cpf.length !== 11 || cpf === "00000000000" || cpf === "11111111111" || cpf === "22222222222" ||
        cpf === "33333333333" || cpf === "44444444444" || cpf === "55555555555" || cpf === "66666666666" ||
        cpf === "77777777777" || cpf === "88888888888" || cpf === "99999999999") {
        return false;
    }

    // Valida 1o digito
    if(!validaDigito(cpf, 1)) {
        return false;
    }

    // Valida 2o digito
    return validaDigito(cpf, 2)
};

cpfBlur = function () {
    const $cpf = $(this);
    const cpf = $cpf.val();
    $cpf.removeClass('is-valid is-invalid');

    if(cpf !== '') {
        if(validarCPF(cpf)) {
            $cpf.addClass('is-valid');
        } else {
            $cpf.addClass('is-invalid');
        }
    }
};

autocompleteDataNasc = function () {
    if ($(this).val()) {
        let year = parseInt($(this).val().substring(6), 10);

        if (year < 100) {
            const currentYear = (new Date()).getFullYear();

            if (2000 + year > currentYear) {
                year = 1900 + year;
            } else if (2000 + year === currentYear) {
                const currentDate = new Date().setHours(0, 0, 0, 0);
                const dateParts = $(this).val().split("/");
                const date = new Date(currentYear, dateParts[1] - 1, +dateParts[0]).setHours(0, 0, 0, 0);

                if (date >= currentDate) {
                    year = 1900 + year;
                } else {
                    year = 2000 + year;
                }
            } else {
                year = 2000 + year;
            }

            $(this).val($(this).val().substring(0, 6) + year);
        }
    }
};

$(function() {
    // Mask
    $('.cep.placeholder').mask('00000-000', {placeholder: "_____-___"});
    $('.cep:not(.placeholder)').mask('00000-000');
    $('.ddd').mask('00');
    $('.cod_ibge').mask('0000000');
    $('.date.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
    $('.date:not(.placeholder)').mask('00/00/0000');
    $('.money').mask("#.##0,00", {reverse: true});
    $('.cpf.placeholder').mask('000.000.000-00', {placeholder: "___.___.___-__"}).on('blur', cpfBlur);
    $('.cpf:not(.placeholder)').mask('000.000.000-00').on('blur', cpfBlur);
    $('.phone.placeholder').mask('(00) 0000-0000', {placeholder: '(__) ____-____'});
    $('.phone:not(.placeholder)').mask('(00) 0000-0000');
    $('.cellphone.placeholder').mask('(00) 00000-0000', {placeholder: '(__) _____-____'});
    $('.cellphone:not(.placeholder)').mask('(00) 00000-0000');

    // Anothers events
    $('input[id*=data_nasc]').blur(autocompleteDataNasc);
});
