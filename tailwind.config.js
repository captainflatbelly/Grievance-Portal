/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",           // Include the root HTML file
    "./**/*.php",             // Include all PHP files in all directories
    "./complaints/**/*.php",  // Include all PHP files in the complaints directory
    "./db config/**/*.php",   // Include all PHP files in the db config directory
    "./staff/**/*.php"
  ],
  theme: {
    extend: {
      fontFamily: {
        custom: ['"Trebuchet MS"', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', 'Arial', 'sans-serif'],
      },
    },
  },
  plugins: [],
}

