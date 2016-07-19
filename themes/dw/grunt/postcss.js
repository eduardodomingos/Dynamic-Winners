module.exports = {
	options: {
		processors: [
			require('autoprefixer')({browsers: 'last 2 versions'})
		]
	},
	dist: {
		src: 'assets/build/css/main.css'
	}
};
