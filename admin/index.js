// Tallennetaan artikkelin tiedot localStorageen
// function saveArticle(articleNumber) {
//     const textContent = document.getElementById(`article${articleNumber}Text`).value;
//     const imageUrl = document.getElementById(`article${articleNumber}Image`).value;

//     // Tallenna tiedot localStorageen
//     localStorage.setItem(`article${articleNumber}Text`, textContent);
//     localStorage.setItem(`article${articleNumber}Image`, imageUrl);

//     alert(`Artikkeli ${articleNumber} tallennettu!`);
// }

// Lataa artikkelit localStoragesta, jos tiedot on tallennettu
// function loadArticles() {
//     const article1Text = localStorage.getItem('article1Text');
//     const article1Image = localStorage.getItem('article1Image');
//     const article2Text = localStorage.getItem('article2Text');
//     const article2Image = localStorage.getItem('article2Image');

//     if (article1Text && article1Image) {
//         document.getElementById('article1Text').value = article1Text;
//         document.getElementById('article1Image').value = article1Image;
//         document.querySelector('#article1 img').src = article1Image;
//     }

//     if (article2Text && article2Image) {
//         document.getElementById('article2Text').value = article2Text;
//         document.getElementById('article2Image').value = article2Image;
//         document.querySelector('#article2 img').src = article2Image;
//     }
// }

// Lataa artikkelit ja muut tiedot localStoragesta heti sivun latauksen jälkeen
window.onload = function() {
    // loadArticles();
    loadFooterData();
};

// Lisää uusi sosiaalisen median linkki
function addSocialLink() {
    const socialLinksContainer = document.getElementById("socialLinks");
    const newLinkIndex = socialLinksContainer.children.length + 1;
    const newLink = document.createElement("a");
    newLink.href = "#";
    newLink.id = `link${newLinkIndex}`;
    newLink.textContent = `Linkki ${newLinkIndex}`;
    socialLinksContainer.appendChild(newLink);

    saveFooterData();
}

// Poista viimeinen sosiaalisen median linkki
function removeSocialLink() {
    const socialLinksContainer = document.getElementById("socialLinks");
    if (socialLinksContainer.children.length > 0) {
        socialLinksContainer.removeChild(socialLinksContainer.lastElementChild);
        saveFooterData();
    }
}

// Muuta yrityksen nimeä ja päivitä footerissa oleva nimi
document.getElementById('companyName').addEventListener('input', function() {
    const companyName = document.getElementById('companyName').value;
    document.getElementById('footerCompanyName').textContent = companyName;
    saveFooterData();
});

// Tallenna yrityksen nimi ja linkit localStorageen
function saveFooterData() {
    const companyName = document.getElementById('companyName').value;
    const socialLinks = [];
    const socialLinksContainer = document.getElementById('socialLinks');
    for (let link of socialLinksContainer.children) {
        socialLinks.push(link.textContent);
    }

    localStorage.setItem('companyName', companyName);
    localStorage.setItem('socialLinks', JSON.stringify(socialLinks));
}

// Lataa yrityksen nimi ja linkit localStoragesta
function loadFooterData() {
    const companyName = localStorage.getItem('companyName');
    const socialLinks = JSON.parse(localStorage.getItem('socialLinks'));

    if (companyName) {
        document.getElementById('companyName').value = companyName;
        document.getElementById('footerCompanyName').textContent = companyName;
    }

    if (socialLinks) {
        const socialLinksContainer = document.getElementById('socialLinks');
        socialLinksContainer.innerHTML = ''; // Tyhjennetään aiemmat linkit

        for (let linkText of socialLinks) {
            const newLink = document.createElement('a');
            newLink.href = '#';
            newLink.textContent = linkText;
            socialLinksContainer.appendChild(newLink);
        }
    }
}
