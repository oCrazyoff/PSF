document.addEventListener('DOMContentLoaded', function() {
    var contatoInput = document.getElementById('contato');

    contatoInput.addEventListener('input', function(e) {
        var value = e.target.value.replace(/\D/g, '');
        var formattedValue = '';

        if (value.length > 0) {
            formattedValue += '(' + value.substring(0, 2);
        }
        if (value.length >= 3) {
            formattedValue += ')' + value.substring(2, 7);
        }
        if (value.length >= 8) {
            formattedValue += '-' + value.substring(7, 11);
        }

        e.target.value = formattedValue;
    });
});