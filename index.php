<!DOCTYPE html>

<html>

<body>


<h2>Get data as JSON from a PHP file on the server.</h2>


<p>The JSON received from the PHP file:</p>


<p id="demo"></p>


<script>

        var obj, dbParam, xmlhttp, myObj, i, store="";


        obj = { "table":"employees", "position":"'android developer'" }; // Define an object containing a table property and a limit property

        dbParam = JSON.stringify(obj);

        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

                myObj = JSON.parse(this.responseText);

                for (i in myObj) {

                    store += myObj[i].name + "<br>";

                }

                document.getElementById("demo").innerHTML = store;

            }

        };

        xmlhttp.open("GET", "server-side.php?x=" + dbParam, true);

        xmlhttp.send();


</script>


</body>

</html>