
const colors = require('tailwindcss/colors')

module.exports = {
  purge: [],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    extend: {
      colors:{
        // Customisable colours for company theme
        'custom': '#0891B2',
        'custom-hover': '#0E7490',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
