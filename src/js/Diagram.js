
class Arc {
    constructor(ctx, cx, cy, radius, start, end, color, width) {
        this.ctx = ctx;
        this.cx = cx;
        this.cy = cy;
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
        this.ctx.fillStyle = "white";
        this.ctx.font = Math.round(this.radius*0.1) + "px Marcellus";
        const coords = this.getTextCoords();
        this.ctx.fillText(text, coords.x + Math.round(this.radius*0.03), coords.y);        
    }

    getTextCoords() {
        const diff = this.end - this.start;
        const angle = this.start + (diff/2);

        let x = this.cx + this.radius * Math.cos(angle);
        let y = this.cy + this.radius * Math.sin(angle);

        return {
            x: x - Math.round(this.radius*0.06),
            y: y + Math.round(this.radius*0.06)
        };

    }

    isClickInside(x, y) {
        
        let dx = x - this.cx;
        let dy = y - this.cy;
        let distance = Math.sqrt(dx * dx + dy * dy);

        let outerRadius = this.radius + this.width/2;
        let innerRadius = outerRadius - this.width*1.5;
        let inRadius = distance >= innerRadius && distance <= outerRadius;
        let angle = Math.atan2(dy, dx); 
        
        if (angle < 0) angle += 2 * Math.PI; // Normalize to [0, 2π]

        let start = this.start; // in radians
        let end = this.end;     // in radians

        if (start > 2 * Math.PI) start -= 2 * Math.PI;
        if (end > 2 * Math.PI) end -= 2 * Math.PI;

        let inAngle;
        if (start < end) {
        inAngle = angle >= start && angle <= end;
        } else {
        // Wrap around 2π
        inAngle = angle >= start || angle <= end;
        }
        let insideArc = inRadius && inAngle;
        return insideArc;
    }

}

export default class Diagram {
    constructor() {
        this.canvas = document.getElementById('canvas');
        if (!this.canvas) return;
        this.id = false;
        this.arcs = [];
        this.size = this.getSize();
        this.canvas.width = this.size;
        this.canvas.height = this.size;       
        this.data = this.collectData();
        this.items = document.querySelectorAll('.diagram__item');
        this.absolute = document.querySelector('.diagram__absolute');        
        this.absolute.style.height = this.size + 'px';  
        this.draw()
        this.canvas.addEventListener('click', (e) => {
            const rect = this.canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            this.checkArcs(x, y);
        })
        this.canvas.addEventListener("mousemove", (e) => {
            const rect = canvas.getBoundingClientRect();
            const mouseX = e.clientX - rect.left;
            const mouseY = e.clientY - rect.top;
            this.checkArcs(mouseX, mouseY);
        });     
        this.canvas.addEventListener("mouseleave", (e) => {
            this.id = false;
            let ctx = this.canvas.getContext('2d');
            ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.arcs = [];            
            this.draw();    
            this.changeItems(false);        
        });            
        
        this.items.forEach(item => {
            item.addEventListener('mouseenter', () => {
                this.id = +item.dataset.id;
                let ctx = this.canvas.getContext('2d');
                ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.arcs = [];            
                this.draw(this.id);     
            });
            item.addEventListener('mouseleave', () => {
                this.id = false;
                let ctx = this.canvas.getContext('2d');
                ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.arcs = [];            
                this.draw();    
            });

            item.addEventListener('click', () => {               
                this.id = +item.dataset.id;
                let ctx = this.canvas.getContext('2d');
                ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.arcs = [];            
                this.draw(this.id);   
                this.changeItems(this.id);   
            });            
        })

        window.addEventListener('resize', () => {    
            this.size = this.getSize();
            this.canvas.width = this.size;
            this.canvas.height = this.size;      
            this.absolute.style.height = this.size + 'px';          
            this.id = false;
            this.arcs = []; 
            let ctx = this.canvas.getContext('2d');
            ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.draw();
        });   
    }

    getSize() {

        if (window.innerWidth > 1300) {
            return 640;
        } else if (window.innerWidth > 1200) {
            return 540;
        } else if (window.innerWidth > 1000) {
            return 440;
        } else {
            return window.innerWidth - 100;
        }
       
    }

    checkArcs(x, y) {
        let i = false;
        this.arcs.forEach((arc, index) => {
            const inside = arc.isClickInside(x, y);
            if (inside) {
                i = index;
                return;
            }
        })
        if ((i !== false) && i !== this.id) {
            this.id = i;
            let ctx = this.canvas.getContext('2d');
            ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.arcs = [];
            this.draw(i)
            this.changeItems(i);
        }
    }

    changeItems(i) {
        this.items.forEach(item => {            
            if (i === +item.dataset.id) {
                item.classList.add('diagram__item--active');
            } else {
                item.classList.remove('diagram__item--active');
            }
        })        
    }

    collectData() {
        const block = document.getElementById('diagramData');
        const data = JSON.parse(block.dataset.items);
        let arr = [];
        let summ = 0;
        let ps = [];

        data.forEach(item => {
            arr.push((+item.percent_from + +item.percent_to)/2);
        })

        arr.forEach(item => {
            summ += item;
        })

        arr.forEach(item => {
            const num = item/summ;           
            ps.push( Math.round(num * 100) / 100);
        })

        return ps;
    }

    draw(i = false) {        
        
        const color = 'rgba(128, 141, 84, ';    
        const gap = Math.PI/20;        
        const counter = this.data.length;
        let availableArc = Math.PI*2 - gap*counter;       
        let ctx = this.canvas.getContext('2d');
        let startAngle = Math.PI+1;
        let endAngle = 0;
        let width = this.size/8;
        let radius = (this.size - width) / 2;        
        let cx = this.size / 2;
        let cy = this.size / 2;  
        let colorChanger = 0.9;
        let currentColor = color + '1)';   

        this.data.forEach((item, index) => {     
            
            endAngle = startAngle + item*availableArc;   
            if ((i !== false) && (i === index)) {
                const arc = new Arc(ctx, cx, cy, radius - radius*0.15, startAngle, endAngle, currentColor, width);
                this.arcs.push(arc);
                arc.draw(index+1);
            } else {
                const arc = new Arc(ctx, cx, cy, radius, startAngle, endAngle, currentColor, width);
                this.arcs.push(arc);
                arc.draw(index+1);
            }

            currentColor = color + colorChanger + ')';
            colorChanger = colorChanger - 0.1;
            startAngle = endAngle + gap;           
        })


    }  

}
