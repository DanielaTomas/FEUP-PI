const eventsContainer = $('#eventsContainer');
const eventContainer = $('#eventContainer');
//const eventTag = $('event')


window.onload = function organicUnitTheme() {
    const organicUnitName = $('#organicUnitName').html();
    console.log(organicUnitName);
    switch (organicUnitName) {
        case "FEUP":
            eventContainer.removeClass("bg-secondary").addClass("FEUP");
            eventsContainer.removeClass("bg-secondary").addClass("FEUP");
            break;
        case "FEP":
            console.log("FEP");
            eventContainer.removeClass("bg-secondary").addClass("FEP");
            eventsContainer.removeClass("bg-secondary").addClass("FEP");
            break;
        default:
            break;
    }
}

//organicUnitTheme();  // Call the function to execute it
