module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.ts',
		'./resources/**/*.vue',


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


    ],
}
