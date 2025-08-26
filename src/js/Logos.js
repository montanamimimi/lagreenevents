export default class Logos {
    constructor() {
        this.container = document.getElementById('scrollContainer');    
        if (!this.container) return;

        this.inner = document.getElementById('scrollInner');
        this.container.addEventListener('mouseenter', this.scroll.bind(this));
        this.container.addEventListener('mouseleave', this.stop.bind(this));
        this.container.addEventListener('touchstart', this.scroll.bind(this));  
    }

    scroll() {

        const screenWidth = window.innerWidth;
        let targetWidth = 1780;

        if (screenWidth < 1000) {
            targetWidth = 1400;
        } 

        if (screenWidth < 480) {
            targetWidth = 1020;
        }         

        const scrollAmount = screenWidth - targetWidth;

        if (scrollAmount < 0) {
            const distance = Math.abs(scrollAmount);                    
            const durationSeconds = distance / 100;                                    
            this.inner.style.transition = `transform ${durationSeconds}s linear`;
            this.inner.style.transform = `translateX(${scrollAmount}px)`;
        }
    }

    stop() {
        this.inner.style.transition = `transform 0.5s ease-out`;
        this.inner.style.transform = `translateX(0)`;
    }
 
}
