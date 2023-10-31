// Função para validar CPF
export function validateCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf === '') return false;

    // Elimina CPFs inválidos conhecidos
    if (
    cpf.length !== 11 ||
    cpf === '00000000000' ||
    cpf === '11111111111' ||
    cpf === '22222222222' ||
    cpf === '33333333333' ||
    cpf === '44444444444' ||
    cpf === '55555555555' ||
    cpf === '66666666666' ||
    cpf === '77777777777' ||
    cpf === '88888888888' ||
    cpf === '99999999999'
    ) {
    return false;
    }

    // Valida 1º dígito
    let add = 0;
    for (let i = 0; i < 9; i++) {
    add += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let rev = 11 - (add % 11);
    if (rev === 10 || rev === 11) {
    rev = 0;
    }
    if (rev !== parseInt(cpf.charAt(9))) {
    return false;
    }

    // Valida 2º dígito
    add = 0;
    for (let i = 0; i < 10; i++) {
    add += parseInt(cpf.charAt(i)) * (11 - i);
    }
    rev = 11 - (add % 11);
    if (rev === 10 || rev === 11) {
    rev = 0;
    }
    if (rev !== parseInt(cpf.charAt(10))) {
    return false;
    }

    return true;
}
  
// Função para validar CNPJ
export function validateCNPJ(cnpj) {
    // Remove caracteres não numéricos
    cnpj = cnpj.replace(/[^\d]+/g, '');
  
    if (cnpj === '') return false;
  
    if (cnpj.length !== 14) return false;
  
    // Elimina CNPJs inválidos conhecidos
    if (
      cnpj === '00000000000000' ||
      cnpj === '11111111111111' ||
      cnpj === '22222222222222' ||
      cnpj === '33333333333333' ||
      cnpj === '44444444444444' ||
      cnpj === '55555555555555' ||
      cnpj === '66666666666666' ||
      cnpj === '77777777777777' ||
      cnpj === '88888888888888' ||
      cnpj === '99999999999999'
    ) {
      return false;
    }
  
    // Valida DVs
    let size = cnpj.length - 2;
    let numbers = cnpj.substring(0, size);
    let digits = cnpj.substring(size);
    let sum = 0;
    let pos = size - 7;
  
    for (let i = size; i >= 1; i--) {
      sum += parseInt(numbers.charAt(size - i)) * pos--;
      if (pos < 2) pos = 9;
    }
  
    const result = sum % 11 < 2 ? 0 : 11 - (sum % 11);
  
    if (result != digits.charAt(0)) return false;
  
    size = size + 1;
    numbers = cnpj.substring(0, size);
    sum = 0;
    pos = size - 7;
  
    for (let i = size; i >= 1; i--) {
      sum += parseInt(numbers.charAt(size - i)) * pos--;
      if (pos < 2) pos = 9;
    }
  
    const secondDigit = sum % 11 < 2 ? 0 : 11 - (sum % 11);
  
    if (secondDigit != digits.charAt(1)) return false;
  
    return true;
  }
  

  