module.exports = {
	js_vendors: {
		expand: true,
		flatten: true,
		src: [
			'bower_components/bootstrap/dist/js/bootstrap.js',
			'bower_components/slick-carousel/slick/slick.js',
			'bower_components/autosize/dist/autosize.js'
		],
		dest: 'assets/src/js/vendors/'
	}
};
