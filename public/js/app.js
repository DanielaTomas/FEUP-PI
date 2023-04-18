//import './bootstrap';

const today = new Date();

const xmas = new Date('2023-12-01').getMonth();
const easter = new Date('2023-04-01').getMonth();
const halloween = new Date('2023-10-01').getMonth();
const newYear = new Date('2023-01-01').getMonth();

const homeIcon = document.querySelector('#home');

    /*check if december  */
    if(today.getMonth() === xmas){
        const xmasIcon =document.querySelector('#xmas');
        xmasIcon.style.display = "block";
        homeIcon.style.display = "none";
    }
    /*check if april */
    else if(today.getMonth() === easter){
        const easterIcon =document.querySelector('#easter');
        easterIcon.style.display = "block";
        homeIcon.style.display = "none";
    }
    else if(today.getMonth() === halloween){
        const halloweenIcon = document.querySelector('#halloween');
        halloweenIcon.style.display = "block";
        homeIcon.style.display = "none";
    }
    else if(today.getMonth() === newYear){
        const newYearIcon = document.querySelector('#newYear');
        newYearIcon.style.display = "block";
        homeIcon.style.display = "none";
    }


const editeventform=document.querySelector('#editeventform');
const editeventformbtn=document.querySelector('#editeventbutton');

const intialFormData= new FormData(editeventform);

editeventform.addEventListener('input', () => {
    // Get the current form data
    const currentFormData = new FormData(editeventform);

    // Compare the current data with the initial data
    let hasChanges = false;
    for (const [name, value] of currentFormData) {
        if (value !== intialFormData.get(name)) {
            hasChanges = true;
            break;
        }  
    }  
    editeventformbtn.disabled = !hasChanges;
    });