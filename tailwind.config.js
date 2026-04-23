/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './page-templates/**/*.php',
    './template-parts/**/*.php',
  ],
  theme: {
    fontFamily: {
      bodoni: ['bodoni-moda', 'serif'],
      'open-sans': ['open-sans', 'sans-serif'],
    },

    extend: {
      letterSpacing: {
        // wide: '.038em',
        // wider: '.06em',
      },
      colors: {
        'brown': '#B39E87',
        'off-white': '#F1F2ED',
        'wine': '#874644',
        'sand': '#E8D4B3',
      },
      transitionTimingFunction: {
        'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
      },
      gridTemplateRows: {
        masonry: 'masonry',
      },
    },
  },
  plugins: [],
};
