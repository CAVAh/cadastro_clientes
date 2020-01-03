function autocomplete(inp, arr, callback) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    let currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function () {
        let a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();

        if (!val) {
            return false;
        }

        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);

        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() === val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function () {
                    const value = this.getElementsByTagName("input")[0].value;

                    if(typeof callback === "function") {
                        callback(inp, value);
                    } else {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = value;
                    }

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });

    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        let x = document.getElementById(this.id + "autocomplete-list");

        if (x) {
            x = x.getElementsByTagName("div");
        }
		
		console.log(e.keyCode);

        if (e.keyCode === 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode === 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode === 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();

            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        } else if (e.keyCode === 9) {
			closeAllLists();
			
			if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            } else {
				$('#administrative_area_level_2').val('');
			}
		}
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) {
            return false;
        }

        /*start by removing the "active" class on all items:*/
        removeActive(x);

        if (currentFocus >= x.length) {
            currentFocus = 0;
        }

        if (currentFocus < 0) {
            currentFocus = (x.length - 1);
        }

        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (let i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        let x = document.getElementsByClassName("autocomplete-items");

        for (let i = 0; i < x.length; i++) {
            if (elmnt !== x[i] && elmnt !== inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

let autocompleteMap;

const componentForm = {
    route: 'long_name',
    street_number: 'short_name',
    //locality: 'long_name',
    administrative_area_level_1: 'short_name',
    administrative_area_level_2: 'long_name',
    country: 'long_name',
    postal_code: 'short_name',
    sublocality_level_1: 'long_name'
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search predictions to
    // geographical location types.
    autocompleteMap = new google.maps.places.Autocomplete(
        document.getElementById('route'), {types: ['geocode']});

    // Avoid paying for data that you don't need by restricting the set of
    // place fields that are returned to just the address components.
    autocompleteMap.setFields(['address_component']);

    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocompleteMap.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocompleteMap.getPlace();

    for (var component in componentForm) {
        if(document.getElementById(component)) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }
    }

    let street_number = '';

    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        if (componentForm[addressType]) {
            let value = place.address_components[i][componentForm[addressType]];

            if(addressType === 'street_number' && value.trim() !== '') {
                street_number = value;
            } else if(document.getElementById(addressType)) {
                document.getElementById(addressType).value = value;
            }
        }
    }

    if(street_number) {
        document.getElementById('route').value += ', ' + street_number;
    }
}

function validarCPF(cpf) {
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
}

$(document).ready(function () {
    $('.date').mask('00/00/0000', {placeholder: "__/__/____"});
    $('.cep').mask('00000-000');
    $('.phone').mask('(00) 0000-0000');
    $('.cellphone').mask('(00) 00000-0000');
    $('.cpf').mask('000.000.000-00').on('blur', function () {
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
    });
	$('#nro_apto').on('blur', function () {
		$(this).removeClass('is-valid is-invalid');
		
		if(nro_apto.includes($(this).val())) {
			$(this).addClass('is-valid');
		} else {
			$(this).addClass('is-invalid');
		}			 
	});
    autocomplete($('#country').get(0), countries);
    autocomplete($('#nro_apto').get(0), nro_apto);
    autocomplete($('#administrative_area_level_2').get(0), cidades, function(inp, value) {
        inp.value = value.substring(0, value.indexOf(' (')).trim();
        $('#administrative_area_level_1').val(value.substr(-3, 2));
    });

    $('#form').on('submit', function (e) {
        e.preventDefault();

        $('.cpf').each(function (i, x) {
            const $cpf = $(x);
            const cpf = $cpf.val();

            if(cpf) {
                if(!validarCPF(cpf)) {
                    $cpf.addClass('is-invalid');
                }
            }
        });

        return false;
    });
});