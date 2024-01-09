/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/views/*.php", "./app/views/components/*.html","./app/views/components/*.php","./app/views/**/*.php"],
  theme: {
    extend: {},
  },
  plugins: [
    function ({ addVariant }) {
      addVariant("child", "& > *");
    },
  ],
};
