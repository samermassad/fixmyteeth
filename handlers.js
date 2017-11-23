/**
 * Created by Alvaro on 11/22/2017.
 */

function onSearchHandler() {
    var address = $('#address').val();
    var city = $('#city').val();
    var speciality = $('#speciality').val();
    var name = $('#name').val();
    $.ajax({
        type: "post",
        url: "functions.php",
        data: {functionName: 'search2', arguments: [address,city,speciality,name]},
        success: function(results, status) {
            console.log('results are', results);
            $('#results').append(results);
        },
        error: function(jqXHR, textStatus, error) {
            console.log("there was an error in the function call");
        }
    })
}