$('#data-table').dataTable({
    "paging": false,
    "searching": false,
    "info": false,
    "order": [[1, 'desc']],
    "columnDefs": [ {
        'targets': [-1], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
  }]
});

$("#country").on('change', function() {
 event.preventDefault();
 $.ajax({
     url: "/admin-panel/countries/" + $('#country').val() + "/states",
     type: "get",
     success: function(response) {
         if (response) {
             var state = $("#state");
             var city = $("#city");
             state.empty();
             city.empty();
            
             state.append($("<option></option>").attr("value", '').text(
                 "Choose"));
             city.append($("<option></option>").attr("value", '').text(
                 "Choose"));
                
             $.each(response.states, function(id, name) {
                 state.append($("<option></option>")
                     .attr("value", id).text(name));
             });
         }
     },
     error: function(error) {
         console.log(error);
     }
 });
});

$("#state").on('change', function() {
 event.preventDefault();
 $.ajax({
     url: "/admin-panel/states/" + $('#state').val() + "/cities",
     type: "get",
     success: function(response) {
         if (response) {
             city = $("#city");
             city.empty(); // remove old options
             city.append($("<option></option>").attr("value", '').text(
                 "Choose"));
             $.each(response.cities, function(id, name) {
                 city.append($("<option></option>")
                     .attr("value", id).text(name));
             });
         }
     },
     error: function(error) {
         console.log(error);
     }
 });
});
