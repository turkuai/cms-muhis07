<?php





?>




<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etusivu</title>
    <link rel="stylesheet" href="../index.css">
    <script>

        // async function name() {
        //     console.log("this function")
        // }

        // name()
        // console.log("not function")

        let EditingTitleMode = false
        function TitleHandlingEdit() {
            console.log("TitleHandlingEdit", EditingTitleMode)
            EditingTitleMode = !EditingTitleMode
            console.log("after change", EditingTitleMode)

            const HeadingElement = document.getElementById("title")
            const inputElement = document.getElementById("titleinput")
            if (!EditingTitleMode) {
                const title = inputElement.value
                HeadingElement.innerHTML = title

                fetch('api/title/', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ title }),
                });
            }

            HeadingElement.hidden = EditingTitleMode
            inputElement.hidden = !EditingTitleMode
            document.getElementById("titlebutton").innerHTML = EditingTitleMode ? "save" : "edit"




        }

        const savedlinks = localStorage.getItem("link-list")

        const linklist = savedlinks ? JSON.parse(savedlinks) : []


        const savedtext = localStorage.getItem("texti")

        const textlist = savedtext ? JSON.parse(savedtext) : []




        async function handleload() {
            const [titleRes, linksRes, textsRes] = await Promise.all([
                fetch('api/title'),
                fetch('api/links'),
                fetch('api/texts'),
            ]);

            const titleJson = await titleRes.json()
            const title = titleJson.title

            const linklist = await linksRes.json();
            const textlist = await textsRes.json();

            document.getElementById("title").innerHTML = title;
            document.getElementById("titleinput").value = title;

            const listElement = document.getElementById("link-list");
            const textElement = document.getElementById("texti");

            linklist.forEach(linkJson => {
                const aElement = document.createElement("a");
                aElement.innerHTML = linkJson.name;
                aElement.href = linkJson.href;
                listElement.appendChild(aElement);
            });

            textlist.forEach(textJson => {
                const hElement = document.createElement("h1");
                const pElement = document.createElement("p");
                hElement.innerHTML = textJson.title;
                pElement.innerHTML = textJson.text;
                textElement.appendChild(hElement);
                textElement.appendChild(pElement);
            });
        }

        addEventListener("load", handleload)


        function addlink(e) {


            const button = e.target
            const editmode = button.innerHTML == "+"
            const inputhidden = !editmode

            const linknimi = document.getElementById("linknimi")
            const linkfile = document.getElementById("linkfile")

            linknimi.hidden = inputhidden
            linkfile.hidden = inputhidden



            if (editmode) {
                button.innerHTML = "save"
            } else {
                button.innerHTML = "+"


                const listElement = document.getElementById("link-list")
                const aElement = document.createElement("a")


                aElement.innerHTML = linknimi.value
                aElement.href = linkfile.value

                listElement.appendChild(aElement)

                 fetch('api/links', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name: linknimi.value, href: linkfile.value }),
                });

            }






        }
        function create_text(e) {
            const button = e.target
            const editmode = button.innerHTML == "add"
            const inputhidden = !editmode

            const textarea = document.getElementById('myTextarea');
            const texttitle = document.getElementById('texttitle');

            texttitle.hidden = inputhidden;
            textarea.hidden = inputhidden;

            if (editmode) {
                button.innerHTML = "save"
            } else {
                button.innerHTML = "add"
                const textElement = document.getElementById("texti")
                const hElement = document.createElement("h1")
                const pElement = document.createElement("p")


                hElement.innerHTML = texttitle.value
                pElement.innerHTML = textarea.value

                textElement.appendChild(hElement)

                textElement.appendChild(pElement)

                 fetch('api/texts', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ title: texttitle.value, text: textarea.value }),
                });
            }

        }
    </script>
</head>

<body>

    <header>
        <div>
            <img src="https://abundberry.com/wp-content/uploads/2023/02/mango-5.webp" alt="Logo">
        </div>
        <nav>
            <a href="#">Linkki 1</a>
            <a href="#">Linkki 2</a>
            <a href="#">Linkki 3</a>
        </nav>
    </header>

    <main>


        <div id="texti" class="vertical-container">



        </div>
        <input id="texttitle" placeholder="title" hidden>
        <br>
        <textarea id="myTextarea" placeholder="texti" hidden></textarea>
        <button onclick="create_text(event)">add</button>

    </main>

    <footer>
        <div class="titlee">
            <h2 ID="title">
                <?php

                // Save to file
                // if ($_GET["type"] == "footer") {
                //     $_GET["title"];
                // }
                


                // Read from file
                
                ?>
            </h2>


            <input name="type" value="footer" hidden>
            <input id="titleinput" name="title" hidden>
            <button id="titlebutton" onclick="TitleHandlingEdit()">edit</button>

        </div>
        <p id="peratext">&copy; moha oikeudet kuuluu yrityksel</p>


        <div id="link-list" class="vertical-container">

        </div>

        <div class="vertical-container">
            <div>
                <input id="linknimi" placeholder="nimi" hidden>
                <input id="linkfile" placeholder="url" hidden>
            </div>

            <button onclick="addlink(event)">+</button>
        </div>


    </footer>

</body>

</html>