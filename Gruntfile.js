module.exports = function(grunt) {
    grunt.config.init({
        netteAssets: {
            target: {
                taskName: 'cms',
                config: 'app/config/assets.yaml',
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
    grunt.loadNpmTasks('grunt-nette-assets');


    return grunt.registerTask('default', ['netteAssets', 'uglify', 'cssmin']);
};
