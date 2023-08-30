/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    colors: {
      'primary-color': '#d9b1fa',
      'secondary-color': '#a63dfc',
    }
  },
  plugins: [],
}