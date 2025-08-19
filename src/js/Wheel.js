
class Arc {
    constructor(ctx, cx, radius, start, end, color, width) {
        this.ctx = ctx;
        this.cx = cx;
        this.cy = cx;
        this.radius = radius;
        this.start = start;
        this.end = end;
        this.color = color;  
        this.width = width;            
    }

    draw(text) {       
        this.ctx.beginPath();
        this.ctx.lineWidth = this.width;
        this.ctx.strokeStyle = this.color;            
        this.ctx.arc(this.cx, this.cy, this.radius, this.start, this.end, false);
        this.ctx.stroke();
        this.ctx.closePath();
        this.drawText(text);    
 
    }

    drawLine() {
        const angle = this.end - Math.PI*0.003;      
        const smallRadius = this.radius*0.3;          
                   
        let sx = this.cx + smallRadius * Math.cos(angle);
        let sy = this.cy + smallRadius * Math.sin(angle);

        this.ctx.save();
        this.ctx.translate(sx, sy);
        this.ctx.rotate(angle);  
        this.ctx.lineWidth = 5;
        this.ctx.strokeStyle = "white";
        this.ctx.beginPath();


        this.ctx.moveTo(0, 0);
        this.ctx.lineTo(this.radius + this.radius*0.4, 0);
        this.ctx.stroke();        
        this.ctx.restore();
    }

    drawText(text) {

        const diff = this.end - this.start;
        const angle = this.start + (diff/2);

        let x = this.cx + this.radius*0.5 * Math.cos(angle);
        let y = this.cy + this.radius*0.5 * Math.sin(angle);

        this.ctx.fillStyle = "white";
        this.ctx.font = Math.round(this.radius*0.1) + "px Inter";
        this.ctx.save();
        this.ctx.translate(x, y);
        this.ctx.rotate(angle);  
        this.ctx.fillText(text, 0, 0);  
        this.ctx.restore();

    }

    isPointInArc() {
        let startAngle = this.start % (2*Math.PI);
        let endAngle = this.end % (2*Math.PI);

        if (startAngle < endAngle) {         
            return startAngle <= 0 && 0 <= endAngle;
        } else {            
            return true;
        }      
    }    

}


export default class Wheel {
    constructor() {
        this.wheelModal = document.getElementById('wheelModal');        
        if (!this.wheelModal) return;    

        this.wheel = document.getElementById('wheel'); 
        this.form = document.getElementById('wheelForm');
        this.close = this.wheelModal.querySelectorAll('.close__item');
        this.arrow = document.getElementById('promoArrow');
        this.size = 0;                
        this.data = this.collectData();
        this.ctx = this.wheel.getContext('2d');
        this.arcs = [];
        this.angle = 1;
        this.draw = this.draw.bind(this);
        this.animId = null;
        this.speed = 0.05;

        this.form.addEventListener('submit', (e) => {
            e.preventDefault()
            const formData = new FormData(this.form);
            if (this.validate(formData)) {
                this.spin();
            }
           
        })

        this.close.forEach(item => {
            item.addEventListener('click', () => {                
                this.wheelModal.classList.remove('wheel--active');
            })
        })

        this.arrow.addEventListener('click', async () => {
            const formData = new FormData(this.form);
            const promo = formData.get("promo");
            const result = promo.toLowerCase();
            const ok = await this.checkPromo(result);
            let errorText = "";

            if (ajax_object.lang == 'ru_RU') {
                errorText += "Промокод неверный.";   
            } else {
                errorText += "Code is not correct.";   
            }                     
                
            const errorContainer = document.getElementById('wheelError');
        
            if (ok) {
                errorContainer.innerHTML = "";                   
                this.regenerateWheel()
            } else {
                errorContainer.innerHTML = errorText;
            }
        })

        this.checkLocalStorage();
    }

    regenerateWheel() {
        this.arrow.style.display = "none";
        const input = document.querySelector('.wheel__input');
        input.classList.add('wheel__input--inactive');
        this.ctx.clearRect(0, 0, this.size, this.size); 
        this.data = this.collectPromoData();
        this.draw();
        this.stopSpin();
    }

    async hashString(str) {
        const buf = await crypto.subtle.digest("SHA-256", new TextEncoder().encode(str));
        return Array.from(new Uint8Array(buf))
            .map(b => b.toString(16).padStart(2, "0"))
            .join("");
    }    
        
    async checkPromo(input) {
        const inputHash = await this.hashString(input);
        return inputHash === ajax_object.hash; 
    }

    checkLocalStorage() {        

        const now = Date.now();
        const lastSpin = localStorage.getItem("lastSpin");

        if (!(lastSpin && (now - lastSpin < 24 * 60 * 60 * 1000))) {

            setTimeout(() => {           
                this.activateWheel();
            }, 5000);
            localStorage.setItem("lastSpin", now);
        } 
        
    }

    activateWheel() {
        this.wheelModal.classList.add('wheel--active');
        this.size = this.getSize();                
        this.draw();
        this.stopSpin();
    }

