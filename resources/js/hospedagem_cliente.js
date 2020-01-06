setYear2000 = function (_this) {
    let year = _this.val().substring(6);

    if (year > 0 && year < 100) {
        _this.val(_this.val().substring(0, 6) + '20' + year);
    }
};

strToDate = function (dateStr) {
    let dateParts = dateStr.split("/");
    return new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
};

$('#data_entrada,#data_saida').blur(function () {
    if ($(this).val()) {
        setYear2000($(this));
    }
});

$('#data_entrada').blur(function () {
    if ($(this).val()) {
        let date = strToDate($(this).val());
        date.setDate(date.getDate() + 1);
        $('#data_saida').val(date.toLocaleDateString('pt-BR'));
    } else {
        $('#data_saida').val('');
    }
});

$(function () {
    setTimeout(function () {
        $('#quarto_id').focus();
    }, 500);

    $(".chosen-select").chosen();
    $(".chosen-container-single").hover(function () {
        $(this).addClass("chosen-with-drop");
        $(this).addClass("chosen-container-active");
        $('.chosen-select').trigger("chosen:open");
    }, function () {
        $(this).removeClass("chosen-with-drop");
        $(this).removeClass("chosen-container-active");
    });
});
