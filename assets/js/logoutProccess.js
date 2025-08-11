$(document).ready(function(){
    $('#signout').on('click',function(e){
        e.preventDefault();
        const href="../logoutprocess.php";
        Swal.fire({
            title: 'Do you wish to sign out?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#686de0',
            cancelButtonColor: '#f46e50',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href=href;
            }
        });
    });
});
    
    
