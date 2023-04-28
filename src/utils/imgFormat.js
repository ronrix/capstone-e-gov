import { be_url } from '../assets/config/config'

function validURL(str) {
  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\?[;&a-z\\d%_.~+=-]*)?' // query string
    ); // fragment locator
  return !!pattern.test(str);
}

// format all the imgs links
export function formatImgs(imgs) {
  return imgs.map(el => {
    if(validURL(el)) { // check the rest of the links
      return el;
    }
    else {
      return be_url + "/" + el;
    }
  });
}