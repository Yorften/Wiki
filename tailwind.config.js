/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/views/*.php", "./app/components/*.html","./app/components/*.php"],
  theme: {
    extend: {},
  },
  plugins: [
    function ({ addVariant }) {
      addVariant("child", "& > *");
    },
  ],
};
