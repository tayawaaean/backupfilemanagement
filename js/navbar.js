let menuToggle = document.querySelector('.logo_icon');
let sidebar = document.querySelector('.sidebar');
const viewPanel = document.getElementById('view-panel');

menuToggle.onclick= function(){
    //menuToggle.classList.toggle('active-menu');
    sidebar.classList.toggle('active');
    viewPanel.classList.toggle('menu-active');

    }
    let Menulist = document.querySelectorAll('.menulist li');
    function activeLink(){
        Menulist.forEach((item)=>
            item.classList.remove('active'));
            this.classList.add('active')
    }
    Menulist.forEach((item) =>
    item.addEventListener('click', activeLink));

