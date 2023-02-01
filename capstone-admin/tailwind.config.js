/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        "primary-dark": "#141419",
        "secondary-dark": "#242426",
        "primary-gray": "#242426",
        "secondary-gray": "#677180",
        "red-theme": "#B92B27",
      }
    },
  },
  plugins: [],
}
