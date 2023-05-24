const eventsContainer = $('#eventsContainer');
const eventContainer = $('#eventContainer');
const tags = $('.badge.bg-secondary.rounded-pill');
//const eventTag = $('event')

window.onload = function organicUnitTheme() {
    const organicUnitName = $('#organicUnitName').html();
    console.log(organicUnitName);
    switch (organicUnitName) {
        case "FEUP":
            eventContainer.removeClass("bg-secondary").addClass("FEUP");
            eventsContainer.removeClass("bg-secondary").addClass("FEUP");
            tags.each(function() {
                $(this).removeClass("bg-secondary").addClass("FEUP");
                $(this).removeClass("bg-secondary").addClass("FEUP");
            });
            break;
        case "FEP":
            eventContainer.removeClass("bg-secondary").addClass("FEP");
            eventsContainer.removeClass("bg-secondary").addClass("FEP");
            tags.each(function() {
                $(this).removeClass("bg-secondary").addClass("FEP");
                $(this).removeClass("bg-secondary").addClass("FEP");
            });
            break;
        default:
            break;
    }
}

//organicUnitTheme();  // Call the function to execute it
