
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
      //  console.log(this.end);
        const smallRadius = this.radius*0.3;  
        console.log(this.radius)   
           
        
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


        return {
            x: x - Math.round(this.radius*0.06),
            y: y + Math.round(this.radius*0.06)
        };

    }

}


export default class Wheel {
    constructor() {
        this.wheelModal = document.getElementById('wheelModal');
        if (!this.wheelModal) return;    
        this.wheel = document.getElementById('wheel'); 
        this.form = document.getElementById('wheelForm');
        this.close = this.wheelModal.querySelectorAll('.close__item');
        this.size = this.getSize();        
        this.data = this.collectData();
        this.ctx = this.wheel.getContext('2d');
        this.arcs = [];


        this.form.addEventListener('submit', (e) => {
            e.preventDefault()
            console.log('test');
        })

        this.close.forEach(item => {
            item.addEventListener('click', () => {                
                this.wheelModal.classList.remove('wheel--active');
            })
        })
        this.draw();
    }
    
    collectData() {
        const block = document.getElementById('wheelData');
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
        this.drawWhiteCircle();   
        const radius = Math.round(this.size/2);
        const width = 0.8*radius;
        const newRadius = radius - width/2 - 6;          
        const counter = this.data.length;
        const arcAngle = (2 * Math.PI)/counter;
        let startAngle = 0;
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
   
    }

    drawArrow() {
        const center = Math.round(this.size/2);
        const startX = 0 + center + center*0.16;  
        const startY = 0 + center - 20;
        const midX   = 20 + center + center*0.16; 
        const midY   = center;
        const endY   = 20 + center;
        const radius = 10;  

      

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



}
