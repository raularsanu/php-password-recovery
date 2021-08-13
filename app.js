const divError = document.querySelector('.form-error-div');
const divSuccess = document.querySelector('.form-success-div');

if(divError.innerHTML === '') {
    divError.style.display = 'none';
} else {
    divError.style.display = 'block';
}

if(divSuccess.innerHTML === '') {
    divSuccess.style.display = 'none';
} else {
    divSuccess.style.display = 'block';
}