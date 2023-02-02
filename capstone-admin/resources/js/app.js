import './bootstrap';
import $ from "jquery";

// starting alpine
import Alpine from 'alpinejs';
window.Alpine = Alpine;

if(!localStorage.getItem("theme")) {
    localStorage.setItem("theme", JSON.stringify("dark"));
}
Alpine.store('darkMode', {
    on: JSON.parse(localStorage.getItem("theme")),
    toggle() {
        const theme = JSON.parse(localStorage.getItem("theme"));
        if(theme === "dark") {
            localStorage.setItem("theme", JSON.stringify("light"));
            this.on = JSON.parse(localStorage.getItem("theme"));
        }
        else {
            localStorage.setItem("theme", JSON.stringify("dark"));
            this.on = JSON.parse(localStorage.getItem("theme"));
        }
    }
})


Alpine.start();