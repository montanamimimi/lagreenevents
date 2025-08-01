export default class Diagram {
    constructor() {
        this.canvas = document.getElementById('canvas');
        if (!this.canvas) return;
        this.data = this.collectData();
        this.draw()
       // this.canvas.addEventListener('mousemove', this.handleMouseMove);
        this.canvas.addEventListener('click', () => {
            console.log('clicked');
        })
    }

    collectData() {
        const block = document.getElementById('diagramData');
        const data = JSON.parse(block.dataset.items);
        console.log(data);
        return data;
    }

    draw() {
        let ctx = this.canvas.getContext('2d');



        const size = 650;
        this.canvas.width = size;
        this.canvas.height = size;
        let startAngle = 0;
        let endAngle = Math.PI/5;
        let radius = 100;
        let cx = size / 2;
        let cy = size / 2;  
        const color = "#808D54";

        this.data.forEach(item => {
            ctx.beginPath();
            ctx.lineWidth = 30;
            ctx.strokeStyle = color;            
            ctx.arc(cx, cy, radius, startAngle, endAngle, false);
            ctx.stroke();
            ctx.closePath();
            startAngle = endAngle + Math.PI/10;
            endAngle = endAngle + Math.PI/10 + Math.PI/5;
        })


    }

    handleMouseMove(event) {
        console.log(event);
    }    

}
