import { APP_URL } from '@/Utils/AppUtils';

const svgPath = APP_URL + '/static/assets/svg/';
const imgPath = APP_URL +'/static/assets/img/';

const getUrl = (url) => {
    return new URL(url, import.meta.url).href || '';
}

const svg = {
    c: getUrl(svgPath + 'c-icon.svg'),
    cSharp: getUrl(svgPath + 'c-sharp-icon.svg'),
    dotNet: getUrl(svgPath + 'dot-net-icon.svg'),
    godot: getUrl(svgPath + 'godot-icon.svg'),
    myLogo: getUrl(svgPath + 'my-logo.svg'),
    odoo: getUrl(svgPath + 'odoo-icon.svg'),
    python: getUrl(svgPath + 'python-icon.svg'),
    tailwindCss: getUrl(svgPath + 'tailwind-css-icon.svg'),
};

const img = {
    bg1: getUrl(imgPath + 'bg1.jpg'),
    hero: getUrl(imgPath + 'hero.png'),
    projectDefaultIcon: getUrl(imgPath + 'project-default-icon.png'),
    resumeDefaultImg: getUrl(imgPath + 'resume-default-img.png'),
};

export default { svg, img }
