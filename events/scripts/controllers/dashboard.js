function showDashMenu(){
    var x = document.getElementById('dashboard_menu');
    var y = document.getElementById('dashboard_menu_button');
    y.style.visibility="collapse";
    x.style.visibility="visible";
}

function closeDashMenu(){
    var x = document.getElementById('dashboard_menu');
    x.style.visibility="collapse";
    var y = document.getElementById('dashboard_menu_button');
    y.style.visibility="visible";
}
