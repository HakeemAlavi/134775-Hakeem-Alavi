function showUsers(){  
    $.ajax({
        url:"../admin/view-users.php",
        method:"post",
        data:{record:1},
        success:function(data){
            //$('.users').html(data);
            $('.allContent-section').load("../admin/view-users.php .users");

        }
    });
}

//delete user data
function userDelete(id){
    $.ajax({
        url:"../controller/deleteUserController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Successfully deleted');
            $('form').trigger('reset');
            showUsers();
        }
    });
}