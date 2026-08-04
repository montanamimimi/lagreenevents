import { loadCookie } from './utils/gtm_cookie';

export default class WhatsApp {
    constructor() {            
        this.links = document.querySelectorAll('a[href*="wa.me"], a[href*="api.whatsapp.com/send"]');        
        this.addListeners();
    }

    addListeners() {
        this.links.forEach(link => {
            link.addEventListener('click', async (e) => {
                this.cookie = loadCookie();
                e.preventDefault();
                const response = await fetch(ajax_object.ajax_url, {
                    method: "POST",
                    body: new URLSearchParams({
                    action: "save_whatsapp_click",
                    utm_source: this.cookie.utm_source ? this.cookie.utm_source : '',
                    utm_campaign_id: this.cookie.utm_campaign_id ? this.cookie.utm_campaign_id : '',
                    utm_adgroup_id: this.cookie.utm_adgroup_id ? this.cookie.utm_adgroup_id : '',
                    utm_term: this.cookie.utm_term ? this.cookie.utm_term : '',
                    gclid: this.cookie.gclid ? this.cookie.gclid : '',
                    src_label: window.location.pathname,
                    feedback_email: ajax_object.feedback_email
                    })
                });

                if (response.status == 200) {
                    const postId = await response.text();  
                    const text = ajax_object.whatsapp_message;
                    const message = text
                        .replaceAll('[id]', postId)
                        .replaceAll('[newline]', '\n');

                    link.href += `&text=${encodeURIComponent(message)}`;
                }

                window.open(link.href, '_blank');                

            })
        })
    }
 
}