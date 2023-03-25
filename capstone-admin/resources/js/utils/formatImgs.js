import { validURL } from "./validUrl";
import { be_url } from "../config/config";

// format all the imgs links
export function formatImgs(imgs) {
  return imgs.map((el, idx) => {
    if(validURL(el)) { // check the rest of the links
      return el;
    }
    else {
      return be_url + "/" + el;
    }
  });
}