    stopSpin() {
        cancelAnimationFrame(this.animId);
        this.animId = null;
        this.speed = 0.05;
    }
    validate(data) {

        let error = false;
        let errorText = "";   
        
        if (data.has('phone')) {
            if (!this.isPhoneNumber(data.get('phone'))) {
                error = true;
                if (ajax_object.lang == 'ru_RU') {
                    errorText += "Введите корректный номер. ";   
                } else {
                    errorText += "Please enter phone. ";   
                }                     
                
            }
        }

        const errorContainer = document.getElementById('wheelError');

        if (error) {            
            errorContainer.innerHTML = errorText;            
        } else {
            errorContainer.innerHTML = "";   
        }

        return !error;
    }

    spin() {
        this.form.style.display = "none";
        document.getElementById('wheelText').innerText = "";
        this.angle = Math.random()*10;

        [1000, 1500, 2000, 2500, 3000, 3500, 4000, 5000, 6000, 7000].forEach((delay, i) => {
        setTimeout(() => {           
            this.speed = this.speed - 0.005;
            if (i == 9) {
                this.stopSpin();
                this.getPromo();
            }
        }, delay);
        });
           
        if (!this.animId) {
            this.animId = requestAnimationFrame(this.draw); 
        }
      
    }

    getPromo() {
        const header = document.getElementById('wheelHeader');        
        const prize = document.getElementById('promoPrize');
        const promo = document.querySelector('.wheel__promo');

        if (ajax_object.lang == 'ru_RU') {
            header.innerHTML = 'Поздравляем!';
        } else {
            header.innerHTML = 'Congratulations!';            
        }        
            
        promo.style.display = "flex";
        const prizeId = this.getPointer();
        prize.innerText = this.data[prizeId].text;

              
        this.savePost(prizeId);    
    
    }

    async savePost(id) {
        const formData = new FormData(this.form);
        const response = await fetch(ajax_object.ajax_url, {
            method: "POST",
            body: new URLSearchParams({
            action: "save_wheel_result",
            prize: this.data[id].text,
            phone: formData.get("phone"),  
            promo: formData.get("promo"),    
            })
        });

        const code = document.getElementById('promoCode');
        const result = await response.text();
        code.innerHTML = result;

        return result;
        
    }

    getPointer() {

        let index = 0;

        this.arcs.forEach((arc, i) => {
           
            if (arc.isPointInArc()) {
                index = i;            
            }
        })

        return index;
    }
    
    collectData() {
        const block = document.getElementById('wheelData');
        const data = JSON.parse(block.dataset.items);
        return data;
    }    

    collectPromoData() {
        const block = document.getElementById('wheelPromoData');
        const data = JSON.parse(block.dataset.items);
        return data;
    }       

    getSize() {
        const rect = this.wheel.getBoundingClientRect();
        this.wheel.width = rect.width;
        this.wheel.height = rect.width;
        return rect.width;
    }

    draw() {
        this.ctx.clearRect(0, 0, this.size, this.size); 
        let startAngle = this.angle;
        this.arcs = [];
        this.drawWhiteCircle();   
        const radius = Math.round(this.size/2);
        const width = 0.8*radius;
        const newRadius = radius - width/2 - 6;          
        const counter = this.data.length;
        const arcAngle = (2 * Math.PI)/counter;        
        let endAngle = startAngle + arcAngle;
        let currentColor = "#808D54";

        this.data.forEach((item, index) => {
            const arc = new Arc(this.ctx, radius, newRadius, startAngle, endAngle, currentColor, width);
            this.arcs.push(arc);
            arc.draw(item.text);
            startAngle = endAngle;
            endAngle = startAngle + arcAngle;

            if (index % 2 === 0) {
                currentColor = "#99A173";
            } else {
                currentColor = "#808D54";
            }

        })

        this.arcs.forEach(arc => {
            arc.drawLine();
        })

        this.drawArrow();        
        this.angle += this.speed;
        this.animId = requestAnimationFrame(this.draw)
    }

    drawArrow() {
        const center = Math.round(this.size/2);
        const padding = Math.round(center*0.06);
        const startX = 0 + center + center*0.16;  
        const startY = 0 + center - padding;
        const midX   = padding + center + center*0.16; 
        const midY   = center;
        const endY   = padding + center;
        const radius = padding/2;    

        this.ctx.fillStyle = "white";
        this.ctx.beginPath();
        this.ctx.moveTo(startX, startY);
        this.ctx.lineTo(midX - radius, startY + (midY - startY) / 2); // approach curve start
        this.ctx.arcTo(midX, midY, midX - radius, endY - (endY - midY) / 2, radius);
        this.ctx.lineTo(startX, endY);
        this.ctx.closePath();
        this.ctx.fill();
    }

    drawWhiteCircle() {      

        const radius = Math.round(this.size/2);
        const width = radius - radius*0.12;
        const newRadius = radius - width/2;
       
        this.ctx.beginPath();     
        this.ctx.lineWidth = width;
        this.ctx.strokeStyle = "white";            
        this.ctx.arc(radius, radius, newRadius, 0, 2 * Math.PI);
        this.ctx.stroke();    ;
        this.ctx.closePath();
 
    }


    isPhoneNumber(value) {
        return /^(\+?\d{1,3}[- ]?)?\d{10}$/.test(value);
    }
}
