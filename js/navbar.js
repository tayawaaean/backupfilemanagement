let menuToggle = document.querySelector('.logo_icon');
let sidebar = document.querySelector('.sidebar');

menuToggle.onclick= function(){

    }
    let Menulist = document.querySelectorAll('.menulist li');
    function activeLink(){
        Menulist.forEach((item)=>
            item.classList.remove('active'));
            this.classList.add('active')
    }
    Menulist.forEach((item) =>
    item.addEventListener('click', activeLink));

