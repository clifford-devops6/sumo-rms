module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.ts',
		'./resources/**/*.vue',
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}'


	],
	theme: {
		extend: {
            fontFamily: {
                'Spartan': ['"League Spartan"', 'sans-serif'],
                'Roboto': ['"Roboto Condensed"', 'sans-serif'],
            },
            zIndex: {
                '1000': '1000',

            },

        },
	},
	plugins: [
        require("daisyui"),
        require('flowbite/plugin')


    ],
}
