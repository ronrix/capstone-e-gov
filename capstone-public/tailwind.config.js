/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'display': ['Playfair Display SC', 'sans-serif']
      },
      colors: {
        primary: "#B92B27",
        darkgray: "#434343",
        secondary: "#6E6E73",
      }
    },
  },
  plugins: [],
}
