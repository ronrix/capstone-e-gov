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
        bggray: "#F2F2F2",
        primarylight: "#CD4945",
        darkgray: "#434343",
        secondary: "#6E6E73",
        bgLightyBlue: "#DFEBF7",
        bgReddy: "#F3E8F2",
        bgGreeny: "#DAF1F0",
      }
    },
  },
  plugins: [],
}
