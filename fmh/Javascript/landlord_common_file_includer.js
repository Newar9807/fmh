var nav, div, aside, doc;
var parser = new DOMParser();


// common navbar
nav = document.querySelector('.navbar');
fetch('navbarLandlord.html')
.then(res=>res.text())
.then(data=>{
    nav.innerHTML=data;
    doc = parser.parseFromString(data, 'text/html');
    eval(doc.querySelector('script').textContent)
})


// mini menu
aside = document.querySelector('.extentedUserMenuClass');
fetch('extentedMenuLandlord.html')
.then(res=>res.text())
.then(data=>{
    aside.innerHTML=data;
})


// fetching common contents : social-share & footer
div = document.querySelector('.socialMainContaineer');
fetch('socialShare.html')
.then(res=>res.text())
.then(data=>{
    div.innerHTML = data;
    doc = parser.parseFromString(data, 'text/html');
    eval(doc.querySelector('script').textContent)
})


// common footer
footer = document.querySelector('.footerbar');
fetch('footer.html')
.then(res=>res.text())
.then(data=>{
    footer.innerHTML = data;
})