// tailwind.config.js
module.exports = {
  content: [ "./resources/**/*.blade.php", "./resources/**/*.js" ],
  theme: {
    extend: {
      colors: {
        'makecents-green': '#1d3d33', // Hijau tua dari logo
      },
      fontFamily: {
        'sans': ['Inter', 'sans-serif'],
      }
    },
  },
  plugins: [],
}