let pageService = 1;
let pagePend = 1;

/*
TODO: adicionar CSS com o AJAX nos elementos da tabela
 */

function attrRequestType(elem,requestTypeTd){
    if(elem.requesttype === "Create"){
        let span = $('<span></span>');
        requestTypeTd.append(span);
        span.html(elem.requesttype);
        span.attr("class","badge bg-primary");
    }
    else if(elem.requesttype === "Edit"){
        let span = $('<span></span>');
        requestTypeTd.append(span);
        span.html(elem.requesttype);
        span.attr("class","badge bg-info");
    }
    else{
        let span = $('<span></span>');
        requestTypeTd.append(span);
        span.html(elem.requesttype);
        span.attr("class","badge bg-warning text-white");
    }
}

function attrRequestStatus(elem,requestStatusTd){
    if(elem.requeststatus === "Accepted"){
        let span = $('<span></span>');
        requestStatusTd.append(span);
        span.html(elem.requeststatus);
        span.attr("class","badge bg-success text-white");
    }
    else{
        let span = $('<span></span>');
        requestStatusTd.append(span);
        span.html(elem.requeststatus);
        span.attr("class","badge bg-danger text-white");
    }
}

function getPaginatedData(page) {
    pageService = page;
    var serviceNames=document.getElementById("serviceNamesList").textContent.split(",");
    $.ajax({
        url: '/admin/servicesCurrent?page=' + page,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            let data = response.data;
            let tbody = $('#CurrServiceTable');

            //Clear tbody 
            tbody.empty();
            console.log("Hello")
            
            for (let i = 0; i < data.length ; i++) {
                let tr = $('<tr></tr>');
              
                let serviceNameTd = $('<td></td>').html(serviceNames[data[i].servicenameid-1]);
                let dateCreatedTd = $('<td></td>').html(data[i].datecreated);
                let requestTypeTd = $('<td></td>');
                let requestStatusTd = $('<td></td>');
                let requestActions = $('<td></td>').html(data[i].datereviewed);

                /*Bootstrap*/
                attrRequestStatus(data[i],requestStatusTd);

                /*Bootstrap Request Type*/
                attrRequestType(data[i],requestTypeTd);


                let serviceLink = $('<a></a>').html(data[i].servicenameenglish);
                serviceLink.attr("href","../service/"+ data[i].serviceId);
                serviceNameTd.append(serviceLink);

                let serviceEmail = $('<p></p>').html(data[i].emailcontact);
                serviceEmail.attr("class","text-muted");
                serviceNameTd.append(serviceEmail);

                tr.append(serviceNameTd);
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
    pagePend = page;
    var serviceNames=document.getElementById("serviceNamesList").textContent.split(",");
    $.ajax({
        url: '/admin/servicesPending?page=' + page,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            let data = response.data;
            let tbody = $('#pendingTable');

            //Clear tbody 
            tbody.empty();
            
            for (let i = 0; i < data.length ; i++) {
                let serviceId = data[i].serviceid;
                let tr = $('<tr></tr>');
                let serviceNameTd = $('<td></td>').html(serviceNames[data[i].servicenameid-1]);
                let dateCreatedTd = $('<td></td>').html(data[i].datecreated);
                let requestTypeTd = $('<td></td>');
                let requestStatusTd = $('<td></td>');
                /*Bootstrap Request Type*/
                attrRequestType(data[i],requestTypeTd);

                /*Bootstrap Request Type*/
                attrRequestStatus(data[i],requestStatusTd);

                // create the form element
                // create the button element
                let buttonGreen = $('<button/>', {
                    class: 'btn btn-success',
                    text: 'Accept'
                });
                
                // create the form element and append the button to it
                let formAccept = $('<form/>', {
                    id: "formAccept",
                    action: '/requests/services/' + serviceId + '/Accepted',
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

                var idInput = $('<input/>', {
                    type: 'hidden',
                    name: 'id',
                    value: serviceId
                    });

                // append the CSRF token input element to the form
                formAccept.append(csrfInput);
                formAccept.append(idInput);
                
                // create the form element and append the button to it
                let formReject = $('<form/>', {
                    id: "formReject",
                    action: '/requests/services/' + serviceId+ '/Accepted',
                    method: 'POST',
                    data:{"_token": "{{ csrf_token() }}"}
                }).append(buttonRed);

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // create the hidden input element for the CSRF token
                var csrfInput = $('<input/>', {
                type: 'hidden',
                name: '_token',
                value: csrfToken
                });

                var idInput = $('<input/>', {
                    type: 'hidden',
                    name: 'id',
                    value: serviceId
                    });

                // append the CSRF token input element to the form
                formReject.append(csrfInput);
                formReject.append(idInput);
                
                // create the td element and append the form to it
                var td = $('<td></td>');
                td.attr("class", "d-flex");
                formAccept.attr("class","mx-1");
                td.append(formAccept);
                td.append(formReject);
                
                tr.append(serviceNameTd);
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

function pendingFormHandler(action,id,token){
    $.ajax({
        url: '/requests/services/' + id + '/' + action,
        type: 'post',
        dataType: 'json',
        headers:{
            'X-CSRF-Token': token
        },
        success: function(response) {
            getPaginatedData(pageService);
            getPaginatedDataPend(pagePend);
    },
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

    $(document).on('click', '#pagePend li a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPaginatedDataPend(page);
    });

    $(document).on('submit', '#formAccept', function(e) {
        e.preventDefault(); // prevent the default form submission behavior
        var form = $(this);

        var token = form.find('input[name="_token"]').val(); 
        var id = form.find('input[name="id"]').val(); 
      
        pendingFormHandler("Accepted",id,token);
      });
      
    $(document).on('submit', '#formReject', function(e) {
        e.preventDefault();
        var form = $(this);
        var token = form.find('input[name="_token"]').val(); 
        var id = form.find('input[name="id"]').val(); 
        pendingFormHandler("Rejected",id,token);
    });
});
