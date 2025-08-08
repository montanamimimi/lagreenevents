export default class Gallery {
    constructor() {
        this.gallery = document.getElementById('testimonials'); 
        if (!this.gallery) return;
        this.slider = document.getElementById('testimonialSlider');    
        this.arrows = this.gallery.querySelectorAll('.testimonials__arrow');
        this.leftArrows = this.gallery.querySelectorAll('.testimonials__arrow--left');
        this.rightArrows = this.gallery.querySelectorAll('.testimonials__arrow--right');
        this.currentIndex = 0;
        this.startX = false;

        this.slider.addEventListener('touchstart', (e) => {
            this.startX = this.getClientX(e);
        })
        
        this.slider.addEventListener('touchend', (e) => {
            this.onEnd(e);
        });

        if (window.innerWidth > 1300) {
            this.visibleItems = 3;
        } else {
            this.visibleItems = 1;
        }

        this.totalItems = this.slider.children.length;
        this.dots = this.gallery.querySelectorAll('.testimonials__dot');

        this.arrows.forEach(arrow => {           
            arrow.addEventListener('click', (e) => {               
                this.checkButton(e.target);
            })
        })      
        this.dots.forEach(dot => {
            dot.addEventListener('click', (e) => {
                if (!dot.classList.contains('testimonials__dot--active')){
                    this.checkButton(e.target);
                }                
            })
        })  

        window.addEventListener('resize', () => {
            this.resetData();
        });        
    }

    getClientX(e) {
        if (e.touches && e.touches[0]) return e.touches[0].clientX;
        if (e.changedTouches && e.changedTouches[0]) return e.changedTouches[0].clientX;
        return e.clientX;
    }    

    onEnd(e) {
        const currentX = this.getClientX(e);   

        if ((this.startX - currentX) < 50 ) {
            
            if (this.currentIndex == 0) {            
                this.currentIndex = this.totalItems - 1;                
            } else {   
                this.currentIndex--;                
            }                            
        }

        if ((this.startX - currentX) > 50 ) {
         
            if (this.currentIndex == (this.totalItems - 1)) {
                this.currentIndex = 0;                
            } else {
                this.currentIndex++;                
            }
        }

        this.updateSlider(-this.currentIndex * 100);
    }

    resetData() {
        this.currentIndex = 0;
        this.slider.style.transform = "unset";
        this.disableButtons(this.leftArrows);
        this.enableButtons(this.rightArrows);   
        if (window.innerWidth > 1300) {
            this.visibleItems = 3;
        } else {
            this.visibleItems = 1;
        }

        this.dots.forEach(dot => {
            if (dot.dataset.id == 0) {
                dot.classList.add('testimonials__dot--active');
            } else {
                dot.classList.remove('testimonials__dot--active');
            }
        })        
    }

    enableButtons(buttons) {        
        buttons.forEach(button => {
            button.classList.remove('testimonials__arrow--inactive');
        })
    }

    disableButtons(buttons) {        
        buttons.forEach(button => {
            button.classList.add('testimonials__arrow--inactive');
        })
    }    

    checkButton(target) {       

        if (target.classList.contains('testimonials__arrow--right')) {
            if (this.currentIndex < (this.totalItems - this.visibleItems)) {
                this.currentIndex++;                    
                this.updateSlider()
                this.enableButtons(this.leftArrows);    

                if (this.currentIndex == (this.totalItems - this.visibleItems)) {
                    this.disableButtons(this.rightArrows);
                }

            }            
        }

        if (target.classList.contains('testimonials__arrow--left')) {
            if (this.currentIndex > 0) {
                this.enableButtons(this.rightArrows);   
                this.currentIndex--;
                this.updateSlider()     
                if (this.currentIndex == 0) {
                    this.disableButtons(this.leftArrows);
                }                   
            }
    
        }

        if (target.classList.contains('testimonials__dot')) {
            const id = +target.dataset.id
            this.currentIndex = id;
            this.updateSlider(-id*100);

            if (id == 0) {
                this.disableButtons(this.leftArrows);
                this.enableButtons(this.rightArrows);   
            } else if (id == this.totalItems - 1) {
                this.disableButtons(this.rightArrows);
                this.enableButtons(this.leftArrows); 
            } else {
                this.enableButtons(this.rightArrows); 
                this.enableButtons(this.leftArrows); 
            }
        }
    }

    updateSlider(shift = false) {
        
        if (!shift) {
            shift = -(this.currentIndex * (100 / this.visibleItems));        
        }        
        
        this.slider.style.transform = `translateX(${shift}%)`;

        const id = - shift/100;

        this.dots.forEach(dot => {
            if (dot.dataset.id == id) {
                dot.classList.add('testimonials__dot--active');
            } else {
                dot.classList.remove('testimonials__dot--active');
            }
        })
    }    

}
