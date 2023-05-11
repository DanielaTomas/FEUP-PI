//import './bootstrap';

const currentYear = new Date().getFullYear();
const url = `https://date.nager.at/api/v3/PublicHolidays/${currentYear}/PT`;

const header = $('header');
const footer = $('footer');
const buttons = $('button');
const footerLinks = $('footer ul li').children();
const sideNav = $('#offcanvasExample');
const backContainer = $('#backContainer');
const backEventsContainer = $('#eventsContainer')
//const eventContainer = $('#eventContainer');
//const eventTag = $('#eventTag').children();
const adminContainer = $('#adminContainer')

function processHolidays(holidays) {
    /*if you want to test change today date, YYYY-MM-DD */
    const today = new Date("");
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
            const xmasIcon = document.querySelector("#xmas");

            header.removeClass("bg-dark").addClass("x-mas");
            footer.removeClass("bg-dark").addClass("x-mas");

            footerLinks.each(function() {
                $( this ).attr("class","nav-link px-2 text-light x-mas");
              });

              buttons.each(function() {
                /*this stops FAQ page from being broken*/
                if ($(this).attr("id") === "FAQbutton") {
                    console.log("hello");
                    return;
                }
                else if ($(this).attr("id") === "sideToggle"){
                    $(this).removeClass("bg-dark").addClass("x-mas");   
                }
                else if ($(this).attr("class") === "btn-close btn-close-white"){
                    return;
                }else{
                    $(this).removeClass("btn-secondary").addClass("x-mas");
                    $(this).removeClass("btn-primary").addClass("x-mas");;
                }

            });

            sideNav.removeClass("bg-dark").addClass("x-mas");
            backContainer.removeClass("bg-secondary").addClass("x-mas");
            backEventsContainer.removeClass("bg-secondary").addClass("x-mas");
            //eventContainer.attr("class","p-5 m-5 x-mas rounded min-height");
            adminContainer.removeClass("bg-secondary").addClass("x-mas");

            /*eventTag.each(function(){
                console.log("hello");
                $(this).attr("class","badge x-mas rounded-pill");
            });*/

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








/**
 * TODO: put things from here in their specific .js file
 */
const editeventform=document.querySelector('#editeventform');
const editeventformbtn=document.querySelector('#editeventbutton');



if(editeventform!=null){
    const intialFormData= new FormData(editeventform);
    console.log(intialFormData)
    editeventform.addEventListener('input', () => {
        // Get the current form data
        const currentFormData = new FormData(editeventform);

        // Compare the current data with the initial data
        let hasChanges = false;
        for (const [name, value] of currentFormData) {
            if(name=="flexdatalist-tags" && value==""){
                //console.log("no tags")
                hasChanges=false;
                break;
            }   
            if (value !== intialFormData.get(name)) {
                //console.log(name)
                //console.log("value: "+value+" initial: "+intialFormData.get(name))
                hasChanges = true;
                //console.log("has changes")
                break;
            }
            
            
        }
        
          
      
        editeventformbtn.disabled = !hasChanges;
    });
}



$('.flexdatalist').flexdatalist({
     selectionRequired: 1,
     minLength: 1
});

