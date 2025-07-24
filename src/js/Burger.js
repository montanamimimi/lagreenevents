export default class Burger {
    constructor() {
        this.burger = document.getElementById('hamburger');
        if (!this.burger) return;
        
        this.burger.addEventListener("click", (event) => {
            this.burger.classList.toggle("is-active");
            document.querySelector('.mobile-nav').classList.toggle("mobile-nav--active");
        });        
    }

}
