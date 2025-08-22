export default class Calculator {
    constructor() {
        this.calculator = document.getElementById('calculator');
        if (!this.calculator) return;
        this.data = JSON.parse(this.calculator.dataset.inputs);
       
        this.id = 0;        
        this.answers = [];
        this.question = this.calculator.querySelector('.calculator__question');
        this.current = document.getElementById('calcCurrent');
        this.total = +this.current.dataset.total - 1;
        this.back = document.getElementById('calcBackBtn');
        this.next = document.getElementById('calcNextBtn');    
        this.error = this.calculator.querySelector('.calculator__error');
        this.options = this.calculator.querySelector('.calculator__options');
        this.contacts = this.calculator.querySelector('.calculator__contacts');

        this.back.addEventListener('click', (e) => {
            if (!e.target.classList.contains('btn--disabled')) {
                this.checkAnswers(false);
                this.changeSlide(-1);                
            }

            if (this.options.style.display == "none") {
                this.options.style.display = "block";
                this.contacts.style.display = "none";
            }                    
       
        })

        this.next.addEventListener('click', (e) => {

            if (this.id > this.total) {
                this.sendForm();
                return;                
            }
            
            if (this.checkAnswers(true)) {
                this.changeSlide(1);
            }

        })        
    }

    async sendForm() {
        const name = this.calculator.querySelector('input[type="text"]');
        const phone = this.calculator.querySelector('input[type="phone"]');     
        let err = false;   

        if (!this.isPhoneNumber(phone.value)) {
            if (ajax_object.lang == 'ru_RU') {
                this.error.innerHTML = "Введите корректный номер";
            } else {
                this.error.innerHTML = "Please enter valid phone";
            }                
           
            err = true;
        } else {
            this.error.innerHTML = "";
        }

        if (!err) {
            this.next.classList.add(`calculator__next--loading`);
            const response = await fetch(ajax_object.ajax_url, {
                method: "POST",
                body: new URLSearchParams({
                action: "send_custom_email",
                name: name.value,
                phone: phone.value,               
                answers: this.answers,
                feedback_email: ajax_object.feedback_email
                })
            });

            if (response.status == 200) {
                this.back.style.display = "none";
                this.next.style.display = "none";
            }

            const result = await response.text();
            this.contacts.innerHTML = '<p class="calculator__result">' + result + '</p>';
              
        }
        
    }

    isPhoneNumber(value) {
        return /^(\+?\d{1,3}[- ]?)?\d{10}$/.test(value);
    }

    checkAnswers(check) {
        const inputs = this.calculator.querySelectorAll('input[type="radio"]');
        let checked = false;
        inputs.forEach(input => {
            if (input.checked) {               
                checked = true;
                this.saveAnswer(+input.value)
            }
        })

        if (!checked && check) {
            if (ajax_object.lang == 'ru_RU') {
                this.error.innerHTML = 'Выберите хотя бы один вариант';
            } else {
                this.error.innerHTML = 'Please pick one option';
            }
            
        } else {
            this.error.innerHTML = '';
        }

        return checked;
    }

    saveAnswer(value) {        

        if (this.data[this.id]) {
            this.answers[this.id] = this.data[this.id].answers[value].answer_text;    
        }
  
    }

    changeSlide(add) {

        if ((add == -1) && this.id == 0) {
            return;
        }
        

        if ((add == 1) && (this.id == this.total)) {
            this.showForm();  
            this.id = this.id + add;     
            return;          
        }   

        this.id = this.id + add;            

        this.current.innerHTML = (this.id + 1);             

        if (this.id == 0) {                    
            this.back.classList.add('btn--disabled');                        
        } else {
            this.back.classList.remove('btn--disabled');
        }     
        
       
        this.changeText();
        
    }

    showForm() {
        if (ajax_object.lang == 'ru_RU') {
            this.question.innerHTML = 'Как с Вами связаться?';
        } else {
            this.question.innerHTML = 'How to contact with you?';
        }        
        
        this.options.style.display = "none";
        this.contacts.style.display = "flex";
    }

    changeText() {
        this.question.innerHTML = this.data[this.id].question_text;
        this.options.innerHTML = "";

        const answers = this.data[this.id].answers;

        answers.forEach((answer, index) => {          

            const optionDiv = document.createElement('div');
            optionDiv.className = 'calculator__option';

            const label = document.createElement('label');
            label.htmlFor = 'calc' + index;

            const input = document.createElement('input');
            input.type = 'radio';
            input.id = 'calc' + index;
            input.name = 'calculator';
            input.value = index;

            if (this.answers[this.id] && answer.answer_text == this.answers[this.id]) {                
                input.checked = true;
            }            

            const span = document.createElement('span');
            span.className = 'custom-radio';

            const text = document.createTextNode(answer.answer_text);

            label.appendChild(input);
            label.appendChild(span);
            label.appendChild(text);

            optionDiv.appendChild(label);

            this.options.appendChild(optionDiv);
        })


    }

}
