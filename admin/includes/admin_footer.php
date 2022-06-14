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

        let div_box = "<div id='load-screen'><div id='loading'></div></div>";
        $("body").prepend(div_box);
        $("#load-screen").delay(700).fadeOut(600, function() {
            $(this).remove();
        });

        function loadUsersOnline() {
            $.get("functions.php?onlineusers=result", function(data) {
                $('.usersonline').text(data);
            })
        }

        loadUsersOnline();

        const tableBody = document.querySelector('tbody');
        console.log(tablebody);
        tableBody.addEventListener('click', function() {
            console.log("Test");
            const target = this.closest('.delete_link');
            const id = target.rel;
            alert(id);
        })
    </script>
    </body>

    </html>