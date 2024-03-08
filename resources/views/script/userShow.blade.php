<script>
    // Script JavaScript
    function showUserModal(user) {
        var title = "Data : " + user.nama;

        console.log(user.nama);

        // Menggunakan AJAX untuk mendapatkan data pengguna dari server
        $.ajax({
            url: '/get-user-info/' + user.id, // Sesuaikan dengan route di Laravel
            method: 'GET',
            success: function(response) {

                console.log(response);

                $('#showTitle').text(title);
                $('#namaTitle').text(response.user.nama);
                $('#unitTitle').text(response.user.unit);
                $('#nama').text(response.user.nama);
                $('#username').text(response.user.username);
                $('#unit').text(response.user.unit);
                $('#totalLapin').text(response.totalLapin);

                $('#showUser').modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


</script>
