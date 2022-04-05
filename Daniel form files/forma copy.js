// ELEMENTS 
const submitButtom = document.querySelector('#submit-butoni');
const formContainer = document.querySelector('.modal-container');
const overlay = document.querySelector('.overlay');
const casilleroNumberInput = document.querySelector('#casillero-number');
const nombreInput = document.querySelector('#nombre');
const apellidoInput = document.querySelector('#apellido');
const segundoApellidoInput = document.querySelector('#segundo-apellido');
const emailInput = document.querySelector('#email');


// HIDES FORM AND OVERLAY TO REVEAL THANKYOU PAGE BELOW
submitButtom.addEventListener('click', function(){
    console.log('working')
    // formContainer.classList.add('hide');
    // overlay.classList.add('hide');
})

// CODE THAT CREATES A CASILLERO NUMBER BASED ON INFORMATION PROVIDED BY USER
function createCasilleroNumber(){
    if (nombreInput.value != '' && apellidoInput.value != ''){
        const apellidoFirstThreeLetters = apellidoInput.value.toUpperCase().slice(0,3);
        const nombreFirstLetter = nombreInput.value.toUpperCase().slice(0,1);
        const currentMonth = (new Date().getMonth() + 1).toString();
        const currentYear = new Date().getFullYear().toString().slice(2);
        const randomThreeNumbers = Math.floor(Math.random() * (89 - 10) + 10);
        return casilleroNumberInput.value = nombreFirstLetter + apellidoFirstThreeLetters + randomThreeNumbers + currentMonth + currentYear;
    }
    
}

// when user presses a key while name and apellido values are not empty, then the create casillero function is called
window.addEventListener('keydown', createCasilleroNumber);







