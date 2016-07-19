module.exports = {
	dist: {
		files: [{
			expand: false,
			src: 'assets/src/sass/components/_fonts.scss',
			dest: 'assets/src/sass/components/_fonts.scss'
		}],
		options: {
			replacements: [{
				pattern: /url\('Montserrat/ig,
				replacement: 'url(\'../fonts/montserrat/Montserrat'
			},
				{
					pattern: /url\('..\/font\/icons-dynamicwinners/ig,
					replacement: 'url(\'../fonts/icons/font/icons-dynamicwinners'
				}]
		}
	}
};
