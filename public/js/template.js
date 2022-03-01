function toggleMenu() {
    let menuItems = document.getElementsByClassName('menu-item');
    for (let i = 0; i < menuItems.length; i++) {
        let menuItem = menuItems[i];
        menuItem.classList.toggle("hidden");
    }
}