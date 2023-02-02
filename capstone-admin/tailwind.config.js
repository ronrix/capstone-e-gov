/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        primary: {
          "dark": "#141419",
          "gray": "#242426",
          "red": "#B92B27",
          "red-300": "#CA4B47",
        },
        secondary: {
          "gray": "#677180",
        },
        dark: {

        },
        light: {}
      }
    },
  },
  plugins: [],
}
