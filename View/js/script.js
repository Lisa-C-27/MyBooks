function deleteBook(BookID) {

    var r = confirm("Are you sure you want to delete!");
    if (r == true) {
        var $deleteurl = "../../Model/delete_process.php?BookID=" + BookID;
        $.ajax( {
            url: $deleteurl,
            method: 'post',
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

function updateBook() {
    $.ajax( {
        url: '../../Model/update_process.php',
        method: 'post',
        data: $('#update_form').serialize(),
        datatype: 'json',
        success: function(res) {
            console.log(res);
        },
        error: function(err) {
            console.log(err);
        }
    });
}
