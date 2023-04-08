//import './bootstrap';
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