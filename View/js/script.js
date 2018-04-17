function deleteBook(BookID) {

    var r = confirm("Are you sure you want to delete!");
    if (r == true) {
        var $deleteurl = "../../Controller/delete_process.php?BookID=" + BookID;
        $.ajax( {
            url: $deleteurl,
            method: 'get',
            data: $('#deletebutton').serialize(),
            datatype: 'json',
            success: function(result) {
                // alert('success');
                console.log(result);
                var div = document.getElementById(BookID);
                if (div.parentNode) {
                    div.parentNode.removeChild(div);
            };
            },
            error: function(error) {
                console.log(error);
            }
        });

    }

}

function updateBook(BookID) {
    var $updateurl = "../../Controller/update_process.php?BookID=" + BookID;
    $.ajax( {
        url: $updateurl,
        method: 'post',
        data: $('#update_form').serialize(),
//        datatype: 'json',
        success: function($result) {
            console.log($result);
            $('#errorsection').html("Success");
        },
        error: function(error) {
            console.log('Didnt work');
            console.log(error);
            $('#errorsection').html("Error");
        }
    });
}
