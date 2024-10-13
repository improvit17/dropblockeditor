/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './src/**/*.php',
        './src/Buttons/*.php',
        './config/*.php',
        './resources/js/*.js'
    ],
    theme: {
        extend: {},
    },
    corePlugins: {
        preflight: false,
    },
    plugins: [],
    prefix: 'tw-editor-',
}
