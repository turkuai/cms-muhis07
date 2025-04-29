<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etusivu</title>
    <link rel="stylesheet" href="index.css">
    <script>
        const savedlinks = localStorage.getItem("link-list")
        
        const linklist = savedlinks ? JSON.parse(savedlinks) : []
        
        const savedtext = localStorage.getItem("texti")

        const textlist = savedtext ? JSON.parse(savedtext) : []
        
        async function handleload() {
            const [titleRes, linksRes, textsRes] = await Promise.all([
                fetch('admin/api/title'),
                fetch('admin/api/links'),
                fetch('admin/api/texts'),
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
</main>

<footer>
    <div class="titlee">
    <h2 ID="title"></h2>

    </div>


    <div id="link-list" class="vertical-container">

    </div>
</footer>

</body>
</html>
