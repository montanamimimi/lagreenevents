export default class Gallery {
    constructor() {
        this.gallery = document.getElementById('gallery'); 
        if (!this.gallery) return;
        this.counter = +this.gallery.dataset.counter;
        this.urls = this.getUrlArray();       
        this.arrows = this.gallery.querySelectorAll('.gallery__arrow');
        this.images = this.gallery.querySelectorAll('.gallery__image');
        this.dots = this.gallery.querySelectorAll('.gallery__dot');
        this.arrows.forEach(arrow => {
            arrow.addEventListener('click', (e) => {
                this.changeImages(e.target);
            })
        })      
        this.dots.forEach(dot => {
            dot.addEventListener('click', (e) => {
                if (!dot.classList.contains('gallery__dot--active')){
                    this.changeImages(e.target);
                }                
            })
        })  
    }

    getUrlArray() {
        const images = {};        
        const blocks = document.querySelectorAll('.gallery-data');
        blocks.forEach(block => {
            images[block.dataset.key] = block.dataset.url;
        })

        return images;
    }

    changeImages(target) {

        const ids = this.getNewIds(target);
       
        this.images.forEach((image, index)=> {
            
            if (!image.classList.contains('gallery__image--small')) {
              
                image.classList.add('gallery__image--active')

                setTimeout(() => {
                    
                    image.style.backgroundImage = "url('" + this.urls[ids[index]] + "')";
                    
                    image.classList.remove('gallery__image--active')
                }, 500);

            } else {
                image.style.backgroundImage = "url('" + this.urls[ids[index]] + "')";
               
            }
            image.dataset.id = ids[index];
           
        })  
        
        const dotId = ids[1];
        this.dots.forEach(dot => {

            if (dot.dataset.id == dotId) {
                dot.classList.add('gallery__dot--active')
            } else {
                dot.classList.remove('gallery__dot--active')
            }
            
        })        
    }

    getNewIds(target) {
        let ids = []
        this.images.forEach(image => {
            const id = +image.dataset.id;
            let newId = id;

            if (target.classList.contains('gallery__arrow--right')) {                
            
                if (id == (this.counter - 1)) {
                    newId = 0;
                } else {
                    newId = id + 1;
                }
            }

            if (target.classList.contains('gallery__arrow--left')) {                
            
                if (id == 0) {
                    newId = this.counter - 1;
                } else {
                    newId = id - 1;
                }                
            }            
            
            ids.push(newId);

        })

        if (target.classList.contains('gallery__dot')) {

            const id = +target.dataset.id;  
                        
            if (id == 0) {
                ids = [this.counter - 1, 0, 1];
            } else if (id == (this.counter - 1)) {
                ids = [this.counter - 2, id, 0];
            } else {
                ids = [id - 1, id, id + 1];
            }
        
        }
       
        return ids;
    }
}
