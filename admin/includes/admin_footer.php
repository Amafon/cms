    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        //Editor
        ClassicEditor.create(document.querySelector('#body')).catch(error => console.error(error));

        const selectAllBoxes = document.querySelector('#selectAllBoxes');
        const allCheckBoxes = document.querySelectorAll('.checkBoxes');

        selectAllBoxes.addEventListener('click', function() {
            allCheckBoxes.forEach(checkbox => {
                checkbox.checked = !checkbox.checked;
            })
        })

        // let div_box = "<div id='load-screen'><div id='loading'></div></div>";
        // $("body").prepend(div_box);
        // $("#load-screen").delay(700).fadeOut(600, function() {
        //     $(this).remove();
        // });

        function loadUsersOnline() {
            $.get("functions.php?onlineusers=result", function(data) {
                $('.usersonline').text(data);
            })
        }

        loadUsersOnline();

        // const deleteLink = document.querySelectorAll('.delete_link');
        // deleteLink.forEach(link => {
        //     link.addEventListener('click', function() {
        //         alert(this);
        //     })
        // })

        const table = document.querySelector('table');
        table.addEventListener('click', function(e) {
            e.preventDefault();
            const click = e.target;
            if (click.classList.contains('delete_link')) {
                const id = click.rel;
                const delete_url = `posts.php?delete=${id}`;
                const modal_delete_link = document.querySelector('.modal_delete_link');
                modal_delete_link.setAttribute('href', delete_url);
                $("#myModal").modal('show');
            }
        })
    </script>
    </body>

    </html>