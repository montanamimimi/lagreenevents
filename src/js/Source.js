export default class Source {
    constructor() {
     
        this.cookieName = 'lg_src';
        this.cookieDays = 90;

        this.params = [
            'utm_source',
            'utm_campaign_id',
            'utm_adgroup_id',
            'utm_term',
            'gclid',
        ];

        this.data = {};
    }

    init() {
     
        if (this.hasCampaignInUrl()) {
            this.data = this.readQueryParams();            
            this.saveCookie();
        } 
    }

    hasCampaignInUrl() {
        const url = new URLSearchParams(window.location.search);

        return this.params.some(param => url.has(param));
    }

    readQueryParams() {
        const url = new URLSearchParams(window.location.search);

        const result = {};

        this.params.forEach(param => {
            const value = url.get(param);

            if (value) {
                result[param] = value;
            }
        });

        return result;
    }

    saveCookie() {
        const expires = new Date();

        expires.setDate(expires.getDate() + this.cookieDays);

        document.cookie =
            `${this.cookieName}=` +
            encodeURIComponent(JSON.stringify(this.data)) +
            `; expires=${expires.toUTCString()}; path=/; SameSite=Lax`;
    }
}