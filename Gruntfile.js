module.exports = function(grunt) {
    grunt.config.init({
        assets: {
            target: {
                config: 'app/config/assets.neon',
                basePath: 'www/'
            }
        },
        cssmin: {
            options: {
                rebase: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-webchemistry-assets');


    return grunt.registerTask('default', ['assets', 'uglify', 'cssmin']);
};
