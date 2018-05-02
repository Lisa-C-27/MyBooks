function deleteBook(BookID) {
//When user clicks delete, asks for confirmation first. If user confirms then runs ajax to delete the book
    var r = confirm("Are you sure you want to delete!");
    if (r == true) {
        var $deleteurl = "../../controller/delete_process.php?BookID=" + BookID;
        $.ajax( {
            url: $deleteurl,
            method: 'get',
            data: $('#deletebutton').serialize(),
            datatype: 'json',
            success: function(result) {
                console.log(result);
                //If delete was successful removes the Book without reloading the page
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
    var $updateurl = "../../controller/update_process.php?BookID=" + BookID;
    $.ajax( {
        url: $updateurl,
        method: 'post',
        data: $('#update_form').serialize(),
//        datatype: 'json',
        success: function($result) {
            console.log($result);
            $('#errorsection').html("Successfully updated");
        },
        error: function(error) {
            console.log('Didnt work');
            console.log(error);
            $('#errorsection').html("Error updating");
        }
    });
}

//Below function shows a preview of the image being uploaded in the 'add book' page
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageURL").change(function() {
    readURL(this);
});