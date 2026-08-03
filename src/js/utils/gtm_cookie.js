export function loadCookie() {

    const cookieName = 'lg_src';

    const match = document.cookie.match(
        new RegExp('(?:^|; )' + cookieName + '=([^;]*)')
    );

    if (!match) {
        return {};
    }

    try {
        return JSON.parse(decodeURIComponent(match[1]));
    } catch (e) {
        return {};
    }

}