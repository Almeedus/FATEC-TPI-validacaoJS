export function validateCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

    if (cpf.length !== 11) return false;

    // Validação do CPF
    var sum = 0;
    for (var i = 0; i < 9; i++) {
        sum += parseInt(cpf.charAt(i)) * (10 - i);
    }

    var remainder = sum % 11;
    if (remainder < 2) {
        if (parseInt(cpf.charAt(9)) !== 0) return false;
    } else {
        if (parseInt(cpf.charAt(9)) !== 11 - remainder) return false;
    }

    sum = 0;
    for (var i = 0; i < 10; i++) {
        sum += parseInt(cpf.charAt(i)) * (11 - i);
    }

    remainder = sum % 11;
    if (remainder < 2) {
        if (parseInt(cpf.charAt(10)) !== 0) return false;
    } else {
        if (parseInt(cpf.charAt(10)) !== 11 - remainder) return false;
    }

    return true;
}

function validateCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

    if (cnpj.length !== 14) return false;

    // Validação do CNPJ
    var sum = 0;
    var size = cnpj.length - 2;
    var digits = cnpj.substring(size);

    for (var i = 0; i < size; i++) {
        sum += parseInt(cnpj.charAt(i)) * size--;
        if (size < 2) size = 9;
    }

    var result = sum % 11 < 2 ? 0 : 11 - (sum % 11);

    if (result !== parseInt(digits.charAt(0))) return false;

    size = cnpj.length - 1;
    sum = 0;
    digits = cnpj.substring(size);

    for (var i = 0; i < size; i++) {
        sum += parseInt(cnpj.charAt(i)) * size--;
        if (size < 2) size = 9;
    }

    result = sum % 11 < 2 ? 0 : 11 - (sum % 11);

    return result === parseInt(digits.charAt(0));
}
