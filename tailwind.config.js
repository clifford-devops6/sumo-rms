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
            }
        },
	},
	plugins: [],
}
