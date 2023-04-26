//import './bootstrap';

const currentYear = new Date().getFullYear();
const url = `https://date.nager.at/api/v3/PublicHolidays/${currentYear}/PT`;

function processHolidays(holidays) {
    /*if you want to test change today date, YYYY-MM-DD */
    const today = new Date();
    const homeIcon = document.querySelector('#home');

    const xmas = new Date(holidays['Christmas Day']);
    const xmasMonth = xmas.getMonth() + 1;
 
    const easter = new Date(holidays['Easter Sunday']);
    const easterMonth = easter.getMonth() + 1;

    /*holiday wont ever change so its fine, not in the API too*/
    const halloween = new Date('2023-10-31');
    const spookyMonth = halloween.getMonth() + 1;
    
    /*new Year */
    const newYear = new Date(holidays["New Year's Day"]);
    const newYearMonth = newYear.getMonth() + 1;

    switch(today.getMonth() + 1){
        /*check if december(12), make it last december */
        case xmasMonth:
            const xmasIcon =document.querySelector('#xmas');
            xmasIcon.style.display = "block";
            homeIcon.style.display = "none";
            break;
        /*check if april(4)*/
        case easterMonth:
            if(today.getDate() > easter.getDate()) break;
            console.log("april");
            const easterIcon =document.querySelector('#easter');
            easterIcon.style.display = "block";
            homeIcon.style.display = "none";
            break;
        /*check if october, its the spooky month */
        case spookyMonth:
            const halloweenIcon = document.querySelector('#halloween');
            halloweenIcon.style.display = "block";
            homeIcon.style.display = "none";
            break;
        /*check if new year, lasts one week */
        case newYearMonth:
            if(today.getDate() > 7) break;
            const newYearIcon = document.querySelector('#newYear');
            newYearIcon.style.display = "block";
            homeIcon.style.display = "none";
            break;
        default:
            console.log("no festivities");
            break;
    }
}

function getHolidays(callback) {
  let holidays = {};

  fetch(url)
    .then(response => response.json())
    .then(data => {
      data.forEach(holiday => {
        holidays[holiday.name] = holiday.date;
      });
      callback(holidays);
    })
    .catch(error => console.error(error));
}

getHolidays(processHolidays);


const editeventform=document.querySelector('#editeventform');
const editeventformbtn=document.querySelector('#editeventbutton');



if(editeventform!=null){
    const intialFormData= new FormData(editeventform);
    editeventform.addEventListener('input', () => {
        // Get the current form data
        const currentFormData = new FormData(editeventform);

        // Compare the current data with the initial data
        let hasChanges = false;
        for (const [name, value] of currentFormData) {
            if (value !== intialFormData.get(name)) {
                console.log("value: "+value+" initial: "+intialFormData.get(name))
                hasChanges = true;
                console.log("has changes")
                break;
            }
             
        }  
        editeventformbtn.disabled = !hasChanges;
        });
}
