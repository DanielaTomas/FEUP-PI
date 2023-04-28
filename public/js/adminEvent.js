/*
TODO: adicionar CSS com o AJAX nos elementos da tabela
 */
function getPaginatedData(page) {
    $.ajax({
        url: '/admin/eventsCurrent?page=' + page,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            let tbody = $('#CurrEventTable');

            //Clear tbody 
            tbody.empty();

            for (let i = 0; i < data.length ; i++) {
                let tr = $('<tr></tr>');
                let eventNameTd = $('<td></td>');
                let dateCreatedTd = $('<td></td>').html(data[i].datecreated);
                let requestTypeTd = $('<td></td>').html(data[i].requesttype);
                let requestStatusTd = $('<td></td>').html(data[i].requeststatus);
                let requestActions = $('<td></td>').html(data[i].datereviewed);

                let eventLink = $('<a></a>').html(data[i].eventnameenglish);;
                eventLink.attr("href",data[i].urlenglish);
                eventNameTd.append(eventLink);

                let eventEmail = $('<p></p>').html(data[i].emailcontact);
                eventEmail.attr("class","text-muted");
                eventNameTd.append(eventEmail);

                tr.append(eventNameTd);
                tr.append(dateCreatedTd);
                tr.append(requestTypeTd);
                tr.append(requestStatusTd);
                tr.append(requestActions);
               
                tbody.append(tr);
            }
            
            // modify the "Previous" link
            let prev = $('#pageCurr .previous a');
            prev.attr("href", response.prev_page_url);
            prev.attr("class", "page-link");
            prev.html("Previous");

            // modify the "Next" link
            let next = $("#pageCurr .next a");
            next.attr("href", response.next_page_url);
            next.attr("class", "page-link");
            next.html("Next");


        },
        error: function(xhr) {
            alert('Error retrieving data.');
        }
    });
}

function getPaginatedDataPend(page) {
    $.ajax({
        url: '/admin/eventsPending?page=' + page,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            let data = response.data;
            let tbody = $('#pendingTable');
            //let pagination = $('#pageCurr');

            //Clear tbody 
            tbody.empty();
           

            console.log(response);

            for (let i = 0; i < data.length ; i++) {
                let eventId = data[i].eventid;
                let tr = $('<tr></tr>');
                let eventNameTd = $('<td></td>').html(data[i].eventnameenglish);
                let dateCreatedTd = $('<td></td>').html(data[i].datecreated);
                let requestTypeTd = $('<td></td>').html(data[i].requesttype);
                let requestStatusTd = $('<td></td>').html(data[i].requeststatus);

                // create the form element
                // create the button element
                let buttonGreen = $('<button/>', {
                    class: 'btn btn-success',
                    text: 'Accept'
                });
                
                // create the form element and append the button to it
                /**
                 TODO: Backenders AJAX nisto
                 */
                let formAccept = $('<form/>', {
                    action: 'http://127.0.0.1:8000/requests/' + eventId+ '/Accepted',
                    method: 'POST',
                    data:{"_token": "{{ csrf_token() }}"}
                }).append(buttonGreen);

                let buttonRed = $('<button/>', {
                    class: 'btn btn-danger',
                    text: 'Reject'
                });

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // create the hidden input element for the CSRF token
                var csrfInput = $('<input/>', {
                type: 'hidden',
                name: '_token',
                value: csrfToken
                });

                // append the CSRF token input element to the form
                formAccept.append(csrfInput);
                
                // create the form element and append the button to it
                /**
                 TODO: Backenders AJAX nisto
                 */
                let formReject = $('<form/>', {
                    action: 'http://127.0.0.1:8000/requests/' + eventId+ '/Rejected',
                    method: 'POST',
                }).append(buttonRed);

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // create the hidden input element for the CSRF token
                var csrfInput = $('<input/>', {
                type: 'hidden',
                name: '_token',
                value: csrfToken
                });

                // append the CSRF token input element to the form
                formReject.append(csrfInput);
                
                // create the td element and append the form to it
                var td = $('<td></td>');
                td.attr("class", "d-flex");
                formAccept.attr("class","mx-1");
                td.append(formAccept);
                td.append(formReject);
                console.log(td);
                
                tr.append(eventNameTd);
                tr.append(dateCreatedTd);
                tr.append(requestTypeTd);
                tr.append(requestStatusTd);
                tr.append(td);
               
                tbody.append(tr);
            }
            
            // modify the "Previous" link
            let prev = $('#pagePend .previous a');
            prev.attr("href", response.prev_page_url);
            prev.attr("class", "page-link");
            prev.html("Previous");

            // modify the "Next" link
            let next = $("#pagePend .next a");
            next.attr("href", response.next_page_url);
            next.attr("class", "page-link");
            next.html("Next");

        },
        error: function(xhr) {
            alert('Error retrieving data.');
        }
    });
}

$(document).ready(function() {
    // Initialize pagination with the first page
    getPaginatedData(1);
    getPaginatedDataPend(1);

    // Handle clicks on pagination links
    $(document).on('click', '#pageCurr li a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPaginatedData(page);
    });

    $(document).on('click', '#pageCurr li a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPaginatedDataPend(page);
    });
});
