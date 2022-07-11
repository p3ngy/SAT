        </div>
    </body>
    <script>
        function navFunction() {
            var x = document.getElementById("nav");
            if (x.className === "nav") {
                x.className += " responsive";
            } else {
                x.className = "nav";
            }
        }

        function showTimetable() {
            var x = document.getElementById("timetable");
            if (x.style.display === "flex") {
                x.style.display = "none";
            } else {
                x.style.display = "flex";
            }
        }
    </script>
</html>