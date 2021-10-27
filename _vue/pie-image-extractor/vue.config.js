// vue.config.js

if (process.env.NODE_ENV === "production") {
	module.exports = {
	  runtimeCompiler: true,
	  filenameHashing: false,
	  publicPath: "/wp-content/plugins/pie-image-extractor/",
  
	  css: {
		extract: {
		  filename: "../../../pie-image-extractor/assets/vue/css/pie-image-extractor.css",
		}
	  },
	  configureWebpack: {
		output: {
		  filename: "../../../pie-image-extractor/assets/vue/js/pie-image-extractor.js",
		}
	  },
	  chainWebpack: config => {
		config.optimization.delete('splitChunks')
	  }
	};
  } else {
	module.exports = {
	  runtimeCompiler: true
	};
  }
  