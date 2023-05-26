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
        case "FAUP":
                eventContainer.removeClass("bg-secondary").addClass("FAUP");
                eventsContainer.removeClass("bg-secondary").addClass("FAUP");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("FAUP");
                    $(this).removeClass("bg-secondary").addClass("FAUP");
                });
        break;
        case "FCNAUP":
                eventContainer.removeClass("bg-secondary").addClass("FCNAUP");
                eventsContainer.removeClass("bg-secondary").addClass("FCNAUP");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("FCNAUP");
                    $(this).removeClass("bg-secondary").addClass("FCNAUP");
                });
        break;
        case "FCUP":
                eventContainer.removeClass("bg-secondary").addClass("FCUP");
                eventsContainer.removeClass("bg-secondary").addClass("FCUP");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("FCUP");
                    $(this).removeClass("bg-secondary").addClass("FCUP");
                });
        break;
        case "FLUP":
                eventContainer.removeClass("bg-secondary").addClass("FLUP");
                eventsContainer.removeClass("bg-secondary").addClass("FLUP");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("FLUP");
                    $(this).removeClass("bg-secondary").addClass("FLUP");
                });
        break;
        case "FMUP":
                eventContainer.removeClass("bg-secondary").addClass("FMUP");
                eventsContainer.removeClass("bg-secondary").addClass("FMUP");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("FMUP");
                    $(this).removeClass("bg-secondary").addClass("FMUP");
                });
        break;
        case "FPCE":
                eventContainer.removeClass("bg-secondary").addClass("FPCE");
                eventsContainer.removeClass("bg-secondary").addClass("FPCE");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("FPCE");
                    $(this).removeClass("bg-secondary").addClass("FPCE");
                });
        break;
        case "ICBAS":
                eventContainer.removeClass("bg-secondary").addClass("ICBAS");
                eventsContainer.removeClass("bg-secondary").addClass("ICBAS");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("ICBAS");
                    $(this).removeClass("bg-secondary").addClass("ICBAS");
                });
        break;
        case "ISPUP":
                eventContainer.removeClass("bg-secondary").addClass("ISPUP");
                eventsContainer.removeClass("bg-secondary").addClass("ISPUP");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("ISPUP");
                    $(this).removeClass("bg-secondary").addClass("ISPUP");
                });
        break;
        case "UPDIGITAL":
                eventContainer.removeClass("bg-secondary").addClass("UPDIGITAL");
                eventsContainer.removeClass("bg-secondary").addClass("UPDIGITAL");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("UPDIGITAL");
                    $(this).removeClass("bg-secondary").addClass("UPDIGITAL");
                });
        break;
        case "REITORIA":
                eventContainer.removeClass("bg-secondary").addClass("REITORIA");
                eventsContainer.removeClass("bg-secondary").addClass("REITORIA");
                tags.each(function() {
                    $(this).removeClass("bg-secondary").addClass("REITORIA");
                    $(this).removeClass("bg-secondary").addClass("REITORIA");
                });
        break;
        default:
            break;
    }
}

//organicUnitTheme();  // Call the function to execute it
