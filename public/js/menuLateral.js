const btn = document.querySelector('#menu-btn');
const menu = document.querySelector('#sidemenu');

$

if(btn) {
    btn.addEventListener('click', e => {
        if (menu.classList.contains('menu-collapsed')) {
            $('.item-text').css('display', 'block');
           $('.item-separator').css('display', 'block');
           $('#items-nav').css('margin-right', '30rem');
           $('.logo-panel').css('margin-left', '100px')


        } else {
            menu.classList.remove('menu-collapsed')
            menu.classList.add('menu-expanded')
            $('.li-items').css('margin-right', '0')
            $('#items-nav').css('margin-right', '0');
            $('.logo-panel').css('margin-left', '0')
        }

        menu.classList.toggle("menu-expanded");
        menu.classList.toggle("menu-collapsed");
        document.querySelector('body').classList.toggle('body-expanded');
    })
}


$('#sidemenu').on('mouseleave', function() {
    var mediaqueryList = window.matchMedia("(min-width: 1000px)");
    if(mediaqueryList.matches) {
       if(menu.classList.contains('menu-collapsed')) {
        $('.consultar-embarque').hide();
        $('.logo-panel').css('margin-left', '0');
        $('.logo-panel').css('width', '50px');
       }
    }
});

// ocultar texto de crear nueva importacion
$('#sidemenu').on('mouseover', function() {
    var mediaqueryList = window.matchMedia("(min-width: 1000px)");
    if(mediaqueryList.matches) {
        $('.consultar-embarque').show();
        $('.logo-panel').css('margin-left', '100px');
        $('.logo-panel').css('width', '100px');

    }});
